@extends('layouts.dashboard')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">My Attendance</h1>
        <p class="text-slate-500 mt-1">Review your presence and working duration log.</p>
    </div>
    
    <!-- Month Picker -->
    <form action="{{ route('employee.attendance') }}" method="GET" class="flex items-center gap-2">
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
                <tr class="bg-[#112F6B] text-white text-xs uppercase font-bold tracking-wider">
                    <th class="px-6 py-3 w-40">Date</th>
                    <th class="px-6 py-3 w-40 text-center">Status</th>
                    <th class="px-6 py-3">Check In</th>
                    <th class="px-6 py-3">Check Out</th>
                    <th class="px-6 py-3 text-center">Break Duration</th>
                    <th class="px-6 py-3 text-right">Work Duration</th>
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
@endsection
