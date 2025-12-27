<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InstructorEarning;
use App\Models\Payroll;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index() {
        $payrolls = Payroll::with('instructor')->latest()->get();
        return view('backend.admin.payroll.index', compact('payrolls'));
    }

    public function create() {
    
        $instructors = User::where('role', 'instructor')
                        ->where('status', '1') 
                        ->get();
                        
        return view('backend.admin.payroll.create', compact('instructors'));
    }

    public function store(Request $request) {
   
        $exists = Payroll::where('instructor_id', $request->instructor_id)
                        ->where('payroll_month', $request->month)
                        ->first();

        if ($exists) {
            
            $notification = array(
                'message' => 'Giảng viên này đã có bảng lương cho tháng ' . $request->month . ' rồi!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        
        $instructor = User::findOrFail($request->instructor_id);
        
        
        $courseRevenue = InstructorEarning::where('instructor_id', $instructor->id)
                            ->where('payment_status', 'pending')
                            ->sum('instructor_amount');

        Payroll::create([
            'instructor_id'   => $instructor->id,
            'payroll_month'   => $request->month,
            'fixed_salary'    => $instructor->fixed_salary, 
            'support_fee'     => $request->support_fee,    
            'course_revenue'  => $courseRevenue,
            'total_amount'    => $courseRevenue + $instructor->fixed_salary + $request->support_fee,
            'status'          => 'draft', 
        ]);

        $notification = array(
            'message' => 'Tạo bảng lương nháp thành công!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.payroll.index')->with($notification);
    }

    public function show($id) {
        $payroll = Payroll::with('instructor')->findOrFail($id);
        return view('backend.admin.payroll.payroll_details', compact('payroll'));
    }

    public function destroy($id) 
    {
        $payroll = Payroll::findOrFail($id);
        
        
        if($payroll->status == 'draft') {
            $payroll->delete();
            
            $notification = array(
                'message' => 'Đã xóa bảng lương sai, bạn có thể tạo lại cái mới.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Không thể xóa bảng lương đã duyệt hoặc đã thanh toán!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function update(Request $request, $id) {
        $payroll = Payroll::findOrFail($id);

        $support_fee = $request->support_fee;
        
        $total_amount = $payroll->fixed_salary + $payroll->course_revenue + $support_fee;

        $payroll->update([
            'payroll_month' => $request->month,
            'support_fee'   => $support_fee,
            'total_amount'  => $total_amount,
        ]);

        return redirect()->route('admin.payroll.index')->with('success', 'Đã cập nhật bảng lương thành công!');
    }

    public function edit($id) {
        $payroll = Payroll::findOrFail($id);
        return view('backend.admin.payroll.edit', compact('payroll'));
    }

    public function updateStatus(Request $request, $id) 
    {
        $payroll = Payroll::findOrFail($id);
        
       
        $payroll->update([
            'status' => 'paid'
        ]);

        
        InstructorEarning::where('instructor_id', $payroll->instructor_id)
                        ->where('payment_status', 'pending')
                        ->update(['payment_status' => 'paid']);

        
        $notification = [
            'message' => 'Bảng lương tháng ' . $payroll->payroll_month . ' đã được phê duyệt.',
            'alert-type' => 'success'
        ];

        
        return redirect()->back()->with($notification);
    }

    public function export(Request $request) 
    {
        $ids = $request->payroll_ids; 
        
        if (!$ids) {
            return redirect()->back()->with('error', 'Vui lòng chọn bảng lương!');
        }

        $payrolls = Payroll::with('instructor')->whereIn('id', $ids)->get();

        
        $fileName = 'payroll_' . date('d_m_Y') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($payrolls) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); 
            fputcsv($file, ['Tên', 'STK', 'Ngân Hàng', 'Số Tiền', 'Nội Dung']);

            foreach ($payrolls as $row) {
                fputcsv($file, [
                    $row->instructor->name,
                    $row->instructor->account_number ?? 'N/A',
                    $row->instructor->bank_name ?? 'N/A',
                    $row->total_amount,
                    "Tra luong " . $row->payroll_month
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function uploadReceipt(Request $request, $id) {
        $request->validate([
            'bank_receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $payroll = Payroll::findOrFail($id);
        if ($request->hasFile('bank_receipt')) {
            $file = $request->file('bank_receipt');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/receipts'), $filename);
            $payroll->bank_receipt = $filename;
            $payroll->status = 'paid'; 
            $payroll->save();
        }
        return redirect()->back()->with('success', 'Đã tải lên minh chứng và hoàn tất thanh toán!');
    }

    public function instructorIndex() 
    {
        $userId = auth()->id();
        
        $payrolls = Payroll::where('instructor_id', $userId)
                        ->where('status', '!=', 'draft') 
                        ->latest()
                        ->get();
                        
        return view('backend.instructor.payroll.index', compact('payrolls'));
    }

    public function instructorShow($id) {
        $payroll = Payroll::where('instructor_id', auth()->id())->findOrFail($id);
        return view('backend.instructor.payroll.payroll_view', compact('payroll'));
    }

    public function adminGenerateReceipt($id) 
    {
        $payroll = Payroll::with('instructor')->findOrFail($id);

        
        $pdf = Pdf::loadView('backend.admin.payroll.receipt_pdf', compact('payroll'))
                ->setPaper('a5', 'portrait')
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true
                ]);

        $filename = 'receipt_' . $id . '_' . time() . '.pdf';
        
        $path = public_path('upload/receipts');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pdf->save($path . '/' . $filename);

        $payroll->update([
            'bank_receipt' => $filename,
            'status' => 'paid'
        ]);

        return redirect()->back()->with('success', 'Hệ thống đã tự động xuất biên lai PDF!');
    }
}
