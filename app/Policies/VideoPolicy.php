<?php

namespace App\Policies;

use App\Models\Course_videos;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class VideoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course_videos $courseVideos): bool
    {
         if ($user->role === 'admin') return true;

        return $courseVideos->course->instructor_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course_videos $courseVideos): bool
    {
        if ($user->role === 'admin') return true;

        return $courseVideos->course->instructor_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course_videos $courseVideos): bool
    {
        if ($user->role === 'admin') return true;

        return $courseVideos->course->instructor_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Course_videos $courseVideos): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Course_videos $courseVideos): bool
    // {
    //     return false;
    // }
}
