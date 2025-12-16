<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
//      public function googleLogin()
//     {
//         return Socialite::driver('google')->redirect();
//     }

//     public function googleAuthentication()
//     {
//         try {
            
//             $googleUser = Socialite::driver('google')->user();

            
//             $user = User::where('email', $googleUser->email)->first();

//             if (!$user) {
                
//                 $user = User::create([
//                     'email' => $googleUser->email,
//                     'name' => $googleUser->name,
//                     'photo' => $googleUser->avatar,
//                     'password' => Hash::make('password@123'),
//                     'role' => 'user',
//                 ]);
//             }

            
//             Auth::login($user);

            
//             return redirect('/user/dashboard');
//         } catch (\Exception $e) {
            
//             return redirect()->back()->with('error', 'Something went wrong!');
//         }
//     }
 }
