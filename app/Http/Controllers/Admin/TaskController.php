<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $allEmployees = User::where('role', '!=', 'admin')->orderBy('name')->get();
        $projects = Project::orderBy('name')->get();

        $employeesQuery = User::where('role', '!=', 'admin')->orderBy('name');

        if ($request->filled('employee_id')) {
            $employeesQuery->where('id', $request->employee_id);
        }

        $employees = $employeesQuery->get();

        $employeeTaskGroups = $employees->map(function ($emp) use ($request) {
            $taskQuery = Task::where('assigned_to', $emp->id)
                ->with(['project', 'assigner', 'assignee'])
                ->latest();

            if ($request->filled('status')) {
                $taskQuery->where('status', $request->status);
            }
            if ($request->filled('project_id')) {
                $taskQuery->where('project_id', $request->project_id);
            }
            if ($request->filled('priority')) {
                $taskQuery->where('priority', $request->priority);
            }

            $tasks = $taskQuery->get();
            $assigned = $tasks->count();
            $completed = $tasks->where('status', 'completed')->count();
            $pending = $tasks->whereIn('status', ['pending', 'in_progress', 'paused'])->count();
            $delayed = $tasks->where('status', 'delayed')->count();
            $completionRate = $assigned > 0 ? round(($completed / $assigned) * 100) : 0;

            return [
                'employee' => $emp,
                'assigned' => $assigned,
                'completed' => $completed,
                'pending' => $pending,
                'delayed' => $delayed,
                'completion_rate' => $completionRate,
                'tasks' => $tasks,
            ];
        });

        return view('admin.tasks.index', compact('employeeTaskGroups', 'employees', 'allEmployees', 'projects'));
    }

    public function create()
    {
        $employees = User::where('role', '!=', 'admin')->get();
        $projects = Project::orderBy('name')->get();
        return view('admin.tasks.create', compact('employees', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'delay_reason' => 'nullable|string',
            'is_recurring' => 'nullable|boolean',
            'recurring_frequency' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $validated['assigned_by'] = auth()->id();

        Task::create($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $task->load(['project', 'assignee', 'assigner', 'comments.user']);
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $employees = User::where('role', '!=', 'admin')->get();
        $projects = Project::orderBy('name')->get();
        return view('admin.tasks.edit', compact('task', 'employees', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,paused,completed,delayed',
            'delay_reason' => 'nullable|string',
            'is_recurring' => 'nullable|boolean',
            'recurring_frequency' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function storeComment(Request $request, Task $task)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $commentData = [
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store file directly in public/comments directory
            $file->move(public_path('comments'), $filename);
            
            $commentData['image_path'] = 'comments/' . $filename;
            $commentData['image_filename'] = $file->getClientOriginalName();
        }

        $task->comments()->create($commentData);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }
}
