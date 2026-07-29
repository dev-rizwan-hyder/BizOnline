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

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 w-full">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Description</h3>
                <p class="text-slate-700 whitespace-pre-wrap">{{ $task->description ?: 'No description provided.' }}</p>
            </div>
            
            @if($task->project)
                <div class="bg-indigo-50/70 border border-indigo-100 rounded-2xl p-4">
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider block mb-1">Associated Project</span>
                    <h4 class="text-base font-bold text-slate-900 flex items-center gap-1.5">
                        <i class="ri-folder-3-line text-indigo-500"></i> {{ $task->project->name }}
                    </h4>
                </div>
            @endif
        </div>
        
        <div class="space-y-6 bg-slate-50 p-6 rounded-xl border border-slate-100">
            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Deadline & Time</h3>
                <div class="flex items-center text-slate-900 font-bold text-sm">
                    <i class="ri-time-line mr-2 text-indigo-600"></i>
                    {{ ($task->deadline ?: \Carbon\Carbon::parse($task->due_date))->format('M d, Y h:i A') }}
                </div>
            </div>

            <div x-data="{ 
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
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Time Logged</h3>
                <div class="flex items-center text-indigo-700 font-extrabold text-base bg-indigo-50 p-2.5 rounded-xl border border-indigo-100">
                    <i class="ri-timer-flash-line mr-2 text-indigo-600" :class="{ 'animate-spin': isRunning }"></i>
                    <span x-text="formatTime(seconds)"></span>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Priority</h3>
                <span class="px-3 py-1 rounded-md text-xs uppercase font-bold tracking-wider inline-block
                    {{ $task->priority === 'high' ? 'bg-red-50 text-red-700 border border-red-200' : ($task->priority === 'medium' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200') }}">
                    {{ $task->priority }}
                </span>
            </div>

            <!-- Task Controls -->
            <div>
                <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Task Execution Controls</h3>
                @if($task->status === 'pending')
                    <form action="{{ route('employee.tasks.start', $task) }}" method="POST" hx-boost="false">
                        @csrf
                        <button type="submit" class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1.5">
                            <i class="ri-play-fill text-base"></i> Start Task
                        </button>
                    </form>
                @elseif($task->status === 'in_progress')
                    <div class="flex gap-2">
                        <form action="{{ route('employee.tasks.pause', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-1">
                                <i class="ri-pause-fill text-base"></i> Pause
                            </button>
                        </form>
                        <form action="{{ route('employee.tasks.finish', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1">
                                <i class="ri-checkbox-circle-fill text-base"></i> Finish
                            </button>
                        </form>
                    </div>
                @elseif($task->status === 'paused')
                    <div class="flex gap-2">
                        <form action="{{ route('employee.tasks.resume', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1">
                                <i class="ri-play-fill text-base"></i> Resume Work
                            </button>
                        </form>
                        <form action="{{ route('employee.tasks.finish', $task) }}" method="POST" class="flex-1" hx-boost="false">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-1">
                                <i class="ri-checkbox-circle-fill text-base"></i> Finish
                            </button>
                        </form>
                    </div>
                @elseif($task->status === 'completed')
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-2 rounded-xl border border-emerald-200 flex items-center justify-center gap-1 w-full">
                            <i class="ri-check-line text-base"></i> Task Completed
                        </span>
                        <form action="{{ route('employee.tasks.resume', $task) }}" method="POST" hx-boost="false" onsubmit="return confirm('Re-open and resume working on this task?');">
                            @csrf
                            <button type="submit" class="w-full py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-1">
                                <i class="ri-restart-line text-indigo-600"></i> Resume / Re-open Task
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 w-full mt-8">
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
                    @if($comment->image_path)
                        <div class="mt-3">
                            <img src="/comments/{{ basename($comment->image_path) }}" alt="{{ $comment->image_filename }}" class="max-w-xs rounded-lg shadow-md border border-slate-200 hover:shadow-lg transition-shadow cursor-pointer" data-image="/comments/{{ basename($comment->image_path) }}">
                        </div>
                    @endif
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
    <form action="{{ route('employee.tasks.comments.store', $task) }}" method="POST" enctype="multipart/form-data" class="mt-6 border-t border-slate-100 pt-6">
        @csrf
        <div class="flex gap-4 items-start">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff&size=36" class="w-9 h-9 rounded-full" alt="Avatar">
            <div class="flex-1">
                <textarea name="content" rows="3" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-slate-700 shadow-sm placeholder-slate-400 resize-none transition-all" placeholder="Write a comment, report progress..."></textarea>
                
                <!-- Image Upload Section -->
                <div class="mt-3 pb-3 border-b border-slate-200">
                    <label class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-slate-300 rounded-lg hover:border-indigo-400 hover:bg-indigo-50/30 cursor-pointer transition-colors group">
                        <div class="text-center">
                            <i class="ri-image-add-line text-slate-400 group-hover:text-indigo-600 text-lg mb-1 block"></i>
                            <span class="text-xs font-medium text-slate-600 group-hover:text-indigo-600">Attach Image (Optional)</span>
                            <span class="text-[10px] text-slate-400 block">JPEG, PNG, GIF, WebP • Max 5MB</span>
                        </div>
                        <input type="file" name="image" id="image-input-emp" accept="image/jpeg,image/png,image/gif,image/webp" class="hidden" data-form="emp">
                    </label>
                    <div id="image-preview-emp" class="mt-3 hidden">
                        <div class="relative inline-block">
                            <img id="preview-img-emp" src="" alt="Preview" class="max-w-xs rounded-lg shadow-md border border-slate-200">
                            <button type="button" class="remove-image-btn absolute top-2 right-2 px-2 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded transition-colors" data-form="emp">✕ Remove</button>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-3">
                    <span class="text-xs text-slate-400">Remember to be clear and concise.</span>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-colors shadow-sm shadow-indigo-100">
                        <i class="ri-send-plane-2-line mr-1.5"></i> Post Comment
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Employee form image preview
            const empFileInput = document.getElementById('image-input-emp');
            const empImagePreview = document.getElementById('image-preview-emp');
            const empPreviewImg = document.getElementById('preview-img-emp');
            const empRemoveBtns = document.querySelectorAll('.remove-image-btn[data-form="emp"]');

            if (empFileInput) {
                empFileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            empPreviewImg.src = event.target.result;
                            empImagePreview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        empImagePreview.classList.add('hidden');
                    }
                });

                empRemoveBtns.forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        empFileInput.value = '';
                        empImagePreview.classList.add('hidden');
                    });
                });
            }
        });
    </script>
</div>
@endsection
