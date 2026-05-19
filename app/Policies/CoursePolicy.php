<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isInstructor() || $user->isUser();
    }

    public function view(User $user, Course $course): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isInstructor()) {
            return $course->instructor_id == $user->id;
        }

        if ($user->isUser()) {
            return $course->students->contains($user->id);
        }
        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isInstructor();
    }

    public function update(User $user, Course $course): bool
    {
        return $user->isAdmin()
            || ($user->isInstructor() && $course->instructor_id == $user->id);
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->isAdmin()
            || ($user->isInstructor() && $course->instructor_id == $user->id);
    }

    public function restore(User $user, Course $course): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Course $course): bool
    {
        return $user->isAdmin();
    }
}
