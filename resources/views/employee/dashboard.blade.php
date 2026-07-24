@extends('layouts.dashboard')

@section('content')
<div x-data="{ delayModalOpen: false, checkOutModalOpen: false, activeTask: null, delayReason: '', taskSearch: '' }">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white rounded-3xl p-6 sm:p-8 mb-8 shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 text-indigo-200 rounded-full text-xs font-bold uppercase tracking-wider mb-2 backdrop-blur-md border border-white/10">
                    <i class="ri-user-star-line text-indigo-400"></i> Employee Workspace
                </div>
                <h1 class="text-3xl font-black tracking-tight">Welcome back, {{ Auth::user()->name }} 👋</h1>
                <p class="text-indigo-200 text-sm mt-1">Here is your daily workflow overview for {{ \Carbon\Carbon::today()->format('l, F j, Y') }}.</p>
            </div>

            <a href="{{ route('employee.tasks.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl text-sm shadow-md transition-all gap-2 self-start sm:self-auto">
                <i class="ri-task-line text-lg"></i> View All Tasks
            </a>
        </div>
    </div>

    <!-- Attendance Widget Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <i class="ri-time-line text-indigo-600"></i> Today's Attendance Punch Portal
                </h2>
                <p class="text-sm text-slate-500 mt-1">Mark your daily check-in time and manage breaks.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                @if(!$attendance || $attendance->status === 'pending')
                    <form action="{{ route('employee.attendance.check-in') }}" method="POST" hx-boost="false">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-extrabold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm shadow-indigo-200 transition-colors">
                            <i class="ri-login-box-line mr-2 text-base"></i> Check In
                        </button>
                    </form>
                @elseif($attendance->status === 'checked_in')
                    <form action="{{ route('employee.attendance.break-start') }}" method="POST" hx-boost="false">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-extrabold text-amber-900 bg-amber-300 hover:bg-amber-400 border border-amber-200 rounded-xl transition-colors">
                            <i class="ri-cup-line mr-2 text-base"></i> Take Break
                        </button>
                    </form>
                    <button type="button" @click="checkOutModalOpen = true" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-extrabold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-sm shadow-rose-200 transition-colors">
                        <i class="ri-logout-box-line mr-2 text-base"></i> Check Out
                    </button>
                @elseif($attendance->status === 'on_break')
                    <form action="{{ route('employee.attendance.break-end') }}" method="POST" hx-boost="false">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-extrabold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm shadow-emerald-200 transition-colors">
                            <i class="ri-play-circle-line mr-2 text-base"></i> Resume Work
                        </button>
                    </form>
                    <button type="button" @click="checkOutModalOpen = true" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-extrabold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-sm shadow-rose-200 transition-colors">
                        <i class="ri-logout-box-line mr-2 text-base"></i> Check Out
                    </button>
                @elseif($attendance->status === 'checked_out')
                    <span class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold text-sm">
                        <i class="ri-check-double-line mr-2"></i> Attendance Logged for Today
                    </span>
                @endif
            </div>
        </div>
        
        @if($attendance)
        <div class="mt-6 pt-6 border-t border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Check In</span>
                <span class="text-sm font-bold text-slate-800">{{ $attendance->check_in ? $attendance->check_in->format('h:i A') : '--:--' }}</span>
            </div>

            <!-- Real-time Working Duration with seconds -->
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100"
                x-data="{ 
                    workSeconds: {{ $attendance->working_duration }},
                    isCheckedIn: {{ $attendance->status === 'checked_in' ? 'true' : 'false' }},
                    timer: null,
                    formatWorkTime(sec) {
                        let total = Math.floor(sec);
                        let h = Math.floor(total / 3600);
                        let m = Math.floor((total % 3600) / 60);
                        let s = total % 60;
                        let pad = (n) => String(n).padStart(2, '0');
                        return `${pad(h)}h ${pad(m)}m ${pad(s)}s`;
                    }
                }"
                x-init="
                    if (isCheckedIn) {
                        timer = setInterval(() => { workSeconds++; }, 1000);
                    }
                ">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Live Working Duration</span>
                <span class="text-sm font-bold text-emerald-600 flex items-center gap-1.5">
                    <i class="ri-timer-flash-line text-emerald-500" :class="{ 'animate-spin': isCheckedIn }"></i>
                    <span x-text="formatWorkTime(workSeconds)"></span>
                </span>
            </div>

            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Total Break Time</span>
                <span class="text-sm font-bold text-amber-600">{{ $attendance->formatDuration($attendance->break_duration) }}</span>
            </div>
            
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Check Out</span>
                <span class="text-sm font-bold text-slate-800">{{ $attendance->check_out ? $attendance->check_out->format('h:i A') : '--:--' }}</span>
            </div>
        </div>
        @endif
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-play-circle-line"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">In Progress</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $inProgressCount }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-time-line"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pending</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $pendingCount }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-checkbox-circle-line"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Completed</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $completedCount }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-folder-3-line"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Assigned Projects</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $assignedProjects->count() }}</h3>
            </div>
        </div>
    </div>

    <!-- Active Task Focal Banner (If Task In Progress) -->
    @if($activeTask)
        <div class="bg-indigo-50 border border-indigo-200 rounded-3xl p-6 sm:p-8 mb-8 relative overflow-hidden shadow-sm">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2 flex-1">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-600 text-white rounded-full text-xs font-extrabold uppercase tracking-wider animate-pulse">
                        <i class="ri-timer-flash-line"></i> Currently Working On
                    </div>
                    <h2 class="text-2xl font-black text-slate-900">{{ $activeTask->title }}</h2>
                    <p class="text-sm text-slate-600 line-clamp-2">{{ $activeTask->description }}</p>
                    
                    @if($activeTask->project)
                        <div class="pt-1">
                            <span class="text-xs font-bold text-indigo-700 bg-white px-3 py-1 rounded-lg border border-indigo-200 inline-flex items-center gap-1">
                                <i class="ri-folder-3-line"></i> {{ $activeTask->project->name }}
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Ticker & Action Controls -->
                <div class="bg-white p-5 rounded-2xl border border-indigo-100 shadow-sm min-w-[240px] text-center">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Time Elapsed</span>
                    
                    <div class="text-2xl font-black text-indigo-700 mb-4 flex items-center justify-center gap-2"
                        x-data="{ 
                            seconds: {{ $activeTask->effective_time_spent_seconds }},
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
                        }" x-init="timer = setInterval(() => { seconds++; }, 1000);">
                        <i class="ri-timer-flash-line text-indigo-600 animate-spin text-xl"></i>
                        <span x-text="formatTime(seconds)"></span>
                    </div>

                    <div class="flex gap-2">
                        <form action="{{ route('employee.tasks.pause', $activeTask) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-xl transition-all">
                                <i class="ri-pause-fill mr-1"></i> Pause
                            </button>
                        </form>
                        <form action="{{ route('employee.tasks.finish', $activeTask) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-all">
                                <i class="ri-checkbox-circle-fill mr-1"></i> Finish
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Recent Tasks Grid -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
            <i class="ri-task-line text-indigo-600"></i> Assigned Tasks
        </h2>
        <a href="{{ route('employee.tasks.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">
            View All Tasks ({{ $tasks->count() }}) <i class="ri-arrow-right-line"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        @forelse($tasks->take(6) as $task)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-md hover:border-indigo-200 transition-all duration-300">
                <div class="p-6 flex-1 relative">
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

                    <!-- Timer / Time Logged -->
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
                </div>
                
                <!-- Action Controls -->
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
                                <button type="submit" class="py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all flex items-center gap-1">
                                    <i class="ri-restart-line text-sm text-indigo-600"></i> Resume
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-300 p-12 flex flex-col items-center justify-center text-center">
                <i class="ri-check-double-line text-4xl text-slate-300 mb-2"></i>
                <h3 class="text-lg font-bold text-slate-700">No Tasks Assigned</h3>
                <p class="text-slate-500 text-sm">You currently have no tasks assigned.</p>
            </div>
        @endforelse
    </div>

    <!-- Check Out Modal with Daily Work Report Summary -->
    <div x-show="checkOutModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="checkOutModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden relative border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white">
                <h2 class="text-base font-bold flex items-center gap-2">
                    <i class="ri-logout-box-line text-rose-400"></i> Check Out & Daily Report Summary
                </h2>
                <button @click="checkOutModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <form action="{{ route('employee.attendance.check-out') }}" method="POST" class="p-6 space-y-4" hx-boost="false">
                @csrf
                
                <!-- Task Selection List (With Live Search & Unchecked Default) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center justify-between">
                        <span>Select Tasks Worked On Today</span>
                        <span class="text-[11px] text-indigo-600 font-semibold">(Started Timer Only)</span>
                    </label>

                    <!-- Real-Time Search Field -->
                    <div class="relative mb-2">
                        <input type="text" x-model="taskSearch" placeholder="Search task by title..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                        <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    </div>

                    <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                        @forelse($startedTasks as $stask)
                            <label class="flex items-start gap-3 p-3 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:border-indigo-300 transition-colors"
                                x-show="!taskSearch || '{{ strtolower(addslashes($stask->title)) }}'.includes(taskSearch.toLowerCase())">
                                <input type="checkbox" name="task_ids[]" value="{{ $stask->id }}" class="mt-1 rounded text-indigo-600 focus:ring-indigo-500 h-4 w-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-bold text-slate-800 text-xs truncate">{{ $stask->title }}</span>
                                        <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700">
                                            {{ str_replace('_', ' ', $stask->status) }}
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 truncate mt-0.5">
                                        {{ $stask->description ? Str::limit($stask->description, 70) : 'No description provided.' }}
                                    </p>
                                    <div class="text-[10px] font-semibold text-slate-400 mt-1 flex items-center gap-2">
                                        @if($stask->project)
                                            <span><i class="ri-folder-3-line"></i> {{ $stask->project->name }}</span>
                                        @endif
                                        <span><i class="ri-timer-flash-line text-indigo-500"></i> Logged: {{ $stask->formatted_time_spent }}</span>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="p-3 text-xs text-slate-400 bg-slate-50 rounded-xl text-center border border-dashed border-slate-200">
                                No active tasks with started timers found for today.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Daily Work Report Summary *</label>
                    <textarea name="daily_report" rows="3" required placeholder="Provide a summary of tasks completed today, key achievements, or notes for the admin..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-rose-500 outline-none text-sm font-medium text-slate-800 resize-none"></textarea>
                    <span class="text-xs text-slate-400 mt-1 block">This summary will be visible in the admin reports dashboard.</span>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="checkOutModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl text-sm shadow-md transition-colors flex items-center gap-2">
                        <i class="ri-check-line text-lg"></i> Submit Report & Check Out
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
