@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    <div class="card">
        <div class="card-header">
            <h4>Edit Lesson</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('instructor.lessons.update', $lesson->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Select Course --}}
                <div class="mb-3">
                    <label class="form-label">Select Course</label>
                    <select name="course_id" class="form-select" required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" 
                                {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Lesson Title --}}
                <div class="mb-3">
                    <label class="form-label">Lesson Title</label>
                    <input type="text" name="title" class="form-control" 
                           value="{{ $lesson->title }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" 
                              class="form-control">{{ $lesson->description }}</textarea>
                </div>

                {{-- Order --}}
                <div class="mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" 
                           value="{{ $lesson->order }}">
                </div>

                {{-- Preview --}}
                <div class="mb-3">
                    <label class="form-label">Is Preview?</label>
                    <select name="is_preview" class="form-select">
                        <option value="0" {{ $lesson->is_preview == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $lesson->is_preview == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>

                {{-- Video URL --}}
                <div class="mb-3">
                    <label class="form-label">Video URL (YouTube)</label>
                    <input type="text" name="video_url" class="form-control" 
                           value="{{ $lesson->video_url }}">
                </div>

                {{-- Current Video Preview --}}
                @if($lesson->video_url)
                    <div class="mb-3">
                        <label class="form-label">Current Video (URL)</label><br>
                        <iframe width="300" height="180"
                            src="{{ str_replace('watch?v=', 'embed/', $lesson->video_url) }}"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif

                {{-- Uploaded Video --}}
                @if($lesson->video_file)
                    <div class="mb-3">
                        <label class="form-label">Uploaded Video</label><br>
                        <video width="300" controls>
                            <source src="{{ asset('storage/' . $lesson->video_file) }}">
                        </video>
                    </div>
                @endif

                {{-- Upload New Video --}}
                <div class="mb-3">
                    <label class="form-label">Upload New Video</label>
                    <input type="file" name="video_file" 
                           class="form-control" accept="video/*">
                </div>

               

                <hr>
                <h5 class="mt-4">Lesson Materials</h5>

                {{-- Upload New Attachments --}}
                <div class="mb-3">
                    <label class="form-label">Upload Files (PDF, DOCX, ZIP)</label>
                    <input type="file" name="attachments[]" class="form-control"
                           multiple accept=".pdf,.doc,.docx,.zip">
                </div>

                {{-- Add Link --}}
                <div class="mb-3">
                    <label class="form-label">Add Document Links</label>
                    <div id="link-area">
                        <input type="text" name="links[]" class="form-control mb-2"
                               placeholder="https://drive.google.com/...">
                    </div>

                    <button type="button" class="btn btn-secondary btn-sm" 
                        onclick="addLinkInput()">+ Add Link</button>
                </div>

                {{-- Current Attachments --}}
                <div class="mt-4">
                    <h5>Existing Lesson Materials</h5>

                    @if($lesson->attachments->count() > 0)
                        <ul class="list-group">

                            @foreach($lesson->attachments as $file)
                                <li class="list-group-item d-flex justify-content-between align-items-center">

                                    @if($file->type === 'file')
                                        📄 <a href="{{ asset('storage/' . $file->file_path) }}" 
                                              target="_blank">{{ $file->file_name }}</a>
                                    @else
                                        🔗 <a href="{{ $file->link_url }}" target="_blank">
                                            {{ $file->link_url }}
                                        </a>
                                    @endif

                                    <a href="{{ route('instructor.lessons.edit', $file->id) }}" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this attachment?')">
                                        Delete
                                    </a>

                                </li>
                            @endforeach

                        </ul>
                    @else
                        <p class="text-muted">No attachments yet.</p>
                    @endif
                </div>

                <button class="btn btn-primary mt-4">Update Lesson</button>

            </form>

        </div>
    </div>

</div>

<script>
function addLinkInput() {
    document.getElementById('link-area')
        .insertAdjacentHTML('beforeend', 
            `<input type="text" name="links[]" class="form-control mb-2" placeholder="https://drive.google.com/...">`
        );
}
</script>

@endsection
