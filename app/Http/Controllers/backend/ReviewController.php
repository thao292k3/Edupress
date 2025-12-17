<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Danh sách đánh giá chờ duyệt
    public function pendingReview() {
        $reviews = Review::where('status', 0)->latest()->get();
        return view('backend.admin.review.pending_review', compact('reviews'));
    }

    // Danh sách đánh giá đã duyệt
    public function activeReview() {
        $reviews = Review::where('status', 1)->latest()->get();
        return view('backend.admin.review.active_review', compact('reviews'));
    }

    // Cập nhật trạng thái duyệt/ẩn
    public function updateReviewStatus(Request $request) {
        $review = Review::findOrFail($request->id);
        $review->status = $request->status;
        $review->save();

        return response()->json(['success' => 'Cập nhật trạng thái thành công!']);
    }

    public function deleteReview($id) {
        Review::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Xóa đánh giá thành công!');
    }
}
