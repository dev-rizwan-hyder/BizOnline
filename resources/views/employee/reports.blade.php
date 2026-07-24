@extends('layouts.dashboard')

@section('content')
<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <i class="ri-file-chart-line text-indigo-600"></i>
                <span>My Performance Report</span>
            </h1>
            <p class="text-slate-500 mt-1">Review your task completion rate, attendance summary, and assigned work breakdown.</p>
        </div>

        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('employee.reports.index') }}" class="flex items-center gap-2">
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()" class="bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
            </form>
            <button onclick="window.print()" class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-colors flex items-center gap-1.5 shadow-sm">
                <i class="ri-printer-line"></i> Print Summary
            </button>
        </div>
    </div>

    <!-- Personal Profile Summary Card -->
    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl mb-8 relative overflow-hidden">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 relative z-10">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-indigo-600 border-2 border-indigo-400 text-white flex items-center justify-center font-black text-2xl shadow-lg shrink-0">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight flex items-center gap-3">
                        <span>{{ $user->name }}</span>
                        <span class="text-xs bg-indigo-500/30 text-indigo-200 border border-indigo-400/30 px-3 py-1 rounded-full font-semibold">User Profile</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1"><i class="ri-mail-line text-indigo-400 mr-1"></i> {{ $user->email }}</p>
                </div>
            </div>

            <!-- Stats Badge Bar -->
            <div class="flex flex-wrap items-center gap-3 sm:gap-6">
                <div class="text-center bg-white/10 backdrop-blur-md px-5 py-3 rounded-2xl border border-white/10">
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Completion Rate</div>
                    <div class="text-2xl font-black text-emerald-400 mt-0.5">{{ $completionRate }}%</div>
                </div>

                <div class="text-center bg-white/10 backdrop-blur-md px-5 py-3 rounded-2xl border border-white/10">
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Days Present</div>
                    <div class="text-2xl font-black text-indigo-300 mt-0.5">{{ $attendancesCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Metrics Cards Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Total Assigned</p>
            <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $totalAssigned }}</h3>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Completed</p>
            <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $completedCount }}</h3>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Pending</p>
            <h3 class="text-2xl font-black text-amber-600 mt-1">{{ $pendingCount }}</h3>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Delayed</p>
            <h3 class="text-2xl font-black text-rose-600 mt-1">{{ $delayedCount }}</h3>
        </div>
    </div>

    <!-- Timeframe Filter Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="border-b border-slate-100 bg-slate-50/50 p-4 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-1 bg-slate-200/70 p-1.5 rounded-xl text-sm font-semibold">
                <a href="{{ route('employee.reports.index', ['type' => 'daily', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'daily' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-sun-line text-lg"></i> Daily
                </a>
                <a href="{{ route('employee.reports.index', ['type' => 'weekly', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'weekly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-calendar-event-line text-lg"></i> Weekly
                </a>
                <a href="{{ route('employee.reports.index', ['type' => 'monthly', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'monthly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-calendar-month-line text-lg"></i> Monthly
                </a>
            </div>

            <div class="text-xs font-bold text-indigo-700 bg-indigo-50 border border-indigo-100 px-3 py-1.5 rounded-xl">
                Timeframe: {{ $dateRangeStr }}
            </div>
        </div>

        <!-- Task List Table -->
        <div class="p-6">
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-4">Task Performance Log</h3>
            <div class="overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 text-xs uppercase font-bold border-b border-slate-200">
                            <th class="px-4 py-3">Task Title</th>
                            <th class="px-4 py-3">Deadline</th>
                            <th class="px-4 py-3 text-center">Priority</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3">Delay Reason</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($tasks as $t)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-semibold text-slate-900">
                                    <div>{{ $t->title }}</div>
                                    @if($t->description)
                                        <div class="text-xs font-normal text-slate-500 truncate max-w-xs">{{ $t->description }}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs text-slate-600 whitespace-nowrap">
                                    {{ $t->deadline ? $t->deadline->format('M d, h:i A') : ($t->due_date ? $t->due_date->format('M d, Y') : '-') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full uppercase
                                        {{ $t->priority === 'high' ? 'bg-rose-100 text-rose-700' : '' }}
                                        {{ $t->priority === 'medium' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $t->priority === 'low' ? 'bg-slate-200 text-slate-700' : '' }}">
                                        {{ ucfirst($t->priority) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    <span class="text-xs font-bold px-2.5 py-1 rounded-full capitalize
                                        {{ $t->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ in_array($t->status, ['pending', 'in_progress']) ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $t->status === 'delayed' ? 'bg-rose-100 text-rose-800' : '' }}">
                                        {{ str_replace('_', ' ', $t->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-xs text-slate-600">
                                    @if($t->delay_reason)
                                        <span class="text-rose-600 font-medium flex items-center gap-1">
                                            <i class="ri-alert-line"></i> {{ $t->delay_reason }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 italic">None</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-xs text-slate-400">
                                    No tasks recorded for this timeframe.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
