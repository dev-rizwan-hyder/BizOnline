@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600">
            <i class="ri-arrow-left-line mr-1"></i> Back to Employee Folders
        </a>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
        <div class="border-b border-slate-100 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <i class="ri-user-add-line text-indigo-600"></i> Add New Employee Profile
            </h1>
            <p class="text-slate-500 text-sm mt-1">Fill out the detailed employee folder information below.</p>
        </div>

        <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Personal Information -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg inline-block">1. Personal Information</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Muhammad Ali" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Father's Name</label>
                        <input type="text" name="father_name" value="{{ old('father_name') }}" placeholder="e.g. Ahmad Khan" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">CNIC Number</label>
                        <input type="text" name="cnic_number" value="{{ old('cnic_number') }}" placeholder="35201-XXXXXXX-X" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Emergency Contact</label>
                        <input type="text" name="emergency_contact" value="{{ old('emergency_contact') }}" placeholder="Name + Contact No." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mobile Number 1 *</label>
                        <input type="text" name="mobile_number_1" value="{{ old('mobile_number_1') }}" required placeholder="0300-1234567" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mobile Number 2</label>
                        <input type="text" name="mobile_number_2" value="{{ old('mobile_number_2') }}" placeholder="0321-7654321" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Current Address</label>
                    <textarea name="current_address" rows="2" placeholder="Complete residential address..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">{{ old('current_address') }}</textarea>
                </div>
            </div>

            <!-- Job & Account Information -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg inline-block">2. Job & Account Details</h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address (Login) *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="employee@biztech.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password *</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Employment Status *</label>
                        <select name="employment_status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-semibold text-slate-800">
                            <option value="Active" selected>Active</option>
                            <option value="Probation">Probation</option>
                            <option value="Contract">Contract</option>
                            <option value="On Leave">On Leave</option>
                            <option value="Terminated">Terminated</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Job Title / Designation</label>
                        <input type="text" name="job_title" value="{{ old('job_title') }}" placeholder="Software Engineer, Sales Exec" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Department</label>
                        <input type="text" name="department" value="{{ old('department') }}" placeholder="Engineering, HR, Marketing" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Date of Joining</label>
                        <input type="date" name="date_of_joining" value="{{ old('date_of_joining') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Bank Account Details</label>
                    <textarea name="bank_account_details" rows="2" placeholder="Bank Name, IBAN / Account Number..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">{{ old('bank_account_details') }}</textarea>
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
                        <label class="block text-xs font-bold text-slate-700 mb-1">CV / Resume (PDF/Doc)</label>
                        <input type="file" name="cv_resume" accept=".pdf,.doc,.docx" class="w-full text-xs text-slate-500">
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Experience Letters (PDF/Zip)</label>
                        <input type="file" name="experience_letters" accept=".pdf,.doc,.docx,.zip" class="w-full text-xs text-slate-500">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.employees.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md">Create Employee Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
