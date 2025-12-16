<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'live_session_id', 'user_id', 'role', 'joined_at'
    ];
    
    protected $casts = [
        'joined_at' => 'datetime',
    ];

    public function user() 
    {
        
        return $this->belongsTo(User::class); 
    }

    public function session() 
    {
        return $this->belongsTo(LiveSessions::class, 'live_session_id');
    }
}
