<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\InfoBox;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Quiz;

class FrontenDashboardController extends Controller
{
    public function home(){

        $all_slider = Slider::latest()->get();

        $all_info = InfoBox::all();

        $all_categories = Category::inRandomOrder()->limit(6)->get();

        $categories = Category::all();

        $course_category = Category::with('course', 'course.user', 'course.course_goal')->get();
        $featured_courses = Course::latest() 
            ->with(['user']) 
            ->where('status', 1) 
            ->take(6) 
            ->get();

        

        return view('frontend.index', compact('all_slider', 'all_info', 'all_categories', 'categories', 'course_category', 'featured_courses'));
    }


    public function view($slug)
    {

        $course = Course::where('course_name_slug', $slug)->with('category', 'subcategory', 'user', 'course_goal')->firstOrFail();
        
        $total_lecture = Lesson::where('course_id', $course->id)->count();
       $course_content = Section::where('course_id', $course->id)
        ->with(['lesson', 'quizzes']) 
        ->orderBy('position', 'asc')
        ->get();

        
        $userId = Auth::id();

        
        $similarCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)->get();

        $all_category = Category::orderBy('name', 'asc')->get();

        

        $more_course_instructor = Course::where('instructor_id', $course->instructor_id)
        ->where('id', '!=', $course->id)
        ->where('status', 1) 
        ->with('user')
        ->get();

        

        $preview_lesson = Lesson::where('course_id', $course->id)
                            ->where('is_preview', true) 
                            ->first();
    
    
        $preview_video_url = $preview_lesson ? $preview_lesson->url : null;

        $total_lecture = Lesson::where('course_id', $course->id)->count();



        $total_minutes = Lesson::where('course_id', $course->id)->sum('duration');

        $hours = floor($total_minutes / 60);
        $minutes = floor($total_minutes % 60);
        $seconds = round(($total_minutes - floor($total_minutes)) * 60);

        $total_lecture_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);


        return view('frontend.pages.course-details.index', compact('course', 'total_lecture', 'course_content', 'similarCourses', 'all_category', 
        'more_course_instructor', 'total_minutes', 'total_lecture_duration', 'preview_lesson', 'preview_video_url'));
    }

   
    public function posts()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('frontend.pages.blog.index', compact('blogs'));
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        
        $comments = $blog->comments()->where('approved', true)->whereNull('parent_id')->with(['user', 'replies.user'])->get();

        $recent = Blog::latest()->limit(5)->get();
        $categories = \App\Models\Category::orderBy('name')->get();
        
        $archives = Blog::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as count")
            ->groupBy('ym')
            ->orderBy('ym', 'desc')
            ->get();

        return view('frontend.pages.blog.show', compact('blog', 'comments', 'recent', 'categories', 'archives'));
    }

    public function takeQuiz($id)
{
    
    $quiz = Quiz::with(['questions.answers'])->findOrFail($id);
   

    return view('frontend.pages.quiz.take_quiz', compact('quiz'));
}

    public function CategoryCourse($id)
    {
        
        $category = Category::findOrFail($id);
        
        
        $courses = Course::where('category_id', $id)
                        ->where('status', 1)
                        ->latest()
                        ->paginate(9); 

        
        $categories = Category::all();

        return view('frontend.pages.course.category_view', compact('courses', 'category', 'categories'));
    }
    
    
}
