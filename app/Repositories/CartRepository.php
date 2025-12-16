<?php


namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository
{
    public function createCart($course_id, $request)
    {
        try {

            $guestToken = $request->cookie('guest_token') ?? Str::uuid();

             if (!$request->cookie('guest_token')) {

                Cookie::queue('guest_token', $guestToken, 60 * 24 * 30); 
            }

             $existingCart = Cart::where('guest_token', $guestToken)
             ->where('course_id', $course_id)
             ->first();

             if ($existingCart) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This course is already in your cart.'
                ], 400);
            }

          
             Cart::create([
                'guest_token' => $guestToken,
                'course_id' => $course_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Course added to cart successfully!'
            ]);


        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! ' . $error->getMessage(),
            ], 500);
        }
    }

    public function viewCart($request){

        try{

             $guestToken = $request->cookie('guest_token') ?? Str::uuid();
             $cart = Cart::where('guest_token', $guestToken)->with('course', 'course.user')->get();

             return $cart;

        }catch(\Exception $error){

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! ' . $error->getMessage(),
            ], 500);

        }

    }

}