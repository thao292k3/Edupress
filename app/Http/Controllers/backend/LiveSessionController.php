<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LiveSessionRequest;
use App\Models\Course;
use App\Models\LiveSessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveSessionController extends Controller
{
    public function index()
    {
        $sessions = LiveSessions::whereHas('course', function($query) {
            $query->where('instructor_id', Auth::id());
        })->with('course')->latest('start_at')->get();

        return view('backend.instructor.live_session.index', compact('sessions'));
    }

    public function create()
    {
        $courses = Course::where('instructor_id', Auth::id())->get();
        return view('backend.instructor.live_session.create', compact('courses'));
    }

    public function store(LiveSessionRequest $request)
    {
        $validated = $request->validated();
        LiveSessions::create($validated);

        return redirect()->route('instructor.live-sessions.index')
            ->with('success', 'Buổi dạy trực tiếp đã được tạo thành công.');
    }

    public function edit(LiveSessions $live_session)
    {
        if ($live_session->course->instructor_id !== Auth::id()) {
            abort(403);
        }
        $courses = Course::where('instructor_id', Auth::id())->get();
        return view('backend.instructor.live_session.show', compact('live_session', 'courses'));
    }

    public function update(LiveSessionRequest $request, LiveSessions $live_session)
    {
        if ($live_session->course->instructor_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validated();
        
       
        if ($live_session->start_at != $validated['start_at']) {
            $validated['is_teacher_joined'] = false; 
        }

        $live_session->update($validated);

        return redirect()->route('instructor.live-sessions.index')
            ->with('success', 'Thông tin buổi học đã được cập nhật.');
    }

    public function destroy(LiveSessions $live_session)
    {
        if ($live_session->course->instructor_id !== Auth::id()) {
            abort(403);
        }
        $live_session->delete(); 

        return redirect()->route('instructor.live-sessions.index')
            ->with('success', 'Buổi dạy đã được xóa.');
    }
    
    
    public function show(LiveSessions $live_session) 
{
    
    if ($live_session->course->instructor_id !== Auth::id()) {
        abort(403);
    }

    
    $live_session->load(['attendees.user']); 
    
    
    $teacherAttendance = $live_session->attendees->where('role', 'teacher')->first();
    
   
    $studentAttendances = $live_session->attendees->where('role', 'student'); 
    
   
    return view('backend.instructor.live_session.show', compact('live_session', 'teacherAttendance', 'studentAttendances'));
}
}
