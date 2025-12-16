<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Services\SectionService;
use Illuminate\Support\Facades\Auth;

class CourseSectionController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService) 
    {
        $this->sectionService = $sectionService;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_categories = Category::all();

        return view('backend.instructor.course.create', compact('all_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
        ]);

        // Store the data in the database
        Section::create($validateData);


        return redirect()->back()->with('success', 'New section added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);

        $course_wise_lecture = Section::with('lesson')->where('course_id', $id)->get();


        return view('backend.instructor.course-section.index', compact('course',  'course_wise_lecture'));
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
        $section = Section::with('lesson')->findOrFail($id);


        $section->delete();

        return redirect()->back()->with('success', 'Data deleted successfully.');
    }
}