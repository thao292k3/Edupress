<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Services\PasswordUpdateService;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class InstructorProfileController extends Controller
{
    protected $profileService, $passwordUpdateService;

    public function __construct(ProfileService $profileService, PasswordUpdateService $passwordUpdateService)
    {
        $this->profileService = $profileService;
        $this->passwordUpdateService = $passwordUpdateService;
    }

    public function index()
    {
        return view('backend.instructor.profile.index');
    }

    public function store(ProfileRequest $request)
    
    {

        $this->profileService->saveProfile($request->validated(), $request->file('photo'));
        return redirect()->back()->with('success', 'Hồ sơ đã được cập nhật thành công.');
        
    }

    public function setting()
    {
        return view('backend.instructor.profile.setting');
    }

    public function passwordSetting(PasswordUpdateRequest $request)
    {
        $result = $this->passwordUpdateService->updatePassword($request->validated());

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->withErrors(['current_password' => $result['message']]);
    }
}
