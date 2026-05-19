<div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chỉnh sửa chương học</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('instructor.course-section.update', $section->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="course_id" value="{{ $course->id }}" />
                    
                    <div class="mb-3">
                        <label for="section-title-{{ $section->id }}" class="form-label">Tên chương học</label>
                        <input type="text" class="form-control" name="title" 
                               id="section-title-{{ $section->id }}" 
                               value="{{ $section->title }}" required>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100">Cập nhật chương</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>