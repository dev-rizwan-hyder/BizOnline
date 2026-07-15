<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $employeeCount = \App\Models\User::where('role', 'employee')->count();
        $taskCount = \App\Models\Task::count();
        return view('admin.dashboard', compact('employeeCount', 'taskCount'));
    }
}
