<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Attendance;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'daily'); // daily, weekly, monthly
        $selectedDate = $request->get('date', Carbon::today()->format('Y-m-d'));
        $employeeId = $request->get('employee_id');
        $search = $request->get('search');
        
        $targetCarbon = Carbon::parse($selectedDate);

        // Fetch all employees for dropdown selector
        $allEmployees = User::where('role', '!=', 'admin')->orderBy('name')->get();

        $employeesQuery = User::where('role', '!=', 'admin');

        if ($employeeId) {
            $employeesQuery->where('id', $employeeId);
        } elseif ($search) {
            $employeesQuery->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $employees = $employeesQuery->get();

        if ($type === 'daily') {
            $startDate = $targetCarbon->copy()->startOfDay();
            $endDate = $targetCarbon->copy()->endOfDay();
            $dateRangeStr = $targetCarbon->format('F d, Y');
        } elseif ($type === 'weekly') {
            $startDate = $targetCarbon->copy()->startOfWeek();
            $endDate = $targetCarbon->copy()->endOfWeek();
            $dateRangeStr = $startDate->format('M d, Y') . ' - ' . $endDate->format('M d, Y');
        } else {
            $startDate = $targetCarbon->copy()->startOfMonth();
            $endDate = $targetCarbon->copy()->endOfMonth();
            $dateRangeStr = $targetCarbon->format('F Y');
        }

        // Fetch daily reports submitted during check-out in this timeframe
        $dailyReportsQuery = Attendance::whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->whereNotNull('daily_report')
            ->where('daily_report', '!=', '');

        if ($employeeId) {
            $dailyReportsQuery->where('user_id', $employeeId);
        }

        $dailyReports = $dailyReportsQuery->with('user')->latest('date')->get();

        $reportData = $employees->map(function ($employee) use ($type, $targetCarbon, $startDate, $endDate) {
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

            // Employee's attendance reports for this date range
            $empReports = Attendance::where('user_id', $employee->id)
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->whereNotNull('daily_report')
                ->where('daily_report', '!=', '')
                ->latest('date')
                ->get();

            return [
                'employee' => $employee,
                'assigned' => $assigned,
                'completed' => $completed,
                'pending' => $pending,
                'delayed' => $delayed,
                'completion_rate' => $completionRate,
                'tasks' => $tasks,
                'daily_reports' => $empReports,
            ];
        });

        return view('admin.reports.index', compact(
            'type',
            'selectedDate',
            'dateRangeStr',
            'reportData',
            'dailyReports',
            'allEmployees',
            'employeeId',
            'search'
        ));
    }
}
