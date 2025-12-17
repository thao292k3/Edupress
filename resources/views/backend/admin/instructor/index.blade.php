@extends('backend.admin.master')

<style>
    .form-check-input {
        width: 2.5rem;
        /* Adjust the width */
        height: 1.5rem;
        /* Adjust the height */
        transform: scale(1.3);
        /* Scale the entire switch */
    }
</style>

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        @include('backend.section.breadcrumb', ['title'=> 'Instructor', 'sub_title'=> 'Managed Instructor']);
        <!--end breadcrumb-->
        <div style="display: flex; align-items:center; justify-content:space-between">
            <h6 class="mb-0 text-uppercase">All Instructor</h6>

        </div>

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_instructors as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($item->photo)
                                            <img src="{{ asset($item->photo) }}" width="70" height="70" />
                                        @else
                                            <span>No image found</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-primary px-3 py-2" style="font-weight: 200">Active</span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2" style="font-weight: 200">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch" >
                                            <input class="form-check-input" style="cursor: pointer" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault{{ $item->id }}"
                                                data-user-id="{{ $item->id }}"
                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.form-check-input').on('change', function() {
                const $this = $(this); // Lưu lại đối tượng checkbox
                const userId = $this.data('user-id');
                const status = $this.is(':checked') ? 1 : 0;
                const row = $this.closest('tr');
                const statusBadge = row.find('td:nth-child(6) .badge');

                // Vô hiệu hóa tạm thời để tránh click nhiều lần
                $this.prop('disabled', true);

                $.ajax({
                    url: '{{ route('admin.instructor.status') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        status: status
                    },
                    success: function(response) {
                        $this.prop('disabled', false); // Mở lại checkbox
                        
                        if (response.success) {
                            // Cập nhật Badge
                            if (status === 1) {
                                statusBadge.removeClass('bg-danger').addClass('bg-primary').text('Active');
                            } else {
                                statusBadge.removeClass('bg-primary').addClass('bg-danger').text('Inactive');
                            }

                            // Thông báo Toast thành công
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                        } else {
                            // Nếu server trả về lỗi, rollback trạng thái checkbox
                            $this.prop('checked', !status);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        $this.prop('disabled', false);
                        $this.prop('checked', !status); // Rollback
                        console.error('AJAX Error:', xhr);
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Thất bại',
                            text: 'Không thể kết nối đến máy chủ. Vui lòng thử lại.'
                        });
                    }
                });
            });
        });
    </script>
@endpush