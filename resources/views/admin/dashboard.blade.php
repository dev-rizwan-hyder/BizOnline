@extends('layouts.dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Overview</h1>
    <p class="text-slate-500 mt-1">Here is what's happening with your projects today.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Employees Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full transition-transform group-hover:scale-150 ease-out duration-500 z-0"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Employees</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $employeeCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl shadow-inner">
                <i class="ri-group-line"></i>
            </div>
        </div>
    </div>

    <!-- Tasks Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full transition-transform group-hover:scale-150 ease-out duration-500 z-0"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Tasks</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $taskCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl shadow-inner">
                <i class="ri-task-line"></i>
            </div>
        </div>
    </div>
</div>
@endsection
