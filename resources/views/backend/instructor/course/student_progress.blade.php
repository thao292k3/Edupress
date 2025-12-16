@extends('backend.instructor.master')

@section('content')
<div class="page-content">

    {{-- Tiêu đề --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4><i class="bx bx-run me-2"></i>Tiến Độ Học Viên Khóa Học</h4>
        <a href="{{ route('instructor.course.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Quay lại Danh sách Khóa học
        </a>
    </div>

    {{-- Thông tin Khóa học --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title fw-bold">{{ $course->course_title }}</h5>
            <p class="card-text mb-0">Giảng viên: **{{ $course->instructor->name ?? 'N/A' }}**</p>
            <p class="card-text mb-0">Tổng số học viên đã ghi danh: **{{ count($studentsProgress) }}**</p>
        </div>
    </div>

    {{-- Bảng Tiến độ Học viên --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Danh sách Học viên & Tiến độ</h5>

            @if (count($studentsProgress) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tên Học viên</th>
                                <th>Email</th>
                                <th>Ngày Ghi danh</th>
                                <th width="200">Tiến độ Hoàn thành</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentsProgress as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <h6 class="mb-0">{{ $student['user_name'] }}</h6>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-muted">{{ $student['user_email'] }}</p>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($student['enrolled_at'])->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar 
                                                @if($student['progress_percentage'] < 50) bg-warning text-dark
                                                @elseif($student['progress_percentage'] == 100) bg-success
                                                @else bg-info
                                                @endif" 
                                                role="progressbar" 
                                                style="width: {{ $student['progress_percentage'] }}%;" 
                                                aria-valuenow="{{ $student['progress_percentage'] }}" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                **{{ $student['progress_percentage'] }}%**
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info border-0 bg-info alert-dismissible fade show">
                    <div class="text-white">Chưa có học viên nào ghi danh vào khóa học này.</div>
                </div>
            @endif
            
        </div>
    </div>

</div>
@endsection