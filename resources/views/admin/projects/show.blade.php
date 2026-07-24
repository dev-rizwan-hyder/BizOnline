@extends('layouts.dashboard')

@section('content')
<div x-data="{ addTaskModalOpen: false }">
    <!-- Breadcrumb & Back -->
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
            <i class="ri-arrow-left-line mr-1 text-lg"></i> Back to Projects
        </a>

        <div class="flex items-center space-x-2">
            <button @click="addTaskModalOpen = true" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-all shadow-md shadow-indigo-200 flex items-center gap-1.5">
                <i class="ri-add-line text-sm"></i> Add Task to Project
            </button>
        </div>
    </div>

    <!-- Main Project Header Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-slate-100">
            <div>
                <div class="flex items-center gap-3 flex-wrap mb-2">
                    <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider
                        {{ $project->status === 'completed' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 
                          ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 
                          ($project->status === 'planning' ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : 
                          ($project->status === 'on_hold' ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-red-100 text-red-800 border border-red-200'))) }}">
                        {{ str_replace('_', ' ', ucfirst($project->status)) }}
                    </span>
                    @if($project->client_name)
                        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="ri-user-star-line text-indigo-500"></i> Client: {{ $project->client_name }}
                        </span>
                    @endif
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $project->name }}</h1>
                <p class="text-slate-500 mt-2 text-sm max-w-3xl leading-relaxed">
                    {{ $project->description ?: 'No description provided.' }}
                </p>
            </div>

            <!-- Progress Box -->
            <div class="bg-slate-50 border border-slate-200/60 rounded-2xl p-5 min-w-[260px]">
                <div class="flex items-center justify-between text-xs font-bold mb-2">
                    <span class="text-slate-500 uppercase tracking-wider">Overall Progress</span>
                    <span class="text-indigo-600 text-lg font-black">{{ $project->completion_percentage }}%</span>
                </div>
                <div class="w-full h-2.5 bg-slate-200 rounded-full overflow-hidden mb-3">
                    <div class="h-full bg-indigo-600 rounded-full transition-all duration-500" style="width: {{ $project->completion_percentage }}%"></div>
                </div>
                <div class="text-xs text-slate-500 font-semibold flex justify-between">
                    <span>{{ $completedTasksCount }} / {{ $tasksCount }} Tasks Completed</span>
                </div>
            </div>
        </div>

        <!-- Project Meta Stats Bar -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 text-sm">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Start Date</span>
                <span class="font-bold text-slate-800 flex items-center gap-1.5">
                    <i class="ri-calendar-line text-indigo-500"></i>
                    {{ $project->start_date ? $project->start_date->format('M d, Y') : 'Not set' }}
                </span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Deadline</span>
                <span class="font-bold {{ $project->deadline && $project->deadline->isPast() && $project->status !== 'completed' ? 'text-red-600' : 'text-slate-800' }} flex items-center gap-1.5">
                    <i class="ri-time-line text-amber-500"></i>
                    {{ $project->deadline ? $project->deadline->format('M d, Y') : 'Not set' }}
                </span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Budget</span>
                <span class="font-bold text-emerald-600 flex items-center gap-1.5">
                    <i class="ri-money-dollar-circle-line"></i>
                    {{ $project->budget ? '$' . number_format($project->budget, 2) : 'N/A' }}
                </span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Created By</span>
                <span class="font-bold text-slate-800 flex items-center gap-1.5">
                    <i class="ri-user-line text-slate-400"></i>
                    {{ $project->creator->name ?? 'Admin' }}
                </span>
            </div>
        </div>

        <!-- Assigned Team Members List -->
        <div class="mt-6 pt-6 border-t border-slate-100 flex items-center gap-3 flex-wrap">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Assigned Team Members:</span>
            @forelse($project->employees as $emp)
                <span class="inline-flex items-center text-xs font-bold text-slate-800 bg-indigo-50 border border-indigo-100 px-3 py-1 rounded-full">
                    <span class="w-5 h-5 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px] font-bold mr-1.5">
                        {{ substr($emp->name, 0, 1) }}
                    </span>
                    {{ $emp->name }}
                </span>
            @empty
                <span class="text-xs text-slate-400 italic">No team members explicitly assigned.</span>
            @endforelse
        </div>
    </div>
    </div>

    <!-- Task Breakdown Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Pending Tasks</span>
                <span class="text-2xl font-black text-slate-800 mt-1 block">{{ $pendingTasksCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold">
                <i class="ri-time-line text-xl"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">In Progress</span>
                <span class="text-2xl font-black text-blue-600 mt-1 block">{{ $inProgressTasksCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                <i class="ri-loader-3-line text-xl"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Completed</span>
                <span class="text-2xl font-black text-emerald-600 mt-1 block">{{ $completedTasksCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                <i class="ri-checkbox-circle-line text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Project Tasks List Section -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <i class="ri-task-line text-indigo-600"></i> Project Tasks ({{ $tasksCount }})
            </h3>
            <button @click="addTaskModalOpen = true" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                <i class="ri-add-line"></i> Quick Add Task
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="px-6 py-4">Task Name</th>
                        <th class="px-6 py-4">Assignee</th>
                        <th class="px-6 py-4">Due Date</th>
                        <th class="px-6 py-4">Priority & Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($project->tasks as $task)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $task->title }}</div>
                                <div class="text-xs text-slate-500 truncate max-w-[250px] mt-0.5">{{ $task->description ?: 'No details' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($task->assignee)
                                    <div class="flex items-center font-medium text-slate-700">
                                        <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold mr-2">
                                            {{ substr($task->assignee->name, 0, 1) }}
                                        </div>
                                        {{ $task->assignee->name }}
                                    </div>
                                @else
                                    <span class="text-slate-400 italic text-xs">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-slate-600">
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider
                                        {{ $task->priority === 'high' ? 'bg-red-50 text-red-700 border border-red-200' : ($task->priority === 'medium' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200') }}">
                                        {{ $task->priority }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold
                                        {{ $task->status === 'completed' ? 'text-emerald-700 bg-emerald-100' : ($task->status === 'in_progress' ? 'text-blue-700 bg-blue-100' : 'text-slate-600 bg-slate-100') }}">
                                        {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.tasks.show', $task) }}" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors inline-block" title="View Task">
                                    <i class="ri-eye-line"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <i class="ri-task-line text-3xl mb-2 block"></i>
                                <p class="text-sm font-medium text-slate-600">No tasks assigned to this project yet.</p>
                                <button @click="addTaskModalOpen = true" class="mt-3 text-xs text-indigo-600 font-bold hover:underline">
                                    + Add First Task
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Add Task Modal for this Project -->
    <div x-show="addTaskModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm overflow-y-auto" x-cloak x-transition>
        <div @click.away="addTaskModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-xl mx-4 my-8 overflow-hidden relative border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    <i class="ri-add-line text-indigo-400"></i> Add Task to {{ $project->name }}
                </h2>
                <button @click="addTaskModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.tasks.store') }}" method="POST" class="p-6 space-y-4" hx-boost="false">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="redirect_to" value="{{ route('admin.projects.show', $project) }}">

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Task Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Design Landing Page Wireframes" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                    <textarea name="description" rows="3" placeholder="Task requirements & instructions..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800 resize-none"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Assign To *</label>
                        <select name="assigned_to" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-800">
                            <option value="">Select Employee</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deadline (Date & Time) *</label>
                        <input type="datetime-local" name="deadline" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Priority *</label>
                        <select name="priority" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-800">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status *</label>
                        <select name="status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-800">
                            <option value="pending" selected>Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="addTaskModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md transition-colors">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
