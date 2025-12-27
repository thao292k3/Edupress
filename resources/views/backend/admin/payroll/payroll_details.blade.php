@extends('backend.admin.master')
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Quản lý lương</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết bảng lương đối soát</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.payroll.index') }}" class="btn btn-secondary px-3"><i class='bx bx-arrow-back'></i>
                    Quay lại</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card radius-10">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Thông tin quyết toán - Tháng {{ $payroll->payroll_month }}</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <span
                                    class="badge {{ $payroll->status == 'draft' ? 'bg-secondary' : ($payroll->status == 'sent_to_instructor' ? 'bg-warning' : 'bg-success') }}">
                                    Trạng thái: {{ strtoupper($payroll->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Hạng mục</th>
                                        <th>Mô tả</th>
                                        <th>Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Lương cứng</strong></td>
                                        <td>Lương cơ bản hàng tháng theo hợp đồng</td>
                                        <td class="text-primary">{{ number_format($payroll->fixed_salary) }}đ</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Doanh thu khóa học</strong></td>
                                        <td>Hoa hồng từ {{ $payroll->student_count }} học viên đăng ký mới</td>
                                        <td class="text-primary">{{ number_format($payroll->course_revenue) }}đ</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phí hỗ trợ/Giải đáp</strong></td>
                                        <td>Các buổi dạy bổ trợ và trả lời thắc mắc</td>
                                        <td class="text-primary">{{ number_format($payroll->support_fee) }}đ</td>
                                    </tr>
                                    <tr class="table-dark">
                                        <td colspan="2" class="text-center"><strong>TỔNG LƯƠNG THỰC NHẬN</strong></td>
                                        <td><strong>{{ number_format($payroll->total_amount) }}đ</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @if ($payroll->status == 'draft')
                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <form action="{{ route('admin.payroll.updateStatus', $payroll->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="sent_to_instructor">
                                    <button type="submit" class="btn btn-warning px-4"
                                        onclick="return confirm('Gửi bảng lương này cho Giảng viên đối soát?')">
                                        <i class='bx bx-paper-plane'></i> Gửi NCC đối soát (3 ngày)
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card radius-10">
                    <div class="card-body">
                        <h6 class="mb-3">Thông tin nhận tiền</h6>
                        <div class="d-flex align-items-center mb-3">
                            {{-- <img src="{{ !empty($payroll->instructor->photo) ? url('upload/instructor_images/' . $payroll->instructor->photo) : url('upload/no_image.jpg') }}"
                                class="rounded-circle p-1 bg-primary" width="120" height="120"> --}}
                                <img id="photoPreview" src="{{  auth()->user()->photo ? asset(auth()->user()->photo) :  asset('backend/assets/images/avatars/avatar-2.png')}}" 
                                alt="Instructor" class="rounded-circle p-1 bg-primary" width="110" height="110">
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{ $payroll->instructor->name }}</h6>
                                <p class="mb-0 text-secondary">{{ $payroll->instructor->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="bank-info p-3 bg-light radius-10">
                            <p class="mb-1 text-secondary">Ngân hàng:</p>
                            <h6 class="mb-2">{{ $payroll->instructor->bank_name ?? 'Chưa cập nhật' }}</h6>
                            <p class="mb-1 text-secondary">Số tài khoản:</p>
                            <h6 class="mb-2 text-danger font-weight-bold">
                                {{ $payroll->instructor->bank_account_number ?? 'Chưa cập nhật' }}</h6>
                            <p class="mb-1 text-secondary">Chủ tài khoản:</p>
                            <h6 class="mb-0 text-uppercase">
                                {{ $payroll->instructor->bank_account_name ?? 'Chưa cập nhật' }}</h6>
                        </div>
                    </div>
                </div>

                <div class="card radius-10">
                    <div class="card-body">
                        <h6 class="mb-3">Minh chứng thanh toán</h6>
                        @if ($payroll->bank_receipt)
                            <img src="{{ asset('upload/receipts/' . $payroll->bank_receipt) }}"
                                class="img-fluid radius-10 border" alt="Receipt">
                        @else
                            <div class="text-center p-4 border border-dashed radius-10">
                                <i class='bx bx-cloud-upload fs-1 text-secondary'></i>
                                <p class="mt-2 text-secondary">Chưa có ảnh xác nhận chuyển khoản</p>
                            </div>
                        @endif

                        @if ($payroll->status == 'paid' && empty($payroll->bank_receipt))
                            <form action="{{ route('admin.payroll.upload_receipt', $payroll->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-3">
                                @csrf
                                @if ($payroll->status == 'approved')
                                    <div class="alert alert-info">
                                        <p>Sau khi bạn đã chuyển tiền ngoài ngân hàng, nhấn nút dưới đây để hệ thống tự tạo
                                            biên lai.</p>
                                        <a href="{{ route('admin.payroll.generate_receipt', $payroll->id) }}"
                                            class="btn btn-primary w-100">
                                            <i class='bx bx-check-double'></i> TỰ ĐỘNG TẠO BIÊN LAI & XÁC NHẬN
                                        </a>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary w-100">Xác nhận ĐÃ CHUYỂN TIỀN</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
