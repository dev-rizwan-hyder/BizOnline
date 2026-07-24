@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.employees.show', $employee) }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600">
            <i class="ri-arrow-left-line mr-1"></i> Back to Employee Profile Folder
        </a>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
        <div class="border-b border-slate-100 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <i class="ri-edit-box-line text-indigo-600"></i> Edit Employee Profile — {{ $employee->name }}
            </h1>
            <p class="text-slate-500 text-sm mt-1">Update employee personal information, job title, and document attachments.</p>
        </div>

        <form action="{{ route('admin.employees.update', $employee) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Personal Information -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg inline-block">1. Personal Information</h3>

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
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Emergency Contact</label>
                        <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $employee->emergency_contact) }}" placeholder="Name + Number" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
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

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Current Address</label>
                    <textarea name="current_address" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">{{ old('current_address', $employee->current_address) }}</textarea>
                </div>
            </div>

            <!-- Job & Account Details -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg inline-block">2. Job & Account Details</h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email) }}" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password (Leave blank to keep)</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
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

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Job Title</label>
                        <input type="text" name="job_title" value="{{ old('job_title', $employee->job_title) }}" placeholder="Software Engineer, Sales Exec" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Department</label>
                        <input type="text" name="department" value="{{ old('department', $employee->department) }}" placeholder="Engineering, Accounts" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Date of Joining</label>
                        <input type="date" name="date_of_joining" value="{{ old('date_of_joining', $employee->date_of_joining ? $employee->date_of_joining->format('Y-m-d') : '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Bank Account Details</label>
                    <textarea name="bank_account_details" rows="2" placeholder="Bank Name, IBAN / Account Number..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">{{ old('bank_account_details', $employee->bank_account_details) }}</textarea>
                </div>
            </div>

            <!-- Documents & Photo Uploads -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg inline-block">3. Attachments & Documents</h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Profile Photo</label>
                        <input type="file" name="profile_photo" accept="image/*" class="w-full text-xs text-slate-500">
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <label class="block text-xs font-bold text-slate-700 mb-1">CV / Resume</label>
                        <input type="file" name="cv_resume" accept=".pdf,.doc,.docx" class="w-full text-xs text-slate-500">
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Experience Letters</label>
                        <input type="file" name="experience_letters" accept=".pdf,.doc,.docx,.zip" class="w-full text-xs text-slate-500">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.employees.show', $employee) }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md">Update Employee Details</button>
            </div>
        </form>
    </div>
</div>
@endsection
