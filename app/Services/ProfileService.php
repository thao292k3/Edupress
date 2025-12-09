<?php
namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Hash;
class ProfileService
{

    protected $profileRepository;
    public function __construct( ProfileRepository $profileRepository){
        $this->profileRepository = $profileRepository;
    }

     public function saveProfile(array $data, $photo = null)
    {
        
        return $this->profileRepository->createOrUpdateProfile($data, $photo);
    }

    public function updatePassword($currentPassword, $newPassword)
    {
        $profile = $this->profileRepository->findProfile();

        // Kiểm tra mật khẩu hiện tại có khớp không
        if (!Hash::check($currentPassword, $profile->password)) {
            return [
                'success' => false,
                'message' => 'Mật khẩu hiện tại không đúng.',
            ];
        }

        // Cập nhật mật khẩu mới
        $profile->password = Hash::make($newPassword);
        $profile->save();

        return [
            'success' => true,
            'message' => 'Mật khẩu đã được cập nhật thành công.',
        ];
    }
}



