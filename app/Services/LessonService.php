<?php

namespace App\Services;

use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LessonService
{
    protected $repo;

    public function __construct(LessonRepository $repo)
    {
        $this->repo = $repo;
    }

    public function createLesson( array $data)
    {
        $manualOrder = Arr::pull($data, 'order');
        
        if (empty($manualOrder)|| (int) $manualOrder <= 0) {
        
        $maxOrder = Lesson::where('section_id', $data['section_id'])
                             ->max('order');
                             
        
        $data['order'] = ($maxOrder ?? 0) + 1; 
        } else {
            
            $data['order'] = (int) $manualOrder;
        }


        
       
        $data['title'] = Arr::pull($data, 'lecture_title');

        $attachments = Arr::pull($data, 'attachments', []);
        $links = Arr::pull($data, 'links', []);

       
        if (!empty($data['video_file'])) {
            $data['video_file'] = $data['video_file']->store('lesson/videos', 'public');
            $data['video_url'] = null; 
        }

       
        if (!empty($data['lesson_file'])) {
            $data['lesson_file'] = $data['lesson_file']->store('lesson/files', 'public');
        }

        
        $lesson = $this->repo->create($data);

       
        if (!empty($data['attachments'])) {
            foreach ($data['attachments'] as $file) {
                $path = $file->store('lesson/attachments', 'public');

                $lesson->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'type'      => 'file'
                ]);
            }
        }

       
        if (!empty($data['links'])) {
            foreach ($data['links'] as $link) {
                if ($link) {
                    $lesson->attachments()->create([
                        'file_path' => $link,
                        'file_name' => $link,
                        'type'      => 'link'
                    ]);
                }
            }
        }

        return $lesson;
    }

    public function updateLesson($id, $data)
    {
        $lesson = $this->repo->find($id);

       
        if (!empty($data['video_file'])) {
            if ($lesson->video_file) {
                Storage::disk('public')->delete($lesson->video_file);
            }

            $data['video_file'] = $data['video_file']->store('lesson/videos', 'public');
            $data['video_url'] = null;
        }

       
        if (!empty($data['lesson_file'])) {
            if ($lesson->lesson_file) {
                Storage::disk('public')->delete($lesson->lesson_file);
            }

            $data['lesson_file'] = $data['lesson_file']->store('lesson/files', 'public');
        }

        // Generate slug
        if (!empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        return $this->repo->update($lesson, $data);
    }

    public function deleteLesson($id)
    {
        $lesson = $this->repo->find($id);

        // Xóa file video
        if ($lesson->video_file) {
            Storage::disk('public')->delete($lesson->video_file);
        }

        // Xóa file tài liệu
        if ($lesson->lesson_file) {
            Storage::disk('public')->delete($lesson->lesson_file);
        }

        // Xóa attachments
        foreach ($lesson->attachments as $att) {
            if ($att->type === 'file') {
                Storage::disk('public')->delete($att->file_path);
            }
            $att->delete();
        }

        return $this->repo->delete($lesson);
    }
}
