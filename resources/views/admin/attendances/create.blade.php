@extends('layouts.dashboard')

@section('content')
<div class="mb-8">
    <div class="flex items-center text-sm text-slate-500 mb-2 font-medium">
        <a href="{{ route('admin.attendances.index') }}" class="hover:text-indigo-600 transition-colors">Attendance</a>
        <i class="ri-arrow-right-s-line mx-2"></i>
        <span class="text-slate-900">Add Record</span>
    </div>
    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Add Attendance</h1>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8 max-w-3xl">
    <form action="{{ route('admin.attendances.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Employee <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="user_id" required class="w-full appearance-none px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-shadow bg-slate-50 focus:bg-white cursor-pointer">
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ request('user_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Date <span class="text-red-500">*</span></label>
                <input type="date" name="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" readonly class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-100 text-slate-500 focus:outline-none cursor-not-allowed">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Status <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="status" required class="w-full appearance-none px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-shadow bg-slate-50 focus:bg-white cursor-pointer">
                        <option value="checked_in" {{ old('status') == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                        <option value="on_break" {{ old('status') == 'on_break' ? 'selected' : '' }}>On Break</option>
                        <option value="checked_out" {{ old('status') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100 mt-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Check In Time</label>
                <input type="time" name="check_in" value="{{ old('check_in') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-shadow bg-slate-50 focus:bg-white">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Check Out Time</label>
                <input type="time" name="check_out" value="{{ old('check_out') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-shadow bg-slate-50 focus:bg-white">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Break Start Time</label>
                <input type="time" name="break_start" value="{{ old('break_start') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-shadow bg-slate-50 focus:bg-white">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Break End Time</label>
                <input type="time" name="break_end" value="{{ old('break_end') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-shadow bg-slate-50 focus:bg-white">
            </div>
        </div>

        <div class="pt-6 mt-6 flex items-center justify-end border-t border-slate-100 gap-3">
            <a href="{{ route('admin.attendances.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm shadow-indigo-200 transition-colors">
                Save Record
            </button>
        </div>
    </form>
</div>
@endsection
