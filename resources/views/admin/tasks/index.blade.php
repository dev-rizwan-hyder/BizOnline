@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    addModalOpen: false, 
    editModalOpen: false, 
    editData: { title: '', description: '', project_id: '', assignee_id: '', deadline: '', priority: '', status: '' },
    editUrl: ''
}">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight flex items-center gap-3">
                <i class="ri-task-line text-indigo-600"></i>
                <span>Task Management</span>
            </h1>
            <p class="text-slate-500 mt-1">Manage, assign, and audit tasks grouped by employee performance breakdown.</p>
        </div>
        <button @click="addModalOpen = true" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-sm shadow-indigo-200">
            <i class="ri-add-line mr-2"></i> Create Task
        </button>
    </div>

    <!-- Add Task Modal -->
    <div x-show="addModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto" x-cloak>
        <div @click.away="addModalOpen = false" x-transition x-show="addModalOpen" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white sticky top-0 z-10">
                <h2 class="text-lg font-bold">Create New Task</h2>
                <button @click="addModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.tasks.store') }}" method="POST" class="p-6" hx-boost="false">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Title *</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project (Optional)</label>
                        <select name="project_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-semibold text-slate-700 cursor-pointer appearance-none">
                            <option value="">-- No Project (Standalone Task) --</option>
                            @foreach($projects as $proj)
                                <option value="{{ $proj->id }}">{{ $proj->name }} {{ $proj->client_name ? '('.$proj->client_name.')' : '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 resize-none"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Assign To *</label>
                            <select name="assigned_to" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="">Select Employee</option>
                                @foreach($allEmployees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deadline (Date & Time) *</label>
                            <input type="datetime-local" name="deadline" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Priority *</label>
                            <select name="priority" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status *</label>
                            <select name="status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="pending" selected>Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end gap-3 sticky bottom-0 bg-white pt-4">
                    <button type="button" @click="addModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-sm transition-colors">Create Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div x-show="editModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto" x-cloak>
        <div @click.away="editModalOpen = false" x-transition x-show="editModalOpen" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white sticky top-0 z-10">
                <h2 class="text-lg font-bold">Edit Task</h2>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            
            <form :action="editUrl" method="POST" class="p-6" hx-boost="false">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Title *</label>
                        <input type="text" name="title" x-model="editData.title" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project (Optional)</label>
                        <select name="project_id" x-model="editData.project_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-semibold text-slate-700 cursor-pointer appearance-none">
                            <option value="">-- No Project (Standalone Task) --</option>
                            @foreach($projects as $proj)
                                <option value="{{ $proj->id }}">{{ $proj->name }} {{ $proj->client_name ? '('.$proj->client_name.')' : '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" x-model="editData.description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 resize-none"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Assign To *</label>
                            <select name="assigned_to" x-model="editData.assignee_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="">Select Employee</option>
                                @foreach($allEmployees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deadline (Date & Time)</label>
                            <input type="datetime-local" name="deadline" x-model="editData.deadline" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Priority *</label>
                            <select name="priority" x-model="editData.priority" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status *</label>
                            <select name="status" x-model="editData.status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="paused">Paused</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end gap-3 sticky bottom-0 bg-white pt-4">
                    <button type="button" @click="editModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-sm transition-colors">Update Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 mb-8">
        <form method="GET" action="{{ route('admin.tasks.index') }}" class="flex flex-wrap items-end gap-4" hx-boost="false">
            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Filter Employee</label>
                <div class="relative">
                    <select name="employee_id" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm text-slate-700 bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Employees</option>
                        @foreach($allEmployees as $emp)
                            <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                        @endforeach
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Project</label>
                <div class="relative">
                    <select name="project_id" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm text-slate-700 bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Projects</option>
                        @foreach($projects as $proj)
                            <option value="{{ $proj->id }}" {{ request('project_id') == $proj->id ? 'selected' : '' }}>{{ $proj->name }}</option>
                        @endforeach
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                <div class="relative">
                    <select name="status" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm text-slate-700 bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="paused" {{ request('status') === 'paused' ? 'selected' : '' }}>Paused</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div class="flex-1 min-w-[160px]">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Priority</label>
                <div class="relative">
                    <select name="priority" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm text-slate-700 bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Priorities</option>
                        <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                        <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div>
                <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 border border-slate-200 rounded-xl bg-white hover:bg-slate-50 transition-colors">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Task Breakdown List Grouped By Employee -->
    <div class="space-y-8">
        @forelse($employeeTaskGroups as $group)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <!-- Employee Group Header Card -->
                <div class="p-6 bg-slate-50/70 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white font-black text-xl flex items-center justify-center shadow-md">
                            {{ substr($group['employee']->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                                <span>{{ $group['employee']->name }}</span>
                                <a href="{{ route('admin.employees.show', $group['employee']) }}" class="text-xs text-indigo-600 font-semibold hover:underline" title="View Profile">(Profile)</a>
                            </h3>
                            <p class="text-xs text-slate-500">{{ $group['employee']->email }}</p>
                        </div>
                    </div>

                    <!-- Progress Bar & Stats Pill badges -->
                    <div class="flex items-center gap-5 flex-wrap">
                        <div class="text-right">
                            <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Completion Rate</div>
                            <div class="text-xl font-black text-slate-900">{{ $group['completion_rate'] }}%</div>
                        </div>
                        <div class="w-28 bg-slate-200 rounded-full h-2.5 overflow-hidden shadow-inner hidden sm:block">
                            <div class="bg-gradient-to-r from-indigo-500 to-emerald-500 h-full rounded-full transition-all duration-500" style="width: {{ $group['completion_rate'] }}%"></div>
                        </div>
                        <div class="flex gap-2 flex-wrap">
                            <span class="px-3 py-1 bg-slate-200 text-slate-800 text-xs font-bold rounded-lg" title="Total Assigned">Total: {{ $group['assigned'] }}</span>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg" title="Completed">Done: {{ $group['completed'] }}</span>
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-lg" title="Pending">Pending: {{ $group['pending'] }}</span>
                            <span class="px-3 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-lg" title="Delayed">Delayed: {{ $group['delayed'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Task Breakdown Table for this Employee -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-900 text-white text-xs uppercase tracking-wider font-bold">
                                <th class="px-6 py-3.5">Task Info</th>
                                <th class="px-6 py-3.5">Project</th>
                                <th class="px-6 py-3.5">Deadline & Time</th>
                                <th class="px-6 py-3.5">Priority</th>
                                <th class="px-6 py-3.5">Status</th>
                                <th class="px-6 py-3.5">Time Logged</th>
                                <th class="px-6 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($group['tasks'] as $task)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900 text-sm">{{ $task->title }}</div>
                                        <div class="text-xs text-slate-500 truncate max-w-xs mt-0.5">{{ $task->description ?: 'No description provided.' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($task->project)
                                            <a href="{{ route('admin.projects.show', $task->project) }}" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200/60 px-2.5 py-1 rounded-lg transition-colors">
                                                <i class="ri-folder-3-line"></i> {{ $task->project->name }}
                                            </a>
                                        @else
                                            <span class="text-xs text-slate-400 italic">Standalone Task</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs font-medium">
                                        @if($task->deadline || $task->due_date)
                                            <div class="flex items-center gap-1.5 {{ ($task->deadline ?: $task->due_date)->isPast() && $task->status !== 'completed' ? 'text-red-600 font-bold' : 'text-slate-700' }}">
                                                <i class="ri-alarm-warning-line text-indigo-500"></i>
                                                <span>{{ ($task->deadline ?: \Carbon\Carbon::parse($task->due_date))->format('M d, Y h:i A') }}</span>
                                            </div>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] uppercase font-bold tracking-wider
                                            {{ $task->priority === 'high' ? 'bg-rose-100 text-rose-700 border border-rose-200' : ($task->priority === 'medium' ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-slate-100 text-slate-700 border border-slate-200') }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold capitalize
                                            {{ $task->status === 'completed' ? 'text-emerald-800 bg-emerald-100' : ($task->status === 'in_progress' ? 'text-blue-800 bg-blue-100 animate-pulse' : ($task->status === 'paused' ? 'text-amber-800 bg-amber-100' : 'text-slate-700 bg-slate-100')) }}">
                                            {{ str_replace('_', ' ', $task->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-extrabold text-indigo-600">
                                        <span class="flex items-center gap-1">
                                            <i class="ri-timer-flash-line"></i> {{ $task->formatted_time_spent }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <a href="{{ route('admin.tasks.show', $task) }}" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="View Task Details">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <button @click="editData = { title: {{ json_encode($task->title) }}, description: {{ json_encode($task->description) }}, project_id: '{{ $task->project_id }}', assignee_id: '{{ $task->assigned_to }}', deadline: '{{ $task->deadline ? $task->deadline->format('Y-m-d\TH:i') : '' }}', priority: '{{ $task->priority }}', status: '{{ $task->status }}' }; editUrl = '{{ route('admin.tasks.update', $task) }}'; editModalOpen = true" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit Task">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                            <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 bg-slate-50 hover:bg-red-50 rounded-lg transition-colors" title="Delete Task">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-xs text-slate-400">
                                        No tasks found matching current filters for {{ $group['employee']->name }}.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-12 text-center text-slate-500">
                <i class="ri-user-unfollow-line text-4xl mb-2 text-slate-300"></i>
                <h3 class="text-lg font-bold text-slate-700">No Employees Found</h3>
                <p class="text-sm text-slate-400 mt-1">Try adjusting the filter options above.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
