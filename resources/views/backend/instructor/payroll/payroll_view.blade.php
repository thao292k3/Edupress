@extends('backend.instructor.master')
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tài chính</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết bảng lương tháng
                            {{ $payroll->payroll_month }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card radius-10">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Chi tiết các khoản thu nhập</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nội dung</th>
                                        <th>Chi tiết</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lương cứng</td>
                                        <td>Theo thỏa thuận hợp đồng</td>
                                        <td>{{ number_format($payroll->fixed_salary) }}đ</td>
                                    </tr>
                                    <tr>
                                        <td>Hoa hồng khóa học</td>
                                        <td>Doanh thu từ {{ $payroll->student_count }} học viên mới</td>
                                        <td>{{ number_format($payroll->course_revenue) }}đ</td>
                                    </tr>
                                    <tr>
                                        <td>Phí hỗ trợ dạy học</td>
                                        <td>Giải đáp thắc mắc & Buổi bổ trợ</td>
                                        <td>{{ number_format($payroll->support_fee) }}đ</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2" class="text-center"><strong>TỔNG NHẬN</strong></td>
                                        <td class="text-danger">
                                            <strong>{{ number_format($payroll->total_amount) }}đ</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- PHẦN 1: Nút bấm xử lý (Hiện khi chưa xác nhận và chưa trả lương) --}}
                        {{-- PHẦN 1: Nút bấm hành động --}}
                        @if ($payroll->status != 'paid')
                            <div class="d-flex justify-content-center gap-3 mt-4">

                                {{-- Nút Xác nhận: Hiện khi chưa khiếu nại HOẶC khi Admin đã giải quyết xong --}}
                                @if ($payroll->complaint_status == 'none' || $payroll->complaint_status == 'resolved')
                                    <form action="{{ route('instructor.payroll.confirm', $payroll->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success px-5"
                                            onclick="return confirm('Xác nhận thông tin lương đã chính xác sau khi đối soát?')">
                                            <i class='bx bx-check-double'></i> Xác nhận thông tin lương OK
                                        </button>
                                    </form>
                                @endif

                                {{-- Nút Khiếu nại: Chỉ hiện khi chưa có khiếu nại nào (none) --}}
                                @if ($payroll->complaint_status == 'none')
                                    <button class="btn btn-outline-danger px-4" data-bs-toggle="modal"
                                        data-bs-target="#complaintModal">
                                        <i class='bx bx-message-error'></i> Gửi khiếu nại
                                    </button>
                                @endif

                            </div>

                            {{-- Thông báo nhắc nhở khi mới gửi --}}
                            @if ($payroll->complaint_status == 'none')
                                <div class="alert alert-info mt-3 text-center">
                                    <i class='bx bx-info-circle'></i> Vui lòng kiểm tra kỹ. Nếu sai sót hãy nhấn
                                    <strong>"Khiếu nại"</strong>. Nếu đúng nhấn <strong>"Xác nhận OK"</strong>.
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                {{-- Tài khoản ngân hàng --}}
                <div class="card radius-10">
                    <div class="card-body">
                        <h6 class="mb-3">Tài khoản nhận tiền</h6>
                        <div class="p-3 bg-light radius-10 border border-primary">
                            <small class="text-muted">Ngân hàng:</small>
                            <p class="fw-bold mb-2">{{ auth()->user()->bank_name }}</p>
                            <small class="text-muted">Số tài khoản:</small>
                            <p class="fw-bold mb-2 text-primary">{{ auth()->user()->bank_account_number }}</p>
                        </div>
                    </div>
                </div>

                {{-- Chứng từ --}}
                @if ($payroll->status == 'paid')
                    <div class="card radius-10 border-success border-top border-3">
                        <div class="card-body">
                            <h6 class="mb-3 text-success"><i class='bx bx-check-circle'></i> Chứng từ thanh toán</h6>
                            @if ($payroll->bank_receipt)
                                <a href="{{ asset('upload/receipts/' . $payroll->bank_receipt) }}" target="_blank"
                                    class="btn btn-sm btn-dark w-100">
                                    <i class='bx bx-download'></i> Xem Biên lai chuyển tiền
                                </a>
                            @else
                                <p class="text-muted">Đang chờ chuyển khoản...</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal Khiếu nại (Sửa ID chuẩn) --}}
    <div class="modal fade" id="complaintModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('instructor.payroll.complaint', $payroll->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Gửi phản hồi về bảng lương</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="message" class="form-control" rows="4" placeholder="Nhập nội dung sai sót..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Gửi cho Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
