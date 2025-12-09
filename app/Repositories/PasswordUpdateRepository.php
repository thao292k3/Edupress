<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateRepository
{
    use FileUploadTrait;

   

    public function updatePassword($data)
    {
        // $user_id = Auth::user()->id;
        // $user = User::where('id', $user_id)->first();

        // //check if the current password is correct
        // if(!Hash::check($data['current_password'], $user->password)){
        //     return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        // }

        // //update new password
        // $user->password = Hash::make($data['new_password']);
        // $user->save();

        // return $user;
        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password)) {
            return [
                'success' => false,
                'message' => 'Mật khẩu hiện tại không chính xác.',
            ];
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return [
            'success' => true,
            'message' => 'Mật khẩu đã được cập nhật thành công.',
        ];
    }
}
