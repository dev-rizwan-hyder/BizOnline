<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('assigned_to', Auth::id())->with(['project', 'assigner']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->input('priority'));
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->input('project_id'));
        }

        $tasks = $query->latest()->paginate(12)->withQueryString();

        $projects = Project::whereHas('employees', function($q) {
            $q->where('users.id', Auth::id());
        })->orWhereHas('tasks', function($q) {
            $q->where('assigned_to', Auth::id());
        })->distinct()->get();

        return view('employee.tasks.index', compact('tasks', 'projects'));
    }

    public function show(Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }
        $task->load(['comments.user', 'assigner', 'project']);
        return view('employee.tasks.show', compact('task'));
    }

    public function storeComment(Request $request, Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

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

    public function updateStatus(Request $request, Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,paused,completed,delayed',
            'delay_reason' => 'nullable|string',
        ]);

        $status = $validated['status'];

        if ($status === 'in_progress') {
            return $this->start($task);
        } elseif ($status === 'paused') {
            return $this->pause($task);
        } elseif ($status === 'completed') {
            return $this->finish($task);
        }

        $task->update([
            'status' => $status,
            'delay_reason' => $validated['delay_reason'] ?? $task->delay_reason,
        ]);

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }

    public function start(Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'status' => 'in_progress',
            'started_at' => Carbon::now(),
            'paused_at' => null,
            'completed_at' => null,
        ]);

        return redirect()->back()->with('success', 'Task started successfully! Timer is now running.');
    }

    public function pause(Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $additionalSeconds = 0;
        if ($task->status === 'in_progress' && $task->started_at) {
            $additionalSeconds = max(0, Carbon::now()->timestamp - $task->started_at->timestamp);
        }

        $task->update([
            'status' => 'paused',
            'started_at' => null,
            'paused_at' => Carbon::now(),
            'total_seconds' => (int)($task->total_seconds ?? 0) + $additionalSeconds,
        ]);

        return redirect()->back()->with('success', 'Task paused. Progress saved.');
    }

    public function resume(Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'status' => 'in_progress',
            'started_at' => Carbon::now(),
            'paused_at' => null,
            'completed_at' => null,
        ]);

        return redirect()->back()->with('success', 'Task resumed successfully! Timer running.');
    }

    public function finish(Task $task)
    {
        if ($task->assigned_to !== Auth::id()) {
            abort(403);
        }

        $additionalSeconds = 0;
        if ($task->status === 'in_progress' && $task->started_at) {
            $additionalSeconds = max(0, Carbon::now()->timestamp - $task->started_at->timestamp);
        }

        $task->update([
            'status' => 'completed',
            'started_at' => null,
            'paused_at' => null,
            'completed_at' => Carbon::now(),
            'total_seconds' => (int)($task->total_seconds ?? 0) + $additionalSeconds,
        ]);

        return redirect()->back()->with('success', 'Task marked as completed! Great job.');
    }
}
