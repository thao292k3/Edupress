@extends('backend.instructor.master')

@section('content')
<div class="page-content">
    <h4 class="mb-3">Manage Videos</h4>

    <a href="{{ route('instructor.videos.create') }}" class="btn btn-primary mb-3">
        Add New Video
    </a>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Preview</th>
                        <th>Type</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $video->course->course_name }}</td>

                            <td>
                                @if ($video->video_type == 'youtube')
                                    <a href="{{ $video->video_url }}" target="_blank">View Youtube</a>
                                @else
                                    <video width="200" controls>
                                        <source src="{{ asset('storage/'.$video->video_file) }}">
                                    </video>
                                @endif
                            </td>

                            <td>
                                <span class="badge bg-info">{{ ucfirst($video->video_type) }}</span>
                            </td>

                            <td>
                                <form method="POST" action="{{ route('instructor.videos.destroy', $video->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this video?')">
                                        Delete
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
