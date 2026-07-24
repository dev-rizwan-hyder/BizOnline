@extends('layouts.dashboard')

@section('content')
<div x-data="{ checkOutModalOpen: false, taskSearch: '' }">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Attendance</h1>
            <p class="text-slate-500 mt-1">Review your presence log, punch in/out, and track break durations.</p>
        </div>
        
        <!-- Month Picker -->
        <form action="{{ route('employee.attendance') }}" method="GET" class="flex items-center gap-2" hx-boost="false">
            <div class="relative">
                <input type="month" name="month" value="{{ $month }}" class="pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-700 bg-white shadow-sm cursor-pointer">
                <i class="ri-calendar-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
            </div>
            <button type="submit" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-sm font-semibold transition-all duration-200 shadow-sm">
                Filter
            </button>
            <a href="{{ route('employee.attendance') }}" class="px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 rounded-xl text-sm font-semibold transition-all duration-200 shadow-sm">
                Reset
            </a>
        </form>
    </div>

    <!-- Interactive Today's Attendance Control Widget Card -->
    <div class="bg-gradient-to-br from-indigo-900 via-indigo-800 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl mb-8 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 text-indigo-200 rounded-full text-xs font-bold uppercase tracking-wider mb-3 backdrop-blur-md border border-white/10">
                    <i class="ri-time-line text-indigo-400"></i> Attendance Portal
                </div>
                <h2 class="text-2xl font-extrabold text-white">Today: {{ \Carbon\Carbon::today()->format('l, F j, Y') }}</h2>
                <p class="text-indigo-200 text-sm mt-1">Mark your daily check-in, take scheduled breaks, and complete check-outs.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                @if(!$todayAttendance || $todayAttendance->status === 'pending')
                    <form action="{{ route('employee.attendance.check-in') }}" method="POST" hx-boost="false">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 text-sm font-extrabold text-indigo-900 bg-white hover:bg-indigo-50 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                            <i class="ri-login-box-line mr-2 text-lg text-indigo-600"></i> Check In Now
                        </button>
                    </form>
                @elseif($todayAttendance->status === 'checked_in')
                    <form action="{{ route('employee.attendance.break-start') }}" method="POST" hx-boost="false">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-3 text-sm font-extrabold text-amber-900 bg-amber-400 hover:bg-amber-300 rounded-xl shadow-md transition-all">
                            <i class="ri-cup-line mr-2 text-lg"></i> Take Break
                        </button>
                    </form>
                    <button type="button" @click="checkOutModalOpen = true" class="inline-flex items-center justify-center px-5 py-3 text-sm font-extrabold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-md transition-all">
                        <i class="ri-logout-box-line mr-2 text-lg"></i> Check Out
                    </button>
                @elseif($todayAttendance->status === 'on_break')
                    <form action="{{ route('employee.attendance.break-end') }}" method="POST" hx-boost="false">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 text-sm font-extrabold text-slate-900 bg-emerald-400 hover:bg-emerald-300 rounded-xl shadow-lg transition-all">
                            <i class="ri-play-circle-line mr-2 text-lg"></i> End Break & Resume
                        </button>
                    </form>
                    <button type="button" @click="checkOutModalOpen = true" class="inline-flex items-center justify-center px-5 py-3 text-sm font-extrabold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-md transition-all">
                        <i class="ri-logout-box-line mr-2 text-lg"></i> Check Out
                    </button>
                @elseif($todayAttendance->status === 'checked_out')
                    <span class="inline-flex items-center px-5 py-2.5 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 font-extrabold text-sm backdrop-blur-md">
                        <i class="ri-check-double-line mr-2 text-lg text-emerald-400"></i> Attendance Logged for Today
                    </span>
                @endif
            </div>
        </div>

        @if($todayAttendance)
            <div class="mt-6 pt-6 border-t border-white/10 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-semibold relative z-10">
                <div class="bg-white/5 p-3 rounded-xl border border-white/10">
                    <span class="text-indigo-300 uppercase tracking-wider block mb-1">Check In Time</span>
                    <span class="text-sm font-bold text-white">{{ $todayAttendance->check_in ? $todayAttendance->check_in->format('h:i A') : '--:--' }}</span>
                </div>

                <!-- Real-time Live Working Timer with Seconds -->
                <div class="bg-white/5 p-3 rounded-xl border border-white/10"
                    x-data="{ 
                        workSeconds: {{ $todayAttendance->working_duration }},
                        isCheckedIn: {{ $todayAttendance->status === 'checked_in' ? 'true' : 'false' }},
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
                    <span class="text-indigo-300 uppercase tracking-wider block mb-1">Live Working Duration</span>
                    <span class="text-sm font-bold text-emerald-400 flex items-center gap-1.5">
                        <i class="ri-timer-flash-line text-emerald-400" :class="{ 'animate-spin': isCheckedIn }"></i>
                        <span x-text="formatWorkTime(workSeconds)"></span>
                    </span>
                </div>

                <div class="bg-white/5 p-3 rounded-xl border border-white/10">
                    <span class="text-indigo-300 uppercase tracking-wider block mb-1">Break Time</span>
                    <span class="text-sm font-bold text-amber-300">{{ $todayAttendance->formatDuration($todayAttendance->break_duration) }}</span>
                </div>
                <div class="bg-white/5 p-3 rounded-xl border border-white/10">
                    <span class="text-indigo-300 uppercase tracking-wider block mb-1">Check Out Time</span>
                    <span class="text-sm font-bold text-white">{{ $todayAttendance->check_out ? $todayAttendance->check_out->format('h:i A') : '--:--' }}</span>
                </div>
            </div>
        @endif
    </div>

    <!-- Stats Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Present Days Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mr-4">
                <i class="ri-checkbox-circle-line text-2xl"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Present Days</span>
                <span class="text-2xl font-bold text-slate-800">{{ $stats['present_days'] }} <span class="text-xs text-slate-400 font-medium">/ {{ $daysInMonth }} days</span></span>
            </div>
        </div>

        <!-- Total Working Hours Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mr-4">
                <i class="ri-time-line text-2xl"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Total Working Hours</span>
                <span class="text-2xl font-bold text-slate-800">{{ $stats['working_time'] }}</span>
            </div>
        </div>

        <!-- Total Break Hours Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mr-4">
                <i class="ri-cup-line text-2xl"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Total Break Duration</span>
                <span class="text-2xl font-bold text-slate-800">{{ $stats['break_time'] }}</span>
            </div>
        </div>
    </div>

    <!-- Attendance Details List -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Monthly Log</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-max">
                <thead>
                    <tr class="bg-slate-900 text-white text-xs uppercase font-bold tracking-wider">
                        <th class="px-6 py-4 w-40">Date</th>
                        <th class="px-6 py-4 w-40 text-center">Status</th>
                        <th class="px-6 py-4">Check In</th>
                        <th class="px-6 py-4">Check Out</th>
                        <th class="px-6 py-4 text-center">Break Duration</th>
                        <th class="px-6 py-4 text-right">Work Duration</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = $startDate->copy()->addDays($day - 1);
                            $isWeekend = $date->isWeekend();
                            $isToday = $date->isToday();
                            $isFuture = $date->isFuture() && !$isToday;
                            $record = $attendances->get($day);
                        @endphp
                        
                        <tr class="hover:bg-slate-50/50 transition-colors {{ $isToday ? 'bg-indigo-50/20' : '' }}">
                            <!-- Date Column -->
                            <td class="px-6 py-4 font-semibold text-slate-700">
                                <span class="block">{{ $date->format('M d, Y') }}</span>
                                <span class="text-xs font-medium text-slate-400">{{ $date->format('l') }}</span>
                            </td>
                            
                            <!-- Status Badge -->
                            <td class="px-6 py-4 text-center">
                                @if($record)
                                    @if($record->status === 'checked_out')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wide">
                                            Checked Out
                                        </span>
                                    @elseif($record->status === 'checked_in')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-wide animate-pulse">
                                            Working
                                        </span>
                                    @elseif($record->status === 'on_break')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100 uppercase tracking-wide">
                                            On Break
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-50 text-slate-600 border border-slate-200 uppercase tracking-wide">
                                            {{ str_replace('_', ' ', $record->status) }}
                                        </span>
                                    @endif
                                @else
                                    @if($isFuture)
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-50 text-slate-400 border border-slate-100 uppercase tracking-wide">
                                            -
                                        </span>
                                    @elseif($isWeekend)
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 uppercase tracking-wide">
                                            Weekend
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-100 uppercase tracking-wide">
                                            Absent
                                        </span>
                                    @endif
                                @endif
                            </td>
                            
                            <!-- Check In Time -->
                            <td class="px-6 py-4 text-slate-600 font-medium">
                                @if($record && $record->check_in)
                                    <i class="ri-login-box-line mr-1 text-slate-400"></i>
                                    {{ $record->check_in->format('h:i A') }}
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            
                            <!-- Check Out Time -->
                            <td class="px-6 py-4 text-slate-600 font-medium">
                                @if($record && $record->check_out)
                                    <i class="ri-logout-box-line mr-1 text-slate-400"></i>
                                    {{ $record->check_out->format('h:i A') }}
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            
                            <!-- Break Duration -->
                            <td class="px-6 py-4 text-center text-slate-600 font-medium">
                                @if($record && $record->break_duration > 0)
                                    {{ $record->formatDuration($record->break_duration) }}
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            
                            <!-- Working Duration -->
                            <td class="px-6 py-4 text-right font-bold text-slate-800">
                                @if($record && $record->working_duration > 0)
                                    {{ $record->formatDuration($record->working_duration) }}
                                @else
                                    <span class="text-slate-300 font-normal">-</span>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
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
