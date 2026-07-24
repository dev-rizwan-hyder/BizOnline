<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('role', '!=', 'admin')->latest()->paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'cnic_number' => 'nullable|string|max:255',
            'mobile_number_1' => 'nullable|string|max:255',
            'mobile_number_2' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'current_address' => 'nullable|string',
            'job_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'date_of_joining' => 'nullable|date',
            'bank_account_details' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:255',
            'employment_status' => 'required|in:Active,Probation,Contract,Terminated,On Leave',
            'profile_photo' => 'nullable|image|max:2048',
            'cv_resume' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'experience_letters' => 'nullable|mimes:pdf,doc,docx,zip,rar|max:10240',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';
        $validated['contact_info'] = $validated['mobile_number_1'] ?? null;

        // Save uploads directly inside public/ directory
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $fileName = time() . '_photo_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('employee_profile'), $fileName);
            $validated['profile_photo_path'] = 'employee_profile/' . $fileName;
        }

        if ($request->hasFile('cv_resume')) {
            $file = $request->file('cv_resume');
            $fileName = time() . '_cv_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('employee_cv'), $fileName);
            $validated['cv_resume_path'] = 'employee_cv/' . $fileName;
        }

        if ($request->hasFile('experience_letters')) {
            $file = $request->file('experience_letters');
            $fileName = time() . '_exp_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('employee_experience'), $fileName);
            $validated['experience_letters_path'] = 'employee_experience/' . $fileName;
        }

        User::create($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(User $employee)
    {
        if ($employee->role === 'admin') abort(404);

        $tasks = $employee->tasks()->latest()->paginate(15);
        $totalAssigned = $employee->tasks()->count();
        $completedCount = $employee->tasks()->where('status', 'completed')->count();
        $pendingCount = $employee->tasks()->whereIn('status', ['pending', 'in_progress'])->count();
        $delayedCount = $employee->tasks()->where('status', 'delayed')->count();

        return view('admin.employees.show', compact(
            'employee',
            'tasks',
            'totalAssigned',
            'completedCount',
            'pendingCount',
            'delayedCount'
        ));
    }

    public function edit(User $employee)
    {
        if ($employee->role === 'admin') abort(404);
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        if ($employee->role === 'admin') abort(404);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'cnic_number' => 'nullable|string|max:255',
            'mobile_number_1' => 'nullable|string|max:255',
            'mobile_number_2' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
            'current_address' => 'nullable|string',
            'job_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'date_of_joining' => 'nullable|date',
            'bank_account_details' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:255',
            'employment_status' => 'required|in:Active,Probation,Contract,Terminated,On Leave',
            'profile_photo' => 'nullable|image|max:2048',
            'cv_resume' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'experience_letters' => 'nullable|mimes:pdf,doc,docx,zip,rar|max:10240',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = Hash::make($request->password);
        }

        $validated['contact_info'] = $validated['mobile_number_1'] ?? $employee->contact_info;

        // Save uploads directly inside public/ directory
        if ($request->hasFile('profile_photo')) {
            if ($employee->profile_photo_path && file_exists(public_path($employee->profile_photo_path))) {
                @unlink(public_path($employee->profile_photo_path));
            }
            $file = $request->file('profile_photo');
            $fileName = time() . '_photo_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('employee_profile'), $fileName);
            $validated['profile_photo_path'] = 'employee_profile/' . $fileName;
        }

        if ($request->hasFile('cv_resume')) {
            if ($employee->cv_resume_path && file_exists(public_path($employee->cv_resume_path))) {
                @unlink(public_path($employee->cv_resume_path));
            }
            $file = $request->file('cv_resume');
            $fileName = time() . '_cv_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('employee_cv'), $fileName);
            $validated['cv_resume_path'] = 'employee_cv/' . $fileName;
        }

        if ($request->hasFile('experience_letters')) {
            if ($employee->experience_letters_path && file_exists(public_path($employee->experience_letters_path))) {
                @unlink(public_path($employee->experience_letters_path));
            }
            $file = $request->file('experience_letters');
            $fileName = time() . '_exp_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('employee_experience'), $fileName);
            $validated['experience_letters_path'] = 'employee_experience/' . $fileName;
        }

        $employee->update($validated);

        if ($request->has('redirect_to')) {
            return redirect($request->redirect_to)->with('success', 'Employee details updated successfully.');
        }

        return redirect()->route('admin.employees.index')->with('success', 'Employee details updated successfully.');
    }

    public function destroy(User $employee)
    {
        if ($employee->role === 'admin') abort(404);

        if ($employee->profile_photo_path && file_exists(public_path($employee->profile_photo_path))) {
            @unlink(public_path($employee->profile_photo_path));
        }
        if ($employee->cv_resume_path && file_exists(public_path($employee->cv_resume_path))) {
            @unlink(public_path($employee->cv_resume_path));
        }
        if ($employee->experience_letters_path && file_exists(public_path($employee->experience_letters_path))) {
            @unlink(public_path($employee->experience_letters_path));
        }

        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
    }
}
