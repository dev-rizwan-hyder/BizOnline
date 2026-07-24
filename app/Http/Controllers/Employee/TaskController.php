<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }
        $task->load(['comments.user', 'assigner']);
        return view('employee.tasks.show', compact('task'));
    }

    public function storeComment(Request $request, Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $task->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'delay_reason' => 'nullable|string',
        ]);

        $task->update([
            'status' => $validated['status'],
            'delay_reason' => $validated['delay_reason'] ?? $task->delay_reason,
        ]);

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }
}
