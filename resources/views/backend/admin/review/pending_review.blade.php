@extends('backend.admin.master')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Course</th>
                        <th>User</th>
                        <th>Comment</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->course->name }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->comment }}</td>
                        <td>
                            @for($i=1; $i<=5; $i++)
                                <i class='bx bxs-star {{ $i <= $item->rating ? "text-warning" : "text-secondary" }}'></i>
                            @endfor
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status-toggle" type="checkbox" 
                                    data-id="{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.review.delete', $item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(function() {
    $('.status-toggle').on('change', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('admin.review.update.status') }}",
            data: {'status': status, 'id': id, '_token': '{{ csrf_token() }}'},
            success: function(data){
                toastr.success(data.success);
            }
        });
    });
});
</script>
@endsection