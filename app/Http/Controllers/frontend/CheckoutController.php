<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyCouponRequest;
use App\Models\Cart;
use App\Services\ApplyCouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{

    protected $applyCouponService;


    public function __construct(ApplyCouponService $applyCouponService) 
    {
        $this->applyCouponService = $applyCouponService;
    }
    public function index(Request $request)
    {
        $guestToken = $request->cookie('guest_token') ?? Str::uuid();
        $cart = Cart::with('course')->where('guest_token', $guestToken)->get();
       
        $total = $cart->sum(function ($item) {
            return $item->course->discount_price ?? $item->course->selling_price;
        });
        $user = Auth::user();
        return view('frontend.pages.checkout.index', compact('cart', 'total', 'user'));
    }

    public function applyCheckoutCoupon(ApplyCouponRequest $request)
    {
      
        $validated = $request->validated();

        $couponName = $validated['coupon'];
        $courseIds = $validated['course_id'];
        $instructorIds = $validated['instructor_id'];

        
        $discounts = $this->applyCouponService->applyCoupon($couponName, $courseIds, $instructorIds);

        
        if (empty($discounts)) {
            
            return redirect()->back()->with('error', 'Invalid coupon!');
        }

        
        $totalDiscount = collect($discounts)->sum('discount');

        
        session(['coupon' => $totalDiscount]);

        
        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }
}
