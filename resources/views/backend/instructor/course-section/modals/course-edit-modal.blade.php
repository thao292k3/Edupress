<div class="modal fade" id="course-edit-{{ $lecture->id }}">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Cập nhật bài học</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{ route('instructor.lessons.update', $lecture->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="section_id" value="{{ $data->id }}">

                    {{-- Title --}}
                    <div class="col-md-12 mb-3">
                        <label for="lecture_title_{{ $lecture->id }}" class="form-label">Teeb bài học</label>
                        <input type="text" name="lecture_title" value="{{ $lecture->lecture_title }}"
                            class="form-control" id="lecture_title_{{ $lecture->id }}" placeholder="Enter lesson title"
                            required>
                    </div>

                    {{-- Video URL + Preview --}}
                    <div class="col-md-12 mb-3">
                        <label for="video_url_{{ $lecture->id }}" class="form-label">YouTube Video URL</label>
                        <input type="url" name="url" class="form-control video_url_edit"
                            id="video_url_{{ $lecture->id }}" value="{{ old('url', $lecture->url) }}"
                            placeholder="Enter YouTube video URL">

                        {{-- Dùng ID cho iframe để dễ dàng nhắm mục tiêu --}}
                        <iframe class="videoPreview mt-3" id="videoPreview_{{ $lecture->id }}"
                            style="width:100%; height:350px; display:none;" frameborder="0" allowfullscreen>
                        </iframe>
                    </div>

                    {{-- Duration --}}
                    <div class="col-md-12 mb-3">
                        <label for="video_duration_{{ $lecture->id }}" class="form-label">Thời lượng
                            (Phút)</label>
                        <input type="number" name="duration" value="{{ old('duration', $lecture->duration ?? '') }}"
                            class="form-control" id="video_duration_{{ $lecture->id }}" placeholder="Ví dụ: 30.5"
                            step="0.01" min="0">
                        @error('duration')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Content --}}
                    <div class="col-md-12 mb-3">
                        <label for="content_{{ $lecture->id }}" class="form-label">Nội dung</label>
                        <textarea name="content" class="form-control editor" id="content_{{ $lecture->id }}" rows="5" required>{{ $lecture->content }}</textarea>
                    </div>

                    {{-- Order --}}
                    <div class="mb-3">
                        <label class="form-label">Thứ tự bài học</label>
                        <input type="number" name="order" value="{{ old('order', $lecture->order) }}"
                            class="form-control">
                    </div>

                    {{-- Preview --}}
                    <div class="mb-3">
                        <label class="form-label">Xem trước</label>
                        <select name="is_preview" class="form-select">
                            <option value="0" @if ($lecture->is_preview == 0) selected @endif>No</option>
                            <option value="1" @if ($lecture->is_preview == 1) selected @endif>Yes (Free Preview)
                            </option>
                        </select>
                    </div>

                    <hr>

                    {{-- Upload Video --}}
                    <div class="col-md-12 mt-3">
                        <label for="video_file_{{ $lecture->id }}" class="form-label">Tải lên tệp video</label>
                        <input type="file" class="form-control" name="video_file"
                            id="video_file_{{ $lecture->id }}" accept="video/mp4,video/webm,video/ogg">
                        <p class="text-muted small">Tối đa 50MB. (Chỉ chọn nếu muốn thay đổi video hiện tại)</p>
                    </div>

                    <hr>

                    {{-- Attachments --}}
                    <h5 class="mt-3">Tệp đính kèm bài học</h5>
                    <p class="text-muted small">Bạn có thể tải nhiều file hoặc nhiều link tài liệu.</p>

                    {{-- Upload multiple files --}}
                    <div class="col-md-12 mt-3">
                        <label for="lesson_file_{{ $lecture->id }}" class="form-label">Tải lên tài liệu bài học(PDF,
                            DOCX, ZIP)</label>
                        <input type="file" class="form-control" name="lesson_file"
                            id="lesson_file_{{ $lecture->id }}" accept=".pdf,.doc,.docx,.zip">
                        <p class="text-muted small">Tối đa 20MB. (Chỉ chọn nếu muốn thêm/thay thế file)</p>

                        {{-- Hiển thị file đã upload (nếu có) --}}
                        @if ($lecture->lesson_file)
                            <p class="text-info small mt-1">File hiện tại: <a
                                    href="{{ Storage::url($lecture->lesson_file) }}"
                                    target="_blank">{{ basename($lecture->lesson_file) }}</a></p>
                        @endif
                    </div>

                    {{-- Attachment Links --}}
                    <div class="col-md-12 mt-3" id="attachment_links_{{ $lecture->id }}">
                        <label for="lesson_document_link_{{ $lecture->id }}" class="form-label">Lesson Document
                            Link</label>

                        
                        @php
                            $current_links = json_decode($lecture->lesson_document_link ?? '[]', true);
                            if (empty($current_links)) {
                                
                                $current_links = [''];
                            }
                        @endphp

                        @foreach ($current_links as $link)
                            <div class="input-group mb-2">
                                <input type="url" class="form-control" name="lesson_document_link[]"
                                    placeholder="Enter document link (Google Drive, Dropbox,...)"
                                    value="{{ $link }}">
                                <button class="btn btn-danger remove-link" type="button">X</button>
                            </div>
                        @endforeach

                    </div>

                    <button type="button" class="btn btn-secondary add-link"
                        data-target="#attachment_links_{{ $lecture->id }}">
                       Thêm liên kết
                    </button>

            </div> {{-- End Modal Body --}}

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary w-100">
                    Cập nhật bài học
                </button>
            </div>
            </form>

        </div>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            

            let videoInputs = document.querySelectorAll(".video_url_edit");

            function extractYouTubeVideoID(url) {
               
                let regex =
                    /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
                let match = url.match(regex);
                return match ? match[1] : null;
            }

            videoInputs.forEach(videoInput => {
                
                let modal = videoInput.closest('.modal-content');
                
                let lectureId = videoInput.id.split('_').pop();
                let videoPreview = modal.querySelector("#videoPreview_" + lectureId);

                function updateVideoPreview() {
                    let url = videoInput.value.trim();
                    let videoId = extractYouTubeVideoID(url);

                    if (videoId && videoPreview) {
                        videoPreview.src = `https://www.youtube.com/embed/${videoId}`;
                        videoPreview.style.display = "block";
                    } else if (videoPreview) {
                        videoPreview.src = "";
                        videoPreview.style.display = "none";
                    }
                }

                videoInput.addEventListener("input", updateVideoPreview);

                
                if (videoInput.value.trim() !== "") {
                    updateVideoPreview();
                }

            });

            
            $(document).on("click", ".add-link", function() {
                let targetId = $(this).data("target");
                $(targetId).append(`
            <div class="input-group mb-2">
                <input type="url" name="lesson_document_link[]" class="form-control" placeholder="Enter file link">
                <button class="btn btn-danger remove-link" type="button">X</button>
            </div>
        `);
            });

            
            $(document).on("click", ".remove-link", function() {
                
                let container = $(this).closest('[id^="attachment_links_"]');
                if (container.children('.input-group').length > 1 || container.children('.input-group')
                    .length === 1 && $(this).closest('.input-group').find('input').val() !== '') {
                    $(this).closest(".input-group").remove();
                } else if (container.children('.input-group').length === 1) {
                    
                    $(this).closest(".input-group").find('input').val('');
                }
            });
        });
    </script>
@endpush
