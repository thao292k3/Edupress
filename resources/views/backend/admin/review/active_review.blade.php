@extends('backend.admin.master')
@section('content')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manage Review</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Active Reviews</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Course Name</th>
                            <th>User Name</th>
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
                            <td>{{ Str::limit($item->comment, 50) }}</td>
                            <td>
                                @php
                                    $rating = (int)$item->rating;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating)
                                        <i class='bx bxs-star text-warning'></i>
                                    @else
                                        <i class='bx bxs-star text-secondary'></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" 
                                        data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                    <span class="badge bg-success">Published</span>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.review.delete', $item->id) }}" class="btn btn-danger px-3" id="delete" title="Delete Review">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Xử lý thay đổi trạng thái nhanh bằng Ajax
        $('.status-toggle').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var review_id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.review.update.status') }}",
                data: {
                    'status': status,
                    'id': review_id,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                        
                        // location.reload(); 
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        });
    });
</script>
@endpush

@endsection