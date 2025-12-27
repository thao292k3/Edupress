<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

   public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // Nội dung mô tả
    public function content()
    {
        return $this->hasOne(LessonContents::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function attachments()
    {
        return $this->hasMany(LessonAttachment::class);
    }

    public function userProgress() {
            return $this->hasOne(LessonProgress::class, 'lesson_id')
                        ->where('user_id', auth()->id());
    }
}
