@extends('backend.instructor.master')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="mb-0 text-primary font-weight-bold">
                <i class="fas fa-list-check mr-2"></i>Danh Sách Câu Hỏi Đánh Giá
            </h5>
            <a href="{{ route('instructor.assessments.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                <i class="fas fa-plus mr-1"></i> Thêm câu hỏi
            </a>
        </div>

        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 text-muted" style="width: 50px;">ID</th>
                            <th class="text-muted">Nội dung câu hỏi</th>
                            <th class="text-muted">Các phương án & Trình độ</th>
                            <th class="text-muted">Đáp án chính</th>
                            <th class="text-center text-muted" style="width: 150px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $q)
                            <tr>
                                <td class="px-4 font-weight-bold text-secondary">#{{ $q->id }}</td>
                                <td style="min-width: 250px;">
                                    <span class="d-block text-dark font-weight-500">{{ $q->question }}</span>
                                </td>
                                <td>
                                    @foreach ($q->options ?? [] as $opt)
                                        <div class="option-item mb-2 p-1 rounded" style="background: #f8f9fa; border-left: 3px solid #007bff;">
                                            <span class="badge {{ $opt['level'] == 'Advanced' ? 'badge-danger' : ($opt['level'] == 'Intermediate' ? 'badge-warning' : 'badge-info') }} mr-1">
                                                {{ $opt['level'] ?? 'Cơ bản' }}
                                            </span>
                                            <span class="text-muted small font-weight-bold">{{ $opt['text'] }}</span>
                                            <span class="ml-auto text-primary small">(Điểm: {{ $opt['weight'] }})</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="text-success font-weight-bold">
                                        <i class="fas fa-check-circle mr-1"></i> {{ $q->correct_option ?: 'Chưa thiết lập' }}
                                    </span>
                                </td>
                                <td class="text-center px-4">
                                    <div class="btn-group shadow-sm" role="group">
                                        <a href="{{ route('instructor.assessments.edit', $q->id) }}"
                                            class="btn btn-sm btn-outline-secondary" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="post" action="{{ route('instructor.assessments.destroy', $q->id) }}"
                                            class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa câu hỏi này?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white border-top-0 py-3">
            <small class="text-muted">Tổng cộng: {{ count($questions) }} câu hỏi hiện có.</small>
        </div>
    </div>
</div>

<style>
    /* CSS tùy chỉnh để làm bảng thanh thoát hơn */
    .table thead th {
        border-top: none;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        font-weight: 700;
    }
    .table td {
        vertical-align: middle !important;
        border-bottom: 1px solid #f2f2f2;
    }
    .option-item {
        display: flex;
        align-items: center;
        transition: all 0.2s;
    }
    .option-item:hover {
        background: #eef2f7 !important;
        transform: translateX(5px);
    }
    .font-weight-500 { font-weight: 500; }
    .badge { padding: 0.4em 0.6em; font-size: 75%; }
</style>
@endsection