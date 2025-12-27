<?php


namespace App\Repositories;

use App\Models\Coupon;
use Illuminate\Support\Carbon;

class ApplyCouponRepository
{


    public function applyCoupon($couponName, $courseIds, $instructorIds)
    {
        try {
            $discounts = [];
            $now = Carbon::now()->format('Y-m-d');

            foreach ($courseIds as $key => $courseId) {
                $instructorId = $instructorIds[$key];

                
                $coupon = Coupon::where('coupon_name', $couponName)
                    ->where('instructor_id', $instructorId)
                    ->where('status', 1)
                    ->where('coupon_validity', '>=', $now)
                    ->first();

                if ($coupon) {
                   
                    $discounts[] = [
                        'course_id'     => $courseId,
                        'instructor_id' => $instructorId,
                        'coupon_name'   => $coupon->coupon_name,
                        'coupon_type'   => $coupon->coupon_type, 
                        'discount_value'=> $coupon->coupon_discount, 
                        'validity'      => $coupon->coupon_validity,
                    ];
                }
            }

            return $discounts;

        } catch (\Exception $error) {
            return [
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $error->getMessage(),
            ];
        }
    }






}