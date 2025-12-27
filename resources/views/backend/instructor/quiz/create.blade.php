@extends('backend.instructor.master')

@section('content')
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Tạo Bài kiểm tra (Quiz) Mới</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('instructor.quizzes.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            </div>

            <div class="card-body">

                <form action="{{ route('instructor.quizzes.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="section_id" value="{{ old('section_id', request()->query('section_id')) }}">
                    <input type="hidden" name="course_id" value="{{ old('course_id', request()->query('course_id')) }}">

                    <div class="mb-3">
                        <label class="form-label">Khóa học <span class="text-danger">*</span></label>

                        @if (request()->query('course_id'))
                            {{-- Nếu có course_id trên URL, hiển thị tên khóa học và dùng input hidden --}}
                            @php
                                $selectedCourse = $courses->where('id', request()->query('course_id'))->first();
                            @endphp

                            <input type="text" class="form-control"
                                value="{{ $selectedCourse->course_name ?? 'Khóa học đã chọn' }}" readonly>
                            <input type="hidden" name="course_id" value="{{ request()->query('course_id') }}">
                        @else
                            {{-- Nếu không có (truy cập trực tiếp), hiện select như cũ --}}
                            <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                                <option value="">-- Chọn Khóa học --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                        @endif

                        @error('course_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tiêu đề Quiz (Bắt buộc) --}}
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề Quiz <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" placeholder="Ví dụ: Kiểm tra giữa kỳ - Unit 1" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mô tả (Tùy chọn) --}}
                    <div class="mb-3">
                        <label class="form-label">Mô tả Quiz</label>
                        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                            placeholder="Mô tả ngắn gọn về nội dung và mục tiêu của bài kiểm tra">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h5>Cấu hình Bài kiểm tra</h5>

                    <div class="row">
                        {{-- Điểm đậu (%) (Bắt buộc) --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Điểm đậu (%) <span class="text-danger">*</span></label>
                            <input type="number" name="pass_score"
                                class="form-control @error('pass_score') is-invalid @enderror" min="0" max="100"
                                value="{{ old('pass_score', 60) }}" required>
                            <small class="form-text text-muted">Phần trăm điểm tối thiểu để vượt qua Quiz.</small>
                            @error('pass_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Thời lượng (Phút) (Tùy chọn) --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Thời lượng (Phút)</label>
                            <input type="number" name="duration_minutes"
                                class="form-control @error('duration_minutes') is-invalid @enderror" min="1"
                                value="{{ old('duration_minutes') }}" placeholder="Để trống nếu không giới hạn">
                            @error('duration_minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Trạng thái (Bắt buộc) --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>0 - Draft (Nháp)</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>1 - Active (Hoạt động)
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Hiển thị kết quả ngay --}}
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="show_result_immediately"
                                    value="1" id="showResultCheck"
                                    {{ old('show_result_immediately') ? 'checked' : '' }}>
                                <label class="form-check-label" for="showResultCheck">
                                    Hiển thị kết quả ngay sau khi nộp bài
                                </label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="total_marks" value="{{ old('total_marks', 0) }}">

                    <button type="submit" class="btn btn-success mt-3"><i class="fas fa-plus"></i> Tạo Quiz và Thêm Câu
                        hỏi</button>
                </form>

            </div>
        </div>

    </div>
@endsection
