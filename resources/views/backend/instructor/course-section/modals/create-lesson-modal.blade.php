<div class="modal" id="course-{{ $section->id }}">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm bài học</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <div class="mb-4">
                    <h5 class="mb-2">Loại bài học:</h5>
                    <div class="btn-group w-100" role="group" aria-label="Lesson Type Selection">
                        {{-- Mặc định là Lesson/Video --}}
                        <button type="button" class="btn btn-primary active lesson-type-switch" data-type="video">
                            <i class="fas fa-video"></i> Video/Text Lesson
                        </button>

                        {{-- Nút chuyển hướng đến trang tạo Quiz --}}
                        <a href="{{ route('instructor.quizzes.create', ['course_id' => $section->course_id, 'section_id' => $section->id]) }}"
                            class="btn btn-outline-info lesson-type-switch" target="_blank">
                            <i class="fas fa-question-circle"></i> Tạo bài kiểm tra 
                        </a>
                    </div>
                </div>

                <form action="{{ route('instructor.lessons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="course_id" value="{{ $section->course_id }}">
                    <input type="hidden" name="section_id" value="{{ $section->id }}">
                    <input type="hidden" name="lesson_type" value="0">


                    {{-- Title --}}
                    <div class="col-md-12">
                        <label for="lecture_title" class="form-label">Tên bài học</label>
                        <input type="text" class="form-control" name="lecture_title" id="lecture-title"
                            placeholder="Enter the lecture title" required>
                    </div>

                    {{-- YouTube URL --}}
                    <div class="col-md-12 mt-3">
                        <label for="video_url" class="form-label">YouTube Video URL</label>
                        <input type="url" class="form-control" name="url" id="video_url"
                            placeholder="Enter the YouTube video URL" value="{{ old('url') }}" required>
                        <iframe id="videoPreview" style="margin-top: 15px; display: none; width: 100%; height: 400px;"
                            frameborder="0" allowfullscreen></iframe>
                    </div>

                    {{-- Duration --}}
                    <div class="col-md-12 mt-3">
                        <label for="duration" class="form-label">Thời lượng bài học (phút)</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="duration"
                            id="video_duration" placeholder="e.g. 5.50 (5 minutes 30 seconds)">
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12 mt-3">
                        <label for="content" class="form-label">Nội dung</label>

                        <textarea class="form-control editor" name="content" required></textarea>
                    </div>

                    {{-- Order --}}
                    @php
                       
                        $maxOrder = $section->lesson->max('order');
                        $nextOrder = $maxOrder === null ? 1 : $maxOrder + 1;
                    @endphp

                   
                    <div class="col-md-12 mb-3">
                        <label for="order_{{ $section->id }}" class="form-label">Thứ tự bài học</label>
                        <input type="number" name="order" value="{{ $nextOrder }}" 
                            class="form-control" id="order_{{ $section->id }}" placeholder="Enter lesson order"
                            min="1" step="1">
                        <small class="text-muted">Giá trị tự động gợi ý. Có thể ghi đè thủ công.</small>
                    </div>

                    {{-- Preview --}}
                    <div class="mb-3">
                        <label class="form-label">Xem trước?</label>
                        <select name="is_preview" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes (Free Preview)</option>
                        </select>
                    </div>

                    <hr>

                    {{-- Upload Video --}}
                    <div class="col-md-12 mt-3">
                        <label for="video_file" class="form-label">Tải lên tệp video</label>
                        <input type="file" class="form-control" name="video_file" id="video_file"
                            accept="video/mp4,video/webm,video/ogg">
                        <p class="text-muted small">Tối đa 50MB (Theo LessonRequest.php: max:50000)</p>
                    </div>

                    <hr>

                    {{-- Attachments --}}
                    <h5 class="mt-3">Tài liệu bài học</h5>
                    <p class="text-muted small">Bạn có thể tải nhiều file hoặc nhiều link tài liệu.</p>

                    {{-- Upload multiple files --}}
                    <div class="col-md-12 mt-3">
                        <label for="lesson_file" class="form-label">Tải lên tài liệu bài học (PDF, DOCX, ZIP)</label>
                        <input type="file" class="form-control" name="lesson_file" id="lesson_file"
                            accept=".pdf,.doc,.docx,.zip">
                        <p class="text-muted small">Tối đa 20MB (Theo LessonRequest.php: max:20000)</p>
                    </div>

                    {{-- Attachment Links --}}
                    <div class="col-md-12 mt-3">
                        <label for="lesson_document_link" class="form-label">Link tài liệu bài học</label>
                        <input type="url" class="form-control" name="lesson_document_link"
                            id="lesson_document_link" placeholder="Enter document link (Google Drive, Dropbox,...)">
                    </div>

                    <button type="button" class="btn btn-secondary add-link"
                        data-target="#attachment_links_{{ $section->id }}">
                        Thêm Link
                    </button>
            </div>

            <hr>

            <button type="submit" class="btn btn-success w-100">Tạo mới bài học</button>
            </form>

        </div>
    </div>
</div>
</div>




@push('scripts')
    <script>
        document.querySelectorAll("[id^='video_url_']").forEach(input => {
            input.addEventListener("input", function() {
                let iframe = document.getElementById("videoPreview_" + this.id.split("_")[2]);
                let url = this.value;

                if (url.includes("youtube.com") || url.includes("youtu.be")) {
                    let videoId = url.split("v=")[1] || url.split("/").pop();
                    iframe.src = "https://www.youtube.com/embed/" + videoId;
                    iframe.style.display = "block";
                } else {
                    iframe.style.display = "none";
                }
            });
        });

        // Add/remove attachment links
        $(document).on("click", ".add-link", function() {
            let target = $(this).data("target");
            $(target).append(`
        <div class="input-group mb-2">
            <input type="url" name="attachment_links[]" class="form-control" placeholder="Enter file link">
            <button class="btn btn-danger remove-link" type="button">X</button>
        </div>
    `);
        });

        $(document).on("click", ".remove-link", function() {
            $(this).closest(".input-group").remove();
        });
    </script>
@endpush
