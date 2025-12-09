<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Course_videos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CourseVideoController extends Controller
{
      public function index()
    {
        $instructorId = Auth::id();

        // Lấy tất cả video thuộc những khóa học mà instructor sở hữu
        $videos = Course_videos::with('course')
            ->whereHas('course', function ($q) use ($instructorId) {
                $q->where('instructor_id', $instructorId);
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.instructor.videos.index', compact('videos'));
    }


    // Trang upload video
    public function create()
    {
        $courses = Course::where('instructor_id', Auth::id())->get();

        return view('backend.instructor.videos.create', compact('courses'));
    }


    // Lưu video
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:50000'
        ]);

        $videoFile = $request->file('video_file');

        
        if ($videoFile && $videoFile->isValid()) {
            $path = $videoFile->store('course/videos', 'public');

            Course_videos::create([
                'course_id' => $request->course_id,
                'video_file' => $path,
                'video_type' => 'upload'
            ]);
        }

        // Nếu là link Youtube
        if ($request->video_url) {
            Course_videos::create([
                'course_id' => $request->course_id,
                'video_url' => $request->video_url,
                'video_type' => 'youtube'
            ]);
        }

        return redirect()->route('instructor.videos.index')
            ->with('success', 'Video added successfully!');
    }


    // Xóa video
    public function destroy(Course_videos $video)
    {
        // Xóa file nếu là video upload
        if ($video->video_type === 'upload' && $video->video_file) {
            Storage::disk('public')->delete($video->video_file);
        }

        $video->delete();

        return back()->with('success', 'Video deleted successfully!');
    }
}
