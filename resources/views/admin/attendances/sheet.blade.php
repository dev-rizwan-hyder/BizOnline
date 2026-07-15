@extends('layouts.dashboard')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Employee Attendance</h1>
        <p class="text-slate-500 mt-1">Track and manage daily presence.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.attendances.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition-colors shadow-sm shadow-indigo-200">
            <i class="ri-add-line mr-2"></i> Add Attendance
        </a>
        <button class="px-5 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-sm font-medium transition-colors shadow-sm">
            <i class="ri-download-2-line mr-2"></i> Download Report
        </button>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" 
     x-data="{ 
        modalOpen: false, 
        isAdding: false,
        today: '{{ \Carbon\Carbon::today()->format('Y-m-d') }}',
        activeData: {
            id: null,
            employeeName: '',
            date: '',
            checkIn: null,
            breakDuration: null,
            checkOut: null
        },
        openModal(employeeName, date, checkIn, breakDuration, checkOut, id) {
            this.activeData = {
                id: id,
                employeeName: employeeName,
                date: date,
                checkIn: checkIn,
                breakDuration: breakDuration,
                checkOut: checkOut
            };
            this.isAdding = !checkIn && !checkOut;
            this.modalOpen = true;
        }
     }">
    <!-- Filter Toolbar -->
    <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center">
            <label class="flex items-center cursor-pointer">
                <div class="relative flex items-center justify-center w-5 h-5 mr-3 bg-white border-2 border-slate-300 rounded-md">
                    <input type="checkbox" class="peer absolute opacity-0 w-full h-full cursor-pointer">
                    <i class="ri-check-line text-white text-sm opacity-0 peer-checked:opacity-100 pointer-events-none z-10 transition-opacity"></i>
                    <div class="absolute inset-0 bg-indigo-600 rounded-[4px] opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></div>
                </div>
                <span class="text-sm font-semibold text-slate-700">Select All Today</span>
            </label>
        </div>
        
        <form action="{{ route('admin.attendances.index') }}" method="GET" class="flex items-center gap-2">
            <div class="relative">
                <input type="month" name="month" value="{{ $month }}" class="pl-4 pr-10 py-2 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-700 bg-white shadow-sm cursor-pointer">
                <i class="ri-calendar-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
            </div>
            <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-sm font-semibold transition-colors">
                Filter
            </button>
            <a href="{{ route('admin.attendances.index') }}" class="px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 rounded-xl text-sm font-semibold transition-colors shadow-sm">
                Reset
            </a>
        </form>
    </div>

    <!-- Grid Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-max">
            <thead>
                <tr class="bg-[#112F6B] text-white">
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider border-r border-[#1e4492] w-16 text-center">ID</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider border-r border-[#1e4492] min-w-[200px]">Employee Name</th>
                    @for($i = 1; $i <= $daysInMonth; $i++)
                        <th class="px-2 py-3 text-[10px] font-bold text-center border-r border-[#1e4492]/50 w-8">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($employees as $employee)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-4 py-3 text-sm font-medium text-slate-500 border-r border-slate-100 text-center">
                            {{ str_pad($employee->id, 3, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-4 py-3 border-r border-slate-100">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=e0e7ff&color=4f46e5&size=24" class="w-6 h-6 rounded-full mr-2">
                                <span class="font-semibold text-slate-700 text-sm">{{ $employee->name }}</span>
                            </div>
                        </td>
                        
                        @for($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $record = $matrix[$employee->id][$day];
                                $dateStr = $startDate->copy()->addDays($day - 1)->format('Y-m-d');
                                
                                // Format times for JS
                                $cIn = $record && $record->check_in ? $record->check_in->format('h:i A') : '';
                                $bDuration = $record ? $record->formatDuration($record->break_duration) : '0h 0m';
                                $cOut = $record && $record->check_out ? $record->check_out->format('h:i A') : '';
                                $recId = $record ? $record->id : '';
                            @endphp
                            <td class="border-r border-slate-100 text-center relative p-0 h-10 w-8 cursor-pointer hover:bg-slate-100 transition-colors"
                                @click="openModal('{{ addslashes($employee->name) }}', '{{ $dateStr }}', '{{ $cIn }}', '{{ $bDuration }}', '{{ $cOut }}', '{{ $recId }}')"
                                title="{{ $record ? $record->status : 'No record' }}">
                                
                                @if($record)
                                    @if(in_array($record->status, ['checked_in', 'checked_out', 'on_break']))
                                        <div class="w-5 h-5 mx-auto bg-emerald-100 text-emerald-700 flex items-center justify-center rounded text-[10px] font-bold">
                                            P
                                        </div>
                                    @else
                                        <div class="w-5 h-5 mx-auto bg-slate-100 text-slate-500 flex items-center justify-center rounded text-[10px] font-bold">
                                            -
                                        </div>
                                    @endif
                                @else
                                    <div class="w-full h-full flex items-center justify-center group-hover:bg-slate-50">
                                        <span class="text-slate-200 text-[10px] font-medium">-</span>
                                    </div>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endforeach
                
                @if($employees->isEmpty())
                    <tr>
                        <td colspan="{{ $daysInMonth + 2 }}" class="px-6 py-12 text-center text-slate-500">
                            No employees found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Timeline/Add Modal -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm" x-cloak>
        <div @click.away="modalOpen = false" x-transition x-show="modalOpen" class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 overflow-hidden relative">
            
            <!-- Header -->
            <div class="text-center pt-8 pb-4">
                <h2 class="text-xl font-bold text-slate-900" x-text="activeData.employeeName"></h2>
                <p class="text-xs font-semibold text-slate-400 mt-1" x-text="activeData.date"></p>
            </div>

            <!-- Content Area -->
            <div class="p-6">
                <!-- TIMELINE VIEW (If record exists) -->
                <div x-show="!isAdding" class="bg-[#F8F9FB] rounded-2xl border border-slate-100 p-5">
                    <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Today's Timeline</h3>
                    
                    <div class="space-y-3">
                        <!-- Check In Card -->
                        <div x-show="activeData.checkIn" class="flex items-center p-4 rounded-xl bg-[#F0FDF4] border-l-4 border-[#22C55E]">
                            <div class="w-6 h-6 rounded-full bg-[#DCFCE7] text-[#22C55E] flex items-center justify-center mr-4">
                                <i class="ri-check-line text-sm font-bold"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Check In</div>
                                <div class="text-sm font-bold text-slate-900" x-text="activeData.checkIn"></div>
                            </div>
                        </div>

                        <!-- Break Duration Card -->
                        <div x-show="activeData.breakDuration && activeData.breakDuration !== '0h 0m'" class="flex items-center p-4 rounded-xl bg-[#FFFBEB] border-l-4 border-[#F59E0B]">
                            <div class="w-6 h-6 rounded-full bg-[#FEF3C7] text-[#F59E0B] flex items-center justify-center mr-4">
                                <i class="ri-cup-line text-sm font-bold"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Total Break Duration</div>
                                <div class="text-sm font-bold text-slate-900" x-text="activeData.breakDuration"></div>
                            </div>
                        </div>

                        <!-- Check Out Card -->
                        <div x-show="activeData.checkOut" class="flex items-center p-4 rounded-xl bg-[#EFF6FF] border-l-4 border-[#3B82F6]">
                            <div class="w-6 h-6 rounded-full bg-[#DBEAFE] text-[#3B82F6] flex items-center justify-center mr-4">
                                <i class="ri-close-line text-sm font-bold"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Check Out</div>
                                <div class="text-sm font-bold text-slate-900" x-text="activeData.checkOut"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-5 text-center">
                        <a :href="'/admin/attendances/' + activeData.id + '/edit'" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 uppercase tracking-wider">
                            Edit Timeline
                        </a>
                    </div>
                </div>

                <!-- ADD VIEW (If no record exists) -->
                <div x-show="isAdding" class="bg-[#F8F9FB] rounded-2xl border border-slate-100 p-5 text-center py-10">
                    <div class="w-16 h-16 mx-auto bg-slate-200 rounded-full flex items-center justify-center mb-4 text-slate-400">
                        <i class="ri-calendar-event-line text-2xl"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-700 mb-2">No attendance found.</h3>
                    <p class="text-xs text-slate-500 mb-6">There is no record for this date.</p>
                    
                    <template x-if="activeData.date === today">
                        <a :href="'/admin/attendances/create?user_id=' + activeData.id + '&date=' + activeData.date" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-colors inline-block">
                            Add Attendance Manually
                        </a>
                    </template>
                    
                    <template x-if="activeData.date !== today">
                        <div class="px-4 py-3 bg-red-50 text-red-600 rounded-lg border border-red-100 text-xs font-semibold inline-block">
                            <i class="ri-error-warning-line mr-1"></i> Attendance can only be added for the current date.
                        </div>
                    </template>
                </div>
            </div>

            <!-- Footer -->
            <div class="p-4 text-center border-t border-slate-50">
                <button @click="modalOpen = false" class="text-xs font-bold text-[#64748B] hover:text-slate-900 uppercase tracking-widest transition-colors py-2 px-6">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
