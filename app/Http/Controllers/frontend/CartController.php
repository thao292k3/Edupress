<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyCouponRequest;
use App\Models\Cart;
use App\Services\ApplyCouponService;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{

    protected $cartService;
    protected $applyCouponService;

    public function __construct(CartService $cartService, ApplyCouponService $applyCouponService) 
    {
        $this->cartService = $cartService;
        $this->applyCouponService = $applyCouponService; 
    }

    public function index()
    {
        return view('frontend.pages.cart.index');
    }



    public function fetchCart(Request $request)
    {

       
        $cart = $this->cartService->viewCart($request);

        $guestToken = $request->cookie('guest_token') ?? Str::uuid();

        $cartItems = Cart::with('course')->where('guest_token', $guestToken)->get();

        
        $subTotal = $cartItems->sum(function ($cartItem) {
            $price = $cartItem->course->discount_price ?? $cartItem->course->selling_price;
            return $cartItem->quantity * ($price ?? 0);
        });

        $html = view('frontend.pages.cart.partial.main', compact('cart', 'subTotal'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);
    }

    public function addToCart(Request $request)
    {

        $validated_data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'quantity' => 'nullable|integer|min:1', 
        ]);

        $course_id = $validated_data['course_id'];

        return $this->cartService->createCart($course_id, $request);
    }

    public function cartAll(Request $request)
    {

        $cart =  $this->cartService->viewCart($request);

        
        $subTotal = $cart->sum(function ($cartItem) {
            $price = $cartItem->course->discount_price ?? $cartItem->course->selling_price;
            return $cartItem->quantity * ($price ?? 0);
        });

        $html = view('frontend.pages.home.partials.cart', compact('cart', 'subTotal'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);
    }

    public function removeCart(Request $request)
    {
        $cartItem = Cart::find($request->id); 
        if (!$cartItem) {
            return response()->json(['status' => 'error', 'message' => 'Cart item not found']);
        }

        $cartItem->delete(); 

        return response()->json(['status' => 'success', 'message' => 'Course removed from cart']);
    }


    public function applyCoupon(ApplyCouponRequest $request)
    {
        // Validate the input
        $validated = $request->validated();

        $couponName = $validated['coupon'];
        $courseIds = $validated['course_id'];
        $instructorIds = $validated['instructor_id'];

        // Gọi service để xử lý logic
        $discounts =  $this->applyCouponService->applyCoupon($couponName, $courseIds, $instructorIds);

        // If no valid coupon found
        if (empty($discounts)) {
            // Trả về lỗi 400 để kích hoạt thông báo lỗi
            return response()->json([
                'success' => false,
                'message' => 'No valid coupon found for the selected courses or it has expired.',
            ], 400); 
        }

        // Calculate total discount
        $totalDiscount = collect($discounts)->sum('discount');

        // Store total discount in session (LƯU Ý: Đảm bảo session hoạt động với AJAX)
        session(['coupon' => $totalDiscount]);

        // Success response
        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'discounts' => $discounts,
            'total_discount' => $totalDiscount, // Trả về tổng giảm giá để cập nhật UI
        ]);
    }

    
}