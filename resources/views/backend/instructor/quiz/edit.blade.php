@extends('backend.instructor.master')

@section('content')
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Chỉnh sửa Bài kiểm tra: {{ $quiz->title }}</h4>
                <a href="{{ route('instructor.quizzes.show', $quiz->id) }}" class="btn btn-secondary">Quay lại</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-body">

                <form action="{{ route('instructor.quizzes.update', $quiz->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="section_id" value="{{ $quiz->section_id }}">
                    <div class="mb-3">
                        <label class="form-label">Khóa học</label>
                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ old('course_id', $quiz->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tiêu đề Quiz --}}
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề Quiz</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $quiz->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Mô tả --}}
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $quiz->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        {{-- Điểm đậu --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Điểm đậu (%)</label>
                            <input type="number" name="pass_score"
                                class="form-control @error('pass_score') is-invalid @enderror" min="0" max="100"
                                value="{{ old('pass_score', $quiz->pass_score) }}" required>
                            @error('pass_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Thời lượng (Phút) --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Thời lượng (Phút, optional)</label>
                            <input type="number" name="duration_minutes"
                                class="form-control @error('duration_minutes') is-invalid @enderror" min="1"
                                value="{{ old('duration_minutes', $quiz->duration_minutes) }}">
                            @error('duration_minutes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Trạng thái --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="0" {{ old('status', $quiz->status) == 0 ? 'selected' : '' }}>Draft
                                </option>
                                <option value="1" {{ old('status', $quiz->status) == 1 ? 'selected' : '' }}>Active
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Cập nhật Quiz</button>
                </form>

            </div>
        </div>

    </div>
@endsection
