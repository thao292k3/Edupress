<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    protected $casts = [
        'is_correct' => 'boolean',
    ];

    // Đáp án thuộc về một Câu hỏi
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
