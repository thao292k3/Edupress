<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\QuizResultMail;
use App\Models\CourseEnrollment;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizResult;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuizAttemptController extends Controller
{
   public function submitQuiz(Request $request, $quizId)
{
    $quiz = Quiz::with('questions.answers', 'course')->findOrFail($quizId);
    $userAnswers = $request->input('answers', []); 
    
    $totalMarks = 0;
    $earnedMarks = 0;
    $correctCount = 0;

    if ($quiz->questions->count() == 0) {
        return back()->with('error', 'Bài thi này chưa có câu hỏi.');
    }

    foreach ($quiz->questions as $question) {
        $totalMarks += $question->marks;
        $studentAnswer = $userAnswers[$question->id] ?? null;

        if ($question->type === 'single_choice') {
            $correctAnswer = $question->answers->where('is_correct', 1)->first();
            if ($correctAnswer && $studentAnswer == $correctAnswer->id) {
                $earnedMarks += $question->marks;
                $correctCount++;
            }
        } 
    }

    $percentage = ($totalMarks > 0) ? round(($earnedMarks / $totalMarks) * 100) : 0;
    $passScore = $quiz->pass_score ?? 60;
    $status = ($percentage >= $passScore) ? 'pass' : 'fail';

    
    $result = QuizResult::create([
        'user_id' => Auth::id(),
        'quiz_id' => $quizId,
        'total_questions' => $quiz->questions->count(),
        'correct_answers' => $correctCount,
        'score' => $earnedMarks,
        'percentage' => $percentage,
        'status' => $status,
    ]);

   
    if ($status === 'pass') {
        $course = $quiz->course;

      
        $allQuizIds = \App\Models\Quiz::where('course_id', $course->id)->pluck('id');
        $totalQuizzesInCourse = $allQuizIds->count();
        
        
        $passedQuizzesCount = QuizResult::where('user_id', Auth::id())
            ->whereIn('quiz_id', $allQuizIds)
            ->where('status', 'pass')
            ->distinct('quiz_id')
            ->count();

        
        if ($passedQuizzesCount >= $totalQuizzesInCourse) {
            $enrollment = CourseEnrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();
                
            if ($enrollment && !$enrollment->issued_certificate) {
                $enrollment->update([
                    'issued_certificate' => true,
                    'certificate_date' => now()
                ]);
            }
        }
    }

    
    try {
        Mail::to(Auth::user()->email)->send(new QuizResultMail($result));
    } catch (\Exception $e) {
        \Log::error("Lỗi gửi mail: " . $e->getMessage());
    }

    return redirect()->route('quiz.result', $result->id)->with('success', 'Nộp bài thành công!');
}

    public function takeQuiz($id) 
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        $user_id = auth()->id();

       
        $hasPassed = QuizResult::where('user_id', $user_id)
            ->where('quiz_id', $id)
            ->where('status', 'pass')
            ->exists();

        if ($hasPassed) {
            $lastPass = QuizResult::where('user_id', $user_id)
                ->where('quiz_id', $id)
                ->where('status', 'pass')
                ->latest()
                ->first();
                
            return redirect()->route('quiz.result', $lastPass->id)
                            ->with('error', 'Bạn đã vượt qua bài kiểm tra này rồi!');
        }

        return view('frontend.pages.quiz.take_quiz', compact('quiz'));
    }

   public function showResult($result_id)
    {
       
        $result = QuizResult::with('quiz.course')->findOrFail($result_id);
        $quiz = $result->quiz;

       
        $isPassed = ($result->status == 'pass');

        
        $nextLesson = \App\Models\Lesson::where('course_id', $quiz->course_id)
            ->where('id', '>', $quiz->id) 
            ->orderBy('id', 'asc')
            ->first();

        return view('frontend.pages.quiz.result', [
            'quiz' => $quiz,
            'result' => $result,
            'isPassed' => $isPassed, 
            'totalMarks' => $result->score,
            'correctCount' => $result->correct_answers,
            'percentage' => $result->percentage,
            'nextLesson' => $nextLesson
        ]);
    }


    




    
}
