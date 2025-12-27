<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentQuestion;
use App\Models\Course;
use Illuminate\Support\Facades\Schema;

class SkillAssessmentController extends Controller
{
    public function showAssessment()
    {
        if (Schema::hasTable('assessment_questions')) {
            $questions = AssessmentQuestion::inRandomOrder()->limit(5)->get();
        } else {
            $questions = collect();
        }
        return view('frontend.assessments.widget', compact('questions'));
    }

    public function submitAssessment(Request $request)
{
    $answers = $request->input('answers', []);
    if (empty($answers)) {
        return redirect()->back()->with('error', 'Vui lòng trả lời câu hỏi.');
    }

    
    $totalScore = array_sum(array_map('intval', $answers));
    $maxPossible = count($answers) * 5; 
    $percent = (int) round(($totalScore / max(1, $maxPossible)) * 100);

    
    if ($percent < 50) {
        $level = 'Beginner';
    } elseif ($percent < 80) {
        $level = 'Intermediate';
    } else {
        $level = 'Advanced';
    }

    
    
    $suggestedCourses = Course::where('course_level', $level)
                                ->where('status', 1)
                                ->latest()
                                ->limit(3)
                                ->get();

    
    return view('frontend.assessments.result', compact('percent', 'level', 'suggestedCourses', 'totalScore'));
}

    public function showCourseTest($courseId)
    {
        return view('frontend.assessments.course-test', ['course' => (object)['id' => $courseId, 'title' => 'Course #'.$courseId]]);
    }

    public function submitCourseTest(Request $request, $courseId)
    {
        $answers = $request->input('answers', []);
       
        $total = 5;
        $correctCount = 0;
        foreach ($answers as $a) { if (!empty($a)) $correctCount++; }
        $score = (int) round(($correctCount / $total) * 100);
        $passed = $score >= 70;

        return view('frontend.assessments.course-test-result', ['submission' => (object)['score' => $score, 'passed' => $passed, 'id' => 0], 'course' => (object)['title' => 'Course #'.$courseId]]);
    }

    public function handleAssessment(Request $request) {
    $answers = $request->input('answers', []);
    
    if (empty($answers)) {
        return redirect()->back()->with('error', 'Vui lòng trả lời câu hỏi.');
    }

   
    $totalWeight = array_sum($answers); 
    $count = count($answers);
    $maxPossible = $count * 5; 
    
    $score = ($totalWeight / $maxPossible) * 100;

   
    if ($score >= 80) {
        $level = 'Advanced';
    } elseif ($score >= 50) {
        $level = 'Intermediate';
    } else {
        $level = 'Beginner';
    }

    
   
    $suggestedCourses = Course::where('course_level', $level)
                                ->where('status', 1)
                                ->latest()
                                ->limit(3)
                                ->get();

    
    return view('frontend.pages.assessment.result', compact('score', 'level', 'suggestedCourses'));
}
}
