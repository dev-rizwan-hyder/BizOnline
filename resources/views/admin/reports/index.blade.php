@extends('layouts.dashboard')

@section('content')
<div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight flex items-center gap-3">
                <i class="ri-file-chart-line text-indigo-600"></i>
                <span>Task Performance Reports</span>
            </h1>
            <p class="text-slate-500 mt-1">Detailed performance audit, task status breakdowns, and delay logs per employee.</p>
        </div>

        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('admin.reports.index') }}" class="flex items-center gap-2">
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()" class="bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
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
                <a href="{{ route('admin.reports.index', ['type' => 'daily', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'daily' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-sun-line text-lg"></i> Daily Report
                </a>
                <a href="{{ route('admin.reports.index', ['type' => 'weekly', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'weekly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-calendar-event-line text-lg"></i> Weekly Report
                </a>
                <a href="{{ route('admin.reports.index', ['type' => 'monthly', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $type === 'monthly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
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
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4 pb-4 border-b border-slate-200/80">
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
                            <div class="flex gap-2">
                                <span class="px-3 py-1 bg-slate-200 text-slate-700 text-xs font-bold rounded-lg" title="Assigned">Assigned: {{ $row['assigned'] }}</span>
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg" title="Completed">Done: {{ $row['completed'] }}</span>
                                <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-lg" title="Pending">Pending: {{ $row['pending'] }}</span>
                                <span class="px-3 py-1 bg-rose-100 text-rose-800 text-xs font-bold rounded-lg" title="Delayed">Delayed: {{ $row['delayed'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Task Breakdown Table per Employee -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-1.5">
                            <i class="ri-list-check"></i> Task Breakdown for {{ $dateRangeStr }}
                        </h4>

                        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
                            <table class="w-full text-left text-sm border-collapse">
                                <thead>
                                    <tr class="bg-slate-100/80 text-slate-600 text-xs uppercase font-bold border-b border-slate-200">
                                        <th class="px-4 py-3">Task Name</th>
                                        <th class="px-4 py-3">Deadline</th>
                                        <th class="px-4 py-3 text-center">Priority</th>
                                        <th class="px-4 py-3 text-center">Status</th>
                                        <th class="px-4 py-3">Delay / Pending Reason</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($row['tasks'] as $t)
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
                                            <td colspan="5" class="px-4 py-6 text-center text-xs text-slate-400">
                                                No tasks recorded for {{ $row['employee']->name }} in this timeframe.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-slate-400">
                    <i class="ri-file-search-line text-4xl mb-2"></i>
                    <p class="text-sm font-medium">No report data found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
