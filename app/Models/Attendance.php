<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'breaks',
        'check_out',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'datetime',
        'breaks' => 'array',
        'check_out' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBreakDurationAttribute()
    {
        $totalSeconds = 0;
        $breaks = $this->breaks ?? [];

        foreach ($breaks as $break) {
            if (isset($break['start'])) {
                $start = \Carbon\Carbon::parse($break['start']);
                $end = isset($break['end']) ? \Carbon\Carbon::parse($break['end']) : now();
                $totalSeconds += $start->diffInSeconds($end);
            }
        }
        
        return $totalSeconds;
    }

    public function getWorkingDurationAttribute()
    {
        if (!$this->check_in) return 0;
        
        $end = $this->check_out ?: now();
        $totalSeconds = $this->check_in->diffInSeconds($end);
        
        return max(0, $totalSeconds - $this->break_duration);
    }
    
    public function formatDuration($seconds)
    {
        if ($seconds <= 0) return '0h 0m';
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        return "{$hours}h {$minutes}m";
    }
}
