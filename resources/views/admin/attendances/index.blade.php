@extends('layouts.dashboard')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-start md:justify-between gap-4" x-data="{ 
    addModalOpen: false,
    selectedEmployee: '',
    markedToday: {{ json_encode($markedToday) }},
    get isAlreadyMarked() {
        return this.markedToday.includes(parseInt(this.selectedEmployee));
    }
}">
    <div>
        <h1 class="text-3xl font-bold text-[#1e293b] tracking-tight">Attendance Detail Logs</h1>
        <p class="text-[#64748b] mt-1 text-sm font-medium">Review and manage detailed employee time logs.</p>
    </div>
    <div class="flex items-center gap-3">
        <button @click="addModalOpen = true; selectedEmployee = ''" class="px-5 py-2.5 bg-[#2563eb] hover:bg-[#1d4ed8] text-white rounded-xl text-sm font-bold transition-colors shadow-sm">
            <i class="ri-add-line mr-1"></i> Add Attendance
        </button>
        <a href="{{ route('admin.attendances.sheet') }}" class="px-5 py-2.5 bg-white border border-[#e2e8f0] hover:bg-[#f8fafc] text-[#334155] rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center">
            <i class="ri-table-line mr-2 text-[#64748b]"></i> Back to Sheet
        </a>
    </div>

    <!-- Professional Add Attendance Modal -->
    <div x-show="addModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" x-cloak>
        <div @click.away="addModalOpen = false" x-transition x-show="addModalOpen" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h2 class="text-lg font-bold text-slate-800">Log New Attendance</h2>
                <button @click="addModalOpen = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.attendances.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Employee</label>
                        <select name="user_id" x-model="selectedEmployee" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm font-medium text-slate-700 cursor-pointer appearance-none">
                            <option value="">Select Employee...</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                        <div x-show="isAlreadyMarked" x-collapse class="mt-3">
                            <div class="px-3 py-2 bg-amber-50 border border-amber-200 rounded-lg flex items-start gap-2">
                                <i class="ri-error-warning-fill text-amber-500 mt-0.5"></i>
                                <span class="text-xs font-semibold text-amber-700 leading-snug">
                                    This employee is already marked present for today. Saving will update their existing times.
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Date (Today Only)</label>
                        <input type="date" name="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" readonly class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100 text-slate-500 outline-none cursor-not-allowed text-sm font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Check In</label>
                            <input type="time" name="check_in" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Check Out</label>
                            <input type="time" name="check_out" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition-all text-sm font-medium text-slate-700">
                        </div>
                    </div>
                    
                    <input type="hidden" name="status" value="checked_in">
                </div>
                
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" @click="addModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-[#2563eb] hover:bg-[#1d4ed8] text-white rounded-xl text-sm font-bold shadow-sm transition-colors">
                        Save Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#f1f5f9]">
        <h3 class="text-xs font-bold text-[#94a3b8] uppercase tracking-wider mb-2">Total Records</h3>
        <div class="text-3xl font-black text-[#0f172a]">{{ $totalRecords }}</div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#f1f5f9]">
        <h3 class="text-xs font-bold text-[#22c55e] uppercase tracking-wider mb-2">Present Today</h3>
        <div class="text-3xl font-black text-[#0f172a]">{{ $presentTodayCount }}</div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-[#f1f5f9]">
        <h3 class="text-xs font-bold text-[#ef4444] uppercase tracking-wider mb-2">Absents Recorded</h3>
        <div class="text-3xl font-black text-[#0f172a]">{{ $absentsCount }}</div>
    </div>
</div>

<!-- Filter Bar -->
<div class="bg-white rounded-2xl p-4 shadow-sm border border-[#f1f5f9] mb-6 flex flex-col md:flex-row items-center gap-4">
    <form action="{{ route('admin.attendances.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 w-full">
        <!-- Employee Filter -->
        <div class="relative w-full md:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ri-user-line text-[#94a3b8]"></i>
            </div>
            <select name="user_id" class="w-full pl-9 pr-8 py-2.5 bg-[#f8fafc] border border-[#e2e8f0] rounded-xl text-sm font-bold text-[#334155] focus:ring-2 focus:ring-[#2563eb] outline-none appearance-none cursor-pointer transition-colors hover:bg-[#f1f5f9]">
                <option value="">All Employees</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $userId == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
            <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-[#94a3b8] pointer-events-none"></i>
        </div>
        
        <!-- Date Filter -->
        <div class="relative w-full md:w-64">
            <input type="date" name="date" value="{{ $date }}" class="w-full px-4 py-2.5 bg-[#f8fafc] border border-[#e2e8f0] rounded-xl text-sm font-bold text-[#334155] focus:ring-2 focus:ring-[#2563eb] outline-none transition-colors hover:bg-[#f1f5f9]">
        </div>
        
        <!-- Actions -->
        <div class="flex items-center gap-2 ml-auto w-full md:w-auto">
            <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-[#1e293b] hover:bg-black text-white rounded-xl text-sm font-bold transition-colors">
                Apply Filters
            </button>
            <a href="{{ route('admin.attendances.index') }}" class="w-10 h-10 flex items-center justify-center bg-[#f8fafc] border border-[#e2e8f0] hover:bg-[#f1f5f9] text-[#64748b] rounded-xl transition-colors">
                <i class="ri-refresh-line"></i>
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm border border-[#f1f5f9] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#f1f5f9]">
                    <th class="px-6 py-4 text-[11px] font-extrabold text-[#94a3b8] uppercase tracking-wider">Employee Details</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-[#94a3b8] uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-[#94a3b8] uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-[#94a3b8] uppercase tracking-wider text-center">Shift Timing</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-[#94a3b8] uppercase tracking-wider text-center">Working Duration</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-[#94a3b8] uppercase tracking-wider text-center">Break Duration</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-[#94a3b8] uppercase tracking-wider text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#f1f5f9]">
                @forelse($attendances as $record)
                    <tr class="hover:bg-[#f8fafc]/50 transition-colors group">
                        <!-- Employee -->
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-[#dbeafe] text-[#2563eb] flex items-center justify-center text-xs font-bold mr-3 border border-[#bfdbfe]">
                                    {{ strtoupper(substr($record->user->name, 0, 1)) }}
                                </div>
                                <span class="font-bold text-[#0f172a] text-sm">{{ $record->user->name }}</span>
                            </div>
                        </td>
                        
                        <!-- Date -->
                        <td class="px-6 py-4 text-sm font-semibold text-[#475569]">
                            {{ $record->date->format('d M, Y') }}
                        </td>
                        
                        <!-- Status -->
                        <td class="px-6 py-4">
                            @if(in_array($record->status, ['checked_in', 'on_break', 'checked_out']))
                                <div class="inline-flex items-center px-2.5 py-1 rounded-md bg-[#dcfce7] text-[#16a34a] text-[10px] font-extrabold uppercase tracking-widest">
                                    Present
                                </div>
                            @else
                                <div class="inline-flex items-center px-2.5 py-1 rounded-md bg-[#f1f5f9] text-[#64748b] text-[10px] font-extrabold uppercase tracking-widest">
                                    {{ $record->status }}
                                </div>
                            @endif
                        </td>
                        
                        <!-- Shift Timing -->
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3">
                                <div>
                                    <div class="text-[9px] font-extrabold text-[#22c55e] uppercase tracking-widest mb-0.5 text-center">In</div>
                                    <div class="px-2 py-1 bg-[#f0fdf4] text-[#15803d] rounded-md text-xs font-bold">
                                        {{ $record->check_in ? $record->check_in->format('h:i A') : '--:--' }}
                                    </div>
                                </div>
                                <i class="ri-arrow-right-line text-[#cbd5e1] text-xs mt-3"></i>
                                <div>
                                    <div class="text-[9px] font-extrabold text-[#3b82f6] uppercase tracking-widest mb-0.5 text-center">Out</div>
                                    <div class="px-2 py-1 bg-[#eff6ff] text-[#1d4ed8] rounded-md text-xs font-bold">
                                        {{ $record->check_out ? $record->check_out->format('h:i A') : '--:--' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Working Duration -->
                        <td class="px-6 py-4 text-center">
                            @php $wDuration = $record->working_duration; @endphp
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full border border-[#bfdbfe] text-[#2563eb] bg-[#eff6ff] text-xs font-bold">
                                <i class="ri-time-line mr-1.5 text-[14px]"></i>
                                {{ $record->formatDuration($wDuration) }}
                            </div>
                        </td>
                        
                        <!-- Break Duration -->
                        <td class="px-6 py-4 text-center">
                            @php $bDuration = $record->break_duration; @endphp
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full border border-[#e2e8f0] text-[#64748b] bg-white text-xs font-bold shadow-sm">
                                <i class="ri-time-line mr-1.5 text-[14px] opacity-70"></i>
                                {{ $record->formatDuration($bDuration) }}
                            </div>
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.attendances.edit', $record) }}" class="w-8 h-8 rounded-lg border border-[#fef08a] bg-[#fef9c3] text-[#ca8a04] hover:bg-[#fde047] flex items-center justify-center transition-colors shadow-sm">
                                    <i class="ri-edit-box-line"></i>
                                </a>
                                <form action="{{ route('admin.attendances.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg border border-[#fecaca] bg-[#fee2e2] text-[#dc2626] hover:bg-[#fca5a5] flex items-center justify-center transition-colors shadow-sm">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="w-16 h-16 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-400">
                                <i class="ri-file-search-line text-2xl"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-700 mb-1">No Records Found</h3>
                            <p class="text-xs text-slate-500">There are no attendance logs matching your criteria.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($attendances->hasPages())
        <div class="px-6 py-4 border-t border-[#f1f5f9] bg-[#f8fafc]">
            {{ $attendances->links() }}
        </div>
    @endif
</div>
@endsection
