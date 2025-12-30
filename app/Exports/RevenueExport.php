<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RevenueExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payment::select('invoice_no', 'name', 'total_amount', 'payment_type', 'created_at')
                      ->where('status', 'completed') 
                      ->get();
    }                  

    public function map($payment): array {
        return [
            $payment->order->order_number ?? 'N/A',
            $payment->user->name ?? 'Khách hàng',
            $payment->total_amount,
            $payment->payment_type,
            $payment->created_at->format('d/m/Y'),
        ];
    }

    public function headings(): array {
        return ["Mã Đơn Hàng","Khách hàng", "Tổng Tiền", "Phương Thức", "Trạng Thái", "Ngày Tạo"];
    }
}
