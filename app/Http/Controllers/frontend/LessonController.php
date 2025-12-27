<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
   public function show($id)
    {
        
        $lesson = Lesson::with('section.course')->findOrFail($id);
        $course = $lesson->section->course;
        $user = Auth::user();

        
        $isEnrolled = false;
        if ($user) {
            $isEnrolled = \App\Models\CourseEnrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->exists();
        }

        
        $courseIsFree = ($course->selling_price <= 0 || $course->is_free == 1);
        
       
        $canView = false;

        if ($user && ($user->id == $course->instructor_id || $isEnrolled)) {
            $canView = true;
        } elseif ($lesson->is_preview == 1) { 
            $canView = true;
        }

        if (!$canView) {
            if (!$user) {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem bài học này.');
            }
            if (!$courseIsFree && !$isEnrolled) {
                return redirect()->back()->with('error', 'Bạn cần mua khóa học này để xem nội dung.');
            }
        }

        
        $course_content = \App\Models\Section::where('course_id', $course->id)
            ->with(['lesson', 'quizzes'])
            ->orderBy('id', 'asc')
            ->get();

        
        
        $course_content = Section::where('course_id', $course->id)
            ->with(['lesson', 'quizzes'])
            ->orderBy('id', 'asc') 
            ->get();

        
        $videoUrl = $lesson->video_url ?? $lesson->url ?? ''; 
        $isYoutube = false;
        $youtubeId = null;

        if (!empty($videoUrl)) {
            if (str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be')) {
                $isYoutube = true;
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match);
                $youtubeId = $match[1] ?? null;
            }
        }

        
        // $user = auth()->user();
        $isEnrolled = $user ? CourseEnrollment::where('course_id', $course->id)->where('user_id', $user->id)->exists() : false;
        $courseIsFree = ($course->selling_price ?? 0) <= 0;
        $canViewFull = $user && ($isEnrolled || $courseIsFree);
        $canViewPreview = $lesson->preview_count == 1;

        return view('frontend.section.lesson-detail', compact(
            'lesson', 'course', 'course_content', 'isEnrolled', 
            'canViewFull', 'canViewPreview', 'isYoutube', 'youtubeId', 'videoUrl'
        ));
    }

    /**
     * Mark a lesson as watched (AJAX).
     */
    public function markWatched(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        if (! $lesson) {
            return response()->json(['ok' => false, 'message' => 'Lesson not found'], 404);
        }

        
        $watched = session()->get('watched_lessons', []);
        if (! in_array($lesson->id, $watched)) {
            $watched[] = $lesson->id;
            session()->put('watched_lessons', $watched);
        }

        
            if (Auth::check() && Schema::hasTable('lesson_progress')) {
            try {
                    DB::table('lesson_progress')->insertOrIgnore([
                    'user_id' => Auth::id(),
                    'lesson_id' => $lesson->id,
                    'course_id' => optional($lesson->section->course)->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                
            }
        }

        return response()->json(['ok' => true]);
    }
}
