@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Khóa học</div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tất cá khóa học</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0 text-uppercase">Tất cả khóa học</h6>
        <a href="{{ route('instructor.course.create') }}" class="btn btn-primary">Thêm khóa học</a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table id="courseTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên khóa học</th>
                            <th>Thể loại</th>
                            <th>Danh mục con</th>
                            <th>Giá gốc</th>
                            <th>Giá giảm</th>
                            <th>thời gian học (Tháng)</th>
                            
                            <th width="320px">Thao tác</th> 
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all_courses as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    @if ($item->course_image)
                                        <img src="{{ asset($item->course_image) }}" width="140" height="70" class="rounded">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>

                                <td>{{ $item->course_name }}</td>

                                <td>{{ $item->category->name ?? '-' }}</td>

                                <td>{{ $item->subCategory->name ?? '-' }}</td>

                                <td>{{ $item->selling_price }}</td>

                                <td>{{ $item->discount_price }}</td>
                                <td>
                                    @if ($item->is_free == 1)
                                        <span class="badge bg-success">FREE / No Limit</span>
                                    @elseif ($item->limit_duration_months)
                                        
                                        <span class="badge bg-warning">{{ $item->limit_duration_months }} tháng</span>
                                    @else
                                        <span class="badge bg-danger">Paid / No Limit Set</span>
                                    @endif
                                </td>
                                

                                <td class="d-flex flex-wrap">
                                    
                                    
                                    <a href="{{ route('instructor.course.edit', $item->id) }}" 
                                       class="btn btn-primary btn-sm me-1 mb-1" 
                                       title="Edit Course Info">
                                        <i class="bx bx-pencil"></i> Sửa
                                    </a>

                                    
                                    <a href="{{ route('instructor.course-section.show', $item->id) }}" 
                                       class="btn btn-info btn-sm me-1 mb-1" 
                                       title="Manage Sections & Lessons">
                                        <i class='bx bx-list-ul'></i> Nội Dung
                                    </a>
                                    
                                    
                                    <a href="{{ route('instructor.course.students.progress', $item->id) }}" 
                                       class="btn btn-success btn-sm me-1 mb-1" 
                                       title="Xem Tiến độ Học viên">
                                        <i class='bx bx-bar-chart-alt-2'></i> Tiến độ
                                    </a>

                                    
                                    <a href="javascript:void(0)" 
                                       class="btn btn-danger btn-sm mb-1 delete-btn"
                                       data-id="{{ $item->id }}" 
                                       title="Delete Course">
                                        <i class="bx bx-trash"></i> Xóa
                                    </a>
                                    
                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('instructor.course.destroy', $item->id) }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

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
    
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            
            title: 'Bạn chắc chắn muốn xóa?',
            text: "Khóa học này sẽ bị xóa vĩnh viễn và không thể phục hồi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    });
</script>
@endpush