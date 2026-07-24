<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Attendance;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $type = $request->get('type', 'monthly'); // daily, weekly, monthly
        $selectedDate = $request->get('date', Carbon::today()->format('Y-m-d'));
        $targetCarbon = Carbon::parse($selectedDate);

        $query = Task::where('assigned_to', $user->id);

        if ($type === 'daily') {
            $query->daily($targetCarbon);
            $dateRangeStr = $targetCarbon->format('F d, Y');
        } elseif ($type === 'weekly') {
            $query->weekly($targetCarbon);
            $dateRangeStr = $targetCarbon->copy()->startOfWeek()->format('M d, Y') . ' - ' . $targetCarbon->copy()->endOfWeek()->format('M d, Y');
        } else {
            $query->monthly($targetCarbon);
            $dateRangeStr = $targetCarbon->format('F Y');
        }

        $allUserTasks = Task::where('assigned_to', $user->id)->get();
        $tasks = $query->latest()->get();

        $totalAssigned = $allUserTasks->count();
        $completedCount = $allUserTasks->where('status', 'completed')->count();
        $pendingCount = $allUserTasks->whereIn('status', ['pending', 'in_progress'])->count();
        $delayedCount = $allUserTasks->where('status', 'delayed')->count();
        $completionRate = $totalAssigned > 0 ? round(($completedCount / $totalAssigned) * 100) : 0;

        $attendancesCount = Attendance::where('user_id', $user->id)->where('status', 'checked_out')->count();

        return view('employee.reports', compact(
            'user',
            'type',
            'selectedDate',
            'dateRangeStr',
            'tasks',
            'allUserTasks',
            'totalAssigned',
            'completedCount',
            'pendingCount',
            'delayedCount',
            'completionRate',
            'attendancesCount'
        ));
    }
}
