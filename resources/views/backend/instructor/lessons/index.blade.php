@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    <div class="d-flex justify-content-between mb-3">
        <h4>All Lessons</h4>
        <a href="{{ route('instructor.lessons.create') }}" class="btn btn-primary">Add New Lesson</a>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="40">#</th> <!-- drag -->
                        <th>Course</th>
                        <th>Title</th>
                        <th>Order</th>
                        <th>Preview</th>
                        <th>Video</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>

                <tbody id="lessonSortable">
                    @foreach ($lessons as $lesson)
                        <tr data-id="{{ $lesson->id }}">
                            <td class="drag-handle text-center" style="cursor: move;">↕</td>

                            <td>{{ $lesson->course->course_name }}</td>
                            <td>{{ $lesson->title }}</td>
                            <td>{{ $lesson->order }}</td>
                            <td>{{ $lesson->is_preview ? 'Yes' : 'No' }}</td>

                            <td>
                                @if ($lesson->video_url)
                                    <span class="badge bg-info">YouTube</span>
                                @elseif($lesson->video_file)
                                    <span class="badge bg-success">Uploaded</span>
                                @else
                                    <span class="badge bg-secondary">None</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('instructor.lessons.edit', $lesson->id) }}"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <!-- DELETE BUTTON WITH MODAL -->
                                <button type="button"
                                    class="btn btn-sm btn-danger"
                                    onclick="confirmDelete('{{ route('instructor.lessons.destroy', $lesson->id) }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <!-- DELETE CONFIRM MODAL -->
            <div class="modal fade" id="deleteModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Delete Lesson</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            Are you sure you want to delete this lesson?
                        </div>

                        <div class="modal-footer">
                            <form method="POST" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection


<!-- DELETE HANDLER -->
<script>
function confirmDelete(url) {
    document.getElementById("deleteForm").action = url;
    var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>

<!-- SORTABLE JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<script>
var el = document.getElementById('lessonSortable');

new Sortable(el, {
    animation: 150,
    handle: '.drag-handle',
    onEnd: function () {
        let order = [];
        document.querySelectorAll('#lessonSortable tr').forEach(row => {
            order.push(row.dataset.id);
        });

        fetch("{{ route('instructor.lessons.sort') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ order })
        });
    }
});
</script>
