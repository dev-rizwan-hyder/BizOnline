@extends('layouts.dashboard')

@section('content')
<div x-data="{ 
    viewModalOpen: false,
    activePolicy: null,
    openModal(policy) {
        this.activePolicy = policy;
        this.viewModalOpen = true;
    }
}">
    <!-- Header -->
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
            <i class="ri-shield-user-line"></i> Corporate Policies
        </div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Company Policies & Handbook</h1>
        <p class="text-slate-500 mt-1">Review official company rules, attendance guidelines, and code of conduct.</p>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-8 space-y-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form method="GET" action="{{ route('employee.policies.index') }}" class="relative flex-1 max-w-md">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search policies by topic or keyword..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-800 outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all">
            </form>
        </div>

        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pt-2 border-t border-slate-100 whitespace-nowrap">
            <a href="{{ route('employee.policies.index', ['search' => request('search')]) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all {{ !request('category') ? 'bg-purple-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                All Categories
            </a>
            @foreach($policyTypes as $type)
                <a href="{{ route('employee.policies.index', ['category' => $type, 'search' => request('search')]) }}" class="px-4 py-1.5 rounded-xl text-xs font-bold transition-all {{ request('category') === $type ? 'bg-purple-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
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
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-bold rounded-full uppercase tracking-wider mb-3 inline-block">
                        {{ $policy->category }}
                    </span>

                    <h3 class="text-xl font-bold text-slate-900 mb-2 leading-snug">
                        {{ $policy->title }}
                    </h3>

                    @if($policy->effective_date)
                        <div class="text-xs text-slate-400 font-medium mb-3 flex items-center gap-1">
                            <i class="ri-calendar-line text-purple-500"></i> Effective: <span>{{ $policy->effective_date->format('M d, Y') }}</span>
                        </div>
                    @endif

                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        {{ Str::limit($policy->summary ?? $policy->content, 140) }}
                    </p>
                </div>

                <div class="bg-slate-50/80 px-6 py-3 border-t border-slate-100 flex items-center justify-between">
                    <button @click='openModal({{ json_encode($policy) }})' class="text-xs font-bold text-purple-600 hover:text-purple-800 flex items-center gap-1">
                        <i class="ri-eye-line text-base"></i> Read Full Policy
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-slate-300 p-16 flex flex-col items-center justify-center text-center">
                <i class="ri-book-read-line text-4xl text-slate-300 mb-2"></i>
                <h3 class="text-lg font-bold text-slate-700 mb-1">No Active Policies Found</h3>
                <p class="text-slate-500 text-sm">Check back later or adjust your search filter.</p>
            </div>
        @endforelse
    </div>

    @if($policies->hasPages())
        <div class="mb-8">
            {{ $policies->links() }}
        </div>
    @endif

    <!-- Policy Content View Modal -->
    <div x-show="viewModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="viewModalOpen = false" class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl mx-4 overflow-hidden relative border border-slate-100 max-h-[85vh] flex flex-col">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-900 text-white shrink-0">
                <div>
                    <span class="text-xs bg-purple-500 text-white px-2.5 py-0.5 rounded-full font-bold uppercase" x-text="activePolicy ? activePolicy.category : ''"></span>
                    <h2 class="text-xl font-bold mt-1" x-text="activePolicy ? activePolicy.title : ''"></h2>
                </div>
                <button @click="viewModalOpen = false" class="text-slate-400 hover:text-white p-1"><i class="ri-close-line text-2xl"></i></button>
            </div>
            <div class="p-6 overflow-y-auto flex-1 space-y-4">
                <template x-if="activePolicy && activePolicy.summary">
                    <div class="bg-purple-50 border border-purple-100 p-4 rounded-xl text-sm text-purple-900 font-medium">
                        <strong class="block text-xs uppercase text-purple-600 mb-1">Summary</strong>
                        <p x-text="activePolicy.summary"></p>
                    </div>
                </template>

                <div>
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Policy Guidelines & Content</h4>
                    <div class="prose prose-slate max-w-none text-slate-800 text-sm whitespace-pre-line leading-relaxed p-4 bg-slate-50 rounded-xl border border-slate-200" x-text="activePolicy ? activePolicy.content : ''"></div>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end shrink-0">
                <button type="button" @click="viewModalOpen = false" class="px-5 py-2 bg-slate-800 text-white font-bold rounded-xl text-xs">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
