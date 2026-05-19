<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function view(User $user, Coupon $coupon): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'instructor') {
            return $coupon->instructor_id == $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function update(User $user, Coupon $coupon): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $coupon->instructor_id == $user->id);
    }

    public function delete(User $user, Coupon $coupon): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $coupon->instructor_id == $user->id);
    }
}
