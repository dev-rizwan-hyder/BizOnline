@extends('layouts.dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">My Workspace</h1>
    <p class="text-slate-500 mt-1">Manage your daily tasks and attendance.</p>
</div>

<!-- Attendance Card -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Today's Attendance</h2>
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

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-slate-800">Assigned Tasks</h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($tasks as $task)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col hover:shadow-md hover:border-indigo-200 transition-all duration-300">
            <div class="p-6 flex-1 relative">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold tracking-wide
                        {{ $task->priority === 'high' ? 'bg-red-100 text-red-700 border border-red-200' : ($task->priority === 'medium' ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-emerald-100 text-emerald-700 border border-emerald-200') }}">
                        {{ ucfirst($task->priority) }} Priority
                    </span>
                    <div class="text-xs font-medium text-slate-500 flex items-center bg-slate-50 px-2 py-1 rounded-md border border-slate-100">
                        <i class="ri-calendar-event-line mr-1 text-slate-400"></i>
                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}
                    </div>
                </div>
                
                <a href="{{ route('employee.tasks.show', $task) }}" class="block mb-2 group-hover:text-indigo-600 transition-colors">
                    <h3 class="text-xl font-bold text-slate-800 leading-tight">{{ $task->title }}</h3>
                </a>
                <p class="text-sm text-slate-500 leading-relaxed">{{ Str::limit($task->description, 100) }}</p>
            </div>
            
            <div class="bg-slate-50/50 px-6 py-4 border-t border-slate-100 mt-auto flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Status</span>
                <form action="{{ route('employee.tasks.status', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="relative inline-block">
                        <select name="status" onchange="this.form.submit()" class="appearance-none pl-4 pr-8 py-1.5 rounded-lg text-sm font-semibold border focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500 cursor-pointer transition-colors shadow-sm
                            {{ $task->status === 'completed' ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : ($task->status === 'in_progress' ? 'bg-blue-50 text-blue-700 border-blue-200 hover:bg-blue-100' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100') }}">
                            <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <i class="ri-arrow-down-s-line absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none 
                            {{ $task->status === 'completed' ? 'text-emerald-500' : ($task->status === 'in_progress' ? 'text-blue-500' : 'text-slate-400') }}"></i>
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
@endsection
