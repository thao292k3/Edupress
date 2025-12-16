@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    {{-- 1. Thông tin Quiz --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4 class="mb-0">Chi tiết Quiz: {{ $quiz->title }}</h4>
            <div class="d-flex">
                <a href="{{ route('instructor.quizzes.edit', $quiz->id) }}" class="btn btn-warning btn-sm me-2">
                    <i class="fas fa-edit"></i> Sửa Quiz
                </a>
                {{-- Route: instructor.quizzes.index --}}
                <a href="{{ route('instructor.quizzes.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Khóa học:</strong> {{ $quiz->course->course_name ?? 'N/A' }}</p>
                    <p><strong>Thời lượng:</strong> {{ $quiz->duration_minutes }} phút</p>
                    <p><strong>Số lượng câu hỏi:</strong> {{ $quiz->questions->count() }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tổng điểm:</strong> <span class="badge bg-info">{{ $quiz->total_marks }} điểm</span></p>
                    <p><strong>Điểm Đạt:</strong> {{ $quiz->passing_score }}%</p>
                    <p><strong>Trạng thái:</strong> 
                        <span class="badge bg-{{ $quiz->is_active ? 'success' : 'secondary' }}">
                            {{ $quiz->is_active ? 'Đang hoạt động' : 'Tạm dừng' }}
                        </span>
                    </p>
                </div>
            </div>
            <p class="mt-3"><strong>Mô tả:</strong> {{ $quiz->description }}</p>
        </div>
    </div>

    {{-- 2. Quản lý Câu hỏi --}}
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Danh sách Câu hỏi</h5>
            {{-- Route: instructor.quizzes.questions.create --}}
            <a href="{{ route('instructor.quizzes.questions.create', $quiz->id) }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Thêm Câu hỏi mới
            </a>
        </div>

        <div class="card-body">
            @if($quiz->questions->isEmpty())
                <div class="alert alert-info text-center">
                    Quiz này chưa có câu hỏi nào. Hãy thêm câu hỏi đầu tiên!
                </div>
            @else
                <div id="questions-list">
                    @foreach($quiz->questions->sortBy('order') as $question)
                        <div class="card mb-3 border question-item" data-id="{{ $question->id }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    {{-- Nội dung Câu hỏi --}}
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">
                                            #{{ $question->order }}. {{ $question->question_text }} 
                                            <span class="badge bg-secondary ms-2">{{ $question->marks }} điểm</span>
                                        </h6>
                                        <p class="small text-muted mb-2">
                                            Loại: 
                                            @if($question->type == 'single_choice')
                                                <span class="badge bg-primary">Một đáp án</span>
                                            @elseif($question->type == 'multiple_choice')
                                                <span class="badge bg-warning text-dark">Nhiều đáp án</span>
                                            @else
                                                <span class="badge bg-info">Tự luận/Trả lời ngắn</span>
                                            @endif
                                        </p>

                                        {{-- Danh sách Đáp án (Chỉ cho trắc nghiệm) --}}
                                        @if($question->answers->isNotEmpty())
                                            <ul class="list-group list-group-flush mt-2">
                                                @foreach($question->answers as $answer)
                                                    <li class="list-group-item p-1 d-flex">
                                                        <span class="me-2 fw-bold text-{{ $answer->is_correct ? 'success' : 'danger' }}">
                                                            @if($answer->is_correct)
                                                                <i class="fas fa-check-circle"></i> 
                                                            @else
                                                                <i class="far fa-circle"></i> 
                                                            @endif
                                                        </span>
                                                        {{ $answer->answer_text }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @elseif($question->type == 'text' && $question->correct_answer_text)
                                             <p class="alert alert-light p-2 small mt-2 mb-0">
                                                <strong class="text-primary">Đáp án Mẫu (Dành cho Instructor):</strong> 
                                                {{ $question->correct_answer_text }}
                                            </p>
                                        @endif
                                    </div>
                                    
                                    {{-- Hành động --}}
                                    <div class="d-flex flex-column ms-3">
                                        <a href="{{ route('instructor.quizzes.questions.edit', [$quiz->id, $question->id]) }}" 
                                           class="btn btn-sm btn-primary mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-danger delete-question-btn" 
                                                data-url="{{ route('instructor.quizzes.questions.destroy', [$quiz->id, $question->id]) }}"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</div>


@include('backend.partials.delete_modal')

@push('scripts')
<script>
    // Hàm xử lý Xóa
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-question-btn');
        const deleteForm = document.getElementById('deleteForm');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const deleteUrl = this.getAttribute('data-url');
                deleteForm.setAttribute('action', deleteUrl);
                
                // Cập nhật nội dung modal (tùy chọn)
                const modalBody = document.getElementById('deleteModalLabel').textContent = 'Xác nhận xóa Câu hỏi này?';
            });
        });
    });
</script>
@endpush
@endsection