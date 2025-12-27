<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyCouponRequest;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Services\ApplyCouponService;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $couponService, $applyCouponService;

    public function __construct(CouponService $couponService, ApplyCouponService $applyCouponService)
    {
        $this->couponService = $couponService;
        $this->applyCouponService = $applyCouponService;
    }

    public function index()
    {
        $instructor_id = Auth::user()->id;
        $all_coupon = Coupon::where('instructor_id', $instructor_id)->latest()->get();
        return view('backend.instructor.coupon.index', compact('all_coupon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.instructor.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        //
        $this->couponService->saveCoupon($request->validated());
        return redirect()->back()->with('success', 'Coupon Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('backend.instructor.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, string $id)
    {
        $this->couponService->updateCoupon($request->validated(), $id);
        return redirect()->back()->with('success', 'Coupon Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();

        return redirect()->route('instructor.coupon.index')->with('success', 'Coupon deleted successfully.');
    }

    public function applyCoupon(ApplyCouponRequest $request)
    {

       
        $validated = $request->validated();

        $couponName = $validated['coupon'];
        $courseIds = $validated['course_id'];
        $instructorIds = $validated['instructor_id'];

        $discounts =  $this->applyCouponService->applyCoupon($couponName, $courseIds, $instructorIds);

        
        if (empty($discounts)) {
            return response()->json([
                'success' => false,
                'message' => 'No valid coupon found for the selected courses.',
            ], 400);
        }

        
        $totalDiscount = collect($discounts)->sum('discount');

        
        session(['coupon' => $totalDiscount]);


        
        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'discounts' => $discounts,
        ]);
    }

    public function applyCheckCoupon(ApplyCouponRequest $request)
    {

       
        $validated = $request->validated();

        $couponName = $validated['coupon'];
        $courseIds = $validated['course_id'];
        $instructorIds = $validated['instructor_id'];

        $discounts =  $this->applyCouponService->applyCoupon($couponName, $courseIds, $instructorIds);

        
        if (empty($discounts)) {
            return redirect()->back()->with('error', 'Invalid coupon!');
        }

        
        $totalDiscount = collect($discounts)->sum('discount');

        
        session(['coupon' => $totalDiscount]);


        
        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }


    public function adminAllCoupon() {
    $coupons = Coupon::with('instructor')->latest()->get();
    foreach($coupons as $item) {
        
        $item->is_valid = $item->coupon_validity >= Carbon::now()->format('Y-m-d');
    }
    return view('admin.coupon.all', compact('coupons'));
}
}