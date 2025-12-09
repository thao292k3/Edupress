<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService){
        $this->courseService = $courseService;
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
        $this->courseService->createCourse($request);

        return redirect()->route('instructor.course.index')
            ->with('success', 'Course created successfully!');
    }

    public function edit(Course $course)
{
    if ($course->instructor_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $course = Course::with('videos')->findOrFail($course->id);
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

     $updated = $this->courseService->updateCourse($request, $course);

    if (!$updated) {
        return back()->with('info', 'Không có thay đổi nào được thực hiện!');
    }

    return redirect()->route('instructor.course.index')
        ->with('success', 'Cập nhật khóa học thành công!');
}

    public function destroy(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $this->courseService->deleteCourse($course);
        return redirect()->back()->with('success', 'Course deleted successfully!');
    }
}
