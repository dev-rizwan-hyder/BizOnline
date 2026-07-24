@extends('layouts.dashboard')

@section('content')
<div x-data="{ delayModalOpen: false, activeTask: null, delayReason: '' }">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">My Workspace</h1>
        <p class="text-slate-500 mt-1">Track assigned tasks, update deadlines, and log attendance.</p>
    </div>

    <!-- Attendance Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <i class="ri-time-line text-indigo-600"></i> Today's Attendance
                </h2>
                <p class="text-sm text-slate-500 mt-1">{{ \Carbon\Carbon::today()->format('l, F j, Y') }}</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                @if(!$attendance || $attendance->status === 'pending')
                    <form action="{{ route('employee.attendance.check-in') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm shadow-indigo-200 transition-colors">
                            <i class="ri-login-box-line mr-2"></i> Check In
                        </button>
                    </form>
                @elseif($attendance->status === 'checked_in')
                    <form action="{{ route('employee.attendance.break-start') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-slate-700 bg-amber-100 hover:bg-amber-200 border border-amber-200 rounded-xl transition-colors">
                            <i class="ri-cup-line mr-2"></i> Take Break
                        </button>
                    </form>
                    <form action="{{ route('employee.attendance.check-out') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-sm shadow-red-200 transition-colors">
                            <i class="ri-logout-box-line mr-2"></i> Check Out
                        </button>
                    </form>
                @elseif($attendance->status === 'on_break')
                    <form action="{{ route('employee.attendance.break-end') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm shadow-indigo-200 transition-colors">
                            <i class="ri-play-circle-line mr-2"></i> Continue Work
                        </button>
                    </form>
                @elseif($attendance->status === 'checked_out')
                    <span class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 font-semibold text-sm">
                        <i class="ri-check-double-line mr-2"></i> You have checked out for today.
                    </span>
                @endif
            </div>
        </div>
        
        @if($attendance)
        <div class="mt-6 pt-6 border-t border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Check In</span>
                <span class="text-sm font-medium text-slate-800">{{ $attendance->check_in ? $attendance->check_in->format('h:i A') : '--:--' }}</span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Breaks Taken</span>
                <span class="text-sm font-medium text-slate-800">{{ $attendance->breaks ? count($attendance->breaks) : 0 }}</span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Total Break Time</span>
                <span class="text-sm font-medium text-slate-800">{{ $attendance->formatDuration($attendance->break_duration) }}</span>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Check Out</span>
                <span class="text-sm font-medium text-slate-800">{{ $attendance->check_out ? $attendance->check_out->format('h:i A') : '--:--' }}</span>
            </div>
        </div>
        @endif
    </div>

    <!-- Assigned Tasks Section -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
            <i class="ri-task-line text-indigo-600"></i> My Assigned Tasks
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($tasks as $task)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-md hover:border-indigo-200 transition-all duration-300">
                <div class="p-6 flex-1 relative">
                    <div class="flex justify-between items-start mb-3 gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                            {{ $task->priority === 'high' ? 'bg-red-100 text-red-700 border border-red-200' : ($task->priority === 'medium' ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-slate-100 text-slate-700 border border-slate-200') }}">
                            {{ ucfirst($task->priority) }} Priority
                        </span>

                        @if($task->is_recurring)
                            <span class="text-[10px] bg-purple-100 text-purple-800 px-2.5 py-0.5 rounded-full font-bold uppercase">Repeat Daily</span>
                        @endif
                    </div>
                    
                    <a href="{{ route('employee.tasks.show', $task) }}" class="block mb-2 hover:text-indigo-600 transition-colors">
                        <h3 class="text-xl font-bold text-slate-800 leading-tight">{{ $task->title }}</h3>
                    </a>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ Str::limit($task->description, 120) }}</p>

                    <!-- Deadline Time Display -->
                    <div class="text-xs font-semibold text-slate-600 flex items-center gap-1.5 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <i class="ri-alarm-warning-line text-indigo-600 text-sm"></i>
                        <span>Deadline: <strong class="text-slate-900">{{ $task->deadline ? $task->deadline->format('M d, Y h:i A') : ($task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No deadline') }}</strong></span>
                    </div>

                    @if($task->delay_reason)
                        <div class="mt-3 text-xs text-rose-600 bg-rose-50 p-2.5 rounded-xl border border-rose-100 font-medium flex items-start gap-1.5">
                            <i class="ri-error-warning-line text-sm mt-0.5"></i>
                            <span>Delay Reason: {{ $task->delay_reason }}</span>
                        </div>
                    @endif
                </div>
                
                <div class="bg-slate-50/70 px-6 py-4 border-t border-slate-100 mt-auto flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Update Status</span>
                    
                    <form action="{{ route('employee.tasks.status', $task) }}" method="POST" id="status-form-{{ $task->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="relative inline-block">
                            <select name="status" onchange="
                                if (this.value === 'delayed') {
                                    activeTask = {{ $task->id }};
                                    delayModalOpen = true;
                                } else {
                                    this.form.submit();
                                }
                            " class="appearance-none pl-4 pr-8 py-1.5 rounded-xl text-xs font-bold border focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500 cursor-pointer transition-colors shadow-sm
                                {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : '' }}
                                {{ in_array($task->status, ['pending', 'in_progress']) ? 'bg-amber-100 text-amber-800 border-amber-300' : '' }}
                                {{ $task->status === 'delayed' ? 'bg-rose-100 text-rose-800 border-rose-300' : '' }}">
                                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="delayed" {{ $task->status === 'delayed' ? 'selected' : '' }}>Delayed</option>
                            </select>
                            <i class="ri-arrow-down-s-line absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500"></i>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-300 p-16 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <i class="ri-check-double-line text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-1">All Caught Up!</h3>
                <p class="text-slate-500">You have no tasks assigned to you right now.</p>
            </div>
        @endforelse
    </div>

    <!-- Delay Reason Prompt Modal -->
    <div x-show="delayModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="delayModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-rose-900 text-white">
                <h2 class="text-base font-bold flex items-center gap-2">
                    <i class="ri-alert-line text-rose-300"></i> Reason for Delay
                </h2>
                <button @click="delayModalOpen = false" class="text-slate-300 hover:text-white"><i class="ri-close-line text-xl"></i></button>
            </div>
            <div class="p-6">
                <p class="text-xs text-slate-600 mb-3 font-medium">Please provide a short explanation for marking this task as delayed so your admin stays informed.</p>
                
                <input type="text" x-model="delayReason" placeholder="e.g. Waiting for client assets, system dependency delay" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm font-medium text-slate-800 outline-none focus:ring-2 focus:ring-rose-500 mb-4">

                <div class="flex justify-end gap-3">
                    <button type="button" @click="delayModalOpen = false" class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-800">Cancel</button>
                    <button type="button" @click="
                        let form = document.getElementById('status-form-' + activeTask);
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'delay_reason';
                        input.value = delayReason;
                        form.appendChild(input);
                        form.submit();
                    " class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-md">
                        Submit & Mark Delayed
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
