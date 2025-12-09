<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Http\Request;

class CourseSectionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $all_categories = Category::all();

        return view('backend.instructor.course.create', compact('all_categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'section_name' => 'required|string|max:255',
          
            
        ]);

        CourseSection::create($validatedData);

        return redirect()->back()
            ->with('success', 'New section added successfully!');
    }

    public function show($id)
    {
        $course = Course::find($id);

        $course_wise_lecture = CourseSection::with('lecture')->where('course_id', $id)->get();


        return view('backend.instructor.course.index', compact('course',  'course_wise_lecture'));
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
       $section = CourseSection::with('lecture')->findOrFail($id);


        $section->delete();

        return redirect()->back()->with('success', 'Data deleted successfully.');
    }
}