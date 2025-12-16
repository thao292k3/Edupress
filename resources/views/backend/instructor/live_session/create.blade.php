@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Tạo buổi dạy trực tiếp</h5>
            <form action="{{ route('instructor.live-sessions.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">Chọn khóa học</label>
                    <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                        <option value="" selected disabled>-- Chọn khóa học --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                    @error('course_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Chủ đề buổi học</label>
                    <input type="text" name="topic" class="form-control" placeholder="VD: Giải đáp thắc mắc chương 1">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nền tảng</label>
                    <select name="platform" class="form-select">
                        <option value="Zoom">Zoom</option>
                        <option value="Google Meet">Google Meet</option>
                        <option value="Microsoft Teams">Microsoft Teams</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Thời gian bắt đầu</label>
                    <input type="datetime-local" name="start_at" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Thời lượng (phút)</label>
                    <input type="number" name="duration_minutes" class="form-control" value="60">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Link tham gia (URL)</label>
                    <input type="url" name="meeting_link" class="form-control" placeholder="https://zoom.us/j/...">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Mô tả nội dung</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4">Lưu buổi học</button>
                    <a href="{{ route('instructor.live-sessions.index') }}" class="btn btn-secondary px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection