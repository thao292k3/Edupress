<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveSessions extends Model
{

    protected $table = 'live_sessions';
    protected $fillable = [
        'course_id', 'topic', 'description', 'platform', 'meeting_link',
        'start_at', 'duration_minutes', 'is_teacher_joined'
    ];
    
    protected $casts = [
        'start_at' => 'datetime',
        'is_teacher_joined' => 'boolean',
    ];

    

    public function attendees()
    {
        return $this->hasMany(Attendance::class, 'live_session_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }


}
