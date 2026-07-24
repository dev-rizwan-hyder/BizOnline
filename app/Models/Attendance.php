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
        'daily_report',
        'task_ids',
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'datetime',
        'breaks' => 'array',
        'check_out' => 'datetime',
        'task_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSelectedTasksAttribute()
    {
        if (empty($this->task_ids)) {
            return collect();
        }
        return Task::whereIn('id', $this->task_ids)->with('project')->get();
    }

    public function getBreakDurationAttribute()
    {
        $totalSeconds = 0;
        $breaks = $this->breaks ?? [];

        foreach ($breaks as $break) {
            if (isset($break['start'])) {
                $start = \Carbon\Carbon::parse($break['start']);
                $end = isset($break['end']) ? \Carbon\Carbon::parse($break['end']) : now();
                $totalSeconds += (int) $start->diffInSeconds($end);
            }
        }
        
        return (int) $totalSeconds;
    }

    public function getWorkingDurationAttribute()
    {
        if (!$this->check_in) return 0;
        
        $end = $this->check_out ?: now();
        $totalSeconds = (int) $this->check_in->diffInSeconds($end);
        
        return max(0, (int) ($totalSeconds - $this->break_duration));
    }
    
    public function formatDuration($seconds)
    {
        if ($seconds <= 0) return '0h 0m';
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        return "{$hours}h {$minutes}m";
    }
}
