<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

public function index(Request $request)
    {
        
        $query = Course::where('status', 1);

        
        if ($request->has('category')) {
            $query->whereIn('category_id', $request->category);
        }

        if ($request->has('subcategory')) {
            $query->whereIn('subcategory_id', $request->subcategory);
        }

        
        if ($request->has('instructor')) {
            $query->whereIn('instructor_id', $request->instructor);
        }

        
        if ($request->has('price')) {
            if ($request->price == 'free') {
                $query->where(function($q) {
                    $q->whereNull('selling_price')->orWhere('selling_price', 0);
                });
            } elseif ($request->price == 'paid') {
                $query->where('selling_price', '>', 0);
            }
        }

        
        $courses = $query->latest()->paginate(9)->withQueryString();

        
        $categories = \App\Models\Category::withCount('course')->with('subcategories')->get();
        $instructors = \App\Models\User::where('role', 'instructor')->withCount('courses')->get();

        return view('frontend.pages.course.list', compact('courses', 'categories', 'instructors'));
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
    public function show(Course $course)
    {
        $isEnrolled = Auth::check() && $course->students()->where('user_id', Auth::id())->exists();

        $liveSessions = $course->liveSessions()->orderBy('start_at', 'asc')->get();

        $similarCourses = Course::where('status', 1)
            ->where('id', '!=', $course->id)
            ->where('category_id', $course->category_id)
            ->latest()
            ->take(6)
            ->get();

        $more_course_instructor = Course::where('status', 1)
            ->where('instructor_id', $course->instructor_id)
            ->where('id', '!=', $course->id)
            ->latest()
            ->take(6)
            ->get();

        $all_category = \App\Models\Category::where('status', 1)->get();

        // Load course content and sections
        $course_content = \App\Models\CourseSection::where('course_id', $course->id)
            ->with('lesson')
            ->with('quizzes')
            ->orderBy('id', 'asc')
            ->get();

        // Calculate total lecture count
        $total_lecture = 0;
        foreach ($course_content as $section) {
            $total_lecture += $section->lesson->count();
        }

        return view('frontend.pages.course-details.index', compact(
            'course',
            'liveSessions',
            'isEnrolled',
            'similarCourses',
            'more_course_instructor',
            'all_category',
            'course_content',
            'total_lecture'
        ));
    }

    
    public function myCourses()
    {
        
        $user = Auth::user(); 
        
        
        $id = Auth::id();

        $enrolledCourses = CourseEnrollment::where('user_id', $id)
            ->with('course')
            ->latest()
            ->get();

        $courses = \App\Models\CourseEnrollment::where('user_id', $id)
        ->with('course')
        ->latest()
        ->get();

    
        return view('frontend.pages.course.my-courses', compact('user', 'enrolledCourses', 'courses'));
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
}
