@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-white">Chi tiết điểm danh: {{ $live_session->topic }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Khóa học:</strong> {{ $live_session->course->course_name }}</p>
                    <p><strong>Thời gian dạy:</strong> {{ $live_session->start_at->format('H:i d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Giáo viên điểm danh:</strong> 
                        @if(isset($teacherAttendance) && $teacherAttendance)
                            <span class="badge bg-success">Đã có mặt ({{ $teacherAttendance->joined_at->format('H:i:s') }})</span>
                        @else
                            <span class="badge bg-danger">Chưa có mặt</span>
                        @endif
                    </p>
                </div>
            </div>

            <hr>
            <h6>Danh sách học sinh tham gia ({{ $studentAttendances->count() }})</h6>
            <div class="table-responsive mt-3">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Học sinh</th>
                            <th>Email</th>
                            <th>Thời điểm tham gia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($studentAttendances as $key => $att)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $att->user->name }}</td>
                            <td>{{ $att->user->email }}</td>
                            <td>{{ $att->joined_at->format('H:i:s d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Chưa có học sinh nào tham gia qua link hệ thống.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection