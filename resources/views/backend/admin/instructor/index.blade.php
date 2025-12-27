@extends('backend.admin.master')

<style>
    /* Thu nhỏ switch và chỉnh con trỏ */
    .form-check-input {
        width: 2.2rem;
        height: 1.2rem;
        transform: scale(1.1);
        cursor: pointer;
    }

    /* Khống chế độ rộng các cột để tránh bị tràn */
    .table th,
    .table td {
        vertical-align: middle;
        white-space: nowrap;
        /* Giữ nội dung trên 1 dòng */
        padding: 8px 10px !important;
        /* Thu nhỏ padding */
        font-size: 14px;
    }

    .col-stt {
        width: 50px;
        text-align: center;
    }

    .col-img {
        width: 80px;
        text-align: center;
    }

    .col-status {
        width: 130px;
    }

    .col-action {
        width: 150px;
    }
</style>

@section('content')
    <div class="page-content">
        @include('backend.section.breadcrumb', [
            'title' => 'Giảng viên',
            'sub_title' => 'Quản lý tất cả giảng viên',
        ])

        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="mb-0 text-uppercase">Danh sách tất cả giảng viên</h6>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="col-stt">STT</th>
                                <th class="col-img">Ảnh</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Lương cứng</th>
                                <th>Hoa hồng trung tâm </th>
                                <th class="col-status">Trạng thái</th>
                                <th class="col-action">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_instructors as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset($item->photo) }}" width="45" height="45"
                                            class="rounded-circle" />
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-primary fw-bold">{{ number_format($item->fixed_salary) }}đ</td>
                                    <td class="text-center">{{ $item->commission_rate ?? 40 }}%</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-success" style="font-size: 11px;">Đang hoạt động</span>
                                        @else
                                            <span class="badge bg-danger" style="font-size: 11px;">Tạm khóa</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="form-check form-switch p-0 m-0">
                                                <input class="form-check-input ms-0" type="checkbox" role="switch"
                                                    id="flexSwitchCheckDefault{{ $item->id }}"
                                                    data-user-id="{{ $item->id }}"
                                                    {{ $item->status == 1 ? 'checked' : '' }}>
                                            </div>

                                            <button type="button" class="btn btn-sm btn-warning py-1 px-2"
                                                style="font-size: 12px;" data-bs-toggle="modal"
                                                data-bs-target="#editInstructor{{ $item->id }}">
                                                <i class='bx bx-edit-alt'></i> Sửa
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($all_instructors as $item)
                        <div class="modal fade" id="editInstructor{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.update.instructor.status') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="instructor_id" value="{{ $item->id }}">

                                    <div class="modal-content text-start">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cập nhật: {{ $item->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-dark">Lương cứng hàng tháng
                                                    (VNĐ)
                                                </label>
                                                <input type="number" name="fixed_salary" class="form-control"
                                                    value="{{ $item->fixed_salary }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-dark">Tỷ lệ hoa hồng</label>
                                                <input type="number" name="commission_rate" class="form-control"
                                                    value="{{ $item->commission_rate ?? 40 }}" min="0"
                                                    max="100">
                                                <small class="text-muted d-block mt-1">
                                                    Nhập 40: Trung tâm hưởng 40%, Giảng viên hưởng 60%.
                                                </small>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-dark">Trạng thái phê duyệt</label>
                                                <select name="status" class="form-select">
                                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Hoạt
                                                        động (Active)</option>
                                                    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Tạm
                                                        khóa (Inactive)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('backend.partials.status-toggle-script')
@endpush
