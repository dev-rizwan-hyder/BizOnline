@extends('layouts.dashboard')

@section('content')
<div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <i class="ri-folder-user-line text-indigo-600"></i>
                <span>Employee Folders & Profiles</span>
            </h1>
            <p class="text-slate-500 mt-1">Manage team profiles, assigned tasks, and official records.</p>
        </div>
        <a href="{{ route('admin.employees.create') }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-indigo-200">
            <i class="ri-user-add-line mr-2 text-lg"></i> Add New Employee Profile
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider font-bold border-b border-slate-100">
                        <th class="px-6 py-4">Employee Profile</th>
                        <th class="px-6 py-4">Job Title & Dept</th>
                        <th class="px-6 py-4">CNIC & Contact</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($employees as $employee)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.employees.show', $employee) }}" class="flex items-center group">
                                    @if($employee->profile_photo_path)
                                        <img src="{{ asset($employee->profile_photo_path) }}" alt="Photo" class="w-10 h-10 rounded-xl object-cover mr-3 border border-indigo-200 shrink-0">
                                    @else
                                        <div class="w-10 h-10 rounded-xl bg-indigo-100 group-hover:bg-indigo-600 group-hover:text-white text-indigo-700 flex items-center justify-center text-sm font-black mr-3 shrink-0 transition-colors border border-indigo-200">
                                            {{ substr($employee->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <span class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors block text-base">{{ $employee->name }}</span>
                                        <span class="text-xs text-slate-400 font-medium">{{ $employee->email }}</span>
                                    </div>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 text-sm">{{ $employee->job_title ?? 'N/A' }}</div>
                                <div class="text-xs text-slate-400">{{ $employee->department ?? 'General' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-800">{{ $employee->mobile_number_1 ?? $employee->contact_info ?? 'N/A' }}</div>
                                <div class="text-xs text-slate-400 font-medium">CNIC: {{ $employee->cnic_number ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider
                                    {{ $employee->employment_status === 'Active' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $employee->employment_status === 'Probation' ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $employee->employment_status === 'Contract' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $employee->employment_status === 'Terminated' ? 'bg-rose-100 text-rose-800' : '' }}
                                    {{ $employee->employment_status === 'On Leave' ? 'bg-purple-100 text-purple-800' : '' }}">
                                    {{ $employee->employment_status ?? 'Active' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.employees.show', $employee) }}" class="p-2 text-indigo-600 hover:text-white bg-indigo-50 hover:bg-indigo-600 rounded-xl transition-all font-bold text-xs flex items-center gap-1 shadow-sm" title="Open Folder">
                                        <i class="ri-folder-open-line text-sm"></i> Open Folder
                                    </a>
                                    <a href="{{ route('admin.employees.edit', $employee) }}" class="p-2 text-slate-500 hover:text-indigo-600 bg-slate-100 hover:bg-indigo-50 rounded-xl transition-colors" title="Edit Profile">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                    <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this employee folder?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 bg-slate-50 hover:bg-red-50 rounded-xl transition-colors" title="Delete Employee">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-400 mb-3">
                                    <i class="ri-folder-user-line text-2xl"></i>
                                </div>
                                <h3 class="text-sm font-medium text-slate-900">No employee folders yet</h3>
                                <p class="text-sm text-slate-500 mt-1">Get started by creating a new employee profile folder.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($employees->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $employees->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
