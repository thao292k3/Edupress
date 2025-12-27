<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentModerationController extends Controller
{
    // List pending comments
    public function index()
    {
        $comments = Comment::where('approved', false)->with('user', 'blog')->orderBy('created_at', 'desc')->get();
        return view('backend.comments.index', compact('comments'));
    }

    // Approve a comment
    public function approve(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->approved = true;
        $comment->save();

        if ($request->ajax()) {
            return response()->json(['status' => 'ok', 'message' => 'Comment approved']);
        }

        return redirect()->back()->with('success', 'Comment approved');
    }

    // Reject / delete a comment
    public function reject(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        if ($request->ajax()) {
            return response()->json(['status' => 'ok', 'message' => 'Comment rejected and deleted']);
        }

        return redirect()->back()->with('success', 'Comment rejected and deleted');
    }
}
