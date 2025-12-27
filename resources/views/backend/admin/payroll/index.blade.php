@extends('backend.admin.master')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.payroll.export') }}" method="POST" id="export-form">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="mb-0">Quản lý bảng lương Admin</h5>
                        <div class="ms-auto">
                            <a href="{{ route('admin.payroll.create') }}" class="btn btn-primary px-3">
                                <i class='bx bx-plus'></i> Tạo mới
                            </a>
                            <button type="submit" class="btn btn-success px-3" id="btn-export" disabled>
                                <i class='bx bx-download'></i> Xuất File Ngân Hàng
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" class="form-check-input" id="check-all"></th>
                                    <th>Tháng</th>
                                    <th>Giảng viên</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payrolls as $item)
                                    <tr>



                                        <td>
                                            @if ($item->status != 'paid')
                                                <input type="checkbox" name="payroll_ids[]" value="{{ $item->id }}"
                                                    class="form-check-input payroll-checkbox">
                                            @else
                                                <input type="checkbox" class="form-check-input" disabled>
                                            @endif
                                        </td>
                                        <td>{{ $item->payroll_month }}</td>
                                        <td>{{ $item->instructor->name }}</td>
                                        <td class="text-primary fw-bold">{{ number_format($item->total_amount) }}đ</td>
                                        <td>
                                            @if ($item->status == 'draft')
                                                <span class="badge bg-warning text-dark">Bản nháp</span>
                                            @else
                                                <span class="badge bg-success">Đã thanh toán</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.payroll.show', $item->id) }}"
                                                    class="btn btn-sm btn-info text-white">Xem</a>

                                                @if ($item->status == 'draft')
                                                    <a href="{{ route('admin.payroll.updateStatus', $item->id) }}"
                                                        class="btn btn-sm btn-success"
                                                        onclick="return confirm('Xác nhận đã thanh toán cho giảng viên này?')">
                                                        Duyệt & Gửi
                                                    </a>
                                                    <a href="{{ route('admin.payroll.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Sửa</a>

                                                    <a href="{{ route('admin.payroll.delete', $item->id) }}"
                                                        class="ms-3 text-danger bg-light-danger border-0" id="delete">
                                                        <i class='bx bxs-trash'></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.payroll-checkbox');
            const btnExport = document.getElementById('btn-export');
            const checkAll = document.getElementById('check-all');

            function toggleExportBtn() {

                const hasChecked = document.querySelectorAll('.payroll-checkbox:checked').length > 0;

                btnExport.disabled = !hasChecked;
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', toggleExportBtn);
            });

            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    toggleExportBtn();
                });
            }
        });
    </script>
@endpush
