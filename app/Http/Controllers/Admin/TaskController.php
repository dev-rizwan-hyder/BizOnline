<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('assignee')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('employee_id')) {
            $query->where('assigned_to', $request->employee_id);
        }

        $tasks = $query->paginate(10);
        $employees = User::where('role', 'employee')->get();
        return view('admin.tasks.index', compact('tasks', 'employees'));
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_to' => 'required|exists:users,id',
        ]);

        Task::create($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $task->load(['comments.user']);
        return view('admin.tasks.show', compact('task'));
    }

    public function storeComment(Request $request, Task $task)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $task->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function edit(Task $task)
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
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
}
