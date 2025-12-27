<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
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
    public function create(Quiz $quiz)
    {
        
        if ($quiz->course->instructor_id !== Auth::id()) {
            abort(403);
        }
        
        
        return view('backend.instructor.quiz.question.create', compact('quiz'));
    }
    /**
     * Store a newly created resource in storage.
     */
   public function store(QuestionRequest $request, Quiz $quiz)
    {
        
        $validated = $request->validated(); 
        
        
        DB::transaction(function () use ($validated, $quiz) {
            
            
            $question = $quiz->questions()->create([
                'question_text' => $validated['question_text'],
                'type' => $validated['type'],
                'marks' => $validated['marks'],
                'order' => $quiz->questions()->count() + 1, 
                'correct_answer_text' => $validated['correct_answer_text'] ?? null,
            ]);

           
            if (in_array($validated['type'], ['multiple_choice', 'single_choice'])) {
                
                $correct_ids = $validated['correct_answers'] ?? []; 
                
                foreach ($validated['answers'] as $index => $answerData) {
                   
                    $is_correct = in_array($index, $correct_ids); 

                    $question->answers()->create([
                        'answer_text' => $answerData['text'],
                        'is_correct' => $is_correct,
                    ]);
                }
            }
            
            
            $quiz->update([
                'total_marks' => $quiz->questions()->sum('marks')
            ]);
        });
        
        
        return redirect()->route('instructor.quizzes.show', $quiz->id)
            ->with('success', 'Câu hỏi mới đã được thêm thành công.');
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
    public function edit(Quiz $quiz, Question $question)
    {
        
        if ($quiz->course->instructor_id !== Auth::id() || $question->quiz_id !== $quiz->id) {
            abort(403, 'Unauthorized access to question editing.');
        }
        
        
        $answers = $question->answers()->get(); 
        
        
        return view('backend.instructor.quiz.question.edit', compact('quiz', 'question', 'answers')); 
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(QuestionRequest $request, Quiz $quiz, Question $question)
    {
        
        $validated = $request->validated();
        
        $old_marks = $question->marks;
        
        
        DB::transaction(function () use ($validated, $quiz, $question, $old_marks) {
            
            
            $question->update([
                'question_text' => $validated['question_text'],
                'type' => $validated['type'],
                'marks' => $validated['marks'],
                'correct_answer_text' => $validated['correct_answer_text'] ?? null,
            ]);

            
            if (in_array($validated['type'], ['multiple_choice', 'single_choice'])) {
                
                $correct_ids = $validated['correct_answers'] ?? []; 
                
                foreach ($validated['answers'] as $index => $answerData) {
                    $is_correct = in_array($index, $correct_ids);
                    
                    if (isset($answerData['id']) && $answerData['id']) { 
                        
                        $question->answers()->where('id', $answerData['id'])->update([
                            'answer_text' => $answerData['text'],
                            'is_correct' => $is_correct,
                        ]);
                    } else {
                        
                        $question->answers()->create([
                            'answer_text' => $answerData['text'],
                            'is_correct' => $is_correct,
                        ]);
                    }
                }
                
                
                if (isset($validated['answers_to_delete'])) {
                    $question->answers()->whereIn('id', $validated['answers_to_delete'])->delete();
                }
                
            } else { 
                
                $question->answers()->delete();
            }

            
            $new_total_marks = $quiz->total_marks - $old_marks + $validated['marks'];
            $quiz->update(['total_marks' => $new_total_marks]);
        });
        
        // Redirect
        return redirect()->route('instructor.quizzes.show', $quiz->id)
            ->with('success', 'Câu hỏi đã được cập nhật thành công.');
    }




    public function destroy(Quiz $quiz, Question $question)
    {
       
        if ($quiz->course->instructor_id !== Auth::id() || $question->quiz_id !== $quiz->id) {
            abort(403);
        }

        $marks_to_deduct = $question->marks;
        
       
        $question->delete();

        
        $quiz->update([
            'total_marks' => $quiz->total_marks - $marks_to_deduct
        ]);

        return redirect()->route('instructor.quizzes.show', $quiz->id)
            ->with('success', 'Câu hỏi đã được xóa.');
    }
}
