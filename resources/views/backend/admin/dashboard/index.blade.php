@extends('backend.admin.master')

@section('content')
    <div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng khóa học</p>
                            <h4 class="my-1 text-info">{{ $total_courses }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                            <i class='bx bxs-book-content'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng học viên</p>
                            <h4 class="my-1 text-danger">{{ $total_students }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                            <i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Nhà cung cấp (GV)</p>
                            <h4 class="my-1 text-success">{{ $total_instructors }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                            <i class='bx bxs-user-badge'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Tổng doanh thu</p>
                            <h4 class="my-1 text-warning">{{ number_format($total_revenue) }}đ</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                            <i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card radius-10 mt-4">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Lịch sử giao dịch gần đây</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Học viên</th>
                            <th>Ngày giao dịch</th>
                            <th>Số tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_orders as $order)
                        <tr>
                            <td>#{{ $order->order_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>{{ number_format($order->total_amount) }}đ</td>
                            <td>
                                <span class="badge bg-gradient-quepal text-white shadow-sm w-100">Thành công</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Biểu đồ doanh thu năm {{ date('Y') }}</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script>
    $(function() {
        var ctx = document.getElementById('revenueChart').getContext('2d');
        
        
        var revenueData = {!! json_encode($monthly_revenue) !!};

        var myChart = new Chart(ctx, {
            type: 'line', 
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 
                         'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: revenueData,
                    backgroundColor: 'rgba(21, 202, 32, 0.2)',
                    borderColor: '#15ca20',
                    borderWidth: 3,
                    pointBackgroundColor: '#15ca20',
                    tension: 0.4, 
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
