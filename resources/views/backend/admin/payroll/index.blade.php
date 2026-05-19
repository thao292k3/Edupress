@extends('backend.admin.master')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.payroll.export') }}" method="POST" id="export-form">
                    @csrf
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="mb-0">Quản lý quyết toán lương</h5>
                        <div class="ms-auto">
                            <a href="{{ route('admin.payroll.create') }}" class="btn btn-primary px-3">
                                <i class='bx bx-plus'></i> Tạo bảng lương mới
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
                                                <span class="badge bg-secondary">Bản nháp</span>
                                            @elseif($item->status == 'sent_to_instructor')
                                                <span class="badge bg-warning text-dark">Đang đối soát</span>
                                            @elseif($item->status == 'approved')
                                                <span class="badge bg-info">Chờ thanh toán</span>
                                            @elseif($item->status == 'paid')
                                                <span class="badge bg-success">Đã thanh toán</span>
                                            @endif

                                            @if($item->complaint_status == 'pending')
                                                <span class="badge bg-danger">Có khiếu nại!</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.payroll.show', $item->id) }}"
                                                    class="btn btn-sm btn-info text-white" title="Xem chi tiết">
                                                    <i class='bx bx-show'></i>
                                                </a>

                                                @if ($item->status == 'draft')
                                                    <a href="{{ route('admin.payroll.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning" title="Sửa">
                                                        <i class='bx bx-edit'></i>
                                                    </a>
                                                    
                                                    {{-- Nút gửi đối soát nhanh --}}
                                                    <button type="button" class="btn btn-sm btn-primary" 
                                                        onclick="if(confirm('Gửi bảng lương cho GV đối soát?')) { document.getElementById('quick-send-{{$item->id}}').submit(); }">
                                                        <i class='bx bx-send'></i>
                                                    </button>
                                                @endif

                                                @if ($item->status != 'paid')
                                                    <a href="{{ route('admin.payroll.delete', $item->id) }}"
                                                        class="text-danger bg-light-danger border-0 p-1 rounded" id="delete" title="Xóa">
                                                        <i class='bx bxs-trash'></i>
                                                    </a>
                                                @endif
                                            </div>

                                            {{-- Form ẩn để gửi đối soát nhanh --}}
                                            @if ($item->status == 'draft')
                                                <form id="quick-send-{{$item->id}}" action="{{ route('admin.payroll.update_status', $item->id) }}" method="POST" style="display:none;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="sent_to_instructor">
                                                </form>
                                            @endif
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