<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
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
    ];

    protected $casts = [
        'due_date' => 'date',
        'deadline' => 'datetime',
        'is_recurring' => 'boolean',
    ];

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

    // Timeframe Scopes
    public function scopeDaily($query, $date = null)
    {
        $targetDate = $date ? \Carbon\Carbon::parse($date) : \Carbon\Carbon::today();
        return $query->where(function ($q) use ($targetDate) {
            $q->whereDate('deadline', $targetDate)
              ->orWhereDate('due_date', $targetDate)
              ->orWhereDate('created_at', $targetDate)
              ->orWhere('is_recurring', true);
        });
    }

    public function scopeWeekly($query, $date = null)
    {
        $targetDate = $date ? \Carbon\Carbon::parse($date) : \Carbon\Carbon::now();
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
        $targetDate = $date ? \Carbon\Carbon::parse($date) : \Carbon\Carbon::now();
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
