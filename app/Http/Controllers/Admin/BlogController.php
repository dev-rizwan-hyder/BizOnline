<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Up to 5MB
        ]);

        // Generate slug if empty
        if (empty($validated['slug'])) {
            $slug = Str::slug($validated['title']);
            // Ensure unique slug
            $originalSlug = $slug;
            $count = 1;
            while (Blog::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Create directory if it doesn't exist
            $path = public_path('blog');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $validated['image'] = $filename;
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        // Generate slug if empty
        if (empty($validated['slug'])) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $count = 1;
            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = public_path('blog');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            // Delete old image if it exists
            if ($blog->image && File::exists($path . '/' . $blog->image)) {
                File::delete($path . '/' . $blog->image);
            }

            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $validated['image'] = $filename;
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete image file if exists
        if ($blog->image) {
            $imagePath = public_path('blog/' . $blog->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
