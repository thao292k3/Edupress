@extends('backend.instructor.master')

@section('content')

<div class="container">

    <h3 class="mb-4">Quản lý nội dung khóa học: {{ $course->title }}</h3>

    <!-- Button: Add Section -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSectionModal">
        + Thêm Section
    </button>

    @foreach($sections as $section)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>{{ $section->section_name }}</strong>

                <button class="btn btn-sm btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#createLessonModal"
                        onclick="setSectionId({{ $section->id }})">
                    + Thêm bài học
                </button>
            </div>

            <ul class="list-group list-group-flush">
                @forelse($section->lessons as $lesson)
                    <li class="list-group-item">
                        {{ $lesson->lesson_title }}
                    </li>
                @empty
                    <li class="list-group-item text-muted">Chưa có bài học nào</li>
                @endforelse
            </ul>
        </div>
    @endforeach

</div>

<!-- Include Modals -->
@include('backend.instructor.course-section.modals.create-section-modal')
@include('backend.instructor.course-section.modals.create-lesson-modal')

<script>
    function setSectionId(id) {
        document.getElementById('section_id_for_lesson').value = id;
    }
</script>

@endsection
