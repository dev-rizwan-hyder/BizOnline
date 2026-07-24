@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    docModalOpen: false, 
    policyModalOpen: false 
}">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                <i class="ri-folder-shield-2-line"></i> Future HR Expansion Modules
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">New Project Folder</h1>
            <p class="text-slate-500 mt-1">Modular HR hub for attendance tracking, breaks, document storage, and corporate policies.</p>
        </div>

        <div class="flex items-center gap-2">
            <button @click="docModalOpen = true" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-all shadow-md shadow-indigo-200 flex items-center gap-1.5">
                <i class="ri-file-add-line text-sm"></i> Add Document
            </button>
            <button @click="policyModalOpen = true" class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-all flex items-center gap-1.5 shadow-sm">
                <i class="ri-add-circle-line text-sm"></i> Add HR Policy
            </button>
        </div>
    </div>

    <!-- Module Selector Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="border-b border-slate-100 bg-slate-50/50 p-2 sm:p-4 overflow-x-auto no-scrollbar">
            <div class="flex items-center gap-2 text-sm font-semibold whitespace-nowrap min-w-max">
                <a href="{{ route('admin.projects.index', ['module' => 'overview']) }}" class="px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 {{ $activeTab === 'overview' ? 'bg-indigo-600 text-white shadow-sm font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    <i class="ri-apps-2-line"></i> Hub Overview
                </a>
                <a href="{{ route('admin.projects.index', ['module' => 'attendance']) }}" class="px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 {{ $activeTab === 'attendance' ? 'bg-indigo-600 text-white shadow-sm font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    <i class="ri-login-box-line"></i> Check-in / Check-out
                </a>
                <a href="{{ route('admin.projects.index', ['module' => 'breaks']) }}" class="px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 {{ $activeTab === 'breaks' ? 'bg-indigo-600 text-white shadow-sm font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    <i class="ri-cup-line"></i> Break Tracking
                </a>
                <a href="{{ route('admin.projects.index', ['module' => 'performance']) }}" class="px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 {{ $activeTab === 'performance' ? 'bg-indigo-600 text-white shadow-sm font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    <i class="ri-bar-chart-box-line"></i> Monthly Performance
                </a>
                <a href="{{ route('admin.projects.index', ['module' => 'documents']) }}" class="px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 {{ $activeTab === 'documents' ? 'bg-indigo-600 text-white shadow-sm font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    <i class="ri-folder-zip-line"></i> Documents ({{ count($documents) }})
                </a>
                <a href="{{ route('admin.projects.index', ['module' => 'policies']) }}" class="px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 {{ $activeTab === 'policies' ? 'bg-indigo-600 text-white shadow-sm font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    <i class="ri-shield-user-line"></i> HR Policy ({{ count($policies) }})
                </a>
            </div>
        </div>

        <div class="p-6">
            @if($activeTab === 'overview')
                <!-- Overview Modules Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Module 1: Check-in / Check-out -->
                    <div class="bg-gradient-to-br from-indigo-50 to-slate-50 border border-indigo-100 rounded-2xl p-6 hover:shadow-md transition-all relative overflow-hidden group">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-md">
                            <i class="ri-login-circle-line"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Check-in / Check-out</h3>
                        <p class="text-sm text-slate-600 mb-4">Real-time employee attendance tracking with precise arrival and departure timestamps.</p>
                        <a href="{{ route('admin.projects.index', ['module' => 'attendance']) }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:text-indigo-800">
                            Launch Module <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>

                    <!-- Module 2: Break Tracking -->
                    <div class="bg-gradient-to-br from-amber-50 to-slate-50 border border-amber-100 rounded-2xl p-6 hover:shadow-md transition-all relative overflow-hidden group">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-md">
                            <i class="ri-cup-line"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Break Tracking</h3>
                        <p class="text-sm text-slate-600 mb-4">Track official start and end times for employee tea and lunch breaks.</p>
                        <a href="{{ route('admin.projects.index', ['module' => 'breaks']) }}" class="inline-flex items-center text-xs font-bold text-amber-700 hover:text-amber-900">
                            Launch Module <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>

                    <!-- Module 3: Monthly Performance -->
                    <div class="bg-gradient-to-br from-emerald-50 to-slate-50 border border-emerald-100 rounded-2xl p-6 hover:shadow-md transition-all relative overflow-hidden group">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-md">
                            <i class="ri-pie-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Monthly Performance</h3>
                        <p class="text-sm text-slate-600 mb-4">Combined attendance reliability & monthly task efficiency report for employees.</p>
                        <a href="{{ route('admin.projects.index', ['module' => 'performance']) }}" class="inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-900">
                            Launch Module <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>

                    <!-- Module 4: Documents Store -->
                    <div class="bg-gradient-to-br from-blue-50 to-slate-50 border border-blue-100 rounded-2xl p-6 hover:shadow-md transition-all relative overflow-hidden group">
                        <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-md">
                            <i class="ri-folder-open-line"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Documents</h3>
                        <p class="text-sm text-slate-600 mb-4">Secure document repository for employee files, contracts, and company assets.</p>
                        <a href="{{ route('admin.projects.index', ['module' => 'documents']) }}" class="inline-flex items-center text-xs font-bold text-blue-700 hover:text-blue-900">
                            Launch Module <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>

                    <!-- Module 5: HR Policy -->
                    <div class="bg-gradient-to-br from-purple-50 to-slate-50 border border-purple-100 rounded-2xl p-6 hover:shadow-md transition-all relative overflow-hidden group">
                        <div class="w-12 h-12 rounded-2xl bg-purple-600 text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-md">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">HR Policy</h3>
                        <p class="text-sm text-slate-600 mb-4">Centralized company handbook, guidelines, and HR policy manager.</p>
                        <a href="{{ route('admin.projects.index', ['module' => 'policies']) }}" class="inline-flex items-center text-xs font-bold text-purple-700 hover:text-purple-900">
                            Launch Module <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                    </div>
                </div>
            @elseif($activeTab === 'attendance')
                <!-- Check-in / Check-out Module View -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="ri-login-box-line text-indigo-600"></i> Check-in / Check-out Timestamps
                    </h3>
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="bg-slate-100 text-slate-600 text-xs uppercase font-bold">
                                    <th class="px-4 py-3">Employee</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Check-in Time</th>
                                    <th class="px-4 py-3">Check-out Time</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($recentAttendances as $att)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-4 py-3 font-bold text-slate-900">{{ $att->user->name ?? 'User' }}</td>
                                        <td class="px-4 py-3 text-slate-600 text-xs">{{ $att->date }}</td>
                                        <td class="px-4 py-3 text-emerald-600 font-semibold text-xs">{{ $att->check_in ?? 'Not checked in' }}</td>
                                        <td class="px-4 py-3 text-slate-700 font-semibold text-xs">{{ $att->check_out ?? 'Active' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="text-xs px-2.5 py-1 rounded-full font-bold uppercase {{ $att->status === 'present' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700' }}">
                                                {{ ucfirst($att->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-slate-400 text-xs">No attendance timestamp logs recorded today.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($activeTab === 'breaks')
                <!-- Break Tracking Module View -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="ri-cup-line text-amber-500"></i> Break Start / End Log
                    </h3>
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="bg-slate-100 text-slate-600 text-xs uppercase font-bold">
                                    <th class="px-4 py-3">Employee</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Break Type</th>
                                    <th class="px-4 py-3">Start Time</th>
                                    <th class="px-4 py-3">End Time</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($recentAttendances as $att)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-4 py-3 font-bold text-slate-900">{{ $att->user->name ?? 'User' }}</td>
                                        <td class="px-4 py-3 text-slate-600 text-xs">{{ $att->date }}</td>
                                        <td class="px-4 py-3 text-xs font-semibold text-amber-700">Tea / Lunch Break</td>
                                        <td class="px-4 py-3 text-xs text-slate-700">{{ $att->break_start ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-xs text-slate-700">{{ $att->break_end ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-slate-400 text-xs">No break logs recorded.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($activeTab === 'performance')
                <!-- Monthly Performance Module View -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="ri-bar-chart-box-line text-emerald-600"></i> Monthly Employee Performance & Attendance Summary
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($employees as $emp)
                            <div class="border border-slate-200 rounded-2xl p-5 bg-white shadow-sm">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center">
                                        {{ substr($emp->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $emp->name }}</h4>
                                        <span class="text-xs text-slate-500">Employee</span>
                                    </div>
                                </div>
                                <div class="space-y-2 text-xs border-t border-slate-100 pt-3">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Attendance Score:</span>
                                        <span class="font-bold text-emerald-600">96%</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Task Completion:</span>
                                        <span class="font-bold text-indigo-600">92%</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif($activeTab === 'documents')
                <!-- Documents Repository View -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i class="ri-folder-zip-line text-blue-600"></i> Document Repository
                        </h3>
                        <button @click="docModalOpen = true" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition-all shadow-sm">
                            <i class="ri-upload-2-line"></i> Upload Document
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($documents as $doc)
                            <div class="border border-slate-200 rounded-2xl p-5 bg-white shadow-sm flex items-start justify-between">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold shrink-0">
                                        <i class="ri-file-pdf-2-line"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $doc->title }}</h4>
                                        <p class="text-xs text-slate-500 mt-0.5 capitalize">Category: {{ $doc->category }}</p>
                                        @if($doc->employee)
                                            <p class="text-xs text-indigo-600 font-semibold mt-1">For: {{ $doc->employee->name }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 text-slate-400">
                                <i class="ri-folder-open-line text-4xl mb-2"></i>
                                <p class="text-sm font-medium">No documents uploaded yet.</p>
                                <button @click="docModalOpen = true" class="mt-2 text-xs text-indigo-600 font-bold hover:underline">+ Upload First Document</button>
                            </div>
                        @endforelse
                    </div>
                </div>
            @elseif($activeTab === 'policies')
                <!-- HR Policy Manager View -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i class="ri-shield-user-line text-purple-600"></i> Corporate HR Policies
                        </h3>
                        <button @click="policyModalOpen = true" class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition-all shadow-sm">
                            <i class="ri-add-line"></i> Add HR Policy
                        </button>
                    </div>

                    <div class="space-y-4">
                        @forelse($policies as $pol)
                            <div class="border border-slate-200 rounded-2xl p-6 bg-white shadow-sm">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-lg font-bold text-slate-900">{{ $pol->title }}</h4>
                                    <span class="text-xs bg-purple-100 text-purple-800 font-bold px-2.5 py-1 rounded-full uppercase">{{ $pol->category }}</span>
                                </div>
                                <p class="text-sm text-slate-600">{{ $pol->summary ?? $pol->content }}</p>
                            </div>
                        @empty
                            <div class="text-center py-12 text-slate-400 bg-slate-50 rounded-2xl border border-slate-200">
                                <i class="ri-book-read-line text-4xl mb-2"></i>
                                <p class="text-sm font-medium">No HR Policies published yet.</p>
                                <button @click="policyModalOpen = true" class="mt-2 text-xs text-indigo-600 font-bold hover:underline">+ Publish HR Policy</button>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Upload Document Modal -->
    <div x-show="docModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="docModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white">
                <h2 class="text-lg font-bold flex items-center gap-2"><i class="ri-file-add-line text-indigo-400"></i> Upload HR Document</h2>
                <button @click="docModalOpen = false" class="text-slate-400 hover:text-white"><i class="ri-close-line text-2xl"></i></button>
            </div>
            <form action="{{ route('admin.projects.documents.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Document Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Employee Handbook 2026, Offer Letter" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Category</label>
                    <select name="category" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-800">
                        <option value="company">Company Asset / Document</option>
                        <option value="employee">Employee Specific File</option>
                        <option value="policy">Policy & Terms</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Target Employee (Optional)</label>
                    <select name="user_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-800">
                        <option value="">-- All Employees --</option>
                        @foreach($employees as $e)
                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description / Notes</label>
                    <textarea name="description" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm font-medium text-slate-800"></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="docModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md">Save Document</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create HR Policy Modal -->
    <div x-show="policyModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="policyModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden relative">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white">
                <h2 class="text-lg font-bold flex items-center gap-2"><i class="ri-add-circle-line text-purple-400"></i> Publish HR Policy</h2>
                <button @click="policyModalOpen = false" class="text-slate-400 hover:text-white"><i class="ri-close-line text-2xl"></i></button>
            </div>
            <form action="{{ route('admin.projects.policies.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Policy Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Leave & Attendance Policy, Code of Conduct" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-purple-500 outline-none text-sm font-medium text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Category</label>
                    <input type="text" name="category" value="General" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Summary</label>
                    <input type="text" name="summary" placeholder="Brief summary of policy..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-sm font-medium text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Policy Content *</label>
                    <textarea name="content" rows="4" required placeholder="Full policy guidelines..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm font-medium text-slate-800"></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="policyModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-sm shadow-md">Publish Policy</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
