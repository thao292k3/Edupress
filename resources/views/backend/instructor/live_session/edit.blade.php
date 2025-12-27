@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Chỉnh sửa buổi dạy trực tiếp</h5>
            <form action="{{ route('instructor.live-sessions.update', $live_session->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT') {{-- Bắt buộc phải có để Laravel hiểu là lệnh Update --}}

                <div class="col-md-6">
                    <label class="form-label">Chọn khóa học</label>
                    <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $live_session->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Chủ đề buổi học</label>
                    <input type="text" name="topic" class="form-control" value="{{ $live_session->topic }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nền tảng</label>
                    <select name="platform" class="form-select">
                        <option value="Zoom" {{ $live_session->platform == 'Zoom' ? 'selected' : '' }}>Zoom</option>
                        <option value="Google Meet" {{ $live_session->platform == 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
                        <option value="Microsoft Teams" {{ $live_session->platform == 'Microsoft Teams' ? 'selected' : '' }}>Microsoft Teams</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Thời gian bắt đầu</label>
                    {{-- Chuyển đổi định dạng ngày tháng để hiển thị trong input --}}
                    <input type="datetime-local" name="start_at" class="form-control" 
                           value="{{ date('Y-m-d\TH:i', strtotime($live_session->start_at)) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Thời lượng (phút)</label>
                    <input type="number" name="duration_minutes" class="form-control" value="{{ $live_session->duration_minutes }}">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Link tham gia (URL)</label>
                    <input type="url" name="meeting_link" class="form-control" value="{{ $live_session->meeting_link }}">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Mô tả nội dung</label>
                    <textarea name="description" class="form-control" rows="3">{{ $live_session->description }}</textarea>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-warning px-4 text-white">Cập nhật thay đổi</button>
                    <a href="{{ route('instructor.live-sessions.index') }}" class="btn btn-secondary px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection