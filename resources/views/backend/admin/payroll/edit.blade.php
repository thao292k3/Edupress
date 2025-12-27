@extends('backend.admin.master')
@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản lý lương</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa bảng lương</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-edit me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">Cập nhật bảng lương nháp</h5>
                    </div>
                    <hr>
                    <form action="{{ route('admin.payroll.update', $payroll->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('POST') 

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Giảng viên</label>
                            <input type="text" class="form-control bg-light" value="{{ $payroll->instructor->name }}" readonly>
                            <small class="text-muted">Không thể thay đổi giảng viên cho bản ghi này.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tháng quyết toán</label>
                            <input type="month" name="month" class="form-control" value="{{ $payroll->payroll_month }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Lương cứng (Cố định)</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-light" value="{{ number_format($payroll->fixed_salary) }}" readonly>
                                <span class="input-group-text">VNĐ</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-danger">Phí hỗ trợ dạy học / Giải đáp (VNĐ)</label>
                            <div class="input-group">
                                <input type="number" name="support_fee" class="form-control border-danger" 
                                       value="{{ $payroll->support_fee }}" 
                                       placeholder="Nhập tổng số tiền, ví dụ: 500000" required>
                                <span class="input-group-text bg-danger text-white">VNĐ</span>
                            </div>
                            <small class="text-danger">* Lưu ý: Nhập TỔNG SỐ TIỀN hỗ trợ, không phải số buổi dạy.</small>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Doanh thu khóa học (Tự động quét)</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-light" value="{{ number_format($payroll->course_revenue) }}" readonly>
                                <span class="input-group-text">VNĐ</span>
                            </div>
                            <small class="text-muted">Tiền hoa hồng từ các khóa học đã bán trong tháng.</small>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary px-5 w-100">
                                <i class="bx bx-save"></i> Cập nhật và Tính lại tổng lương
                            </button>
                            <a href="{{ route('admin.payroll.index') }}" class="btn btn-link w-100 mt-2 text-secondary">Hủy bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection