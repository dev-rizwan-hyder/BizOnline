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

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 max-w-4xl mt-8">
    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
        <i class="ri-chat-3-line mr-2 text-indigo-600"></i> Task Discussion
        <span class="ml-2 px-2 py-0.5 bg-slate-100 text-slate-600 text-xs font-semibold rounded-full">{{ $task->comments->count() }}</span>
    </h3>

    <!-- Comments List -->
    <div class="space-y-6 mb-8 max-h-[400px] overflow-y-auto pr-2">
        @forelse($task->comments as $comment)
            <div class="flex gap-4 items-start pb-4 border-b border-slate-50 last:border-0 last:pb-0">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background={{ $comment->user->role === 'admin' ? 'f59e0b&color=fff' : '4f46e5&color=fff' }}&size=36" class="w-9 h-9 rounded-full shadow-sm" alt="Avatar">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <span class="font-semibold text-slate-800 text-sm">{{ $comment->user->name }}</span>
                        <span class="px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider
                            {{ $comment->user->role === 'admin' ? 'bg-amber-100 text-amber-800' : 'bg-indigo-50 text-indigo-700' }}">
                            {{ $comment->user->role }}
                        </span>
                        <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-slate-600 text-sm whitespace-pre-wrap leading-relaxed">{{ $comment->content }}</p>
                </div>
            </div>
        @empty
            <div class="text-center py-8 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                <i class="ri-chat-voice-line text-3xl text-slate-300 mb-2 block"></i>
                <p class="text-slate-500 text-sm">No comments yet. Start the conversation!</p>
            </div>
        @endforelse
    </div>

    <!-- Post Comment Form -->
    <form action="{{ route('admin.tasks.comments.store', $task) }}" method="POST" class="mt-6 border-t border-slate-100 pt-6">
        @csrf
        <div class="flex gap-4 items-start">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=f59e0b&color=fff&size=36" class="w-9 h-9 rounded-full" alt="Avatar">
            <div class="flex-1">
                <textarea name="content" rows="3" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-slate-700 shadow-sm placeholder-slate-400 resize-none transition-all" placeholder="Write a comment or update for the employee..."></textarea>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-xs text-slate-400">Remember to be clear and concise.</span>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-colors shadow-sm shadow-indigo-100">
                        <i class="ri-send-plane-2-line mr-1.5"></i> Post Comment
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
