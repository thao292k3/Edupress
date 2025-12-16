<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseGoal;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        
        $instructorId = Auth::user()->id;
        $all_courses = Course::with(['category', 'subCategory'])
                    ->where('instructor_id', $instructorId)
                    ->orderBy('created_at', 'asc')
                    ->get();
       
        return view('backend.instructor.course.index', compact('all_courses', 'instructorId'));
    }

    public function create()
    {
         $all_categories = Category::all();
        $subcategories = SubCategory::all();
        return view('backend.instructor.course.create', compact('all_categories', 'subcategories'));
    }

    public function store(CourseRequest $request)
    {
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
    if ($course->instructor_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $course = Course::with(['videos', 'courseGoals'])->findOrFail($course->id);
    return view('backend.instructor.course.edit', [
        'course' => $course,
        'all_categories' => Category::all(),
        'subcategories' => SubCategory::all()
    ]);
}

     public function update(CourseRequest $request, Course $course)
{
    if ($course->instructor_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    
    $updated = $this->service->updateCourse($request, $course); //

    if (!$updated) {
        return back()->with('info', 'Không có thay đổi nào được thực hiện!');
    }
    return redirect('/instructor/course') 
        ->with('success', 'Cập nhật khóa học thành công!');

}
     public function destroy(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        
        $this->service->deleteCourse($course); //
        return redirect()->back()->with('success', 'Course deleted successfully!');
    }

    public function show(Course $course)
    {
        
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        
        return redirect()->route('instructor.course.content', [
            'course' => $course->id 
        ]);

    
        // return redirect()->route('instructor.course.content', $course); 
    }

    public function courseStatistics()
    {
        $courses = Course::withCount('enrollments')->get(); // Lấy số lượng học viên trực tiếp

        foreach ($courses as $course) {
            echo "Khóa học: " . $course->course_name . " - Số lượng học viên: " . $course->enrollments_count . "<br>";
        }
    }

    public function showCourseStudents($courseId)
    {
        $course = Course::with(['enrollments.user'])->findOrFail($courseId);
        
        $studentsProgress = $course->enrollments->map(function ($enrollment) use ($course) {
            $user = $enrollment->user;
            $progress = $course->getProgressPercentageForUser($user->id);
            
            return [
                'user_id' => $user->id,
                'user_name' => $user->name, 
                'enrolled_at' => $enrollment->enrolled_at,
                'progress_percentage' => $progress,
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

}