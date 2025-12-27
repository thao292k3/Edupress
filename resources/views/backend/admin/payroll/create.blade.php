@extends('backend.admin.master')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Tạo bảng lương quyết toán tháng</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.payroll.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Chọn Giảng viên</label>
                                <select name="instructor_id" class="form-select" required>
                                    <option value="">-- Chọn giảng viên --</option>
                                    @foreach ($instructors as $ins)
                                        <option value="{{ $ins->id }}">{{ $ins->name }} (Lương cứng:
                                            {{ number_format($ins->fixed_salary) }}đ)</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tháng quyết toán</label>
                                <input type="month" name="month" class="form-control" value="{{ date('Y-m') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-danger fw-bold">Tổng tiền phí hỗ trợ/giải đáp (VNĐ)</label>
                                <input type="number" name="support_fee" class="form-control"
                                    placeholder="Nhập TỔNG TIỀN, không phải số buổi. VD: 500000" value="0">
                                <small class="text-muted">Lưu ý: Nếu dạy 5 buổi, mỗi buổi 100k thì hãy nhập 500000.</small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">Tạo bảng lương nháp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
