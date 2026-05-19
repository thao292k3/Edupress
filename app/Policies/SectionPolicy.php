<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function view(User $user, Section $section): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'instructor') {
            return $section->course->instructor_id == $user->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function update(User $user, Section $section): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $section->course->instructor_id == $user->id);
    }

    public function delete(User $user, Section $section): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $section->course->instructor_id == $user->id);
    }
}
