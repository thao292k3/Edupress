<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // public function lessons()
    // {
    //     return $this->hasMany(Lesson::class)->orderBy('position');
    // }

     public function lesson(){
        return $this->hasMany(Lesson::class, 'section_id', 'id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'section_id');
    }

    


}
