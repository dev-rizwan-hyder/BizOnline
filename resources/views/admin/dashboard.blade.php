@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    detailModalOpen: false, 
    activeEmployee: null, 
    activeTasks: [],
    openEmployeeModal(employeeData) {
        this.activeEmployee = employeeData.employee;
        this.activeTasks = employeeData.tasks;
        this.detailModalOpen = true;
    }
}">
    <!-- Header Hero Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white rounded-3xl p-6 sm:p-8 mb-8 shadow-xl relative overflow-hidden">
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 text-indigo-200 rounded-full text-xs font-bold uppercase tracking-wider mb-3 backdrop-blur-md border border-white/10">
                    <i class="ri-dashboard-3-line text-indigo-400"></i> Executive Admin Control Center
                </div>
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight">Company Dashboard</h1>
                <p class="text-indigo-200 text-sm mt-1">Real-time overview of workforce attendance, projects, and task productivity.</p>
            </div>

            <!-- Date Picker & Quick Actions -->
            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2" hx-boost="false">
                    <input type="hidden" name="tab" value="{{ $activeTab }}">
                    <div class="relative">
                        <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()" class="bg-white/10 text-white border border-white/20 text-sm font-semibold rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-indigo-400 backdrop-blur-md shadow-sm">
                    </div>
                </form>

                <a href="{{ route('admin.projects.index') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl text-sm shadow-md transition-all flex items-center gap-1.5">
                    <i class="ri-add-line text-lg"></i> New Project
                </a>
            </div>
        </div>
    </div>

    <!-- Top Key Metrics Cards Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <!-- Employees -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Employees</span>
                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg font-bold">
                    <i class="ri-team-line"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ $totalEmployees }}</h3>
            <span class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-1">
                <i class="ri-checkbox-circle-line"></i> {{ $checkedInCount }} Present Today
            </span>
        </div>

        <!-- Projects -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Projects</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-lg font-bold">
                    <i class="ri-folder-3-line"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ $totalProjects }}</h3>
            <span class="text-[11px] font-semibold text-blue-600 flex items-center gap-1 mt-1">
                <i class="ri-loader-4-line"></i> {{ $activeProjects }} Active
            </span>
        </div>

        <!-- Total Tasks -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Total Tasks</span>
                <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-lg font-bold">
                    <i class="ri-task-line"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-slate-900">{{ $totalTasks }}</h3>
            <span class="text-[11px] font-semibold text-purple-600 flex items-center gap-1 mt-1">
                <i class="ri-play-circle-line"></i> {{ $totalInProgress }} In Progress
            </span>
        </div>

        <!-- Completed Tasks -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Completed</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-emerald-600">{{ $totalCompleted }}</h3>
            <span class="text-[11px] font-semibold text-slate-400 mt-1 block">
                {{ $totalTasks > 0 ? round(($totalCompleted / $totalTasks) * 100) : 0 }}% Rate
            </span>
        </div>

        <!-- Pending Tasks -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Pending</span>
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-bold">
                    <i class="ri-time-line"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-amber-600">{{ $totalPending }}</h3>
            <span class="text-[11px] font-semibold text-amber-600 mt-1 block">Needs Attention</span>
        </div>

        <!-- Delayed Tasks -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Delayed</span>
                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-lg font-bold">
                    <i class="ri-alert-line"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-rose-600">{{ $totalDelayed }}</h3>
            <span class="text-[11px] font-semibold text-rose-600 mt-1 block">Overdue/Blocked</span>
        </div>
    </div>

    <!-- Active Projects & Attendance Summary Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Active Projects Widget (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <i class="ri-folder-3-line text-indigo-600"></i> Active Projects Portfolio
                    </h3>
                    <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-indigo-600 hover:underline flex items-center gap-1">
                        View All Projects <i class="ri-arrow-right-line"></i>
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($recentProjects as $proj)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-indigo-200 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-slate-900 text-sm">{{ $proj->name }}</span>
                                    @if($proj->client_name)
                                        <span class="text-xs text-slate-400">({{ $proj->client_name }})</span>
                                    @endif
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-indigo-100 text-indigo-700">
                                    {{ str_replace('_', ' ', ucfirst($proj->status)) }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center text-xs text-slate-500 mb-1.5 font-medium">
                                <span>Task Completion</span>
                                <span class="font-bold text-indigo-600">{{ $proj->completion_percentage }}%</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-slate-200 overflow-hidden">
                                <div class="h-full bg-indigo-600 rounded-full transition-all duration-500" style="width: {{ $proj->completion_percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-400 text-xs font-medium">
                            No active projects created yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Today's Attendance Overview Card (1 Col) -->
        <div class="bg-gradient-to-br from-indigo-900 to-slate-900 text-white rounded-2xl shadow-sm p-6 flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="ri-user-follow-line text-indigo-400"></i> Attendance Today
                    </h3>
                    <a href="{{ route('admin.attendances.index') }}" class="text-xs font-bold text-indigo-300 hover:underline">
                        Log Details
                    </a>
                </div>

                <div class="space-y-4 my-4">
                    <div class="flex justify-between items-center bg-white/10 p-3.5 rounded-xl backdrop-blur-sm">
                        <span class="text-xs font-semibold text-indigo-200 uppercase">Total Checked In</span>
                        <span class="text-xl font-extrabold text-emerald-400">{{ $checkedInCount }} / {{ $totalEmployees }}</span>
                    </div>

                    <div class="flex justify-between items-center bg-white/10 p-3.5 rounded-xl backdrop-blur-sm">
                        <span class="text-xs font-semibold text-indigo-200 uppercase">On Break Currently</span>
                        <span class="text-xl font-extrabold text-amber-300">{{ $onBreakCount }}</span>
                    </div>

                    <div class="flex justify-between items-center bg-white/10 p-3.5 rounded-xl backdrop-blur-sm">
                        <span class="text-xs font-semibold text-indigo-200 uppercase">Not Checked In</span>
                        <span class="text-xl font-extrabold text-rose-300">{{ max(0, $totalEmployees - $checkedInCount) }}</span>
                    </div>
                </div>
            </div>

            <div class="relative z-10 pt-2 border-t border-white/10">
                <span class="text-[11px] text-indigo-300 font-medium">
                    <i class="ri-time-line"></i> {{ \Carbon\Carbon::today()->format('l, F j, Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Employee Task Performance Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="border-b border-slate-100 bg-slate-50/50 p-4 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-1 bg-slate-200/70 p-1.5 rounded-xl text-sm font-semibold">
                <a href="{{ route('admin.dashboard', ['tab' => 'daily', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $activeTab === 'daily' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-sun-line text-lg"></i>
                    <span>Daily Task</span>
                </a>
                <a href="{{ route('admin.dashboard', ['tab' => 'weekly', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $activeTab === 'weekly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-calendar-event-line text-lg"></i>
                    <span>Weekly Task</span>
                </a>
                <a href="{{ route('admin.dashboard', ['tab' => 'monthly', 'date' => $selectedDate]) }}" class="px-5 py-2 rounded-lg transition-all flex items-center gap-2 {{ $activeTab === 'monthly' ? 'bg-white text-indigo-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="ri-calendar-month-line text-lg"></i>
                    <span>Monthly Task</span>
                </a>
            </div>

            <div class="text-xs font-semibold text-slate-500 flex items-center gap-2">
                <i class="ri-information-line text-indigo-500"></i>
                <span>Showing <strong class="text-slate-800 capitalize">{{ $activeTab }}</strong> task breakdown per employee</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-900 text-white text-xs uppercase tracking-wider font-bold">
                        <th class="px-6 py-4">Employee</th>
                        <th class="px-6 py-4 text-center">Assigned</th>
                        <th class="px-6 py-4 text-center">Completed</th>
                        <th class="px-6 py-4 text-center">Pending</th>
                        <th class="px-6 py-4 text-center">Delayed</th>
                        <th class="px-6 py-4 text-right">Task Breakdown</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($employeeStats as $stat)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                        {{ substr($stat['employee']->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <button @click='openEmployeeModal({{ json_encode($stat) }})' class="font-bold text-slate-900 hover:text-indigo-600 text-base transition-colors text-left flex items-center gap-1 group">
                                            <span>{{ $stat['employee']->name }}</span>
                                            <i class="ri-arrow-right-up-line text-slate-400 group-hover:text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                        </button>
                                        <div class="text-xs text-slate-400">{{ $stat['employee']->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-slate-700 text-base">
                                <span class="px-3 py-1 bg-slate-100 text-slate-800 rounded-lg">{{ $stat['assigned'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-emerald-600 text-base">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-lg">{{ $stat['completed'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-amber-600 text-base">
                                <span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-lg">{{ $stat['pending'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-rose-600 text-base">
                                <span class="px-3 py-1 bg-rose-50 text-rose-700 rounded-lg">{{ $stat['delayed'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click='openEmployeeModal({{ json_encode($stat) }})' class="inline-flex items-center gap-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-2 rounded-xl transition-colors">
                                        <i class="ri-eye-line"></i> View Tasks ({{ count($stat['tasks']) }})
                                    </button>
                                    <a href="{{ route('admin.employees.show', $stat['employee']) }}" class="inline-flex items-center gap-1 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-3 py-2 rounded-xl transition-colors" title="Open Profile">
                                        <i class="ri-folder-open-line"></i> Profile
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <i class="ri-user-unfollow-line text-3xl text-slate-400"></i>
                                <p class="mt-2 text-sm">No employees found in the system.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Employee Detailed Tasks Modal -->
    <div x-show="detailModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="detailModalOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[85vh] mx-4 overflow-hidden flex flex-col">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-900 text-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                        <span x-text="activeEmployee ? activeEmployee.name.charAt(0) : ''"></span>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold" x-text="activeEmployee ? activeEmployee.name + '\'s Tasks' : 'Employee Tasks'"></h2>
                        <p class="text-xs text-slate-400 capitalize" x-text="'Showing ' + '{{ $activeTab }}' + ' assigned task details'"></p>
                    </div>
                </div>
                <button @click="detailModalOpen = false" class="text-slate-400 hover:text-white transition-colors p-1">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto flex-1 space-y-4">
                <template x-if="activeTasks.length === 0">
                    <div class="text-center py-12 text-slate-400">
                        <i class="ri-inbox-line text-4xl mb-2"></i>
                        <p class="text-sm font-medium">No tasks assigned for this period.</p>
                    </div>
                </template>

                <template x-for="task in activeTasks" :key="task.id">
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 hover:border-indigo-200 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                            <div class="flex items-center gap-2">
                                <h3 class="font-bold text-slate-900 text-base" x-text="task.title"></h3>
                                <template x-if="task.is_recurring">
                                    <span class="text-[10px] bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-bold uppercase">Daily Recurring</span>
                                </template>
                            </div>
                            <div class="flex items-center gap-2">
                                <span :class="{
                                    'bg-rose-100 text-rose-700': task.priority === 'High',
                                    'bg-amber-100 text-amber-700': task.priority === 'Medium',
                                    'bg-slate-200 text-slate-700': task.priority === 'Low'
                                }" class="text-xs px-2.5 py-1 rounded-full font-bold uppercase" x-text="task.priority + ' Priority'"></span>

                                <span :class="{
                                    'bg-emerald-100 text-emerald-800': task.raw_status === 'completed',
                                    'bg-amber-100 text-amber-800': task.raw_status === 'pending' || task.raw_status === 'in_progress',
                                    'bg-rose-100 text-rose-800': task.raw_status === 'delayed'
                                }" class="text-xs px-2.5 py-1 rounded-full font-bold" x-text="task.status"></span>
                            </div>
                        </div>

                        <p class="text-sm text-slate-600 mb-3" x-text="task.description || 'No description provided.'"></p>

                        <div class="flex flex-wrap items-center justify-between text-xs text-slate-500 pt-3 border-t border-slate-200/60 gap-2">
                            <div class="flex items-center gap-2">
                                <i class="ri-time-line text-indigo-500"></i>
                                <span>Deadline: <strong class="text-slate-800" x-text="task.deadline"></strong></span>
                            </div>

                            <template x-if="task.delay_reason">
                                <div class="text-rose-600 font-semibold flex items-center gap-1">
                                    <i class="ri-error-warning-line"></i>
                                    <span>Reason: <span x-text="task.delay_reason"></span></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-between items-center">
                <a x-bind:href="activeEmployee ? '/admin/employees/' + activeEmployee.id : '#'" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                    <i class="ri-folder-user-line"></i> Open Full Employee Folder
                </a>
                <button type="button" @click="detailModalOpen = false" class="px-5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
