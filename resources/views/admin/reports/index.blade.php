@extends('layouts.dashboard')

@section('content')
<div>
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight flex items-center gap-3">
                <i class="ri-file-chart-line text-indigo-600"></i>
                <span>Task & Daily Work Performance Reports</span>
            </h1>
            <p class="text-slate-500 mt-1">Detailed performance audit, check-out daily work report summaries, and task status breakdowns.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-wrap items-center gap-2" hx-boost="false">
                <input type="hidden" name="type" value="{{ $type }}">
                
                <!-- Date Selector -->
                <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()" class="bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">

                <!-- Employee Selector Dropdown -->
                <select name="employee_id" onchange="this.form.submit()" class="bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
                    <option value="">All Employees</option>
                    @foreach($allEmployees as $emp)
                        <option value="{{ $emp->id }}" {{ $employeeId == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                    @endforeach
                </select>

                <!-- Search Input Field -->
                <div class="relative">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search employee..." class="bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl pl-9 pr-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
                    <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs px-3.5 py-2.5 rounded-xl transition-colors shadow-sm">
                    Filter
                </button>
            </form>

            <button onclick="window.print()" class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-colors flex items-center gap-1.5 shadow-sm">
                <i class="ri-printer-line"></i> Print Report
            </button>
        </div>
    </div>

    <!-- Report Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="border-b border-slate-100 bg-slate-50/50 p-2 sm:p-4 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-1 bg-slate-200/70 p-1.5 rounded-xl text-sm font-semibold">
                <a href="{{ route('admin.reports.index', ['type' => 'daily', 'date' => $selectedDate, 'employee_id' => $employeeId, 'search' => $search]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'daily' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-sun-line text-lg"></i> Daily Report
                </a>
                <a href="{{ route('admin.reports.index', ['type' => 'weekly', 'date' => $selectedDate, 'employee_id' => $employeeId, 'search' => $search]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'weekly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-calendar-event-line text-lg"></i> Weekly Report
                </a>
                <a href="{{ route('admin.reports.index', ['type' => 'monthly', 'date' => $selectedDate, 'employee_id' => $employeeId, 'search' => $search]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'monthly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-calendar-month-line text-lg"></i> Monthly Report
                </a>
            </div>

            <div class="text-xs font-bold text-indigo-700 bg-indigo-50 border border-indigo-100 px-3 py-1.5 rounded-xl flex items-center gap-2">
                <i class="ri-time-line"></i> Date Range: <span>{{ $dateRangeStr }}</span>
            </div>
        </div>

        <!-- Employee Performance Summary List -->
        <div class="p-6 space-y-8">
            @forelse($reportData as $row)
                <div class="border border-slate-200 rounded-2xl p-6 bg-slate-50/50 hover:border-indigo-200 transition-all shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-200/80">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-xl flex items-center justify-center shadow-md">
                                {{ substr($row['employee']->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                                    <span>{{ $row['employee']->name }}</span>
                                    <a href="{{ route('admin.employees.show', $row['employee']) }}" class="text-xs text-indigo-600 font-semibold hover:underline" title="View Folder">(View Profile Folder)</a>
                                </h3>
                                <p class="text-xs text-slate-500">{{ $row['employee']->email }}</p>
                            </div>
                        </div>

                        <!-- Progress Bar & Stats -->
                        <div class="flex items-center gap-6">
                            <div class="text-right">
                                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Completion Rate</div>
                                <div class="text-2xl font-black text-slate-900">{{ $row['completion_rate'] }}%</div>
                            </div>
                            <div class="w-32 bg-slate-200 rounded-full h-3 overflow-hidden shadow-inner hidden sm:block">
                                <div class="bg-gradient-to-r from-indigo-500 to-emerald-500 h-full rounded-full transition-all duration-500" style="width: {{ $row['completion_rate'] }}%"></div>
                            </div>
                            <div class="flex gap-2 flex-wrap">
                                <span class="px-3 py-1 bg-slate-200 text-slate-700 text-xs font-bold rounded-lg" title="Assigned">Assigned: {{ $row['assigned'] }}</span>
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg" title="Completed">Done: {{ $row['completed'] }}</span>
                                <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-lg" title="Pending">Pending: {{ $row['pending'] }}</span>
                                <span class="px-3 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-lg" title="Delayed">Delayed: {{ $row['delayed'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submitted Daily Check-Out Report Summaries -->
                    @if($row['daily_reports']->count() > 0)
                        <div class="mb-6 space-y-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-600 flex items-center gap-1.5">
                                <i class="ri-chat-quote-line text-base"></i> Submitted Daily Check-Out Report Summaries ({{ $row['daily_reports']->count() }})
                            </h4>
                            <div class="space-y-3">
                                @foreach($row['daily_reports'] as $rep)
                                    <div class="bg-indigo-50/80 border border-indigo-100 rounded-xl p-4 text-xs text-slate-800 shadow-sm relative">
                                        <div class="flex flex-wrap justify-between items-center mb-2 text-[11px] font-bold text-indigo-800 gap-2">
                                            <span class="flex items-center gap-1">
                                                <i class="ri-calendar-line text-indigo-600"></i> Date: {{ \Carbon\Carbon::parse($rep->date)->format('l, M d, Y') }}
                                            </span>
                                            <span class="text-slate-500 font-medium">
                                                Check In: {{ $rep->check_in ? $rep->check_in->format('h:i A') : '-' }} | Check Out: {{ $rep->check_out ? $rep->check_out->format('h:i A') : '-' }} | Logged Hours: <strong class="text-slate-900">{{ $rep->formatDuration($rep->working_duration) }}</strong>
                                            </span>
                                        </div>

                                        <div class="text-slate-800 font-semibold text-sm leading-relaxed bg-white p-3 rounded-lg border border-indigo-100/60 mb-3">
                                            "{{ $rep->daily_report }}"
                                        </div>

                                        <!-- Selected Worked Tasks with 1-line details -->
                                        @if($rep->selected_tasks->count() > 0)
                                            <div class="pt-3 border-t border-indigo-200/60">
                                                <span class="text-[11px] font-bold text-indigo-900 uppercase tracking-wider block mb-2">
                                                    Tasks Worked On ({{ $rep->selected_tasks->count() }}):
                                                </span>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                                    @foreach($rep->selected_tasks as $st)
                                                        <div class="bg-white p-2.5 rounded-lg border border-slate-200 text-xs shadow-xs">
                                                            <div class="flex items-center justify-between font-bold text-slate-800">
                                                                <span class="truncate">{{ $st->title }}</span>
                                                                <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-indigo-50 text-indigo-700 ml-2 shrink-0">
                                                                    {{ str_replace('_', ' ', $st->status) }}
                                                                </span>
                                                            </div>
                                                            <p class="text-slate-500 text-[11px] truncate mt-0.5">
                                                                {{ $st->description ? Str::limit($st->description, 60) : 'No description provided.' }}
                                                            </p>
                                                            <div class="text-[10px] text-slate-400 font-semibold mt-1 flex items-center gap-2">
                                                                @if($st->project)
                                                                    <span><i class="ri-folder-3-line"></i> {{ $st->project->name }}</span>
                                                                @endif
                                                                <span><i class="ri-timer-line text-indigo-500"></i> Time: {{ $st->formatted_time_spent }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            @empty
                <div class="text-center py-12 text-slate-400">
                    <i class="ri-file-search-line text-4xl mb-2"></i>
                    <p class="text-sm font-medium">No report data found for selected filter.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
