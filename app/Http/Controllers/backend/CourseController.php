<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseGoal;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\CourseService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('viewAny', Course::class);
        
        $instructorId = Auth::user()->id;
        $all_courses = Course::with(['category', 'subCategory'])
                    ->where('instructor_id', $instructorId)
                    ->orderBy('created_at', 'asc')
                    ->paginate(10);
       
        return view('backend.instructor.course.index', compact('all_courses', 'instructorId'));
    }

    public function create()
    {
        $this->authorize('create', Course::class);
         
         $all_categories = Category::all();
        $subcategories = SubCategory::all();
        return view('backend.instructor.course.create', compact('all_categories', 'subcategories'));
    }

    public function store(CourseRequest $request)
    {
       $this->authorize('create', Course::class);
     
       $validatedData = $request->validated();
   
   
        $course = $this->service->createCourse($request); 

    
        if ($course && !empty($validatedData['course_goals'])) {
   
            $this->service->createCourseGoals($course->id, $validatedData['course_goals']);
    }

    return redirect()->back()
        ->with('success', 'Khóa học đã tạo thành công.');
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);

        $course = Course::with(['videos', 'courseGoals','liveSessions' ])->findOrFail($course->id);
        return view('backend.instructor.course.edit', [
            'course' => $course,
            'all_categories' => Category::all(),
            'subcategories' => SubCategory::all()
        ]);
    }

     public function update(CourseRequest $request, Course $course)
    {
        $this->authorize('update', $course);

        
        $updated = $this->service->updateCourse($request, $course); //

        if (!$updated) {
            return back()->with('info', 'Không có thay đổi nào được thực hiện!');
        }
        return redirect('/instructor/course') 
            ->with('success', 'Cập nhật khóa học thành công!');

    }
     public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        
        $this->service->deleteCourse($course); 
        return redirect()->back()->with('success', 'Course deleted successfully!');
    }

    public function show(Course $course)
    {
        $this->authorize('view', $course);

        
        return redirect()->route('instructor.course.content', [
            'course' => $course->id 
        ]);

    
        // return redirect()->route('instructor.course.content', $course); 
    }

    public function courseStatistics()
    {
        $courses = Course::withCount('enrollments')->get(); 

        foreach ($courses as $course) {
            echo "Khóa học: " . $course->course_name . " - Số lượng học viên: " . $course->enrollments_count . "<br>";
        }
    }

    public function showCourseStudents($courseId)
{
    
    $course = Course::with(['enrollments.user'])->findOrFail($courseId);

   
    $videoLessonIds = \App\Models\Lesson::whereHas('section', function($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })
        ->whereNull('quiz_id')
        ->pluck('id');

    $quizLessonIds = \App\Models\Lesson::whereHas('section', function($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })
        ->whereNotNull('quiz_id')
        ->pluck('quiz_id', 'id'); 

   
    $studentsProgress = $course->enrollments->map(function ($enrollment) use ($videoLessonIds, $quizLessonIds) {
        $user = $enrollment->user;
        $userId = $user->id;

        
        $totalVideos = $videoLessonIds->count();
        $completedVideos = \App\Models\LessonProgress::where('user_id', $userId)
            ->whereIn('lesson_id', $videoLessonIds)
            ->where('is_completed', 1)
            ->count();
        $videoPercentage = ($totalVideos > 0) ? round(($completedVideos / $totalVideos) * 100) : 0;

       
        $totalQuizzes = $quizLessonIds->count();
        $completedQuizzes = \App\Models\QuizResult::where('user_id', $userId)
            ->whereIn('quiz_id', $quizLessonIds->values())
            ->where('status', 'pass')
            ->distinct('quiz_id')
            ->count();
        $quizPercentage = ($totalQuizzes > 0) ? round(($completedQuizzes / $totalQuizzes) * 100) : 0;

        return [
            'user_id'             => $userId,
            'user_name'           => $user->name,
            'user_email'          => $user->email,
            'issued_certificate'  => $enrollment->issued_certificate,
            'certificate_date'    => $enrollment->certificate_date,
            'enrolled_at'         => $enrollment->created_at,
            
            // Dữ liệu Video
            'video_percentage'    => $videoPercentage,
            'video_count'         => $completedVideos . '/' . $totalVideos,
            
            // Dữ liệu Quiz
            'quiz_percentage'     => $quizPercentage,
            'quiz_count'          => $completedQuizzes . '/' . $totalQuizzes,
            
            
            'can_approve'         => ($videoPercentage == 100) 
        ];
    });

    return view('backend.instructor.course.student_progress', compact('course', 'studentsProgress'));
}

    public function syncCourseGoals($courseId, array $goals)
    {
        
        CourseGoal::where('course_id', $courseId)->delete(); 

        
        $dataToInsert = [];
        foreach ($goals as $goal_name) {
            if (!empty(trim($goal_name))) { 
                $dataToInsert[] = [
                    'course_id' => $courseId,
                    'goal_name' => trim($goal_name),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        
        if (!empty($dataToInsert)) {
            return CourseGoal::insert($dataToInsert);
        }

        return true; 
    }


    public function downloadCertificate($courseId, $userId)
    {
        $course = Course::findOrFail($courseId);
        $user = User::findOrFail($userId);

       
        if ($course->is_free == 1) {
            return back()->with([
                'message' => 'Khóa học miễn phí không hỗ trợ cấp chứng chỉ.',
                'alert-type' => 'warning'
            ]);
        }

        
        $enrollment = CourseEnrollment::where('course_id', $courseId)
            ->where('user_id', $userId)
            ->first();

        if (!$enrollment || !$enrollment->issued_certificate) {
            return back()->with([
                'message' => 'Học viên này chưa đủ điều kiện nhận chứng chỉ.',
                'alert-type' => 'error'
            ]);
        }

       
        $data = [
            'user'   => $user,
            'course' => $course,
            'date'   => $enrollment->certificate_date 
                        ? \Carbon\Carbon::parse($enrollment->certificate_date)->format('d/m/Y') 
                        : now()->format('d/m/Y'),
        ];

        
        $pdf = Pdf::loadView('emails.certificate_pdf', $data)
                ->setPaper('a4', 'landscape')
                ->setOptions([
                    'defaultFont' => 'DejaVu Sans',
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true, 
                    'chroot' => public_path(),     
                ]);

        return $pdf->download('Chung-chi-' . Str::slug($user->name) . '.pdf');
    }


    public function approveCertificate($courseId, $userId)
    {
        $course = Course::findOrFail($courseId);
        $user = User::findOrFail($userId);
        $enrollment = CourseEnrollment::where('course_id', $courseId)->where('user_id', $userId)->firstOrFail();

        $lessonIds = \App\Models\Lesson::whereHas('section', function($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })
        ->whereNull('quiz_id')
        ->pluck('id');

        $totalLessons = $lessonIds->count();
        $completedCount = \App\Models\LessonProgress::where('user_id', $userId)
        ->whereIn('lesson_id', $lessonIds)
        ->where('is_completed', 1)
        ->count();

        $enrollment->update(['issued_certificate' => 1, 'certificate_date' => now()]);

    
        $data = [
            'user'   => $user,
            'course' => $course,
            'date'   => now()->format('d/m/Y'),
            'is_free' => ($course->selling_price <= 0)
        ];
        Mail::send('emails.course_completed', $data, function($message) use ($user, $course, $data) {
                $message->to($user->email)->subject('Chúc mừng! Bạn đã hoàn thành khóa học ' . $course->course_name);

                
                if ($course->selling_price > 0) {
                    $pdf = Pdf::loadView('emails.certificate_pdf', $data)
                            ->setPaper('a4', 'landscape')
                            ->setOptions([
                                'defaultFont' => 'DejaVu Sans',
                                'isRemoteEnabled' => true 
                            ]);
                    
                    $message->attachData($pdf->output(), 'Chung-chi-' . Str::slug($course->course_name) . '.pdf');
                }
            });

            return back()->with([
                'message' => 'Đã phê duyệt và gửi thông báo thành công!',
                'alert-type' => 'success'
            ]);
        }

}