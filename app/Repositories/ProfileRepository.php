<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \App\Traits\FileUploadTrait;

class ProfileRepository
{
    use FileUploadTrait;

    public function findProfile()
    {
        $user_id = Auth::user()->id;
        return User::where('id', $user_id)->first();
    }

    public function createOrUpdateProfile(array $data, $photo)
    {
        $profile = $this->findProfile();

        // Handle file upload
        if ($profile) {
            $data['photo'] = $this->uploadFile($photo, 'user', $profile->photo);
        }

        $profile->update($data); //lưu trử tất cả dữ liệu trừ ảnh
        // if ($photo) {
        //     $profile->addMedia($photo)->toMediaCollection('profile_photos');
        // }
        return $profile;

    }
}
