@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    createModalOpen: false, 
    editModalOpen: false,
    viewModalOpen: false,
    isCustomCategory: false,
    selectedCategory: '',
    editData: { id: '', title: '', category: '', effective_date: '', summary: '', content: '', is_active: true },
    editUrl: '',
    activeViewPolicy: null,
    openViewModal(policy) {
        this.activeViewPolicy = policy;
        this.viewModalOpen = true;
    },
    openEditModal(policy, updateUrl) {
        this.editData = { ...policy };
        this.editUrl = updateUrl;
        this.editModalOpen = true;
    }
}">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                <i class="ri-shield-user-line"></i> Corporate Governance
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">HR Policies & Guidelines</h1>
            <p class="text-slate-500 mt-1">Manage corporate HR policies, policy types, employee handbooks, and compliance rules.</p>
        </div>

        <button @click="createModalOpen = true" class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition-all shadow-md shadow-purple-200 flex items-center gap-2">
            <i class="ri-add-circle-line text-lg"></i> Add HR Policy
        </button>
    </div>

    <!-- Search & Policy Type Filters -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-8 space-y-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Search Bar -->
            <form method="GET" action="{{ route('admin.policies.index') }}" class="relative flex-1 max-w-md">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search policies by title or content..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all">
            </form>

            <div class="text-xs font-bold text-slate-500">
                Total Policies: <strong class="text-slate-900">{{ $policies->total() }}</strong>
            </div>
        </div>

        <!-- Policy Type Category Pills -->
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pt-2 border-t border-slate-100 whitespace-nowrap">
            <a href="{{ route('admin.policies.index', ['search' => request('search')]) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all {{ !request('category') ? 'bg-purple-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                All Types
            </a>
            @foreach($policyTypes as $type)
                <a href="{{ route('admin.policies.index', ['category' => $type, 'search' => request('search')]) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all {{ request('category') === $type ? 'bg-purple-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    {{ $type }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Policy Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($policies as $policy)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-purple-200 transition-all flex flex-col justify-between overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-bold rounded-full uppercase tracking-wider">
                            {{ $policy->category }}
                        </span>

                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $policy->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                            {{ $policy->is_active ? 'Active' : 'Draft' }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-2 leading-snug hover:text-purple-600 transition-colors">
                        {{ $policy->title }}
                    </h3>

                    @if($policy->effective_date)
                        <div class="text-xs text-slate-400 font-medium mb-3 flex items-center gap-1">
                            <i class="ri-calendar-line text-purple-500"></i> Effective: <span>{{ $policy->effective_date->format('M d, Y') }}</span>
                        </div>
                    @endif

                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        {{ Str::limit($policy->summary ?? $policy->content, 130) }}
                    </p>
                </div>

                <div class="bg-slate-50/80 px-6 py-3 border-t border-slate-100 flex items-center justify-between">
                    <button @click='openViewModal({{ json_encode($policy) }})' class="text-xs font-bold text-purple-600 hover:text-purple-800 flex items-center gap-1">
                        <i class="ri-eye-line"></i> Read Full Policy
                    </button>

                    <div class="flex items-center gap-2">
                        <button @click='openEditModal({{ json_encode($policy) }}, "{{ route("admin.policies.update", $policy) }}")' class="p-2 text-slate-400 hover:text-purple-600 bg-white hover:bg-purple-50 rounded-lg transition-colors border border-slate-200" title="Edit Policy">
                            <i class="ri-pencil-line"></i>
                        </button>

                        <form action="{{ route('admin.policies.destroy', $policy) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this policy?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 rounded-lg transition-colors border border-slate-200" title="Delete Policy">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-300 p-16 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mb-3 text-purple-600 text-3xl">
                    <i class="ri-book-read-line"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">No HR Policies Found</h3>
                <p class="text-slate-500 text-sm mb-4">Start by adding corporate policies, handbooks, or compliance documents.</p>
                <button @click="createModalOpen = true" class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-all shadow-md">
                    + Add First HR Policy
                </button>
            </div>
        @endforelse
    </div>

    @if($policies->hasPages())
        <div class="mb-8">
            {{ $policies->links() }}
        </div>
    @endif

    <!-- Create / Add HR Policy Modal -->
    <div x-show="createModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="createModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden relative border border-slate-100 max-h-[90vh] flex flex-col">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white shrink-0">
                <div class="flex items-center gap-2">
                    <i class="ri-shield-user-line text-purple-400 text-xl"></i>
                    <h2 class="text-lg font-bold">Add HR Policy</h2>
                </div>
                <button @click="createModalOpen = false" class="text-slate-400 hover:text-white transition-colors">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>

            <form action="{{ route('admin.policies.store') }}" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Policy Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Attendance & Punctuality Policy, Leave Entitlement" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-purple-500 outline-none text-sm font-medium text-slate-800">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Policy Type / Category *</label>
                        <select name="category" x-model="selectedCategory" @change="isCustomCategory = (selectedCategory === '__NEW__')" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-purple-500 outline-none text-sm font-semibold text-slate-800">
                            <option value="Attendance">Attendance</option>
                            <option value="Leave & Time Off">Leave & Time Off</option>
                            <option value="Code of Conduct">Code of Conduct</option>
                            <option value="IT & Security">IT & Security</option>
                            <option value="Performance & Review">Performance & Review</option>
                            <option value="__NEW__">+ Create New Policy Type...</option>
                        </select>
                    </div>

                    <div x-show="isCustomCategory" x-cloak>
                        <label class="block text-xs font-bold text-purple-600 uppercase tracking-wider mb-2">New Policy Type Name *</label>
                        <input type="text" name="custom_category" placeholder="Enter custom type name..." class="w-full px-4 py-3 rounded-xl border border-purple-300 bg-purple-50/50 focus:bg-white focus:ring-2 focus:ring-purple-500 outline-none text-sm font-semibold text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Effective Date</label>
                        <input type="date" name="effective_date" value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-purple-500 outline-none text-sm font-semibold text-slate-800">
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="relative flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500 border-slate-300">
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Publish as Active</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Summary / Short Overview</label>
                    <textarea name="summary" rows="2" placeholder="Brief 1-2 sentence overview of the policy..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-purple-500 outline-none text-sm font-medium text-slate-800"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Policy Content / Guidelines *</label>
                    <textarea name="content" rows="6" required placeholder="Enter the complete HR policy content, rules, and procedures..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-purple-500 outline-none text-sm font-medium text-slate-800"></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                    <button type="button" @click="createModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-sm shadow-md">Publish Policy</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Read Full Policy View Modal -->
    <div x-show="viewModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="viewModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl mx-4 overflow-hidden relative border border-slate-100 max-h-[85vh] flex flex-col">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white shrink-0">
                <div>
                    <span class="text-xs bg-purple-500 text-white px-2.5 py-0.5 rounded-full font-bold uppercase" x-text="activeViewPolicy ? activeViewPolicy.category : ''"></span>
                    <h2 class="text-xl font-bold mt-1" x-text="activeViewPolicy ? activeViewPolicy.title : ''"></h2>
                </div>
                <button @click="viewModalOpen = false" class="text-slate-400 hover:text-white p-1"><i class="ri-close-line text-2xl"></i></button>
            </div>
            <div class="p-6 overflow-y-auto flex-1 space-y-4">
                <template x-if="activeViewPolicy && activeViewPolicy.summary">
                    <div class="bg-purple-50 border border-purple-100 p-4 rounded-xl text-sm text-purple-900 font-medium">
                        <strong class="block text-xs uppercase text-purple-600 mb-1">Summary</strong>
                        <p x-text="activeViewPolicy.summary"></p>
                    </div>
                </template>

                <div>
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Policy Guidelines & Content</h4>
                    <div class="prose prose-slate max-w-none text-slate-800 text-sm whitespace-pre-line leading-relaxed p-4 bg-slate-50 rounded-xl border border-slate-200" x-text="activeViewPolicy ? activeViewPolicy.content : ''"></div>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end shrink-0">
                <button type="button" @click="viewModalOpen = false" class="px-5 py-2 bg-slate-800 text-white font-bold rounded-xl text-xs">Close</button>
            </div>
        </div>
    </div>

    <!-- Edit HR Policy Modal -->
    <div x-show="editModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="editModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden relative border border-slate-100 max-h-[90vh] flex flex-col">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white shrink-0">
                <h2 class="text-lg font-bold">Edit HR Policy</h2>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-white"><i class="ri-close-line text-2xl"></i></button>
            </div>

            <form :action="editUrl" method="POST" class="p-6 space-y-4 overflow-y-auto flex-1">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Policy Title *</label>
                    <input type="text" name="title" x-model="editData.title" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm font-medium text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Policy Type / Category *</label>
                    <input type="text" name="category" x-model="editData.category" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm font-semibold text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Summary</label>
                    <textarea name="summary" x-model="editData.summary" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm font-medium text-slate-800"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Content *</label>
                    <textarea name="content" x-model="editData.content" rows="6" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white text-sm font-medium text-slate-800"></textarea>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                    <button type="button" @click="editModalOpen = false" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-sm shadow-md">Update Policy</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
