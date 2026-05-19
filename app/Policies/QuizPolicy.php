<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function view(User $user, Quiz $quiz): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'instructor') {
            return $quiz->course->instructor_id == $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function update(User $user, Quiz $quiz): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $quiz->course->instructor_id == $user->id);
    }

    public function delete(User $user, Quiz $quiz): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $quiz->course->instructor_id == $user->id);
    }
}
