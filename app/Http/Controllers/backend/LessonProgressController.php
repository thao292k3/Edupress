<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function markAsCompleted(Request $request)
{
    $request->validate([
        'lesson_id' => 'required|exists:lessons,id',
    ]);

    $lessonId = $request->lesson_id;
    $userId = Auth::id();

    // Tìm hoặc tạo mới record tiến độ
    $progress = LessonProgress::firstOrCreate(
        [
            'user_id' => $userId, 
            'lesson_id' => $lessonId
        ],
        [
            'is_completed' => 1,
            'completed_at' => now()
        ]
    );

    
    if ($progress->wasRecentlyCreated === false && $progress->is_completed === 0) {
        $progress->update([
            'is_completed' => 1,
            'completed_at' => now()
        ]);
    }

    return response()->json(['message' => 'Bài học đã được đánh dấu hoàn thành!']);
}
}
