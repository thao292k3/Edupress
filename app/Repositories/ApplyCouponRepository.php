<?php


namespace App\Repositories;

use App\Models\Coupon;

class ApplyCouponRepository
{


    public function applyCoupon($couponName, $courseIds, $instructorIds)
    {
        try {

             
        $discounts = [];

        foreach ($courseIds as $key => $courseId) {
            $instructorId = $instructorIds[$key];

            
            $coupon = Coupon::where('coupon_name', $couponName)
                ->where('instructor_id', $instructorId)
                ->where('status', 1) 
                ->first();

            if ($coupon) {
                $discounts[] = [
                    'course_id' => $courseId,
                    'instructor_id' => $instructorId,
                    'discount' => $coupon->coupon_discount,
                    'validity' => $coupon->coupon_validity,
                ];
            }
        }

        return $discounts;




        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! ' . $error->getMessage(),
            ], 500);
        }
    }






}