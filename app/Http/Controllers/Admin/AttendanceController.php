<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function sheet(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        $daysInMonth = $startDate->daysInMonth;

        $employees = User::where('role', 'employee')->get();
        
        $attendances = Attendance::whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])->get();
        
        $matrix = [];
        foreach ($employees as $employee) {
            $matrix[$employee->id] = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $matrix[$employee->id][$day] = null;
            }
        }

        foreach ($attendances as $record) {
            $day = Carbon::parse($record->date)->day;
            if (isset($matrix[$record->user_id][$day])) {
                $matrix[$record->user_id][$day] = $record;
            }
        }

        return view('admin.attendances.sheet', compact('employees', 'matrix', 'month', 'daysInMonth', 'startDate'));
    }

    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));
        $userId = $request->input('user_id');

        $query = Attendance::with('user')->where('date', $date);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $attendances = $query->latest('check_in')->paginate(15);
        $employees = User::where('role', 'employee')->get();

        // KPIs
        $totalRecords = $attendances->total();
        
        // Present Today (anyone who checked in today)
        $presentTodayCount = Attendance::where('date', Carbon::today()->format('Y-m-d'))
                                       ->whereNotNull('check_in')
                                       ->distinct('user_id')
                                       ->count('user_id');
        
        // Array of user IDs who already have attendance today
        $markedToday = Attendance::where('date', Carbon::today()->format('Y-m-d'))
                                 ->pluck('user_id')
                                 ->toArray();
        
        $totalEmployees = $employees->count();
        $absentsCount = max(0, $totalEmployees - $presentTodayCount);

        return view('admin.attendances.index', compact(
            'attendances', 
            'employees', 
            'date', 
            'userId', 
            'totalRecords', 
            'presentTodayCount', 
            'absentsCount',
            'markedToday'
        ));
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
        ]);

        $date = Carbon::today()->format('Y-m-d');
        
        $data = [
            'status' => 'pending',
        ];

        if ($validated['check_in']) {
            $data['check_in'] = $date . ' ' . $validated['check_in'] . ':00';
            $data['status'] = 'checked_in';
        }
        
        if ($validated['check_out']) {
            $data['check_out'] = $date . ' ' . $validated['check_out'] . ':00';
            $data['status'] = 'checked_out';
        }

        Attendance::updateOrCreate(
            ['user_id' => $validated['user_id'], 'date' => $date],
            $data
        );

        // If it was an ajax request (from our professional modal), return json
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Attendance record added successfully.');
    }

    public function edit(Attendance $attendance)
    {
        return view('admin.attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status' => 'required|in:pending,checked_in,on_break,checked_out',
        ]);

        $date = $attendance->date->format('Y-m-d');
        
        $attendance->update([
            'check_in' => $validated['check_in'] ? $date . ' ' . $validated['check_in'] . ':00' : null,
            'check_out' => $validated['check_out'] ? $date . ' ' . $validated['check_out'] . ':00' : null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.attendances.sheet')->with('success', 'Attendance record updated.');
    }
    
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->back()->with('success', 'Record deleted.');
    }
}
