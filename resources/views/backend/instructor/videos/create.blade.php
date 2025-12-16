@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    <h4 class="mb-3">Create Lesson</h4>

    <form action="{{ route('instructor.lessons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-body">

                {{-- COURSE --}}
                <div class="mb-3">
                    <label class="form-label">Select Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Choose Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- SECTION --}}
                <div class="mb-3">
                    <label class="form-label">Select Section</label>
                    <select name="section_id" class="form-select" required>
                        <option value="">-- Select Section --</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">
                                {{ $section->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- LESSON TITLE --}}
                <div class="mb-3">
                    <label class="form-label">Lesson Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                </div>

                {{-- MULTIPLE VIDEOS --}}
                <div class="mb-3">
                    <label class="form-label">Videos</label>
                    <div id="video-area">
                        <div class="d-flex gap-2 mb-2">
                            <input type="text" name="videos[0][url]" class="form-control" placeholder="https://youtu.be/...">
                            <input type="file" name="videos[0][file]" class="form-control" accept="video/*">
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="addVideo()">+ Add Video</button>
                </div>

                {{-- ATTACHMENTS --}}
                <div class="mb-3">
                    <label class="form-label">Attachments (PDF, DOCX, ZIP)</label>
                    <input type="file" name="attachments[]" class="form-control" multiple accept=".pdf,.doc,.docx,.zip">
                </div>

                {{-- LINKS --}}
                <div class="mb-3">
                    <label class="form-label">Resource Links</label>
                    <div id="link-area">
                        <input type="text" name="links[]" class="form-control mb-2" placeholder="https://drive.google.com/...">
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="addLink()">+ Add Link</button>
                </div>

                <button class="btn btn-primary">Create Lesson</button>

            </div>
        </div>

    </form>

</div>

<script>
let videoIndex = 1;

function addVideo() {
    document.getElementById('video-area').insertAdjacentHTML('beforeend', `
        <div class="d-flex gap-2 mb-2">
            <input type="text" name="videos[${videoIndex}][url]" class="form-control" placeholder="https://youtu.be/...">
            <input type="file" name="videos[${videoIndex}][file]" class="form-control" accept="video/*">
        </div>
    `);
    videoIndex++;
}

function addLink() {
    document.getElementById('link-area').insertAdjacentHTML('beforeend',
        `<input type="text" name="links[]" class="form-control mb-2" placeholder="https://...">`
    );
}
</script>
@endsection
