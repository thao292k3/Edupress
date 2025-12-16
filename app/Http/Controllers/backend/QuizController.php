<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructorId = Auth::id();
        $quizzes = Quiz::whereHas('course', function($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->with('course')->get();

        return view('backend.instructor.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('instructor_id', Auth::id())->get();
        return view('backend.instructor.quiz.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizRequest $request) 
    {
        $validated = $request->validated();
        
        
        $course = Course::findOrFail($validated['course_id']);
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized. You do not own this course.');
        }
        $sectionId = $request->input('section_id');

        $quiz = Quiz::create($validated);

       $lastLesson = Lesson::where('section_id', $sectionId)->orderBy('order', 'desc')->first();
        $newOrder = $lastLesson ? ($lastLesson->order + 1) : 1;

    Lesson::create([
        'course_id' => $quiz->course_id,
        'section_id' => $sectionId, // Đảm bảo trường này được truyền
        'lecture_title' => $quiz->quiz_title, // Sử dụng tiêu đề Quiz làm tiêu đề Lesson
        'lesson_type' => 1, // 1: Quiz (chúng ta đã giả định 0 là Video/Text)
        'quiz_id' => $quiz->id, // Liên kết ID Quiz
        'order' => $newOrder,
        // Các trường khác (như video_url, video_duration) sẽ để NULL
    ]);

    // Chuyển hướng về trang quản lý Section của Course đó
    return redirect()->route('instructor.course-section.show', $quiz->course_id)
        ->with('success', 'Bài kiểm tra đã được tạo và thêm vào khóa học thành công. Vui lòng thêm câu hỏi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        
        if ($quiz->course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        
        $quiz->load(['course', 'questions.answers']);

        return view('backend.instructor.quiz.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
       
        if ($quiz->course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized. You do not own this quiz.');
        }
        
        
        $courses = Course::where('instructor_id', Auth::id())->get();

        return view('backend.instructor.quiz.edit', compact('quiz', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizRequest $request, Quiz $quiz)
    {
        // 1. Kiểm tra quyền sở hữu Quiz
        if ($quiz->course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized. You do not own this quiz.');
        }

        $validated = $request->validated();
        
        // 2. Nếu Instructor thay đổi Course, phải đảm bảo họ sở hữu Course mới đó
        if ($validated['course_id'] != $quiz->course_id) {
            $newCourse = Course::findOrFail($validated['course_id']);
            if ($newCourse->instructor_id !== Auth::id()) {
                 return back()->with('error', 'Bạn không sở hữu khóa học mới này.');
            }
        }

        // 3. Cập nhật dữ liệu
        $quiz->update($validated);

        return redirect()->route('instructor.quizzes.show', $quiz->id)
            ->with('success', 'Thông tin Bài kiểm tra đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        // 1. Kiểm tra quyền sở hữu Quiz
        if ($quiz->course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized. You do not own this quiz.');
        }
        
        // 2. Xóa Quiz (Questions và Answers liên quan sẽ bị xóa nhờ onDelete('cascade'))
        $quiz->delete();

        return redirect()->route('instructor.quizzes.index')
            ->with('success', 'Bài kiểm tra đã được xóa thành công.');
    }

    
}
