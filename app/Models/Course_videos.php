<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course_videos extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function videoFileUrl()
    {
        if ($this->video_file) {
            return Storage::disk('public')->url($this->video_file);
        }
        return null;
    }
}
