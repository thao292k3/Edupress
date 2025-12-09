@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    <div class="card">
        <div class="card-header">
            <h4>Create Lesson</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('instructor.lessons.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Course --}}
                <div class="mb-3">
                    <label class="form-label">Select Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">-- Choose Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Lesson Title</label>
                    <input type="text" name="title" class="form-control" required placeholder="Lesson title...">
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Lesson description"></textarea>
                </div>

                {{-- Order --}}
                <div class="mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>

                {{-- Preview --}}
                <div class="mb-3">
                    <label class="form-label">Is Preview?</label>
                    <select name="is_preview" class="form-select">
                        <option value="0">No</option>
                        <option value="1">Yes (free preview)</option>
                    </select>
                </div>

                {{-- Video URL --}}
                <div class="mb-3">
                    <label class="form-label">Video URL (YouTube)</label>
                    <input type="text" name="video_url" class="form-control" placeholder="https://youtube.com/...">
                </div>

                {{-- Video File Upload --}}
                <div class="mb-3">
                    <label class="form-label">Or Upload Video File</label>
                    <input type="file" name="video_file" class="form-control" accept="video/*">
                </div>

                {{-- Upload file tài liệu --}}
        <div class="mb-3">
            <label class="form-label">Tài liệu (PDF, DOCX, ZIP)</label>
            <input type="file" name="attachments[]" class="form-control" multiple accept=".pdf,.doc,.docx,.zip">
        </div>

        {{-- Link tài liệu --}}
        <div class="mb-3">
            <label class="form-label">Link tài liệu</label>
            <div id="link-area">
                <input type="text" name="links[]" class="form-control mb-2" placeholder="https://drive.google.com/...">
            </div>
                <button type="button" class="btn btn-secondary btn-sm" onclick="addLink()">+ Add Link</button>
                <button class="btn btn-primary">Create Lesson</button>

            </form>

        </div>
    </div>

</div>

<script>
function addLink() {
    document.getElementById('link-area').insertAdjacentHTML('beforeend',
        `<input type="text" name="links[]" class="form-control mb-2" placeholder="https://...">`
    );
}
</script>


@endsection
