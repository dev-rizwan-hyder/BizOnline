@extends('layouts.dashboard')

@section('content')
<div class="mb-8">
    <div class="flex items-center text-sm text-slate-500 mb-2 font-medium">
        <a href="{{ route('employee.dashboard') }}" class="hover:text-indigo-600 transition-colors">My Tasks</a>
        <i class="ri-arrow-right-s-line mx-2"></i>
        <span class="text-slate-900">Task Details</span>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $task->title }}</h1>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 max-w-4xl">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Description</h3>
                <p class="text-slate-700 whitespace-pre-wrap">{{ $task->description ?: 'No description provided.' }}</p>
            </div>
        </div>
        
        <div class="space-y-6 bg-slate-50 p-6 rounded-xl border border-slate-100">
            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Due Date</h3>
                <div class="flex items-center text-slate-700 font-medium">
                    <i class="ri-calendar-event-line mr-2 text-slate-400"></i>
                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Priority</h3>
                <span class="px-3 py-1 rounded-md text-xs uppercase font-bold tracking-wider inline-block
                    {{ $task->priority === 'high' ? 'bg-red-50 text-red-700 border border-red-200' : ($task->priority === 'medium' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200') }}">
                    {{ $task->priority }}
                </span>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Update Status</h3>
                <form action="{{ route('employee.tasks.status', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="relative inline-block w-full">
                        <select name="status" onchange="this.form.submit()" class="w-full appearance-none pl-4 pr-10 py-2 rounded-lg text-sm font-semibold border focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500 cursor-pointer transition-colors shadow-sm
                            {{ $task->status === 'completed' ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : ($task->status === 'in_progress' ? 'bg-blue-50 text-blue-700 border-blue-200 hover:bg-blue-100' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100') }}">
                            <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none 
                            {{ $task->status === 'completed' ? 'text-emerald-500' : ($task->status === 'in_progress' ? 'text-blue-500' : 'text-slate-400') }}"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
