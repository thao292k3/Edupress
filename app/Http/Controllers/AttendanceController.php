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

    // 1. Kiểm tra quyền sở hữu (Giảng viên) hoặc đã mua (Sinh viên) qua bảng orders
    $isTeacher = ($user->id === $course->instructor_id);
    $hasBought = \App\Models\Order::where('user_id', $user->id)->where('course_id', $course->id)->exists();
    $isFree = ($course->selling_price <= 0);

    if (!$isTeacher && !($hasBought || $isFree)) {
        return back()->with(['message' => 'Bạn cần mua khóa học để tham gia.', 'alert-type' => 'error']);
    }

    // 2. Kiểm tra thời gian (Chỉ áp dụng cho sinh viên)
    if (!$isTeacher) {
        $now = now();
        $startTime = $live_session->start_at;
        $earlyJoinTime = $startTime->copy()->subMinutes(15); // Cho vào sớm 15p

        if ($now->lt($earlyJoinTime)) {
            return back()->with([
                'message' => 'Còn quá sớm! Bạn chỉ có thể vào lớp từ: ' . $earlyJoinTime->format('H:i d/m/Y'),
                'alert-type' => 'warning'
            ]);
        }
        
        // (Tùy chọn) Kiểm tra nếu buổi học đã kết thúc quá lâu
        $endTime = $startTime->copy()->addMinutes($live_session->duration_minutes);
        if ($now->gt($endTime->addHours(2))) { // Sau 2 tiếng thì không cho vào nữa
            return back()->with(['message' => 'Buổi học này đã kết thúc.', 'alert-type' => 'info']);
        }
    }

    // 3. Điểm danh & Redirect (Giữ nguyên phần code bạn đã làm)
    $isAttended = \App\Models\Attendance::where('live_session_id', $live_session->id)
                                ->where('user_id', $user->id)
                                ->exists();
    if (!$isAttended) {
        \App\Models\Attendance::create([
            'live_session_id' => $live_session->id,
            'user_id' => $user->id,
            'role' => $isTeacher ? 'teacher' : 'student',
            'joined_at' => now(),
        ]);
        if ($isTeacher) {
            $live_session->update(['is_teacher_joined' => true]);
        }
    }

    return redirect()->away($live_session->meeting_link);
}
}
