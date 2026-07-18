@extends('layouts.dashboard')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Services Pages</h1>
        <p class="text-slate-500 mt-1">Manage featured images for all frontend service pages.</p>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="px-6 py-4 w-20">Preview Image</th>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Image Source</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($services as $service)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-14 h-10 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 shrink-0 flex items-center justify-center">
                                    @if($service->custom_image)
                                        <img src="{{ asset('services/' . $service->category . '/' . $service->custom_image) }}" alt="Custom Preview" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset($service->default_image) }}" alt="Default Preview" class="w-full h-full object-cover opacity-60">
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-slate-900 truncate max-w-xs block" title="{{ $service->title }}">{{ $service->title }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-sm font-mono">{{ $service->slug }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-800 capitalize">
                                    {{ $service->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($service->custom_image)
                                    <span class="inline-flex items-center text-xs font-semibold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Custom Upload
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-xs font-semibold text-slate-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-300 mr-1.5"></span> Config Default
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="p-2 text-slate-400 hover:text-cyan-600 bg-slate-50 hover:bg-cyan-50 rounded-lg transition-colors" title="View Public Page">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service->slug) }}" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit Image">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
