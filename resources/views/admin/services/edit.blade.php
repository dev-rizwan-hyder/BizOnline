@extends('layouts.dashboard')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.services.index') }}" class="p-2 text-slate-400 hover:text-slate-600 bg-white border border-slate-200 rounded-xl transition-colors shadow-sm">
            <i class="ri-arrow-left-line text-lg"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Service Page Content</h1>
            <p class="text-slate-500 mt-1">Update page text fields and upload custom featured images.</p>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
        <form action="{{ route('admin.services.update', $service->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6" hx-boost="false">
            @csrf
            @method('PUT')
            
            <!-- Service Metadata Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-6">
                <div>
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Category</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 mt-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 capitalize">
                        {{ $service->category }}
                    </span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Slug / Route</span>
                    <span class="text-slate-600 font-mono text-sm block mt-1">/services/{{ $service->slug }}</span>
                </div>
            </div>

            <!-- Text Fields -->
            <div>
                <label for="title" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Service Title (Navigation / Name)</label>
                <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none bg-slate-50/50" required />
            </div>

            <div>
                <label for="headline" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Hero Headline</label>
                <input type="text" name="headline" id="headline" value="{{ old('headline', $service->headline) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none bg-slate-50/50" required />
            </div>

            <div>
                <label for="intro" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Service Description / Intro Paragraph</label>
                <textarea name="intro" id="intro" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none bg-slate-50/50" required>{{ old('intro', $service->intro) }}</textarea>
            </div>

            <!-- Current Image Preview -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Featured Image</label>
                <div class="flex items-start gap-4">
                    <div class="w-64 h-40 rounded-xl overflow-hidden border border-slate-200 bg-slate-100 shadow-sm relative group">
                        @if($service->custom_image)
                            <img src="{{ asset('services/' . $service->category . '/' . $service->custom_image) }}" alt="Current Image" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset($service->default_image) }}" alt="Default Image" class="w-full h-full object-cover opacity-60">
                        @endif
                    </div>
                    <div>
                        <div class="mt-1">
                            @if($service->custom_image)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Custom Uploaded Image
                                </span>
                                <p class="text-xs text-slate-400 mt-2 max-w-xs">This image is currently overriding the default template image. Uploading a new file will replace it.</p>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300 mr-1.5"></span> Default Config Image
                                </span>
                                <p class="text-xs text-slate-400 mt-2 max-w-xs">No custom image has been uploaded yet. The default theme image is currently active.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Upload Box -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload New Featured Image (Optional)</label>
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

            <!-- Actions -->
            <div class="flex justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-sm transition-colors">Save Changes</button>
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
