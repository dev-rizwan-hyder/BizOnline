@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    addModalOpen: false, 
    editModalOpen: false, 
    editData: { id: '', name: '', client_name: '', employees: [], description: '', status: 'in_progress', start_date: '', deadline: '', budget: '' },
    editUrl: ''
}">
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-wider mb-2 border border-indigo-100">
                <i class="ri-folder-3-line"></i> Project Management System
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Projects</h1>
            <p class="text-slate-500 mt-1">Organize client deliverables, assign team members, and track milestones.</p>
        </div>

        <button @click="addModalOpen = true" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-md shadow-indigo-200 gap-2">
            <i class="ri-add-line text-lg"></i> Create New Project
        </button>
    </div>

    <!-- Stats Overview Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-folder-3-line"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Projects</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $totalProjects }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-loader-4-line"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">In Progress</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $inProgressProjects }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-checkbox-circle-line"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Completed</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $completedProjects }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl font-bold shrink-0">
                <i class="ri-money-dollar-circle-line"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Portfolio Value</span>
                <h3 class="text-2xl font-black text-slate-900 mt-0.5">${{ number_format($totalBudget, 0) }}</h3>
            </div>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm mb-6">
        <form method="GET" action="{{ route('admin.projects.index') }}" class="flex flex-wrap items-center justify-between gap-4" hx-boost="false">
            <div class="flex flex-wrap items-center gap-3 flex-1 min-w-[280px]">
                <div class="relative flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search project name or client..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm text-slate-700">
                    <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>

                <div class="relative min-w-[160px]">
                    <select name="employee_id" onchange="this.form.submit()" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-700 cursor-pointer">
                        <option value="">All Assigned Team Members</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
                        @endforeach
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>

                <div class="relative min-w-[150px]">
                    <select name="status" onchange="this.form.submit()" class="w-full appearance-none pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-700 cursor-pointer">
                        <option value="">All Statuses</option>
                        <option value="planning" {{ request('status') === 'planning' ? 'selected' : '' }}>Planning</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="on_hold" {{ request('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold text-xs shadow-sm transition-colors">
                    Filter Results
                </button>
                @if(request()->hasAny(['search', 'status', 'employee_id']))
                    <a href="{{ route('admin.projects.index') }}" class="px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl font-bold text-xs transition-colors">
                        Reset Filters
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Projects Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($projects as $project)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between overflow-hidden group">
                <div class="p-6">
                    <!-- Top Badge & Actions -->
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <span class="px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider
                            {{ $project->status === 'completed' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 
                              ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800 border border-blue-200' : 
                              ($project->status === 'planning' ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : 
                              ($project->status === 'on_hold' ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-red-100 text-red-800 border border-red-200'))) }}">
                            {{ str_replace('_', ' ', ucfirst($project->status)) }}
                        </span>

                        <div class="flex items-center space-x-1">
                            <button @click="editData = { 
                                id: '{{ $project->id }}', 
                                name: {{ json_encode($project->name) }}, 
                                client_name: {{ json_encode($project->client_name) }}, 
                                employees: {{ json_encode($project->employees->pluck('id')->map(fn($id) => (string)$id)) }}, 
                                description: {{ json_encode($project->description) }}, 
                                status: '{{ $project->status }}', 
                                start_date: '{{ $project->start_date ? $project->start_date->format('Y-m-d') : '' }}', 
                                deadline: '{{ $project->deadline ? $project->deadline->format('Y-m-d') : '' }}', 
                                budget: '{{ $project->budget }}' 
                            }; editUrl = '{{ route('admin.projects.update', $project) }}'; editModalOpen = true" class="p-1.5 text-slate-400 hover:text-indigo-600 rounded-lg hover:bg-slate-100 transition-colors" title="Edit Project">
                                <i class="ri-pencil-line text-lg"></i>
                            </button>

                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" hx-boost="false" onsubmit="return confirm('Are you sure you want to delete this project? Associated tasks will remain standalone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Delete Project">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Project Title & Client -->
                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                        <a href="{{ route('admin.projects.show', $project) }}">
                            {{ $project->name }}
                        </a>
                    </h3>
                    
                    @if($project->client_name)
                        <p class="text-xs font-semibold text-indigo-600 mt-1 flex items-center gap-1">
                            <i class="ri-user-star-line"></i> {{ $project->client_name }}
                        </p>
                    @endif

                    <!-- Assigned Employees Badges -->
                    <div class="mt-3 flex items-center gap-1.5 flex-wrap">
                        <span class="text-xs font-semibold text-slate-400 mr-1">Team:</span>
                        @forelse($project->employees as $emp)
                            <span class="inline-flex items-center text-[11px] font-bold text-slate-700 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-md">
                                <span class="w-4 h-4 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-[9px] font-extrabold mr-1">
                                    {{ substr($emp->name, 0, 1) }}
                                </span>
                                {{ $emp->name }}
                            </span>
                        @empty
                            <span class="text-xs text-slate-400 italic">No assigned team members</span>
                        @endforelse
                    </div>

                    <p class="text-sm text-slate-500 mt-3 line-clamp-2">
                        {{ $project->description ?: 'No detailed project description provided.' }}
                    </p>

                    <!-- Progress Bar -->
                    <div class="mt-6">
                        <div class="flex justify-between items-center text-xs font-bold mb-1.5">
                            <span class="text-slate-500">Task Completion Progress</span>
                            <span class="text-indigo-600 font-extrabold">{{ $project->completion_percentage }}%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full bg-indigo-600 rounded-full transition-all duration-500" style="width: {{ $project->completion_percentage }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Footer Meta -->
                <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <div class="flex items-center gap-3">
                        <span class="font-semibold text-slate-700">
                            <i class="ri-task-line text-indigo-500"></i> {{ $project->tasks_count }} Tasks
                        </span>
                        @if($project->budget)
                            <span class="font-bold text-emerald-600">
                                ${{ number_format($project->budget, 0) }}
                            </span>
                        @endif
                    </div>

                    <a href="{{ route('admin.projects.show', $project) }}" class="font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                        View Project <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-slate-200 p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="ri-folder-add-line"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">No Projects Found</h3>
                <p class="text-sm text-slate-500 mt-1 max-w-sm mx-auto">Get started by creating your first company project to organize tasks and track deliverables.</p>
                <button @click="addModalOpen = true" class="mt-4 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-md inline-flex items-center gap-2">
                    <i class="ri-add-line"></i> Create New Project
                </button>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($projects->hasPages())
        <div class="mt-6">
            {{ $projects->links() }}
        </div>
    @endif

    <!-- Create Project Modal -->
    <div x-show="addModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm overflow-y-auto" x-cloak x-transition>
        <div @click.away="addModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-xl mx-4 my-8 overflow-hidden relative border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    <i class="ri-folder-add-line text-indigo-400"></i> Create New Project
                </h2>
                <button @click="addModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" class="p-6 space-y-4" hx-boost="false">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Website Redesign 2026, Mobile App Launch" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Client Name</label>
                        <input type="text" name="client_name" placeholder="e.g. Acme Corp" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status *</label>
                        <select name="status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-800">
                            <option value="planning">Planning</option>
                            <option value="in_progress" selected>In Progress</option>
                            <option value="on_hold">On Hold</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Assign Employees (Multiple)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 max-h-40 overflow-y-auto p-3 border border-slate-200 bg-slate-50 rounded-xl">
                        @foreach($employees as $emp)
                            <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 cursor-pointer">
                                <input type="checkbox" name="employees[]" value="{{ $emp->id }}" class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                <span>{{ $emp->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Start Date</label>
                        <input type="date" name="start_date" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deadline</label>
                        <input type="date" name="deadline" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Budget ($)</label>
                        <input type="number" step="0.01" min="0" name="budget" placeholder="e.g. 5000" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project Description</label>
                    <textarea name="description" rows="3" placeholder="Outline scope, goals, and key deliverables..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800 resize-none"></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="addModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md transition-colors">Save Project</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div x-show="editModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm overflow-y-auto" x-cloak x-transition>
        <div @click.away="editModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-xl mx-4 my-8 overflow-hidden relative border border-slate-100">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    <i class="ri-pencil-line text-indigo-400"></i> Edit Project
                </h2>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <form :action="editUrl" method="POST" class="p-6 space-y-4" hx-boost="false">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project Name *</label>
                    <input type="text" name="name" x-model="editData.name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Client Name</label>
                        <input type="text" name="client_name" x-model="editData.client_name" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status *</label>
                        <select name="status" x-model="editData.status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-semibold text-slate-800">
                            <option value="planning">Planning</option>
                            <option value="in_progress">In Progress</option>
                            <option value="on_hold">On Hold</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Assign Employees (Multiple)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 max-h-40 overflow-y-auto p-3 border border-slate-200 bg-slate-50 rounded-xl">
                        @foreach($employees as $emp)
                            <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 hover:text-indigo-600 cursor-pointer">
                                <input type="checkbox" name="employees[]" value="{{ $emp->id }}" x-model="editData.employees" class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                <span>{{ $emp->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Start Date</label>
                        <input type="date" name="start_date" x-model="editData.start_date" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Deadline</label>
                        <input type="date" name="deadline" x-model="editData.deadline" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Budget ($)</label>
                        <input type="number" step="0.01" min="0" name="budget" x-model="editData.budget" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Project Description</label>
                    <textarea name="description" x-model="editData.description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none text-sm font-medium text-slate-800 resize-none"></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="editModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm shadow-md transition-colors">Update Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
