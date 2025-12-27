<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $sectionId = $request->input('section_id');

        try {
            DB::transaction(function () use ($validated, $sectionId) {
                
                $quiz = new Quiz();
                $quiz->fill($validated);
                $quiz->section_id = $sectionId;
                $quiz->save();

                
                \App\Models\Lesson::create([
                    'course_id' => $validated['course_id'],
                    'section_id' => $sectionId,
                    'lecture_title' => $quiz->lecture_title,
                    'lesson_type' => 'quiz',
                    'quiz_id' => $quiz->id,
                    'order' => \App\Models\Lesson::where('section_id', $sectionId)->max('order') + 1,
                ]);
            });

            
            return redirect()->route('instructor.quizzes.index')
                            ->with('success', 'Tạo bài kiểm tra thành công!');

        } catch (\Exception $e) {
            
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
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
        
        if ($quiz->course->instructor_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validated();
        
        
        $validated['section_id'] = $quiz->section_id; 

        
        $quiz->update($validated);

       
        \App\Models\Lesson::where('quiz_id', $quiz->id)->update([
            'lecture_title' => $quiz->title,
            'course_id' => $quiz->course_id
        ]);

        return redirect()->route('instructor.quizzes.show', $quiz->id)
            ->with('success', 'Thông tin Bài kiểm tra đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
       
        if ($quiz->course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized. You do not own this quiz.');
        }
        
        
        $quiz->delete();

        return redirect()->route('instructor.quizzes.index')
            ->with('success', 'Bài kiểm tra đã được xóa thành công.');
    }

    



    
}
