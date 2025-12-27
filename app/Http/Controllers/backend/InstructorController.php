<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function login()
    {
        return view('backend.instructor.login.index');
    }

    public function dashboard()
    {
        return view('backend.instructor.dashboard.index');
    }
    
    public function destroy(Request $request):RedirectResponse
    {
         Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }

    public function confirmPayroll($id) {
        $payroll = Payroll::where('id', $id)
                    ->where('instructor_id', Auth::id())
                    ->firstOrFail();

        
        $payroll->update([
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Bạn đã xác nhận bảng lương thành công. Vui lòng chờ Admin chuyển khoản.');
    }
}
