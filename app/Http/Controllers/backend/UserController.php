<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        $id = Auth::user()->id;
    
    // Lấy danh sách khóa học người dùng đã đăng ký/mua
    $enrolledCourses = \App\Models\CourseEnrollment::where('user_id', $id)
        ->with('course') // Eager load thông tin khóa học
        ->latest()
        ->take(5) // Lấy 5 khóa học mới nhất để hiện ở Dashboard
        ->get();
        return view('backend.user.index', compact('enrolledCourses'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function deleteAccount(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        Auth::logout();

        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Tài khoản của bạn đã được xóa khỏi hệ thống.');
    }
}
