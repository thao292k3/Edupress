<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseContentController extends Controller
{
   


        public function index(Course $course) 
        {
            
            if ($course->instructor_id !== Auth::id()) {
               
                abort(403, 'Unauthorized action.');
            }

            
            $sections = $course->sections() 
                
                ->with(['lessons' => function ($query) {
                    $query->orderBy('order'); 
                }])
                ->get();
                
            
            return view('backend.instructor.course.content_management', compact('course', 'sections'));
        }

    /**
     * Logic để sắp xếp lại thứ tự của Sections (drag & drop)
     */
        public function sortSections(Request $request)
        {
            $request->validate([
                'order' => 'required|array', 
                'order.*' => 'exists:sections,id',
            ]);

            foreach ($request->input('order') as $index => $sectionId) {
                Section::where('id', $sectionId)->update(['position' => $index + 1]);
            }

            return response()->json(['message' => 'Sections order updated successfully!']);
        }
}
