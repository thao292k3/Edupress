<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\InstructorEarning;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function login()
    {
        return view('backend.admin.login.index');
    }

    public function dashboard()
    {
        $today = Carbon::today();

        $total_courses = Course::count();
        $total_students = User::where('role', 'user')->count();
        $total_instructors = User::where('role', 'instructor')->count();
        $total_revenue = Payment::where('status', 'completed')->sum('total_amount');

   
        $total_paid_payroll = Payroll::where('status', 'paid')->sum('total_amount');

    
        $recent_orders = Order::with('user')->latest()->take(5)->get();

        

        $year = date('Y');
        $monthly_revenue = [];

    
        for ($m = 1; $m <= 12; $m++) {
            $revenue = Payment::where('status', 'completed') 
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $m)
                            ->sum('total_amount');
            
            $monthly_revenue[] = $revenue;

        }    

        return view('backend.admin.dashboard.index', compact(
            'total_courses', 
            'total_students', 
            'total_instructors', 
            'total_revenue', 
            'total_paid_payroll',
            'recent_orders',
            'monthly_revenue'            
    ));
    }


        public function destroy(Request $request):RedirectResponse
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/admin/login');
        }

    

        public function adminAllEarnings(Request $request) 
        {
            
            $query = InstructorEarning::with(['instructor', 'course', 'order']);

            
            if ($request->has('status') && $request->status == 'pending') {
                $query->where('payment_status', 'pending');
            }

            $earnings = $query->latest()->get();
            
            return view('backend.admin.report.admin_all_earnings', compact('earnings'));
        }

        public function updatePaymentStatus($id) 
        {
            $earning = InstructorEarning::findOrFail($id);
            
            
            $earning->update(['payment_status' => 'paid']); 

            return redirect()->back()->with('success', 'Đã xác nhận thanh toán lương thành công!');
        }

        public function createPayroll(Request $request) {
        $instructorId = $request->instructor_id;
        $month = $request->month; 

        
        $courseData = InstructorEarning::where('instructor_id', $instructorId)
                        ->where('payment_status', 'pending')
                        ->selectRaw('SUM(instructor_amount) as total_earn, COUNT(DISTINCT order_id) as students')
                        ->first();

        
        $payroll = Payroll::create([
            'instructor_id' => $instructorId,
            'payroll_month' => $month,
            'course_revenue' => $courseData->total_earn ?? 0,
            'student_count' => $courseData->students ?? 0,
            'fixed_salary' => $request->fixed_salary, 
            'support_fee' => $request->support_fee,   
            'total_amount' => ($courseData->total_earn ?? 0) + $request->fixed_salary + $request->support_fee,
            'status' => 'draft'
        ]);

        return redirect()->back()->with('success', 'Đã tạo bảng lương tạm tính.');
}

   
}
