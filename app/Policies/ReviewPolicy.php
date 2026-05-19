<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function view(User $user, Review $review): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'instructor') {
            return $review->course->instructor_id == $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->role === 'user';
    }

    public function update(User $user, Review $review): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $review->course->instructor_id == $user->id)
            || $review->user_id == $user->id;
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $review->course->instructor_id == $user->id);
    }

    public function approve(User $user): bool
    {
        return $user->role === 'admin';
    }
}
