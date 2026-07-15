@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    addModalOpen: false, 
    editModalOpen: false, 
    editData: { title: '', description: '', assignee_id: '', due_date: '', priority: '', status: '' },
    editUrl: ''
}">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Tasks</h1>
            <p class="text-slate-500 mt-1">Manage and assign tasks across the team.</p>
        </div>
        <button @click="addModalOpen = true" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-sm shadow-indigo-200">
            <i class="ri-add-line mr-2"></i> Create Task
        </button>
    </div>

    <!-- Add Task Modal -->
    <div x-show="addModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto" x-cloak>
        <div @click.away="addModalOpen = false" x-transition x-show="addModalOpen" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50 sticky top-0 z-10">
                <h2 class="text-lg font-bold text-slate-800">Create New Task</h2>
                <button @click="addModalOpen = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.tasks.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Title</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 resize-none"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Assign To</label>
                            <select name="assigned_to" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="">Select Employee</option>
                                @foreach(\App\Models\User::where('role','employee')->get() as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Due Date</label>
                            <input type="date" name="due_date" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Priority</label>
                            <select name="priority" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status</label>
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
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50 sticky top-0 z-10">
                <h2 class="text-lg font-bold text-slate-800">Edit Task</h2>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            
            <form :action="editUrl" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Title</label>
                        <input type="text" name="title" x-model="editData.title" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" x-model="editData.description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 resize-none"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Assign To</label>
                            <select name="assigned_to" x-model="editData.assignee_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="">Select Employee</option>
                                @foreach(\App\Models\User::where('role','employee')->get() as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Due Date</label>
                            <input type="date" name="due_date" x-model="editData.due_date" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Priority</label>
                            <select name="priority" x-model="editData.priority" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                            <select name="status" x-model="editData.status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
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

    <!-- Filters (Submitted automatically via HTMX because body is hx-boost) -->
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 mb-6">
        <form method="GET" action="{{ route('admin.tasks.index') }}" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                <div class="relative">
                    <select name="status" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm text-slate-700 bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Assignee</label>
                <div class="relative">
                    <select name="employee_id" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm text-slate-700 bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Employees</option>
                        @foreach(\App\Models\User::where('role','employee')->get() as $emp)
                            <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                        @endforeach
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 border border-slate-200 rounded-xl bg-white hover:bg-slate-50 transition-colors">
                    Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="px-6 py-4">Task Info</th>
                        <th class="px-6 py-4">Assignee</th>
                        <th class="px-6 py-4">Due Date</th>
                        <th class="px-6 py-4">Priority & Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tasks as $task)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $task->title }}</div>
                                <div class="text-xs text-slate-500 truncate max-w-[200px] mt-0.5">{{ $task->description ?: 'No description' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($task->assignee)
                                    <div class="flex items-center text-sm font-medium text-slate-700">
                                        <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold mr-2 shrink-0">
                                            {{ substr($task->assignee->name, 0, 1) }}
                                        </div>
                                        {{ $task->assignee->name }}
                                    </div>
                                @else
                                    <span class="text-slate-400 text-sm italic">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm">
                                @if($task->due_date)
                                    <div class="flex items-center {{ \Carbon\Carbon::parse($task->due_date)->isPast() && $task->status !== 'completed' ? 'text-red-600 font-medium' : '' }}">
                                        <i class="ri-calendar-event-line mr-1.5"></i>
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2 items-start">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] uppercase font-bold tracking-wider
                                        {{ $task->priority === 'high' ? 'bg-red-50 text-red-700 border border-red-200' : ($task->priority === 'medium' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200') }}">
                                        {{ $task->priority }}
                                    </span>
                                    <span class="px-2.5 py-1 rounded-md text-xs font-semibold
                                        {{ $task->status === 'completed' ? 'text-emerald-700 bg-emerald-100' : ($task->status === 'in_progress' ? 'text-blue-700 bg-blue-100' : 'text-slate-600 bg-slate-100') }}">
                                        {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.tasks.show', $task) }}" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="View Details">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <button @click="editData = { title: '{{ addslashes($task->title) }}', description: '{{ addslashes($task->description) }}', assignee_id: '{{ $task->assigned_to }}', due_date: '{{ $task->due_date }}', priority: '{{ $task->priority }}', status: '{{ $task->status }}' }; editUrl = '{{ route('admin.tasks.update', $task) }}'; editModalOpen = true" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                                        <i class="ri-pencil-line"></i>
                                    </button>
                                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 bg-slate-50 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-400 mb-3">
                                    <i class="ri-task-line text-2xl"></i>
                                </div>
                                <h3 class="text-sm font-medium text-slate-900">No tasks found</h3>
                                <p class="text-sm text-slate-500 mt-1">Try adjusting filters or create a new task.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tasks->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $tasks->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
