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
        $query = Task::with(['assignee', 'assigner'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('employee_id')) {
            $query->where('assigned_to', $request->employee_id);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->paginate(15);
        $employees = User::where('role', '!=', 'admin')->get();
        return view('admin.tasks.index', compact('tasks', 'employees'));
    }

    public function create()
    {
        $employees = User::where('role', '!=', 'admin')->get();
        return view('admin.tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
        $validated['is_recurring'] = $request->has('is_recurring');
        
        // If deadline is set, sync due_date for fallback
        if (!empty($validated['deadline'])) {
            $validated['due_date'] = date('Y-m-d', strtotime($validated['deadline']));
        }

        Task::create($validated);

        if ($request->has('redirect_to')) {
            return redirect($request->get('redirect_to'))->with('success', 'Task assigned successfully.');
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $task->load(['comments.user', 'assignee', 'assigner']);
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
        $employees = User::where('role', '!=', 'admin')->get();
        return view('admin.tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
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

        $validated['is_recurring'] = $request->has('is_recurring');

        if (!empty($validated['deadline'])) {
            $validated['due_date'] = date('Y-m-d', strtotime($validated['deadline']));
        }

        $task->update($validated);

        if ($request->has('redirect_to')) {
            return redirect($request->get('redirect_to'))->with('success', 'Task updated successfully.');
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
