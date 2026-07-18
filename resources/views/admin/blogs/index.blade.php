@extends('layouts.dashboard')

@section('content')
<div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Blogs</h1>
            <p class="text-slate-500 mt-1">Manage website articles and announcements.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-colors shadow-sm shadow-indigo-200">
            <i class="ri-add-line mr-2"></i> Add Blog Post
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="px-6 py-4 w-20">Image</th>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Published Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($blogs as $blog)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-14 h-10 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 shrink-0 flex items-center justify-center">
                                    @if($blog->image)
                                        <img src="{{ asset('blog/' . $blog->image) }}" alt="Preview" class="w-full h-full object-cover">
                                    @else
                                        <i class="ri-image-line text-slate-400 text-lg"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-slate-900 truncate max-w-xs block" title="{{ $blog->title }}">{{ $blog->title }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-sm font-mono">{{ $blog->slug }}</td>
                            <td class="px-6 py-4 text-slate-600 text-sm">{{ $blog->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="p-2 text-slate-400 hover:text-cyan-600 bg-slate-50 hover:bg-cyan-50 rounded-lg transition-colors" title="View Public Post">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="p-2 text-slate-400 hover:text-indigo-600 bg-slate-50 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
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
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-400 mb-3">
                                    <i class="ri-article-line text-2xl"></i>
                                </div>
                                <h3 class="text-sm font-medium text-slate-900">No blog posts</h3>
                                <p class="text-sm text-slate-500 mt-1">Get started by creating your first blog post.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($blogs->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
