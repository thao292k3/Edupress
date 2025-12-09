@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    <h4 class="mb-3">Add New Video</h4>

    <form action="{{ route('instructor.videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Select Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Select Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }}
                            </option>
                        @endforeach

                        {{-- @foreach ($all_categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Youtube Link</label>
                    <input type="url" name="video_url" class="form-control" placeholder="https://youtu.be/...">
                </div>

                <div class="mb-3">
                    <label class="form-label">Or Upload Video</label>
                    <input type="file" name="video_file" class="form-control">
                    <small class="text-muted">MP4, WEBM, OGG – Max 50MB</small>
                </div>

                <button class="btn btn-success">Save</button>

            </div>
        </div>
    </form>

</div>
@endsection
