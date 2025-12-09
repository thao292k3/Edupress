<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Lesson::class);

        $lessons = Lesson::with('course')
            ->whereHas('course', fn($q) => $q->where('instructor_id', auth()->id()))
            ->orderBy('course_id')
            ->orderBy('order')
            ->get();

        return view('backend.instructor.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $this->authorize('create', Lesson::class);

        $courses = Course::where('instructor_id', auth()->id())->get();

        return view('backend.instructor.lessons.create', compact('courses'));
    }


    
    public function store(Request $request)
    {
        $this->authorize('create', Lesson::class);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required|string|max:255',
            'description' => 'nullable',
            'is_preview' => 'boolean',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:50000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:pdf,doc,docx,zip|max:20000',
            'links' => 'nullable|array',
            'links.*' => 'nullable|url|max:255',
           
            'lesson_file' => 'nullable|mimes:pdf,doc,docx,zip|max:20000',
            'lesson_document_link' => 'nullable|string',
        ]);

        // Video upload
        $videoPath = $request->hasFile('video_file')
            ? $request->file('video_file')->store('lesson/videos', 'public')
            : null;

        // Lesson file upload
        $docFilePath = $request->hasFile('lesson_file')
            ? $request->file('lesson_file')->store('lesson/files', 'public')
            : null;

        $lesson = Lesson::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'is_preview' => $request->is_preview ?? false,
            'video_url' => $request->video_url,
            'video_file' => $videoPath,
            
            'order' => $request->order ?? 0,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('lesson/attachments', 'public');
                $lesson->attachments()->create([ // Cần quan hệ attachments() trong Lesson Model
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'type' => 'file',
                ]);
            }
        }

        if ($request->filled('links')) {
            foreach ($request->input('links') as $link) {
                if ($link) {
                    $lesson->attachments()->create([
                        'file_path' => $link,
                        'file_name' => $link,
                        'type' => 'link',
                    ]);
                }
            }
        }

        return redirect()->route('instructor.lessons.index')
            ->with('success', 'Lesson created!');
    }


   
    public function edit(Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $courses = Course::where('instructor_id', auth()->id())->get();

        return view('backend.instructor.lessons.edit', compact('lesson', 'courses'));
    }



    public function update(Request $request, Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $request->validate([
            'course_id' => 'required',
            'title'     => 'required|string|max:255',
            'description' => 'nullable',
            'is_preview' => 'boolean',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,webm,ogg|max:50000',

            // NEW
            'lesson_file' => 'nullable|mimes:pdf,doc,docx,zip|max:20000',
            'lesson_document_link' => 'nullable|string',
        ]);

        // Handle video update
        if ($request->hasFile('video_file')) {
            if ($lesson->video_file) {
                Storage::disk('public')->delete($lesson->video_file);
            }

            $lesson->video_file = $request->file('video_file')
                ->store('lesson/videos', 'public');
        }

        // Handle document file update
        if ($request->hasFile('lesson_file')) {
            if ($lesson->lesson_file) {
                Storage::disk('public')->delete($lesson->lesson_file);
            }

            $lesson->lesson_file = $request->file('lesson_file')
                ->store('lesson/files', 'public');
        }

        $lesson->update([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'is_preview' => $request->is_preview ?? false,
            'video_url' => $request->video_url,
            'lesson_document_link' => $request->lesson_document_link,
            'order' => $request->order ?? $lesson->order,
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

        $lesson->delete();

        return back()->with('success', 'Lesson deleted!');
    }


    public function sort(Request $request)
    {
        $this->authorize('update', Lesson::class);

        foreach ($request->order as $index => $id) {
            Lesson::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'success']);
    }
}
