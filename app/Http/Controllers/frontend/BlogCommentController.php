<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        $request->validate([
            'content' => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $blog = Blog::where('slug', $slug)->firstOrFail();

        $comment = Comment::create([
            'blog_id' => $blog->id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'approved' => false, // require admin approval
        ]);

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

    // mark helpful (AJAX)
    public function helpful(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Login required'], 401);
        }

        $comment = Comment::findOrFail($id);
        $comment->increment('helpful_count');

        return response()->json(['status' => 'success', 'helpful_count' => $comment->helpful_count]);
    }
}
