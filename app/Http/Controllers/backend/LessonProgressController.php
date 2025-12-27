<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function markAsCompleted(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        $lessonId = $request->lesson_id;
        $userId = Auth::id();

        // Tìm hoặc tạo mới record tiến độ
        $progress = LessonProgress::firstOrCreate(
            [
                'user_id' => $userId, 
                'lesson_id' => $lessonId
            ],
            [
                'is_completed' => 1,
                'completed_at' => now()
            ]
        );

        
        if ($progress->wasRecentlyCreated === false && $progress->is_completed === 0) {
            $progress->update([
                'is_completed' => 1,
                'completed_at' => now()
            ]);
        }

        return response()->json(['message' => 'Bài học đã được đánh dấu hoàn thành!']);
    }

    public function updateVideoProgress(Request $request)
    {
        $lessonId = $request->lesson_id;
        $watchedTime = $request->watched_time; 
        $userId = Auth::id();

        $lesson = \App\Models\Lesson::findOrFail($lessonId);
        
        
        $totalSeconds = ($lesson->duration > 0) ? $lesson->duration * 60 : 1; 
        
        $percentage = ($watchedTime / $totalSeconds) * 100;
        $isCompletedNow = ($percentage >= 80) ? 1 : 0;

        
        $existingProgress = \App\Models\LessonProgress::where('user_id', $userId)
                                                    ->where('lesson_id', $lessonId)
                                                    ->first();

        $progress = \App\Models\LessonProgress::updateOrCreate(
            ['user_id' => $userId, 'lesson_id' => $lessonId],
            [
                'watched_time' => $watchedTime,
                'is_completed' => ($existingProgress && $existingProgress->is_completed == 1) ? 1 : $isCompletedNow,
                'completed_at' => ($isCompletedNow && (!$existingProgress || !$existingProgress->completed_at)) ? now() : ($existingProgress->completed_at ?? null)
            ]
        );

        return response()->json([
            'status' => 'success',
            'is_completed' => $progress->is_completed,
            'percentage' => round($percentage, 2)
        ]);
    }

    public function myCourses()
{
    $user_id = auth()->id();
    
    
    $enrolledCourses = CourseEnrollment::where('user_id', $user_id)
        ->with('course.lessons')
        ->get();

    $courses = $enrolledCourses->map(function($enrollment) use ($user_id) {
        $course = $enrollment->course;
        
       
        $totalLessons = $course->lessons->count();
        
        
        $completedLessons = \App\Models\LessonProgress::where('user_id', $user_id)
            ->where('course_id', $course->id)
            ->where('is_watched', 1)
            ->count();

        
        $course->progress = ($totalLessons > 0) ? round(($completedLessons / $totalLessons) * 100) : 0;
        
        return $course;
    });

    return view('frontend.pages.course.my-courses', compact('courses'));
}
}
