@extends('backend.instructor.master')

@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Mã giảm giá</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tất cả mã giảm giá</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="mb-0 text-uppercase">Danh sách mã giảm giá</h6>
            <a href="{{route('instructor.coupon.create')}}" class="btn btn-primary px-4">+ Thêm mã mới</a>
        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên mã</th>
                                <th>Mức giảm</th>
                                <th>Ngày hết hạn</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_coupon as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $item->coupon_name }}</strong></td>
                                    <td>
                                        @if($item->coupon_type == 'percent')
                                            <span class="badge bg-info text-dark">{{ $item->coupon_discount }}%</span>
                                        @else
                                            <span class="badge bg-success">{{ number_format($item->coupon_discount) }} VNĐ</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->coupon_validity)->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-primary">Đang hoạt động</span>
                                        @else
                                            <span class="badge bg-danger">Đã tắt</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('instructor.coupon.edit', $item->id) }}" class="text-primary me-2" title="Sửa">
                                            <i class="bx bxs-edit fs-5"></i>
                                        </a>
                                        <a href="javascript:;" class="text-danger delete-category" data-id="{{ $item->id }}" title="Xóa">
                                            <i class="bx bxs-trash fs-5"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection