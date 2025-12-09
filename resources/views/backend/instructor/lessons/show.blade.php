@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <h4>Lesson Detail</h4>
            <a href="{{ route('instructor.lessons.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <h5 class="fw-bold">{{ $lesson->title }}</h5>
            <p class="text-muted mb-1">Slug: {{ $lesson->slug }}</p>

            <p><strong>Course:</strong> {{ $lesson->course->title }}</p>

            <p><strong>Description:</strong></p>
            <div class="border rounded p-3">
                {!! $lesson->description !!}
            </div>

            <p class="mt-3"><strong>Order:</strong> {{ $lesson->order }}</p>

            <p><strong>Preview:</strong> 
                @if($lesson->is_preview)
                    <span class="badge bg-success">Yes</span>
                @else
                    <span class="badge bg-secondary">No</span>
                @endif
            </p>

            <p><strong>Duration:</strong> {{ $lesson->duration }} minutes</p>

            <hr>

            {{-- Video --}}
            @if($lesson->video_url)
                <h5>YouTube Video</h5>
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $lesson->video_url }}" allowfullscreen></iframe>
                </div>
            @endif

            @if($lesson->video_file)
                <h5 class="mt-3">Uploaded Video</h5>
                <video controls width="100%">
                    <source src="{{ asset('storage/'.$lesson->video_file) }}">
                </video>
            @endif
        </div>
    </div>
</div>
@endsection
