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
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight flex items-center gap-3">
                <span>Task Overview</span>
                <span class="text-xs px-2.5 py-1 bg-indigo-100 text-indigo-700 font-semibold rounded-full uppercase tracking-wider">Live Tracker</span>
            </h1>
            <p class="text-slate-500 mt-1">Real-time daily, weekly, and monthly task statistics assigned to employees.</p>
        </div>

        <!-- Date Filter & Quick Actions -->
        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <input type="hidden" name="tab" value="{{ $activeTab }}">
                <div class="relative">
                    <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()" class="bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
                </div>
            </form>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Employees</p>
                <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $totalEmployees }}</h3>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl font-bold">
                <i class="ri-user-star-line"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Total Tasks</p>
                <h3 class="text-2xl font-black text-slate-900 mt-1">{{ $totalTasks }}</h3>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                <i class="ri-task-line"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Completed</p>
                <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $totalCompleted }}</h3>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
                <i class="ri-checkbox-circle-line"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Pending</p>
                <h3 class="text-2xl font-black text-amber-600 mt-1">{{ $totalPending }}</h3>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                <i class="ri-time-line"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between col-span-2 md:col-span-1">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400 tracking-wider">Delayed</p>
                <h3 class="text-2xl font-black text-rose-600 mt-1">{{ $totalDelayed }}</h3>
            </div>
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl font-bold">
                <i class="ri-alert-line"></i>
            </div>
        </div>
    </div>

    <!-- Dashboard Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="border-b border-slate-100 bg-slate-50/50 p-2 sm:p-4 flex flex-wrap items-center justify-between gap-3">
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

        <!-- Dashboard Table (per employee) -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider font-bold border-b border-slate-100">
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
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-600 to-violet-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">
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
                                    <a href="{{ route('admin.employees.show', $stat['employee']) }}" class="inline-flex items-center gap-1 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-3 py-2 rounded-xl transition-colors" title="Open Folder">
                                        <i class="ri-folder-open-line"></i> Folder
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
            <!-- Modal Header -->
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

            <!-- Modal Content -->
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
                                <!-- Priority Badge -->
                                <span :class="{
                                    'bg-rose-100 text-rose-700': task.priority === 'High',
                                    'bg-amber-100 text-amber-700': task.priority === 'Medium',
                                    'bg-slate-200 text-slate-700': task.priority === 'Low'
                                }" class="text-xs px-2.5 py-1 rounded-full font-bold uppercase" x-text="task.priority + ' Priority'"></span>

                                <!-- Status Badge -->
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

            <!-- Modal Footer -->
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
