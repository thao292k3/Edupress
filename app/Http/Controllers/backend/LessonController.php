<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\User_course_progress;
use App\Services\LessonService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    use AuthorizesRequests;

    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function index()
    {
      
    }

    public function create()
{
}


   public function store(LessonRequest $request)
{
    $this->authorize('create', Lesson::class);

    $validated = $request->validated();

    $this->lessonService->createLesson($validated);

    // return redirect()
    //     ->route('instructor.lessons.index')
    //     ->with('success', 'Lesson created!');

    return back()->with('success', 'Lesson created success');
}



    public function update(Request $request, Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $request->validate([
            'course_id'   => 'required',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',

            'is_preview' => 'boolean',
            'video_url'  => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:50000',

            'lesson_file' => 'nullable|mimes:pdf,doc,docx,zip|max:20000',
            'lesson_document_link' => 'nullable|string',
            'duration' => 'nullable|numeric|min:0',
        ]);

        
        if ($request->hasFile('video_file')) {

            if ($lesson->video_file) {
                Storage::disk('public')->delete($lesson->video_file);
            }

            $lesson->video_file = $request
                ->file('video_file')
                ->store('lesson/videos', 'public');

            
            $lesson->video_url = null;
        }

        
        if ($request->hasFile('lesson_file')) {

            if ($lesson->lesson_file) {
                Storage::disk('public')->delete($lesson->lesson_file);
            }

            $lesson->lesson_file = $request
                ->file('lesson_file')
                ->store('lesson/files', 'public');
        }

        $lesson->update([
            'course_id' => $request->course_id,
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'description' => $request->description,
            'is_preview' => $request->is_preview ?? false,
            'video_url' => $request->video_url,
            'lesson_document_link' => $request->lesson_document_link,
            'order' => $request->order ?? $lesson->order,
            'duration' => $request->duration,
        ]);

        return redirect()->route('instructor.lessons.index')
            ->with('success', 'Lesson updated!');
    }

    public function destroy(Lesson $lesson)
    {
        $this->authorize('delete', $lesson);

        if ($lesson->video_file) {
            Storage::disk('public')->delete($lesson->video_file);
        }

        if ($lesson->lesson_file) {
            Storage::disk('public')->delete($lesson->lesson_file);
        }

        
        foreach ($lesson->attachments as $a) {
            if ($a->type === 'file') {
                Storage::disk('public')->delete($a->file_path);
            }
            $a->delete();
        }

        $lesson->delete();

        return back()->with('success', 'Lesson deleted!');
    }

    public function sort(Request $request)
    {
        $this->authorize('update', Lesson::class);

        foreach ($request->order as $index => $id) {
            Lesson::where('id', $id)->update([
                'order' => $index + 1
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function markCompleted(Request $request) {
    $user_id = auth()->id();
    
    
    LessonProgress::updateOrCreate(
        ['user_id' => $user_id, 'lesson_id' => $request->lesson_id],
        ['course_id' => $request->course_id, 'is_completed' => 1]
    );

    return response()->json(['status' => 'success']);
    }

    
}
