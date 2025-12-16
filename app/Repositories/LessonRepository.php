<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonAttachment;
use Illuminate\Support\Facades\Storage;

class LessonRepository


{
    public function find($id)
    {
         return Lesson::with(['content', 'attachments'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Lesson::create($data);
    }

    public function update(Lesson $lesson, array $data)
    {
        $lesson->update($data);
        return $lesson;
    }

    public function delete(Lesson $lesson)
    {
         foreach ($lesson->attachments as $a) {
            if ($a->type === 'file' && Storage::disk('public')->exists($a->file_path)) {
                Storage::disk('public')->delete($a->file_path);
            }
            $a->delete();
        }

        return $lesson->delete();
    }
public function syncAttachments(Lesson $lesson, array $files = [], array $links = [])
    {
        // 1. File uploads
       foreach ($files as $file) {
        if ($file && $file->isValid()) {
            $path = $file->store('lesson/attachments', 'public');

            LessonAttachment::create([
                'lesson_id' => $lesson->id,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'type' => 'file'
            ]);
        }
    }

    // 2. Link attachments (links[])
    foreach ($links as $link) {
        if ($link) {
            LessonAttachment::create([
                'lesson_id' => $lesson->id,
                'file_path' => $link,
                'file_name' => basename(parse_url($link, PHP_URL_PATH)) ?: 'external-link',
                'type' => 'link'
            ]);
        }
    }

}
}

