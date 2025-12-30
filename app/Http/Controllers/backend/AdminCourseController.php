<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_courses = Course::latest()->with('user', 'category')->get();
        return view('backend.admin.course.index', compact('all_courses'));
    }



    public function courseStatus(Request $request)
    {
        $course = Course::find($request->course_id);

        if ($course) {
            $course->status = $request->status;
            $course->save();

            
            if ($request->status == 1) {
                try {
                    
                    Http::timeout(60)->post('http://127.0.0.1:5000/webhook/update-courses');
                } catch (\Exception $e) {
                    
                    \Log::error("Lỗi cập nhật AI: " . $e->getMessage());
                }
            }

            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái và dữ liệu AI thành công!']);
        }

        return response()->json(['success' => false, 'message' => 'Course not found!']);
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
    public function show(string $id)
    {
        $course = Course::where('id', $id)->with('user', 'category', 'subCategory')->first();
        return view('backend.admin.course.view', compact('course'));
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
       
    }

    
}
