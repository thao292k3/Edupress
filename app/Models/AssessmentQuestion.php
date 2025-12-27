<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id', 'question', 'options', 'correct_option'
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
