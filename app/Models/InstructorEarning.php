<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorEarning extends Model
{
    protected $guarded = [];

    public function instructor() {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
