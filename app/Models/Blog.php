<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Comment;

class Blog extends Model
{
    protected $guarded = [];

    /**
     * Comments for the blog post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }
    public function user() {
    return $this->belongsTo(User::class, 'user_id', 'id');
}
}
