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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class QuizAttemptController extends Controller
{
   public function submitQuiz(Request $request, $quizId)
    {
        $quiz = Quiz::with('questions.answers', 'course')->findOrFail($quizId);
        $userAnswers = $request->input('answers', []); 
        $user = Auth::user();
        
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
        
        
        $isPassed = false;
        if (isset($quiz->pass_mark)) {
            $isPassed = ($earnedMarks >= $quiz->pass_mark);
        } else {
            $passScorePercent = $quiz->pass_score ?? 60;
            $isPassed = ($percentage >= $passScorePercent);
        }
        
        $status = $isPassed ? 'pass' : 'fail';

        
        $result = QuizResult::create([
            'user_id' => $user->id,
            'quiz_id' => $quizId,
            'total_questions' => $quiz->questions->count(),
            'correct_answers' => $correctCount,
            'score' => $earnedMarks,
            'percentage' => $percentage,
            'status' => $status,
        ]);

        
        if ($status === 'pass') {
            
            $currentLesson = \App\Models\Lesson::where('quiz_id', $quizId)->first();
            
            if ($currentLesson) {
                
                \Illuminate\Support\Facades\DB::table('lesson_progress')->updateOrInsert(
                    ['user_id' => $user->id, 'lesson_id' => $currentLesson->id],
                    [
                        'course_id' => $quiz->course_id,
                        'is_completed' => 1,
                        'completed_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            
            $course = $quiz->course;
            $allQuizIds = \App\Models\Quiz::where('course_id', $course->id)->pluck('id');
            $totalQuizzesInCourse = $allQuizIds->count();
            
            $passedQuizzesCount = QuizResult::where('user_id', $user->id)
                ->whereIn('quiz_id', $allQuizIds)
                ->where('status', 'pass')
                ->distinct('quiz_id')
                ->count();

            if ($passedQuizzesCount >= $totalQuizzesInCourse) {
                $enrollment = \App\Models\CourseEnrollment::where('user_id', $user->id)
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
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\QuizResultMail($result));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Lỗi gửi mail: " . $e->getMessage());
        }

        return redirect()->route('quiz.result', $result->id)->with('success', 'Nộp bài thành công!');
    }

    public function takeQuiz($id) 
    {
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để làm bài thi.');
        }

        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        $user_id = Auth::id();

    
        $lastPass = QuizResult::where('user_id', $user_id)
            ->where('quiz_id', $id)
            ->where('status', 'pass')
            ->latest()
            ->first();

        if ($lastPass) {
            return redirect()->route('quiz.result', $lastPass->id)
                            ->with('info', 'Bạn đã vượt qua bài kiểm tra này rồi!');
        }

        return view('frontend.pages.quiz.take_quiz', compact('quiz'));
    }

  public function showResult($result_id)
    {
        $result = QuizResult::with(['quiz.course', 'quiz.questions'])->findOrFail($result_id);
        $quiz = $result->quiz;
        
        
        $totalMarks = $quiz->questions->count(); 
        $correctCount = $result->score; 
        $isPassed = $result->score >= $quiz->pass_mark;
        $percentage = ($totalMarks > 0) ? ($result->score / $totalMarks) * 100 : 0;

        
        $currentLesson = \App\Models\Lesson::where('quiz_id', $quiz->id)->first();
        $nextLesson = null;
        if ($currentLesson) {
            $nextLesson = \App\Models\Lesson::where('course_id', $quiz->course_id)
                ->where('order', '>', $currentLesson->order) 
                ->orderBy('order', 'asc') 
                ->select('id', 'quiz_id', 'order')
                ->first(); 
        }



        return view('frontend.pages.quiz.result', [
            'quiz' => $quiz,
            'result' => $result,
            'isPassed' => $isPassed,
            'totalMarks' => $totalMarks,
            'correctCount' => $correctCount,
            'percentage' => $percentage,
            'nextLesson' => $nextLesson,
            'course' => $quiz->course
        ]);
    }


}


    




    

