<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $month = $request->input('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        $daysInMonth = $startDate->daysInMonth;
        
        $attendances = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get()
            ->keyBy(function ($record) {
                return Carbon::parse($record->date)->day;
            });
            
        $totalPresent = 0;
        $totalWorkSeconds = 0;
        $totalBreakSeconds = 0;
        
        foreach ($attendances as $record) {
            if (in_array($record->status, ['checked_in', 'checked_out', 'on_break'])) {
                $totalPresent++;
            }
            $totalWorkSeconds += $record->working_duration;
            $totalBreakSeconds += $record->break_duration;
        }
        
        $formatHours = function ($seconds) {
            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds / 60) % 60);
            return "{$hours}h {$minutes}m";
        };
        
        $stats = [
            'present_days' => $totalPresent,
            'working_time' => $formatHours($totalWorkSeconds),
            'break_time' => $formatHours($totalBreakSeconds),
        ];

        $todayAttendance = $this->getTodayAttendance();

        // Tasks that have timer started or worked on
        $startedTasks = Task::where('assigned_to', $user->id)
            ->where(function($q) {
                $q->whereNotNull('started_at')
                  ->orWhere('total_seconds', '>', 0)
                  ->orWhereIn('status', ['in_progress', 'paused', 'completed']);
            })
            ->with('project')
            ->latest()
            ->get();

        return view('employee.attendance.index', compact(
            'attendances',
            'month',
            'daysInMonth',
            'startDate',
            'stats',
            'todayAttendance',
            'startedTasks'
        ));
    }

    public function checkIn()
    {
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::firstOrCreate(
            ['user_id' => Auth::id(), 'date' => $today],
            ['check_in' => Carbon::now(), 'status' => 'checked_in']
        );

        return redirect()->back()->with('success', 'Checked in successfully.');
    }

    public function startBreak()
    {
        $attendance = $this->getTodayAttendance();
        if ($attendance && $attendance->status === 'checked_in') {
            $breaks = $attendance->breaks ?? [];
            $breaks[] = [
                'start' => Carbon::now()->toDateTimeString(),
                'end' => null
            ];
            
            $attendance->update([
                'breaks' => $breaks,
                'status' => 'on_break'
            ]);
            return redirect()->back()->with('success', 'Break started.');
        }
        return redirect()->back()->withErrors('Cannot start break right now.');
    }

    public function endBreak()
    {
        $attendance = $this->getTodayAttendance();
        if ($attendance && $attendance->status === 'on_break') {
            $breaks = $attendance->breaks ?? [];
            
            if (count($breaks) > 0) {
                $lastIndex = count($breaks) - 1;
                $breaks[$lastIndex]['end'] = Carbon::now()->toDateTimeString();
            }
            
            $attendance->update([
                'breaks' => $breaks,
                'status' => 'checked_in'
            ]);
            return redirect()->back()->with('success', 'Break ended, back to work.');
        }
        return redirect()->back()->withErrors('Cannot end break right now.');
    }

    public function checkOut(Request $request)
    {
        $attendance = $this->getTodayAttendance();
        if ($attendance && in_array($attendance->status, ['checked_in', 'on_break'])) {
            $validated = $request->validate([
                'daily_report' => 'nullable|string|max:5000',
                'task_ids' => 'nullable|array',
                'task_ids.*' => 'exists:tasks,id',
            ]);

            $attendance->update([
                'check_out' => Carbon::now(),
                'status' => 'checked_out',
                'daily_report' => $validated['daily_report'] ?? $attendance->daily_report,
                'task_ids' => $validated['task_ids'] ?? [],
            ]);
            return redirect()->back()->with('success', 'Checked out successfully! Daily report logged.');
        }
        return redirect()->back()->withErrors('Cannot check out right now.');
    }

    private function getTodayAttendance()
    {
        return Attendance::where('user_id', Auth::id())
            ->where('date', Carbon::today()->toDateString())
            ->first();
    }
}
