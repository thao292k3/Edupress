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
use App\Models\Partner;
use App\Models\Quiz;
use App\Models\User;

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

        $blogs = Blog::with('user')->latest()->limit(3)->get();

        $total_instructors = User::where('role', 'instructor')->count();
        $total_students = User::where('role', 'user')->count(); 
        $total_followers = 1000; 
        $total_certificates = 1500; 

        $partners = Partner::latest()->get();

        $instructors = User::where('role', 'instructor')
            ->where('status', 1)
            ->withCount('courses')
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.index', compact(
            'all_slider', 
            'all_info', 
            'all_categories', 
            'categories', 
            'course_category', 
            'featured_courses', 
            'blogs',
            'total_instructors', 
            'total_students', 
            'total_certificates',
            'total_followers', 
            'partners',
            'instructors'
        ));
    }

    public function view($slug)
    {
        // Lấy course từ slug
        $course = Course::where('course_name_slug', $slug)
            ->with(['user', 'course_goal', 'sections.lessons', 'enrollments'])
            ->firstOrFail();

        // Lấy video preview từ lesson đầu tiên hoặc course_videos
        $preview_video_url = '';
        if ($course->sections->count() > 0) {
            $firstSection = $course->sections->first();
            if ($firstSection->lessons->count() > 0) {
                $firstLesson = $firstSection->lessons->first();
                $preview_video_url = $firstLesson->video_url ?? '';
            }
        }

        // Nếu không có từ lessons, thử lấy từ course_videos
        if (!$preview_video_url) {
            $videoRecord = $course->videos()->first();
            if ($videoRecord) {
                $preview_video_url = $videoRecord->video_url;
            }
        }

        // Lấy course content (sections với lessons)
        $course_content = $course->sections()->with('lessons')->get();

        // Tính tổng số lectures và duration
        $total_lecture = $course->lessons()->count();
        $total_lecture_duration = round($course->totalDuration() / 60, 2); // Convert seconds to minutes then to hours

        // Trả về view
        return view('frontend.pages.course-details.index', compact(
            'course',
            'preview_video_url',
            'course_content',
            'total_lecture',
            'total_lecture_duration'
        ));
    }

    public function CategoryCourse($id)
    {
        $category = Category::findOrFail($id);

        $courses = Course::where('status', 1)
            ->where('category_id', $id)
            ->latest()
            ->paginate(9);

        $categories = Category::withCount('course')->get();
        $instructors = User::where('role', 'instructor')->withCount('courses')->get();

        return view('frontend.pages.course.list', compact('courses', 'categories', 'instructors'));
    }

    public function posts(Request $request)
    {
        $query = Blog::with('user');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $blogs = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::withCount('course')->get();
        $archives = Blog::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym")
            ->groupBy('ym')
            ->orderBy('ym', 'desc')
            ->get();

        return view('frontend.pages.blog.index', compact('blogs', 'categories', 'archives'));
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)->with('user')->firstOrFail();
        $comments = $blog->comments()->with(['user', 'replies.user'])->get();
        $categories = Category::with('course')->get();
        $recent = Blog::latest()->take(5)->get();

        return view('frontend.pages.blog.show', compact('blog', 'comments', 'categories', 'recent'));
    }
}
