<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Attendance;
use App\Models\Project;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $tasks = Task::where('assigned_to', $user->id)
                     ->with(['project', 'assigner'])
                     ->latest()
                     ->get();

        $activeTask = Task::where('assigned_to', $user->id)
                          ->where('status', 'in_progress')
                          ->with('project')
                          ->first();

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

        $attendance = Attendance::where('user_id', $user->id)
                                ->where('date', Carbon::today()->toDateString())
                                ->first();

        $pendingCount = $tasks->where('status', 'pending')->count();
        $inProgressCount = $tasks->where('status', 'in_progress')->count();
        $completedCount = $tasks->where('status', 'completed')->count();

        $assignedProjects = Project::whereHas('employees', function($q) use ($user) {
            $q->where('users.id', $user->id);
        })->orWhereHas('tasks', function($q) use ($user) {
            $q->where('assigned_to', $user->id);
        })->distinct()->take(4)->get();

        return view('employee.dashboard', compact(
            'user',
            'tasks',
            'activeTask',
            'startedTasks',
            'attendance',
            'pendingCount',
            'inProgressCount',
            'completedCount',
            'assignedProjects'
        ));
    }
}
