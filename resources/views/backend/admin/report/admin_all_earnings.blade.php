@extends('backend.admin.master')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="mb-0">
                        Quản lý Hoa hồng & Trả lương 
                        @if(request()->status == 'pending') 
                            <span class="text-danger">(Chờ thanh toán)</span> 
                        @endif
                    </h5>
                    @if(request()->status == 'pending')
                        <a href="{{ route('admin.all.earnings') }}" class="btn btn-secondary btn-sm">Xem tất cả</a>
                    @endif
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Giảng viên</th>
                                <th>Khóa học</th>
                                <th>Giá bán</th>
                                <th>Hoa hồng (20%)</th>
                                <th>Lương GV (80%)</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($earnings as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $item->instructor->name }}</td>
                                    <td>{{ $item->course->course_name }}</td>
                                    {{-- Sửa course_price -> total_price --}}
                                    <td>{{ number_format($item->total_price) }}đ</td>
                                    <td class="text-danger">{{ number_format($item->admin_commission) }}đ</td>
                                    <td class="text-success">{{ number_format($item->instructor_amount) }}đ</td>
                                    <td>
                                        {{-- Sửa status -> payment_status --}}
                                        <span class="badge {{ $item->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $item->payment_status == 'paid' ? 'Đã thanh toán' : 'Chờ xử lý' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->payment_status == 'pending')
                                            <a href="{{ route('admin.pay.instructor', $item->id) }}"
                                                class="btn btn-primary btn-sm"
                                                onclick="return confirm('Xác nhận bạn đã chuyển tiền thực tế cho giáo viên này?')">
                                                Xác nhận đã trả lương
                                            </a>
                                        @else
                                            <span class="badge bg-success">Hoàn thành</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection