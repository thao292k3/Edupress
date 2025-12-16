@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Live Sessions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tất cả buổi dạy</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('instructor.live-sessions.create') }}" class="btn btn-primary px-4">
                <i class="bx bx-plus-circle"></i> Thêm buổi mới
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khóa học</th>
                            <th>Chủ đề</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Nền tảng</th>
                            <th>GV tham gia</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            
                            <td>{{ $item->course?->course_name }}</td> 
                            <td>{{ $item->topic }}</td>
                            <td>
                                
                                @if($item->start_at)
                                    {{ $item->start_at->format('d/m/Y H:i') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td><span class="badge bg-info">{{ $item->platform }}</span></td>
                            <td>
                                @if($item->is_teacher_joined)
                                    <span class="badge bg-success">Đã điểm danh</span>
                                @else
                                    <span class="badge bg-warning text-dark">Chưa vào</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    
                                    <a href="{{ route('instructor.live.join', $item->id) }}" target="_blank" class="btn btn-success btn-sm" title="Vào dạy">
                                        <i class="bx bx-video"></i> Bắt đầu
                                    </a>
                                    
                                    <a href="{{ route('instructor.live-sessions.show', $item->id) }}" class="btn btn-primary btn-sm" title="Xem điểm danh">
                                        <i class="bx bx-user-check"></i>
                                    </a>
                                    <a href="{{ route('instructor.live-sessions.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('instructor.live-sessions.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Xóa buổi học này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                                    </form>
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