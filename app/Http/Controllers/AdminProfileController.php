<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Services\PasswordUpdateService;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    protected $profileService, $passwordUpdateService;

    // Khai báo constructor để inject service
    public function __construct(ProfileService $profileService, PasswordUpdateService $passwordUpdateService)
    {   
         $this->profileService = $profileService;
        $this->passwordUpdateService = $passwordUpdateService;
    }

    public function index()
    {
        return view('backend.admin.profile.index');
    }

    public function store(ProfileRequest $request)
    {
        // Xử lý cập nhật hồ sơ ở đây
        $this->profileService->saveProfile($request->validated(), $request->file('photo'));
         return redirect()->back()->with('success', 'Profile Updated successfully');
    }

    public function setting()
    {
        return view('backend.admin.profile.setting');
    }

    public function passwordSetting(PasswordUpdateRequest $request)
    {
        // Gọi service cập nhật mật khẩu
        $result = $this->passwordUpdateService->updatePassword($request->validated());

        if (!$result['success']) {
            return redirect()->back()->withErrors(['current_password' => $result['message']]);
        }

        return redirect()->back()->with('success', $result['message']);
    }
}
