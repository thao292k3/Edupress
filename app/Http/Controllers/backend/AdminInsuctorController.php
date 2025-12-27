<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminInsuctorController extends Controller
{

    public function index()
    {
        $all_instructors = User::where('role', 'instructor')
                            
                            ->orderBy('id', 'desc')
                            ->get();
        return view('backend.admin.instructor.index', compact('all_instructors'));
    }


    public function updateStatus(Request $request)
    {
        $user = User::find($request->user_id);

        if($user){
            $user->status = $request->status;
            $user->save();

            return response()->json(['success' => true, 'message' => 'User status updated.']);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }


    public function instructorActive(Request $request)
    {
        $active_instructor = User::where('status', '1')->where('role', 'instructor')->latest()->get();
        return view('backend.admin.instructor.active', compact('active_instructor'));
    }

    public function updateInstructorStatus(Request $request)
    {
        $userId = $request->instructor_id;
        $user = User::findOrFail($userId);
        
        
        $user->status = $request->status;

        
        if($request->has('fixed_salary')) {
            $user->fixed_salary = $request->fixed_salary;
        }
        
        $user->save();

        
        if (!$request->ajax()) {
            return redirect()->back()->with('success', 'Cập nhật thông tin giảng viên thành công!');
        }

        
        return response()->json(['success' => 'Cập nhật trạng thái thành công!']);
    }

    
}
