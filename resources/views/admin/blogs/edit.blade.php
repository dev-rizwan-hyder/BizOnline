@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.blogs.index') }}" class="p-2 text-slate-400 hover:text-slate-600 bg-white border border-slate-200 rounded-xl transition-colors shadow-sm">
            <i class="ri-arrow-left-line text-lg"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Blog Post</h1>
            <p class="text-slate-500 mt-1">Modify article details, featured image, or SEO slug.</p>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8" x-data="{ 
        title: '{{ addslashes($blog->title) }}', 
        slug: '{{ addslashes($blog->slug) }}',
        autoSlug: false,
        updateSlug() {
            if (this.autoSlug) {
                this.slug = this.title
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }
        }
    }">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="space-y-6" hx-boost="false">
            @csrf
            @method('PUT')
            
            <!-- Title -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Title</label>
                <input type="text" name="title" required x-model="title" @input="updateSlug()" placeholder="Enter post title" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">
            </div>

            <!-- Slug -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">SEO Slug / URL</label>
                    <label class="inline-flex items-center text-xs text-slate-400 cursor-pointer">
                        <input type="checkbox" x-model="autoSlug" @change="updateSlug()" class="mr-1.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        Auto-generate
                    </label>
                </div>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs font-mono select-none">/blog/</span>
                    <input type="text" name="slug" x-model="slug" :readonly="autoSlug" placeholder="post-url-slug" class="w-full pl-16 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-mono text-slate-700 read-only:opacity-75 read-only:cursor-not-allowed">
                </div>
                <p class="text-xs text-slate-400 mt-1">SEO-friendly unique url name of the article.</p>
            </div>

            <!-- Summary -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Summary (Optional)</label>
                <textarea name="summary" rows="3" placeholder="Provide a brief summary for the blog card preview..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700">{{ $blog->summary }}</textarea>
                <p class="text-xs text-slate-400 mt-1">Summarized intro text displayed in blog list preview cards.</p>
            </div>

            <!-- Current Featured Image Preview -->
            @if($blog->image)
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Current Featured Image</label>
                    <div class="w-48 h-32 rounded-xl overflow-hidden border border-slate-200 bg-slate-100 shadow-sm relative group">
                        <img src="{{ asset('blog/' . $blog->image) }}" alt="Current Image" class="w-full h-full object-cover">
                    </div>
                </div>
            @endif

            <!-- Image Upload -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    {{ $blog->image ? 'Replace Featured Image' : 'Featured Image' }}
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-indigo-400 transition-colors bg-slate-50/50">
                    <div class="space-y-1 text-center">
                        <i class="ri-image-add-line text-3xl text-slate-400"></i>
                        <div class="flex text-sm text-slate-600">
                            <label for="image-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload a file</span>
                                <input id="image-upload" name="image" type="file" accept="image/*" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-slate-400">PNG, JPG, GIF, WebP up to 5MB</p>
                        <p id="file-chosen-text" class="text-xs text-slate-500 font-semibold mt-1"></p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Content</label>
                <textarea name="content" rows="12" required placeholder="Write your blog post body content here (supports basic html)..." class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm font-medium text-slate-700 font-sans">{{ $blog->content }}</textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.blogs.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-sm transition-colors">Update Post</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('image-upload');
        const chosenText = document.getElementById('file-chosen-text');

        if (fileInput && chosenText) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    chosenText.textContent = "Selected: " + this.files[0].name;
                } else {
                    chosenText.textContent = "";
                }
            });
        }
    });
</script>
@endsection
