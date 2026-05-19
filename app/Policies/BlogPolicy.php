<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Blog $blog): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'instructor']);
    }

    public function update(User $user, Blog $blog): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $blog->instructor_id == $user->id);
    }

    public function delete(User $user, Blog $blog): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'instructor' && $blog->instructor_id == $user->id);
    }
}
