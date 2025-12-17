<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SocialController extends Controller
{
    //  public function googleLogin()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function googleAuthentication()
    // {
    //     try {
            
    //         $googleUser = Socialite::driver('google')->user();

            
    //         $user = User::where('email', $googleUser->email)->first();

    //         if (!$user) {
                
    //             $user = User::create([
    //                 'email' => $googleUser->email,
    //                 'name' => $googleUser->name,
    //                 'photo' => $googleUser->avatar,
    //                 'password' => Hash::make('password@123'),
    //                 'role' => 'user',
    //             ]);
    //         }

            
    //         Auth::login($user);

            
    //         return redirect('/user/dashboard');
    //     } catch (\Exception $e) {
            
    //         return redirect()->back()->with('error', 'Something went wrong!');
    //     }
    // }

    public function firebaseGoogleLogin(Request $request)
{
    try {
        $email = $request->email;
        $name = $request->name;
        $photo = $request->photo;

        // Tìm hoặc tạo User mới
        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'email' => $email,
                'name' => $name,
                'photo' => $photo,
                'password' => bcrypt('password@123'), // Mật khẩu mặc định
                'role' => 'user',
            ]);
        }

        Auth::login($user);

        return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}
 }
