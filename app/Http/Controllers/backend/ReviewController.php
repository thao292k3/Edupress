<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

   public function storeReview(Request $request)
{
    $courseId = $request->course_id;
    $user_id = Auth::id();

    // 1. Kiểm tra xem khóa học có tồn tại không
    $course = Course::findOrFail($courseId);

    // 2. Kiểm tra điều kiện: Nếu là khóa học mất phí thì phải mua mới được review
    $isFree = ($course->selling_price <= 0 || $course->is_free == 1);
    
    if (!$isFree) {
        $hasBought = Order::where('user_id', $user_id)
                          ->where('course_id', $courseId)
                          ->where('status', 'completed') // Hoặc trạng thái thanh toán thành công của bạn
                          ->exists();

        if (!$hasBought) {
            return back()->with([
                'message' => 'Bạn cần mua khóa học này để có thể đánh giá!',
                'alert-type' => 'error'
            ]);
        }
    }

    // 3. Kiểm tra xem user này đã review khóa học này chưa (tránh spam)
    $alreadyReviewed = Review::where('user_id', $user_id)->where('course_id', $courseId)->exists();
    if ($alreadyReviewed) {
        return back()->with([
            'message' => 'Bạn đã đánh giá khóa học này rồi!',
            'alert-type' => 'warning'
        ]);
    }

    // 4. Lưu đánh giá
    Review::create([
        'course_id' => $courseId,
        'user_id' => $user_id,
        'comment' => $request->message,
        'rating' => $request->rating,
        'status' => 0, // Chờ duyệt
        'created_at' => now(),
    ]);

    $notification = array(
        'message' => 'Đánh giá của bạn đã được gửi và đang chờ quản trị viên phê duyệt.',
        'alert-type' => 'success'
    );

    return back()->with($notification);
}
}
