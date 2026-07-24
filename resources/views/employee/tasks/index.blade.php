@extends('layouts.dashboard')

@section('content')
<div x-data="{ delayModalOpen: false, activeTask: null, delayReason: '' }">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-wider mb-2 border border-indigo-100">
                <i class="ri-task-line"></i> Employee Task Manager
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Assigned Tasks</h1>
            <p class="text-slate-500 mt-1">View, search, filter, and execute tasks assigned to you across projects.</p>
        </div>
    </div>

    <!-- Search & Filters Bar -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm mb-8">
        <form method="GET" action="{{ route('employee.tasks.index') }}" class="flex flex-wrap items-center justify-between gap-4" hx-boost="false">
            <div class="flex flex-wrap items-center gap-3 flex-1 min-w-[280px]">
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search task title or description..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm text-slate-700 font-medium">
                    <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>

                <!-- Status Filter -->
                <div class="relative min-w-[150px]">
                    <select name="status" onchange="this.form.submit()" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-700 cursor-pointer">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="paused" {{ request('status') === 'paused' ? 'selected' : '' }}>Paused</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>

                <!-- Priority Filter -->
                <div class="relative min-w-[150px]">
                    <select name="priority" onchange="this.form.submit()" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-700 cursor-pointer">
                        <option value="">All Priorities</option>
                        <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low Priority</option>
                        <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium Priority</option>
                        <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High Priority</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>

                <!-- Project Filter -->
                <div class="relative min-w-[160px]">
                    <select name="project_id" onchange="this.form.submit()" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-700 cursor-pointer">
                        <option value="">All Projects</option>
                        @foreach($projects as $proj)
                            <option value="{{ $proj->id }}" {{ request('project_id') == $proj->id ? 'selected' : '' }}>{{ $proj->name }}</option>
                        @endforeach
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-xs shadow-sm transition-colors">
                    Apply Filters
                </button>
                @if(request()->hasAny(['search', 'status', 'priority', 'project_id']))
                    <a href="{{ route('employee.tasks.index') }}" class="px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl font-bold text-xs transition-colors">
                        Clear Filters
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tasks Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        @forelse($tasks as $task)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-md hover:border-indigo-200 transition-all duration-300">
                <div class="p-6 flex-1 relative">
                    <!-- Badges -->
                    <div class="flex justify-between items-start mb-3 gap-2 flex-wrap">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                            {{ $task->priority === 'high' ? 'bg-red-100 text-red-700 border border-red-200' : ($task->priority === 'medium' ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-slate-100 text-slate-700 border border-slate-200') }}">
                            {{ ucfirst($task->priority) }} Priority
                        </span>

                        <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider
                            {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 
                              ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800 border border-blue-200 animate-pulse' : 
                              ($task->status === 'paused' ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-slate-100 text-slate-700 border border-slate-200')) }}">
                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                        </span>
                    </div>

                    @if($task->project)
                        <div class="mb-2">
                            <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-100 inline-flex items-center gap-1">
                                <i class="ri-folder-3-line"></i> {{ $task->project->name }}
                            </span>
                        </div>
                    @endif
                    
                    <a href="{{ route('employee.tasks.show', $task) }}" class="block mb-2 hover:text-indigo-600 transition-colors">
                        <h3 class="text-xl font-bold text-slate-800 leading-tight">{{ $task->title }}</h3>
                    </a>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ Str::limit($task->description, 120) }}</p>

                    <!-- Deadline Date & Time Display -->
                    <div class="text-xs font-semibold text-slate-600 flex items-center justify-between bg-slate-50 p-3 rounded-xl border border-slate-100 mb-3">
                        <div class="flex items-center gap-1.5">
                            <i class="ri-alarm-warning-line text-indigo-600 text-sm"></i>
                            <span>Deadline: <strong class="{{ ($task->deadline ?: $task->due_date) && ($task->deadline ?: $task->due_date)->isPast() && $task->status !== 'completed' ? 'text-red-600 font-extrabold' : 'text-slate-900' }}">{{ ($task->deadline ?: \Carbon\Carbon::parse($task->due_date))->format('M d, Y h:i A') }}</strong></span>
                        </div>
                    </div>

                    <!-- Timer / Time Logged with Live Real-time Ticker -->
                    <div class="text-xs font-bold text-indigo-700 bg-indigo-50/80 p-3 rounded-xl border border-indigo-100 flex items-center justify-between"
                        x-data="{ 
                            seconds: {{ $task->effective_time_spent_seconds }},
                            isRunning: {{ $task->status === 'in_progress' ? 'true' : 'false' }},
                            timer: null,
                            formatTime(sec) {
                                let total = Math.floor(sec);
                                let h = Math.floor(total / 3600);
                                let m = Math.floor((total % 3600) / 60);
                                let s = total % 60;
                                let pad = (n) => String(n).padStart(2, '0');
                                if (h > 0) {
                                    return `${pad(h)}h ${pad(m)}m ${pad(s)}s`;
                                }
                                return `${pad(m)}m ${pad(s)}s`;
                            }
                        }" x-init="
                            if (isRunning) {
                                timer = setInterval(() => { seconds++; }, 1000);
                            }
                        ">
                        <span class="flex items-center gap-1.5">
                            <i class="ri-timer-flash-line text-base text-indigo-600" :class="{ 'animate-spin': isRunning }"></i> Time Logged:
                        </span>
                        <span class="text-sm font-black" x-text="formatTime(seconds)"></span>
                    </div>

                    @if($task->delay_reason)
                        <div class="mt-3 text-xs text-rose-600 bg-rose-50 p-2.5 rounded-xl border border-rose-100 font-medium flex items-start gap-1.5">
                            <i class="ri-error-warning-line text-sm mt-0.5"></i>
                            <span>Delay Reason: {{ $task->delay_reason }}</span>
                        </div>
                    @endif
                </div>
                
                <!-- Task Execution Action Buttons -->
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex items-center justify-between gap-2">
                    @if($task->status === 'pending')
                        <form action="{{ route('employee.tasks.start', $task) }}" method="POST" class="w-full" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1.5">
                                <i class="ri-play-fill text-base"></i> Start Task
                            </button>
                        </form>
                    @elseif($task->status === 'in_progress')
                        <form action="{{ route('employee.tasks.pause', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-3 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-1">
                                <i class="ri-pause-fill text-base"></i> Pause
                            </button>
                        </form>
                        <form action="{{ route('employee.tasks.finish', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1">
                                <i class="ri-checkbox-circle-fill text-base"></i> Finish Task
                            </button>
                        </form>
                    @elseif($task->status === 'paused')
                        <form action="{{ route('employee.tasks.resume', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1">
                                <i class="ri-play-fill text-base"></i> Resume Work
                            </button>
                        </form>
                        <form action="{{ route('employee.tasks.finish', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1">
                                <i class="ri-checkbox-circle-fill text-base"></i> Finish Task
                            </button>
                        </form>
                    @elseif($task->status === 'completed')
                        <div class="flex items-center justify-between w-full gap-2">
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-2 rounded-xl border border-emerald-200 flex items-center gap-1">
                                <i class="ri-check-line text-base"></i> Completed
                            </span>
                            <form action="{{ route('employee.tasks.resume', $task) }}" method="POST" hx-boost="false" onsubmit="return confirm('Re-open and resume working on this task?');">
                                @csrf
                                <button type="submit" class="py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all flex items-center gap-1" title="Accidentally finished? Re-open & resume task">
                                    <i class="ri-restart-line text-sm text-indigo-600"></i> Resume / Re-open
                                </button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('employee.tasks.start', $task) }}" method="POST" class="w-full" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-1.5">
                                <i class="ri-play-fill text-base"></i> Start Task
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-300 p-16 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <i class="ri-search-eye-line text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-1">No Tasks Found</h3>
                <p class="text-slate-500">No tasks match your search or filter criteria.</p>
                @if(request()->hasAny(['search', 'status', 'priority', 'project_id']))
                    <a href="{{ route('employee.tasks.index') }}" class="mt-4 px-4 py-2 bg-indigo-50 text-indigo-600 font-bold text-xs rounded-xl hover:bg-indigo-100 transition-colors">
                        Clear Search Filters
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($tasks->hasPages())
        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
    @endif
</div>
@endsection
