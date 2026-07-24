@extends('layouts.dashboard')

@section('content')
<div x-data="{ addTaskModalOpen: false, editProfileModalOpen: false }">
    <!-- Breadcrumb & Back -->
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
            <i class="ri-arrow-left-line mr-1"></i> Back to Employee Folders
        </a>
        <div class="flex items-center gap-3">
            <button @click="editProfileModalOpen = true" class="inline-flex items-center bg-slate-800 hover:bg-slate-900 text-white font-bold px-4 py-2.5 rounded-xl text-sm transition-all shadow-sm">
                <i class="ri-edit-line mr-2"></i> Edit Profile Info
            </button>
            <button @click="addTaskModalOpen = true" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-md shadow-indigo-200">
                <i class="ri-add-line mr-2 text-lg"></i> Add More Task
            </button>
        </div>
    </div>

    <!-- Employee Profile Header Card -->
    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl mb-8 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 relative z-10">
            <div class="flex items-center gap-5">
                @if($employee->profile_photo_path)
                    <img src="{{ asset($employee->profile_photo_path) }}" alt="Photo" class="w-20 h-20 rounded-2xl object-cover border-2 border-indigo-400 shadow-lg shrink-0">
                @else
                    <div class="w-20 h-20 rounded-2xl bg-indigo-600 border-2 border-indigo-400 text-white flex items-center justify-center font-black text-3xl shadow-lg shrink-0">
                        {{ substr($employee->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $employee->name }}</h1>
                        
                        <!-- Employment Status Badge -->
                        <span class="text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider
                            {{ $employee->employment_status === 'Active' ? 'bg-emerald-500/30 text-emerald-300 border border-emerald-400/40' : '' }}
                            {{ $employee->employment_status === 'Probation' ? 'bg-amber-500/30 text-amber-300 border border-amber-400/40' : '' }}
                            {{ $employee->employment_status === 'Contract' ? 'bg-blue-500/30 text-blue-300 border border-blue-400/40' : '' }}
                            {{ $employee->employment_status === 'Terminated' ? 'bg-rose-500/30 text-rose-300 border border-rose-400/40' : '' }}
                            {{ $employee->employment_status === 'On Leave' ? 'bg-purple-500/30 text-purple-300 border border-purple-400/40' : '' }}">
                            {{ $employee->employment_status ?? 'Active' }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-300 mt-2">
                        @if($employee->job_title)
                            <span class="font-semibold text-indigo-300"><i class="ri-briefcase-line"></i> {{ $employee->job_title }}</span>
                        @endif
                        @if($employee->department)
                            <span class="text-slate-400">• {{ $employee->department }}</span>
                        @endif
                        <span class="flex items-center gap-1.5"><i class="ri-mail-line text-indigo-400"></i> {{ $employee->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Metrics Grid -->
            <div class="grid grid-cols-4 gap-2 sm:gap-4 w-full sm:w-auto text-center border-t sm:border-t-0 border-slate-800 pt-4 sm:pt-0">
                <div class="bg-white/10 backdrop-blur-md px-4 py-3 rounded-2xl border border-white/10">
                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Assigned</p>
                    <p class="text-xl font-black text-white mt-0.5">{{ $totalAssigned }}</p>
                </div>
                <div class="bg-emerald-500/20 backdrop-blur-md px-4 py-3 rounded-2xl border border-emerald-400/30">
                    <p class="text-[10px] uppercase font-bold text-emerald-300 tracking-wider">Completed</p>
                    <p class="text-xl font-black text-emerald-300 mt-0.5">{{ $completedCount }}</p>
                </div>
                <div class="bg-amber-500/20 backdrop-blur-md px-4 py-3 rounded-2xl border border-amber-400/30">
                    <p class="text-[10px] uppercase font-bold text-amber-300 tracking-wider">Pending</p>
                    <p class="text-xl font-black text-amber-300 mt-0.5">{{ $pendingCount }}</p>
                </div>
                <div class="bg-rose-500/20 backdrop-blur-md px-4 py-3 rounded-2xl border border-rose-400/30">
                    <p class="text-[10px] uppercase font-bold text-rose-300 tracking-wider">Delayed</p>
                    <p class="text-xl font-black text-rose-300 mt-0.5">{{ $delayedCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Detailed Profile Information Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 mb-8">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
            <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                <i class="ri-user-settings-line text-indigo-600"></i> Personal & Employment Details
            </h2>
            <button @click="editProfileModalOpen = true" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                <i class="ri-pencil-line"></i> Edit Details
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-sm">
            <!-- Full Name -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Full Name</span>
                <span class="font-bold text-slate-900">{{ $employee->name }}</span>
            </div>

            <!-- Father's Name -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Father's Name</span>
                <span class="font-semibold text-slate-800">{{ $employee->father_name ?? 'N/A' }}</span>
            </div>

            <!-- Date of Birth -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Date of Birth</span>
                <span class="font-semibold text-slate-800">{{ $employee->date_of_birth ? $employee->date_of_birth->format('M d, Y') : 'N/A' }}</span>
            </div>

            <!-- CNIC Number -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">CNIC Number</span>
                <span class="font-semibold text-slate-800">{{ $employee->cnic_number ?? 'N/A' }}</span>
            </div>

            <!-- Mobile Number 1 -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Mobile Number 1</span>
                <span class="font-semibold text-slate-800">{{ $employee->mobile_number_1 ?? $employee->contact_info ?? 'N/A' }}</span>
            </div>

            <!-- Mobile Number 2 -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Mobile Number 2</span>
                <span class="font-semibold text-slate-800">{{ $employee->mobile_number_2 ?? 'N/A' }}</span>
            </div>

            <!-- Job Title -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Job Title / Designation</span>
                <span class="font-bold text-indigo-700">{{ $employee->job_title ?? 'N/A' }}</span>
            </div>

            <!-- Department -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Department</span>
                <span class="font-semibold text-slate-800">{{ $employee->department ?? 'N/A' }}</span>
            </div>

            <!-- Date of Joining -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Date of Joining</span>
                <span class="font-semibold text-slate-800">{{ $employee->date_of_joining ? $employee->date_of_joining->format('M d, Y') : 'N/A' }}</span>
            </div>

            <!-- Emergency Contact -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Emergency Contact</span>
                <span class="font-semibold text-rose-600">{{ $employee->emergency_contact ?? 'N/A' }}</span>
            </div>

            <!-- Employment Status -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Employment Status</span>
                <span class="font-bold text-slate-900">{{ $employee->employment_status ?? 'Active' }}</span>
            </div>

            <!-- Current Address -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 md:col-span-2 lg:col-span-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Current Address</span>
                <span class="font-medium text-slate-800">{{ $employee->current_address ?? 'N/A' }}</span>
            </div>

            <!-- Bank Account Details -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 md:col-span-2 lg:col-span-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Bank Account Details</span>
                <span class="font-medium text-slate-800 whitespace-pre-line">{{ $employee->bank_account_details ?? 'N/A' }}</span>
            </div>

            <!-- Uploaded Documents & Attachments -->
            <div class="bg-indigo-50/60 p-5 rounded-2xl border border-indigo-100 md:col-span-2 lg:col-span-3">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-700 block mb-3">Employee Attachments & Files</span>
                <div class="flex flex-wrap gap-4">
                    <!-- CV / Resume -->
                    @if($employee->cv_resume_path)
                        <a href="{{ asset($employee->cv_resume_path) }}" target="_blank" class="bg-white px-4 py-2.5 rounded-xl border border-indigo-200 text-xs font-bold text-indigo-700 hover:bg-indigo-600 hover:text-white transition-all flex items-center gap-2 shadow-sm">
                            <i class="ri-file-text-line text-lg"></i> Download CV / Resume
                        </a>
                    @else
                        <span class="text-xs text-slate-400 bg-white/60 px-3 py-2 rounded-xl border border-slate-200">No CV Uploaded</span>
                    @endif

                    <!-- Experience Letters -->
                    @if($employee->experience_letters_path)
                        <a href="{{ asset($employee->experience_letters_path) }}" target="_blank" class="bg-white px-4 py-2.5 rounded-xl border border-indigo-200 text-xs font-bold text-indigo-700 hover:bg-indigo-600 hover:text-white transition-all flex items-center gap-2 shadow-sm">
                            <i class="ri-folder-zip-line text-lg"></i> Download Experience Letters
                        </a>
                    @else
                        <span class="text-xs text-slate-400 bg-white/60 px-3 py-2 rounded-xl border border-slate-200">No Experience Letters</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Assigned Tasks List Header -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
            <i class="ri-task-line text-indigo-600"></i> Assigned Tasks History
        </h2>
        <button @click="addTaskModalOpen = true" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
            <i class="ri-add-circle-line text-lg"></i> Add More Task
        </button>
    </div>

    <!-- Tasks Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider font-bold border-b border-slate-100">
                        <th class="px-6 py-4">Task Title & Description</th>
                        <th class="px-6 py-4">Deadline (Date + Time)</th>
                        <th class="px-6 py-4 text-center">Priority</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tasks as $task)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4 max-w-xs sm:max-w-md">
                                <div class="font-bold text-slate-900 text-base flex items-center gap-2">
                                    <span>{{ $task->title }}</span>
                                    @if($task->is_recurring)
                                        <span class="text-[10px] bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-bold uppercase">Repeat Daily</span>
                                    @endif
                                </div>
                                @if($task->description)
                                    <p class="text-xs text-slate-500 truncate mt-1">{{ $task->description }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-700 text-sm font-semibold">
                                @if($task->deadline)
                                    <div class="flex items-center gap-1.5 text-slate-800 font-bold">
                                        <i class="ri-calendar-check-line text-indigo-600"></i>
                                        <span>{{ $task->deadline->format('M d, Y h:i A') }}</span>
                                    </div>
                                @elseif($task->due_date)
                                    <div class="flex items-center gap-1.5 text-slate-700">
                                        <i class="ri-calendar-line"></i>
                                        <span>{{ $task->due_date->format('M d, Y') }}</span>
                                    </div>
                                @else
                                    <span class="text-slate-400 italic">No deadline set</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-bold px-3 py-1 rounded-full uppercase
                                    {{ $task->priority === 'high' ? 'bg-rose-100 text-rose-700' : '' }}
                                    {{ $task->priority === 'medium' ? 'bg-amber-100 text-amber-700' : '' }}
                                    {{ $task->priority === 'low' ? 'bg-slate-200 text-slate-700' : '' }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-bold px-3 py-1 rounded-full capitalize
                                    {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ in_array($task->status, ['pending', 'in_progress']) ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $task->status === 'delayed' ? 'bg-rose-100 text-rose-800' : '' }}">
                                    {{ str_replace('_', ' ', $task->status) }}
                                </span>
                                @if($task->delay_reason)
                                    <div class="text-[11px] text-rose-600 font-medium mt-1 truncate" title="{{ $task->delay_reason }}">
                                        Reason: {{ $task->delay_reason }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.tasks.show', $task) }}" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="View Task">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 bg-slate-50 hover:bg-red-50 rounded-lg transition-colors" title="Delete Task">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <i class="ri-task-line text-4xl text-slate-300 mb-2"></i>
                                <p class="text-sm font-medium">No tasks assigned to {{ $employee->name }} yet.</p>
                                <button @click="addTaskModalOpen = true" class="mt-3 inline-flex items-center text-xs font-bold text-indigo-600 hover:underline">
                                    <i class="ri-add-line mr-1"></i> Assign First Task
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tasks->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $tasks->links() }}
            </div>
        @endif
    </div>

    <!-- Edit Employee Profile Info Modal -->
    <div x-show="editProfileModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="editProfileModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl mx-4 overflow-hidden relative border border-slate-100 max-h-[90vh] flex flex-col">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white shrink-0">
                <h2 class="text-lg font-bold flex items-center gap-2"><i class="ri-edit-box-line text-indigo-400"></i> Edit Employee Profile Details</h2>
                <button @click="editProfileModalOpen = false" class="text-slate-400 hover:text-white"><i class="ri-close-line text-2xl"></i></button>
            </div>

            <form action="{{ route('admin.employees.update', $employee) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto flex-1">
                @csrf
                @method('PUT')
                <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $employee->name) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Father's Name</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $employee->father_name) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $employee->date_of_birth ? $employee->date_of_birth->format('Y-m-d') : '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">CNIC Number</label>
                        <input type="text" name="cnic_number" value="{{ old('cnic_number', $employee->cnic_number) }}" placeholder="35201-XXXXXXX-X" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Employment Status *</label>
                        <select name="employment_status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800">
                            <option value="Active" {{ $employee->employment_status === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Probation" {{ $employee->employment_status === 'Probation' ? 'selected' : '' }}>Probation</option>
                            <option value="Contract" {{ $employee->employment_status === 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="On Leave" {{ $employee->employment_status === 'On Leave' ? 'selected' : '' }}>On Leave</option>
                            <option value="Terminated" {{ $employee->employment_status === 'Terminated' ? 'selected' : '' }}>Terminated</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mobile Number 1 *</label>
                        <input type="text" name="mobile_number_1" value="{{ old('mobile_number_1', $employee->mobile_number_1 ?? $employee->contact_info) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mobile Number 2</label>
                        <input type="text" name="mobile_number_2" value="{{ old('mobile_number_2', $employee->mobile_number_2) }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Job Title</label>
                        <input type="text" name="job_title" value="{{ old('job_title', $employee->job_title) }}" placeholder="Software Engineer, Sales Exec" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Department</label>
                        <input type="text" name="department" value="{{ old('department', $employee->department) }}" placeholder="Engineering, Accounts" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Date of Joining</label>
                        <input type="date" name="date_of_joining" value="{{ old('date_of_joining', $employee->date_of_joining ? $employee->date_of_joining->format('Y-m-d') : '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Emergency Contact</label>
                        <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $employee->emergency_contact) }}" placeholder="Name + Number" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Current Address</label>
                    <textarea name="current_address" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">{{ old('current_address', $employee->current_address) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Bank Account Details</label>
                    <textarea name="bank_account_details" rows="2" placeholder="Bank Name, IBAN / Account Number..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">{{ old('bank_account_details', $employee->bank_account_details) }}</textarea>
                </div>

                <!-- File Uploads -->
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block">File Attachments (Upload / Update)</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Profile Photo</label>
                            <input type="file" name="profile_photo" accept="image/*" class="w-full text-slate-500">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">CV / Resume</label>
                            <input type="file" name="cv_resume" accept=".pdf,.doc,.docx" class="w-full text-slate-500">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Experience Letters</label>
                            <input type="file" name="experience_letters" accept=".pdf,.doc,.docx,.zip" class="w-full text-slate-500">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                    <button type="button" @click="editProfileModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Assign Task Modal -->
    <div x-show="addTaskModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="addTaskModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-xl mx-4 overflow-hidden relative border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white">
                <div class="flex items-center gap-2">
                    <i class="ri-add-box-line text-indigo-400 text-xl"></i>
                    <h2 class="text-lg font-bold">Assign Task to {{ $employee->name }}</h2>
                </div>
                <button @click="addTaskModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.tasks.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="assigned_to" value="{{ $employee->id }}">
                <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Task Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Daily Sales Report, Design Logo" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                    <textarea name="description" rows="3" placeholder="Provide detailed explanation or instructions..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deadline (Date + Time) *</label>
                        <input type="datetime-local" name="deadline" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Priority *</label>
                        <select name="priority" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800">
                            <option value="medium">Medium Priority</option>
                            <option value="high">High Priority</option>
                            <option value="low">Low Priority</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="delayed">Delayed</option>
                        </select>
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="relative flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_recurring" value="1" class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500 border-slate-300">
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Repeat Daily (Recurring)</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="addTaskModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md">Assign Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
