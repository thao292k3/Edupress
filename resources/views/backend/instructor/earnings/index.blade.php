{{-- resources/views/backend/admin/payroll/index.blade.php --}}

@extends('backend.admin.master')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            
            <form action="{{ route('admin.payroll.export') }}" method="POST" id="export-form">
                @csrf
                <div class="d-flex align-items-center mb-3">
                    <h5 class="mb-0">Quản lý bảng lương</h5>
                    <div class="ms-auto">
                        
                        <button type="submit" class="btn btn-success px-3" id="btn-export" disabled>
                            <i class='bx bx-download'></i> Xuất File Ngân Hàng
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="10">
                                    {{-- Checkbox chọn tất cả ở Header --}}
                                    <input type="checkbox" class="form-check-input" id="check-all">
                                </th>
                                <th>Tháng</th>
                                <th>Giảng viên</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payrolls as $item)
                            <tr>
                                <td>
                                    {{-- Checkbox từng dòng --}}
                                    <input type="checkbox" name="payroll_ids[]" value="{{ $item->id }}" 
                                           class="form-check-input payroll-checkbox"
                                           {{-- Chỉ cho chọn những bảng lương Giảng viên đã Approved --}}
                                           @if($item->status != 'approved') disabled @endif>
                                </td>
                                <td>{{ $item->payroll_month }}</td>
                                <td>{{ $item->instructor->name }}</td>
                                <td>{{ number_format($item->total_amount) }}đ</td>
                                <td>
                                    <span class="badge {{ $item->status == 'approved' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.payroll.show', $item->id) }}" class="btn btn-sm btn-primary">Chi tiết</a>
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

{{-- Đoạn mã Script xử lý Logic --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('check-all');
        const checkboxes = document.querySelectorAll('.payroll-checkbox');
        const btnExport = document.getElementById('btn-export');

        // Hàm cập nhật trạng thái nút bấm
        function toggleExportBtn() {
            const hasChecked = document.querySelectorAll('.payroll-checkbox:checked').length > 0;
            btnExport.disabled = !hasChecked;
        }

        // Xử lý chọn tất cả
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                if (!cb.disabled) cb.checked = this.checked;
            });
            toggleExportBtn();
        });

        // Xử lý chọn từng ô
        checkboxes.forEach(cb => {
            cb.addEventListener('change', toggleExportBtn);
        });
    });
</script>
@endsection