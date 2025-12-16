@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    {{-- Thông báo thành công/thất bại --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h4>Tất cả Bài kiểm tra (Quizzes)</h4>
        <a href="{{ route('instructor.quizzes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tạo Quiz Mới
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Tiêu đề Quiz</th>
                        <th>Khóa học</th>
                        <th>Tổng điểm / Điểm đậu</th>
                        <th>Trạng thái</th>
                        <th width="200">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>
                                {{-- Hiển thị tên Khóa học liên quan --}}
                                @if($quiz->course)
                                    <span class="badge bg-info">{{ $quiz->course->course_title ?? 'N/A' }}</span>
                                @else
                                    <span class="badge bg-danger">Khóa học đã xóa</span>
                                @endif
                            </td>
                            <td>
                                {{ $quiz->total_marks }} Điểm / {{ $quiz->pass_score }}%
                            </td>
                            <td>
                                @if($quiz->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                            </td>
                            <td>
                                {{-- Nút Xem/Quản lý Câu hỏi (Show) --}}
                                <a href="{{ route('instructor.quizzes.show', $quiz->id) }}" 
                                    class="btn btn-sm btn-info text-white" title="Quản lý Câu hỏi">
                                    <i class="fas fa-list-alt"></i> Quản lý
                                </a>

                                {{-- Nút Sửa (Edit) --}}
                                <a href="{{ route('instructor.quizzes.edit', $quiz->id) }}" 
                                    class="btn btn-sm btn-warning" title="Sửa Quiz">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                {{-- Nút Xóa (Destroy) --}}
                                <button type="button" class="btn btn-sm btn-danger" 
                                    onclick="confirmDelete('{{ route('instructor.quizzes.destroy', $quiz->id) }}')" title="Xóa Quiz">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Chưa có bài kiểm tra nào được tạo.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

{{-- Modal Xác nhận Xóa (Dùng lại cấu trúc từ Lessons/Courses) --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận Xóa Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa Quiz này không? Toàn bộ Câu hỏi liên quan cũng sẽ bị xóa.
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Hàm này được gọi khi nhấn nút xóa
    function confirmDelete(url) {
        document.getElementById("deleteForm").action = url;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>
@endpush
@endsection