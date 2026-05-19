<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            font-size: 14px; 
            line-height: 1.6;
        }
        .header { text-align: center; margin-bottom: 30px; }
        .receipt-title { color: #2c3e50; font-size: 22px; font-weight: bold; text-transform: uppercase; }
        
        .info-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .info-table td { padding: 8px 0; border-bottom: 1px dashed #ddd; }
        .label { font-weight: bold; width: 30%; }
        
        .footer { margin-top: 50px; text-align: right; }
        .date { font-style: italic; font-size: 12px; }
        
        .stamp-wrapper { margin-top: 20px; text-align: right; }
        .stamp { 
            color: red; 
            border: 4px double red; 
            display: inline-block; 
            padding: 10px 20px; 
            font-weight: bold; 
            font-size: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="receipt-title">BIÊN LAI CHUYỂN KHOẢN HỆ THỐNG</div>
        <p>Mã giao dịch: #{{ $payroll->id }}-{{ time() }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Người nhận:</td>
            <td>{{ $payroll->instructor->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Số tài khoản:</td>
            <td>{{ $payroll->instructor->account_number ?? 'Chưa cập nhật' }}</td>
        </tr>
        <tr>
            <td class="label">Ngân hàng:</td>
            <td>{{ $payroll->instructor->bank_name ?? 'Chưa cập nhật' }}</td>
        </tr>
        <tr>
            <td class="label">Số tiền:</td>
            <td><strong style="font-size: 16px;">{{ number_format($payroll->total_amount) }} VNĐ</strong></td>
        </tr>
        <tr>
            <td class="label">Nội dung:</td>
            <td>Thanh toán lương tháng {{ $payroll->payroll_month }}</td>
        </tr>
        <tr>
            <td class="label">Trạng thái:</td>
            <td><span style="color: green; font-weight: bold;">THÀNH CÔNG</span></td>
        </tr>
    </table>

    <div class="footer">
        <p class="date">Ngày xác nhận: {{ date('d/m/Y H:i:s') }}</p>
        <div class="stamp-wrapper">
            <div class="stamp">HỆ THỐNG ĐÃ CHI</div>
        </div>
    </div>
</body>
</html>