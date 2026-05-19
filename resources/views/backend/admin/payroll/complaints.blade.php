@extends('backend.admin.master')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Danh sách khiếu nại lương từ giảng viên</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>GV / Tháng</th>
                            <th>Nội dung khiếu nại</th>
                            <th>Số tiền gốc</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->instructor->name }}</strong><br>
                                <small>Tháng: {{ $item->payroll_month }}</small>
                            </td>
                            <td>{{ Str::limit($item->complaint_message, 50) }}</td>
                            <td>{{ number_format($item->total_amount) }}đ</td>
                            <td>
                                @if($item->complaint_status == 'pending')
                                    <span class="badge bg-warning text-dark">Đang chờ xử lý</span>
                                @else
                                    <span class="badge bg-success">Đã giải quyết</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#resolveModal{{ $item->id }}">
                                    Xem & Xử lý
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="resolveModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.payroll.resolve', $item->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Xử lý khiếu nại: {{ $item->instructor->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nội dung giảng viên gửi:</strong></p>
                                            <div class="alert alert-secondary">{{ $item->complaint_message }}</div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Phản hồi của Admin (Gửi cho GV)</label>
                                                <textarea name="admin_response" class="form-control" rows="3" required placeholder="VD: Đã kiểm tra và cộng bù vào tháng sau..."></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="status" value="resolved" class="btn btn-success">Đánh dấu đã giải quyết</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection