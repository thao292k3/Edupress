<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order'); 
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
