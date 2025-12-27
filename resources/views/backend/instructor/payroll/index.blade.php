@extends('backend.instructor.master')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Lịch sử nhận lương</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tháng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payrolls as $item)
                        <tr>
                            <td>{{ $item->payroll_month }}</td>
                            <td>{{ number_format($item->total_amount) }}đ</td>
                            <td>
                                <span class="badge bg-success">Đã duyệt</span>
                            </td>
                            <td>
                              
                                <a href="{{ route('instructor.payroll.show', $item->id) }}" class="btn btn-sm btn-primary">Xem chi tiết</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection