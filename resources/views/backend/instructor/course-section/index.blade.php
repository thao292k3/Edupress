@extends('backend.instructor.master')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Khóa học</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chương học</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-12 col-lg-12">
                <div style="display: flex; align-items:center; justify-content:space-between">
                    <h6 class="mb-0 text-uppercase">Tất cả các phần nội dung</h6>
                    <a href="{{ route('instructor.course.index') }}" class="btn btn-danger px-5">Quay lại</a>

                </div>

                <hr />
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90"
                                height="90" alt="...">
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mt-0">{{ $course->course_name }}</h6>
                                <p class="mb-0">{{ $course->course_title }}
                                </p>
                            </div>
                            <div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Thêm chương
                                    học</button>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($course_wise_lecture as $section)
                    <div class="card col-md-12 radius-10">
                        <div class="card-body">

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <!-- Icon -->
                                    <svg style="cursor: pointer" data-bs-toggle="collapse"
                                        data-bs-target="#demo{{ $section->id }}" xmlns="http://www.w3.org/2000/svg"
                                        width="25" height="25" fill="currentColor" class="bi bi-plus-circle"
                                        viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    <!-- Title -->
                                    <div class="ms-3">
                                        <h6 class="mt-0 mb-0">{{ $section->title }}</h6>

                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#course-{{ $section->id }}" title="Thêm bài học">
                                        <i class="bx bx-plus-circle fs-5"></i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#editSectionModal{{ $section->id }}" title="Sửa chương">
                                        <i class="bx bx-edit fs-5"></i>
                                    </button>

                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger delete-section"
                                        data-id="{{ $section->id }}" title="Xóa chương">
                                        <i class="bx bx-trash fs-5"></i>
                                    </a>

                                    <form id="delete-form-{{ $section->id }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>


                            </div>
                        </div>

                        <hr>

                        
                        <div class="collapse show mt-3" id="demo{{ $section->id }}">
                            <div class="list-group list-group-flush border rounded">
                                @foreach ($section->lessons as $lesson)
                                    <div
                                        class="list-group-item d-flex align-items-center justify-content-between py-2 px-3">
                                        <div class="d-flex align-items-center">
                                            @if ($lesson->lesson_type == 1)
                                                <i class="bx bx-help-circle text-warning fs-5 me-2"></i>
                                                <span class="fw-medium">{{ $lesson->lecture_title }}</span>
                                                <span class="badge bg-light-warning text-warning ms-2">Quiz</span>
                                            @else
                                                <i class="bx bx-play-circle text-primary fs-5 me-2"></i>
                                                <span>{{ $lesson->lecture_title }}</span>
                                            @endif
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                                data-bs-target="#course-edit-{{ $lesson->id }}">
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger delete-lesson"
                                                data-id="{{ $lesson->id }}">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </div>
                                    </div>

                                    
                                    @include('backend.instructor.course-section.modals.course-edit-modal', [
                                        'lecture' => $lesson,
                                        'data' => $section,
                                    ])
                                @endforeach

                                
                            </div>
                        </div>


                    </div>

                    @include('backend.instructor.course-section.modals.edit-section-modal', ['section' => $section])


                    <!-- Add Course Modal -->
                    @include('backend.instructor.course-section.modals.create-lesson-modal')
                @endforeach


            </div>
        </div>



        <!-- course section Modal -->
        @include('backend.instructor.course-section.modals.create-section-modal')





    </div>
@endsection

@push('scripts')
    <script src="{{ asset('customjs/instructor/lecture.js') }}"></script>

    <script>
        $(document).on('click', '.delete-lesson', function(e) {
            e.preventDefault();

            let lessonId = $(this).data('id');

            let deleteForm = document.getElementById('delete-form-' + lessonId);

            if (!deleteForm) {

                let deleteUrl = "{{ route('instructor.lessons.destroy', ':id') }}".replace(':id', lessonId);
                deleteForm = $('#delete-form');
                deleteForm.attr('action', deleteUrl);
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (deleteForm.nodeName) {
                        deleteForm.submit();
                    } else {
                        deleteForm.get(0).submit();
                    }
                }
            });
        });

        
    </script>

    
@endpush
