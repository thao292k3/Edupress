<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isInstructor();
    }

    public function view(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) return true;

        return $lesson->course->instructor_id == $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isInstructor();
    }

    public function update(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) return true;

        return $lesson->course->instructor_id == $user->id;
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        if ($user->isAdmin()) return true;

        return $lesson->course->instructor_id == $user->id;
    }
}
