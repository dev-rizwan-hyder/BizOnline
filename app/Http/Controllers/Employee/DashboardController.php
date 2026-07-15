<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('assigned_to', $user->id)
                     ->latest()
                     ->get();
                     
        $attendance = \App\Models\Attendance::where('user_id', $user->id)
                     ->where('date', \Carbon\Carbon::today()->toDateString())
                     ->first();

        return view('employee.dashboard', compact('tasks', 'attendance'));
    }
}
