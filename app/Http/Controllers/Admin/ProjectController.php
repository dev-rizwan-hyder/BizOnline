<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['employees', 'assignee', 'creator'])->withCount([
            'tasks',
            'tasks as completed_tasks_count' => function ($q) {
                $q->where('status', 'completed');
            }
        ])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('employee_id')) {
            $empId = $request->employee_id;
            $query->where(function ($q) use ($empId) {
                $q->whereHas('employees', function ($sub) use ($empId) {
                    $sub->where('users.id', $empId);
                })->orWhere('assigned_to', $empId);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->paginate(12);
        $employees = User::where('role', '!=', 'admin')->get();

        $totalProjects = Project::count();
        $inProgressProjects = Project::where('status', 'in_progress')->count();
        $completedProjects = Project::where('status', 'completed')->count();
        $totalBudget = Project::sum('budget');

        return view('admin.projects.index', compact(
            'projects',
            'employees',
            'totalProjects',
            'inProgressProjects',
            'completedProjects',
            'totalBudget'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'employees' => 'nullable|array',
            'employees.*' => 'exists:users,id',
            'description' => 'nullable|string',
            'status' => 'required|in:planning,in_progress,on_hold,completed,cancelled',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'budget' => 'nullable|numeric|min:0',
        ]);

        $validated['created_by'] = auth()->id();

        $project = Project::create($validated);

        if ($request->has('employees')) {
            $project->employees()->sync($request->input('employees', []));
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['tasks.assignee', 'tasks.assigner', 'employees', 'assignee', 'creator']);

        $tasksCount = $project->tasks->count();
        $completedTasksCount = $project->tasks->where('status', 'completed')->count();
        $inProgressTasksCount = $project->tasks->where('status', 'in_progress')->count();
        $pendingTasksCount = $project->tasks->where('status', 'pending')->count();

        $employees = User::where('role', '!=', 'admin')->get();

        return view('admin.projects.show', compact(
            'project',
            'tasksCount',
            'completedTasksCount',
            'inProgressTasksCount',
            'pendingTasksCount',
            'employees'
        ));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'employees' => 'nullable|array',
            'employees.*' => 'exists:users,id',
            'description' => 'nullable|string',
            'status' => 'required|in:planning,in_progress,on_hold,completed,cancelled',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'budget' => 'nullable|numeric|min:0',
        ]);

        $project->update($validated);
        $project->employees()->sync($request->input('employees', []));

        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
