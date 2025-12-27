<?php

namespace App\Exports;

use App\Models\Payroll;
use Maatwebsite\Excel\Concerns\FromCollection;

class PayrollExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $payrollIds;

    
    public function __construct($payrollIds)
    {
        $this->payrollIds = $payrollIds;
    }

    public function collection()
    {
        return Payroll::with('instructor')
            ->whereIn('id', $this->payrollIds)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tên Giảng Viên',
            'Ngân Hàng',
            'Số Tài Khoản',
            'Chủ Tài Khoản',
            'Số Tiền Chuyển',
            'Nội Dung Chuyển Khoản'
        ];
    }

    public function map($payroll): array
    {
        return [
            $payroll->instructor->name,
            $payroll->instructor->bank_name,
            
            "'" . $payroll->instructor->bank_account_number, 
            strtoupper($payroll->instructor->bank_account_name),
            $payroll->total_amount,
            "THANH TOAN LUONG THANG " . $payroll->payroll_month . " CHO " . $payroll->instructor->name,
        ];
    }
}
