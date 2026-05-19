<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function view(User $user, Question $question): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'instructor') {
            return $question->quiz->course->instructor_id == $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function update(User $user, Question $question): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $question->quiz->course->instructor_id == $user->id);
    }

    public function delete(User $user, Question $question): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $question->quiz->course->instructor_id == $user->id);
    }
}
