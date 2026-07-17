@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    addModalOpen: false, 
    editModalOpen: false, 
    editData: { id: '', name: '', email: '', contact: '' },
    editUrl: ''
}">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Employees</h1>
            <p class="text-slate-500 mt-1">Manage team members and accounts.</p>
        </div>
        <button @click="addModalOpen = true" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-sm shadow-indigo-200">
            <i class="ri-add-line mr-2"></i> Add Employee
        </button>
    </div>

    <!-- Add Employee Modal -->
    <div x-show="addModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" x-cloak>
        <div @click.away="addModalOpen = false" x-transition x-show="addModalOpen" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h2 class="text-lg font-bold text-slate-800">Add New Employee</h2>
                <button @click="addModalOpen = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.employees.store') }}" method="POST" class="p-6" hx-boost="false">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password</label>
                        <input type="password" name="password" required minlength="8" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Contact Info (Optional)</label>
                        <input type="text" name="contact_info" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" @click="addModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-sm transition-colors">Save Employee</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div x-show="editModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" x-cloak>
        <div @click.away="editModalOpen = false" x-transition x-show="editModalOpen" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h2 class="text-lg font-bold text-slate-800">Edit Employee</h2>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
            
            <form :action="editUrl" method="POST" class="p-6" hx-boost="false">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="name" x-model="editData.name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" x-model="editData.email" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">New Password (Leave blank to keep)</label>
                        <input type="password" name="password" minlength="8" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Contact Info (Optional)</label>
                        <input type="text" name="contact_info" x-model="editData.contact" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" @click="editModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-sm transition-colors">Update Employee</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Contact</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($employees as $employee)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold mr-3 shrink-0">
                                        {{ substr($employee->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-slate-900">{{ $employee->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm">{{ $employee->email }}</td>
                            <td class="px-6 py-4 text-slate-500 text-sm">{{ $employee->contact_info ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <button @click="editData = { name: {{ json_encode($employee->name) }}, email: {{ json_encode($employee->email) }}, contact: {{ json_encode($employee->contact_info) }} }; editUrl = '{{ route('admin.employees.update', $employee) }}'; editModalOpen = true" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                                        <i class="ri-pencil-line"></i>
                                    </button>
                                    <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 bg-slate-50 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-400 mb-3">
                                    <i class="ri-group-line text-2xl"></i>
                                </div>
                                <h3 class="text-sm font-medium text-slate-900">No employees</h3>
                                <p class="text-sm text-slate-500 mt-1">Get started by adding a new employee.</p>
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
