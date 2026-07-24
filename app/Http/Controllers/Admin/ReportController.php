<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'daily'); // daily, weekly, monthly
        $selectedDate = $request->get('date', Carbon::today()->format('Y-m-d'));
        $targetCarbon = Carbon::parse($selectedDate);

        $employees = User::where('role', '!=', 'admin')->get();

        if ($type === 'daily') {
            $dateRangeStr = $targetCarbon->format('F d, Y');
        } elseif ($type === 'weekly') {
            $dateRangeStr = $targetCarbon->copy()->startOfWeek()->format('M d, Y') . ' - ' . $targetCarbon->copy()->endOfWeek()->format('M d, Y');
        } else {
            $dateRangeStr = $targetCarbon->format('F Y');
        }

        $reportData = $employees->map(function ($employee) use ($type, $targetCarbon) {
            $query = Task::where('assigned_to', $employee->id);

            if ($type === 'daily') {
                $query->daily($targetCarbon);
            } elseif ($type === 'weekly') {
                $query->weekly($targetCarbon);
            } else {
                $query->monthly($targetCarbon);
            }

            $tasks = $query->get();
            $assigned = $tasks->count();
            $completed = $tasks->where('status', 'completed')->count();
            $pending = $tasks->whereIn('status', ['pending', 'in_progress'])->count();
            $delayed = $tasks->where('status', 'delayed')->count();
            $completionRate = $assigned > 0 ? round(($completed / $assigned) * 100) : 0;

            return [
                'employee' => $employee,
                'assigned' => $assigned,
                'completed' => $completed,
                'pending' => $pending,
                'delayed' => $delayed,
                'completion_rate' => $completionRate,
                'tasks' => $tasks,
            ];
        });

        return view('admin.reports.index', compact('type', 'selectedDate', 'dateRangeStr', 'reportData'));
    }
}
