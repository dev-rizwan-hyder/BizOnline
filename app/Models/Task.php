<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'due_date',
        'deadline',
        'priority',
        'status',
        'delay_reason',
        'is_recurring',
        'recurring_frequency',
        'assigned_to',
        'assigned_by',
        'started_at',
        'paused_at',
        'completed_at',
        'total_seconds',
    ];

    protected $casts = [
        'due_date' => 'date',
        'deadline' => 'datetime',
        'started_at' => 'datetime',
        'paused_at' => 'datetime',
        'completed_at' => 'datetime',
        'is_recurring' => 'boolean',
        'total_seconds' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'asc');
    }

    public function getEffectiveTimeSpentSecondsAttribute()
    {
        $seconds = (int) ($this->total_seconds ?? 0);
        
        if ($this->status === 'in_progress' && $this->started_at) {
            $seconds += max(0, Carbon::now()->timestamp - $this->started_at->timestamp);
        }

        return max(0, $seconds);
    }

    public function getFormattedTimeSpentAttribute()
    {
        $seconds = $this->effective_time_spent_seconds;
        if ($seconds <= 0) {
            return '00m 00s';
        }

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        if ($hours > 0) {
            return sprintf('%02dh %02dm %02ds', $hours, $minutes, $secs);
        }

        return sprintf('%02dm %02ds', $minutes, $secs);
    }

    // Timeframe Scopes
    public function scopeDaily($query, $date = null)
    {
        $targetDate = $date ? Carbon::parse($date) : Carbon::today();
        return $query->where(function ($q) use ($targetDate) {
            $q->whereDate('deadline', $targetDate)
              ->orWhereDate('due_date', $targetDate)
              ->orWhereDate('created_at', $targetDate)
              ->orWhere('is_recurring', true);
        });
    }

    public function scopeWeekly($query, $date = null)
    {
        $targetDate = $date ? Carbon::parse($date) : Carbon::now();
        $startOfWeek = $targetDate->copy()->startOfWeek();
        $endOfWeek = $targetDate->copy()->endOfWeek();

        return $query->where(function ($q) use ($startOfWeek, $endOfWeek) {
            $q->whereBetween('deadline', [$startOfWeek, $endOfWeek])
              ->orWhereBetween('due_date', [$startOfWeek, $endOfWeek])
              ->orWhereBetween('created_at', [$startOfWeek, $endOfWeek])
              ->orWhere('is_recurring', true);
        });
    }

    public function scopeMonthly($query, $date = null)
    {
        $targetDate = $date ? Carbon::parse($date) : Carbon::now();
        $startOfMonth = $targetDate->copy()->startOfMonth();
        $endOfMonth = $targetDate->copy()->endOfMonth();

        return $query->where(function ($q) use ($startOfMonth, $endOfMonth) {
            $q->whereBetween('deadline', [$startOfMonth, $endOfMonth])
              ->orWhereBetween('due_date', [$startOfMonth, $endOfMonth])
              ->orWhereBetween('created_at', [$startOfMonth, $endOfMonth])
              ->orWhere('is_recurring', true);
        });
    }
}
