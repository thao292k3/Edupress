<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\LiveSessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function joinSession(LiveSessions $live_session)
    {
        $user = Auth::user();
        $course = $live_session->course;
        
       
        $isTeacher = ($user->id === $course->instructor_id);
        
        
        $isStudent = $course->students()->where('user_id', $user->id)->exists(); 

        if (!$isTeacher && !$isStudent) {
            return back()->with('error', 'Bạn chưa đăng ký khóa học này hoặc không có quyền truy cập.');
        }

        
        $isAttended = Attendance::where('live_session_id', $live_session->id)
                                ->where('user_id', $user->id)
                                ->exists();

        if (!$isAttended) {
            $role = $isTeacher ? 'teacher' : 'student';

            Attendance::create([
                'live_session_id' => $live_session->id,
                'user_id' => $user->id,
                'role' => $role,
                'joined_at' => now(),
            ]);

            
            if ($isTeacher) {
                $live_session->update(['is_teacher_joined' => true]);
            }
        }


        return redirect()->away($live_session->meeting_link);
    }
}
