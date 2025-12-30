@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản lý tài chính</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Báo cáo doanh thu</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.revenue.export') }}" class="btn btn-success px-4 d-flex align-items-center">
                <i class="bx bxs-file-export me-1"></i> Xuất File Excel
            </a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng Doanh Thu</p>
                            <h4 class="my-1 text-info">{{ number_format($totalRevenue) }}đ</h4>
                            <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i> Dữ liệu thực tế</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                            <i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Số đơn hàng</p>
                            <h4 class="my-1 text-danger">{{ $orders->total() }} đơn</h4>
                            <p class="mb-0 font-13 text-secondary">Đã thanh toán thành công</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                            <i class='bx bxs-cart'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h6 class="mb-0">Chi tiết giao dịch gần đây</h6>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Mã Hóa Đơn</th>
                            <th>Khách hàng</th>
                            <th>Số tiền</th>
                            <th>Phương thức</th>
                            <th>Trạng thái</th>
                            <th>Ngày thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-14">{{ $item->invoice_no }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->name ?? 'Khách lẻ' }}</td>
                            <td class="text-primary font-weight-bold">{{ number_format($item->total_amount, 0, ',', '.') }}đ</td>
                            <td>
                                <div class="badge rounded-pill text-uppercase px-3 py-1 bg-light-info text-info" style="font-size: 11px;">
                                    <i class='bx bxs-circle me-1'></i>{{ $item->payment_type }}
                                </div>
                            </td>
                            <td>
                                <div class="badge rounded-pill text-white bg-success p-2 text-uppercase px-3">
                                    <i class='bx bx-check-circle me-1'></i>{{ $item->status }}
                                </div>
                            </td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

<style>
   
    .radius-10 { border-radius: 10px !important; }
    .bg-light-info { background-color: rgba(13, 202, 240, 0.1) !important; }
    .widgets-icons-2 {
        width: 56px; height: 56px;
        display: flex; align-items: center; justify-content: center;
        font-size: 27px;
    }
    .bg-gradient-scooter { background: linear-gradient(45deg, #17ead9, #6078ea) !important; }
    .bg-gradient-bloody { background: linear-gradient(45deg, #f54ea2, #ff7676) !important; }
</style>
@endsection