@extends('backend.instructor.master')
@section('content')
<div class="page-content">
    {{-- Breadcrumb & Title --}}
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('instructor.course.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tiến độ học viên</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('instructor.course.index') }}" class="btn btn-secondary btn-sm px-3"><i class="bx bx-arrow-back"></i> Quay lại</a>
        </div>
    </div>

    <div class="card radius-10 border-top border-0 border-4 border-primary">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <div>
                    <h5 class="mb-0 text-primary">Chi tiết tiến độ: {{ $course->course_title }}</h5>
                    <p class="mb-0 font-13 text-secondary">Theo dõi quá trình xem video và làm bài kiểm tra của học viên</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Học viên</th>
                            <th style="width: 30%;">Tiến độ Video</th>
                            <th style="width: 25%;">Tiến độ Quiz</th>
                            <th>Ngày đăng ký</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentsProgress as $student)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="widgets-icons-2 rounded-circle bg-light-primary text-primary me-3">
                                        <i class="bx bxs-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 font-14">{{ $student['user_name'] }}</h6>
                                        <p class="mb-0 font-12 text-secondary">{{ $student['user_email'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="font-12">Hoàn thành: <strong>{{ $student['video_count'] }}</strong></span>
                                    <span class="badge bg-light-success text-success">{{ $student['video_percentage'] }}%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                         role="progressbar" style="width: {{ $student['video_percentage'] }}%"></div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="font-12">Đã đỗ: <strong>{{ $student['quiz_count'] }}</strong></span>
                                    <span class="badge bg-light-info text-info">{{ $student['quiz_percentage'] }}%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-info" role="progressbar" 
                                         style="width: {{ $student['quiz_percentage'] }}%"></div>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($student['enrolled_at'])->format('d M, Y') }}</td>
                            <td>
                                @if ($student['issued_certificate'])
                                    <span class="badge rounded-pill bg-light-success text-success w-100">
                                        <i class="bx bx-check-double me-1"></i>Đã cấp chứng chỉ
                                    </span>
                                @elseif ($student['can_approve'])
                                    <span class="badge rounded-pill bg-light-warning text-warning w-100">
                                        <i class="bx bx-time-five me-1"></i>Chờ phê duyệt
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-light-secondary text-secondary w-100">
                                        <i class="bx bx-book-reader me-1"></i>Đang học
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (!$student['issued_certificate'] && $student['can_approve'])
                                    <form action="{{ route('instructor.certificate.approve', [$course->id, $student['user_id']]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm radius-30 px-3">
                                            Duyệt & Mail
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-light radius-30 px-3 disabled">---</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light-primary { background-color: rgba(13, 110, 253, 0.1) !important; }
    .bg-light-success { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-light-info { background-color: rgba(13, 202, 240, 0.1) !important; }
    .bg-light-warning { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-light-secondary { background-color: rgba(108, 117, 125, 0.1) !important; }
    .font-12 { font-size: 12px; }
    .font-13 { font-size: 13px; }
    .font-14 { font-size: 14px; }
    .radius-30 { border-radius: 30px; }
    .widgets-icons-2 {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
</style>
@endsection