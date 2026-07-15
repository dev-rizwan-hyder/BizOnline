@extends('layouts.dashboard')

@section('content')
<div class="mb-8">
    <div class="flex items-center text-sm text-slate-500 mb-2 font-medium">
        <a href="{{ route('admin.tasks.index') }}" class="hover:text-indigo-600 transition-colors">Tasks</a>
        <i class="ri-arrow-right-s-line mx-2"></i>
        <span class="text-slate-900">Task Details</span>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $task->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.tasks.edit', $task) }}" class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-xl font-medium transition-colors">
                <i class="ri-pencil-line mr-2"></i> Edit Task
            </a>
        </div>
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
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Assigned To</h3>
                @if($task->assignee)
                    <div class="flex items-center text-slate-900 font-medium">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($task->assignee->name) }}&background=e0e7ff&color=4f46e5&size=32" class="rounded-full mr-3">
                        {{ $task->assignee->name }}
                    </div>
                @else
                    <span class="text-slate-500 italic">Unassigned</span>
                @endif
            </div>

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
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Status</h3>
                <span class="px-3 py-1 rounded-md text-sm font-semibold inline-block
                    {{ $task->status === 'completed' ? 'text-emerald-700 bg-emerald-100' : ($task->status === 'in_progress' ? 'text-blue-700 bg-blue-100' : 'text-slate-700 bg-slate-200') }}">
                    {{ str_replace('_', ' ', ucfirst($task->status)) }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
