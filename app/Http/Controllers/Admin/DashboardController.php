<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'daily'); // daily, weekly, monthly
        $selectedDate = $request->get('date', Carbon::today()->format('Y-m-d'));
        $now = Carbon::parse($selectedDate);

        // Fetch employees / users
        $employees = User::where('role', '!=', 'admin')->get();

        // Calculate statistics per employee based on selected tab
        $employeeStats = $employees->map(function ($employee) use ($activeTab, $now) {
            $taskQuery = Task::where('assigned_to', $employee->id);

            if ($activeTab === 'daily') {
                $taskQuery->daily($now);
            } elseif ($activeTab === 'weekly') {
                $taskQuery->weekly($now);
            } elseif ($activeTab === 'monthly') {
                $taskQuery->monthly($now);
            }

            $tasks = $taskQuery->get();

            $assigned = $tasks->count();
            $completed = $tasks->where('status', 'completed')->count();
            $inProgress = $tasks->where('status', 'in_progress')->count();
            $pending = $tasks->whereIn('status', ['pending', 'in_progress'])->count();
            $delayed = $tasks->where('status', 'delayed')->count();

            return [
                'employee' => $employee,
                'assigned' => $assigned,
                'completed' => $completed,
                'pending' => $pending,
                'delayed' => $delayed,
                'tasks' => $tasks->map(function ($t) {
                    return [
                        'id' => $t->id,
                        'title' => $t->title,
                        'description' => $t->description ?? '',
                        'deadline' => $t->deadline ? $t->deadline->format('M d, Y h:i A') : ($t->due_date ? $t->due_date->format('M d, Y') : 'No deadline'),
                        'priority' => ucfirst($t->priority),
                        'status' => ucfirst(str_replace('_', ' ', $t->status)),
                        'raw_status' => $t->status,
                        'delay_reason' => $t->delay_reason ?? '',
                        'is_recurring' => $t->is_recurring,
                    ];
                }),
            ];
        });

        // Top KPI Cards Metrics
        $totalEmployees = $employees->count();
        $totalProjects = Project::count();
        $activeProjects = Project::where('status', 'in_progress')->count();
        $totalTasks = Task::count();
        $totalCompleted = Task::where('status', 'completed')->count();
        $totalInProgress = Task::where('status', 'in_progress')->count();
        $totalPending = Task::where('status', 'pending')->count();
        $totalDelayed = Task::where('status', 'delayed')->count();

        // Attendance stats for today
        $todayAttendance = Attendance::whereDate('date', Carbon::today())->get();
        $checkedInCount = $todayAttendance->whereIn('status', ['checked_in', 'on_break', 'checked_out'])->count();
        $onBreakCount = $todayAttendance->where('status', 'on_break')->count();

        // Recent active projects
        $recentProjects = Project::withCount('tasks')->with('employees')->latest()->take(5)->get();

        // Recent tasks
        $recentTasks = Task::with(['assignee', 'project'])->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'employeeStats',
            'activeTab',
            'selectedDate',
            'totalEmployees',
            'totalProjects',
            'activeProjects',
            'totalTasks',
            'totalCompleted',
            'totalInProgress',
            'totalPending',
            'totalDelayed',
            'checkedInCount',
            'onBreakCount',
            'recentProjects',
            'recentTasks'
        ));
    }
}
