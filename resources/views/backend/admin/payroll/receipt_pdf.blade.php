<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 30px; }
        .receipt-title { color: #2c3e50; font-size: 22px; font-weight: bold; }
        .info-row { margin-bottom: 10px; border-bottom: 1px dashed #ddd; padding-bottom: 5px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
        .footer { margin-top: 50px; text-align: right; font-style: italic; }
        .stamp { color: red; border: 3px double red; display: inline-block; padding: 10px; margin-top: 20px; font-weight: bold; transform: rotate(-10deg); }
    </style>
</head>
<body>
    <div class="header">
        <div class="receipt-title">BIÊN LAI CHUYỂN KHOẢN HỆ THỐNG</div>
        <p>Mã giao dịch: #{{ $payroll->id }}-{{ time() }}</p>
    </div>

    <div class="info-row"><span class="label">Người nhận:</span> {{ $payroll->instructor->name }}</div>
    <div class="info-row"><span class="label">Số tài khoản:</span> {{ $payroll->instructor->account_number }}</div>
    <div class="info-row"><span class="label">Ngân hàng:</span> {{ $payroll->instructor->bank_name }}</div>
    <div class="info-row"><span class="label">Số tiền:</span> <strong>{{ number_format($payroll->total_amount) }} VNĐ</strong></div>
    <div class="info-row"><span class="label">Nội dung:</span> Thanh toán lương tháng {{ $payroll->payroll_month }}</div>
    <div class="info-row"><span class="label">Trạng thái:</span> <span style="color: green;">THÀNH CÔNG</span></div>

    <div class="footer">
        <p>Ngày xác nhận: {{ date('d/m/Y H:i:s') }}</p>
        <div class="stamp">HỆ THỐNG ĐÃ CHI</div>
    </div>
</body>
</html>