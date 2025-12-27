@extends('backend.instructor.master')

@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Mã giảm giá</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm mã giảm giá</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card col-md-8">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="mb-0">Tạo mã giảm giá mới</h5>
                    <a href="{{route('instructor.coupon.index')}}" class="btn btn-secondary px-3">Quay lại</a>
                </div>

                <form class="row g-3" method="post" action="{{route('instructor.coupon.store')}}">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-md-12">
                        <label class="form-label">Tên mã giảm giá</label>
                        <input type="text" name="coupon_name" class="form-control" placeholder="Ví dụ: GIAM50K, CHAOHE..." value="{{ old('coupon_name') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Loại giảm giá</label>
                        <select name="coupon_type" id="coupon_type" class="form-select">
                            <option value="percent">Giảm theo phần trăm (%)</option>
                            <option value="fixed">Giảm số tiền cố định (VNĐ)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mức giảm giá</label>
                        <div class="input-group">
                            <input type="number" name="coupon_discount" class="form-control" placeholder="Nhập giá trị" value="{{ old('coupon_discount') }}">
                            <span class="input-group-text" id="type-label">%</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ngày hết hạn</label>
                        <input type="date" class="form-control" name="coupon_validity" value="{{ old('coupon_validity') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="1" selected>Kích hoạt</option>
                            <option value="0">Tạm dừng</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary px-4 w-100">Lưu mã giảm giá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('coupon_type').addEventListener('change', function() {
            document.getElementById('type-label').innerText = this.value === 'percent' ? '%' : 'VNĐ';
        });
    </script>
@endsection