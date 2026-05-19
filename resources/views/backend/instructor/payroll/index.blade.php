@extends('backend.instructor.master')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Lịch sử nhận lương</h5>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tháng</th>
                            <th>Tổng tiền nhận</th>
                            <th>Trạng thái lương</th>
                            <th>Khiếu nại</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payrolls as $item)
                        <tr>
                            <td>{{ $item->payroll_month }}</td>
                            <td><strong class="text-primary">{{ number_format($item->total_amount) }}đ</strong></td>
                            <td>
                                @if($item->status == 'sent_to_instructor')
                                    <span class="badge bg-warning text-dark">Chờ đối soát</span>
                                @elseif($item->status == 'approved')
                                    <span class="badge bg-info">Đã phê duyệt</span>
                                @elseif($item->status == 'paid')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                @endif
                            </td>
                            <td>
                                @if($item->complaint_status == 'pending')
                                    <span class="badge rounded-pill bg-danger">Đang khiếu nại</span>
                                @elseif($item->complaint_status == 'resolved')
                                    <span class="badge rounded-pill bg-success">Đã giải quyết</span>
                                @else
                                    <span class="text-muted small">Không có</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('instructor.payroll.show', $item->id) }}" class="btn btn-sm btn-primary px-3">
                                    <i class='bx bx-show'></i> Xem chi tiết
                                </a>
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