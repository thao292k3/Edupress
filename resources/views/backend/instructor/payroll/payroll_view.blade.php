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
                                        <td colspan="2" class="text-center"><strong>TỔNG NHẬN (Tạm tính)</strong></td>
                                        <td class="text-danger">
                                            <strong>{{ number_format($payroll->total_amount) }}đ</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        @if ($payroll->status == 'sent_to_instructor')
                            <div class="alert alert-info mt-4">
                                <i class='bx bx-info-circle'></i> Vui lòng kiểm tra kỹ các thông số trên. Nếu có sai sót,
                                hãy nhấn <strong>"Khiếu nại"</strong> ngay. Nếu đã chính xác, nhấn <strong>"Xác nhận
                                    OK"</strong> để hệ thống tiến hành chuyển khoản.
                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <form action="{{ route('instructor.payroll.confirm', $payroll->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success px-5"
                                        onclick="return confirm('Tôi xác nhận thông tin lương này là chính xác')">
                                        <i class='bx bx-check-double'></i> Xác nhận thông tin lương OK
                                    </button>
                                </form>
                                <button class="btn btn-outline-danger px-4" data-bs-toggle="modal"
                                    data-bs-target="#complaintModal">
                                    <i class='bx bx-message-error'></i> Gửi khiếu nại
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">

                <div class="card radius-10">
                    <div class="card-body">
                        <h6 class="mb-3">Tài khoản nhận tiền của bạn</h6>
                        <div class="p-3 bg-light radius-10 border border-primary">
                            <small class="text-muted">Ngân hàng:</small>
                            <p class="fw-bold mb-2">{{ auth()->user()->bank_name }}</p>
                            <small class="text-muted">Số tài khoản:</small>
                            <p class="fw-bold mb-2 text-primary">{{ auth()->user()->bank_account_number }}</p>
                            <small class="text-muted">Chủ tài khoản:</small>
                            <p class="fw-bold mb-0 text-uppercase">{{ auth()->user()->bank_account_name }}</p>
                        </div>
                        <p class="small text-muted mt-2 text-center">*Nếu sai thông tin, hãy cập nhật lại ở phần Hồ sơ.</p>
                    </div>
                </div>


                @if ($payroll->status == 'paid')
                    <div class="card radius-10 border-success border-top border-3">
                        <div class="card-body">
                            <h6 class="mb-3 text-success"><i class='bx bx-check-circle'></i> Chứng từ thanh toán</h6>
                            @if ($payroll->bank_receipt)
                                <div class="alert alert-success">
                                    Hệ thống đã xác nhận thanh toán thành công.
                                    <a href="{{ asset('upload/receipts/' . $payroll->bank_receipt) }}" target="_blank"
                                        class="btn btn-sm btn-dark ms-2">
                                        <i class='bx bx-download'></i> Tải về Biên lai PDF
                                    </a>
                                </div>
                            @else
                                <p class="text-muted">Đang chờ kế toán chuyển khoản...</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="complaintModal text-start" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-start">
                <div class="modal-header">
                    <h5 class="modal-title">Gửi phản hồi về bảng lương</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" rows="4" placeholder="Nhập nội dung bạn thấy chưa đúng..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Gửi cho Admin</button>
                </div>
            </div>
        </div>
    </div>
@endsection
