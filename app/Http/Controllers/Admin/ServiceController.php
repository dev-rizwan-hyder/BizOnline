<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services defined in config.
     */
    public function index()
    {
        $configPages = config('service_pages.pages');
        $dbServices = Service::all()->keyBy('slug');

        $services = [];
        foreach ($configPages as $slug => $page) {
            $dbService = $dbServices->get($slug);
            
            $services[] = (object)[
                'slug' => $slug,
                'title' => ($dbService && $dbService->title) ? $dbService->title : ($page['title'] ?? Str::headline($slug)),
                'category' => $page['category'] ?? 'general',
                'default_image' => $page['image'] ?? 'portfolio_section.png',
                'custom_image' => $dbService ? $dbService->image : null,
            ];
        }

        return view('admin.services.index', compact('services'));
    }

    public function edit(string $slug)
    {
        $configPages = config('service_pages.pages');
        abort_unless(array_key_exists($slug, $configPages), 404);

        $page = $configPages[$slug];
        $dbService = Service::where('slug', $slug)->first();

        // Load packages with fallback and prepare features text
        $packages = ($dbService && $dbService->packages) ? $dbService->packages : ($page['packages'] ?? []);
        foreach ($packages as $index => $package) {
            $packages[$index]['features_text'] = implode("\n", $package['features'] ?? []);
        }

        // Load work with fallback
        $work = ($dbService && $dbService->work) ? $dbService->work : ($page['work'] ?? []);

        $service = (object)[
            'slug' => $slug,
            'title' => ($dbService && $dbService->title) ? $dbService->title : ($page['title'] ?? Str::headline($slug)),
            'headline' => ($dbService && $dbService->headline) ? $dbService->headline : ($page['headline'] ?? ''),
            'intro' => ($dbService && $dbService->intro) ? $dbService->intro : ($page['intro'] ?? ''),
            'category' => $page['category'] ?? 'general',
            'default_image' => $page['image'] ?? 'portfolio_section.png',
            'custom_image' => $dbService ? $dbService->image : null,
            'packages' => $packages,
            'work' => $work,
        ];

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service image and content in storage.
     */
    public function update(Request $request, string $slug)
    {
        $configPages = config('service_pages.pages');
        abort_unless(array_key_exists($slug, $configPages), 404);

        $page = $configPages[$slug];
        $category = $page['category'] ?? 'general';

        $request->validate([
            'title' => 'required|string|max:255',
            'headline' => 'required|string|max:500',
            'intro' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            
            // Validate Packages
            'packages' => 'required|array|size:3',
            'packages.*.name' => 'required|string|max:255',
            'packages.*.price' => 'required|string|max:255',
            'packages.*.tag' => 'required|string|max:255',
            'packages.*.description' => 'nullable|string|max:1000',
            'packages.*.features_text' => 'required|string',
            'packages.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',

            // Validate Work Items
            'work' => 'required|array|size:3',
            'work.*.label' => 'required|string|max:255',
            'work.*.name' => 'required|string|max:255',
            'work.*.text' => 'required|string|max:1000',
            'work.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $dbService = Service::firstOrNew(['slug' => $slug]);
        $dbService->title = $request->input('title');
        $dbService->headline = $request->input('headline');
        $dbService->intro = $request->input('intro');

        // Path setup
        $path = public_path('services/' . $category);
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        // Process Main Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($dbService->image && File::exists($path . '/' . $dbService->image)) {
                File::delete($path . '/' . $dbService->image);
            }
            $filename = time() . '_' . Str::slug($slug) . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $dbService->image = $filename;
        }

        // Process Packages
        $inputPackages = $request->input('packages', []);
        $existingPackages = $dbService->packages ?? $page['packages'] ?? [];
        $finalPackages = [];

        foreach ($inputPackages as $index => $pkg) {
            $featuresArray = array_filter(array_map('trim', explode("\n", $pkg['features_text'] ?? '')));
            
            $pkgImage = $existingPackages[$index]['image'] ?? null;
            if ($request->hasFile("packages.{$index}.image")) {
                $imageFile = $request->file("packages.{$index}.image");
                if ($pkgImage && File::exists($path . '/' . $pkgImage)) {
                    File::delete($path . '/' . $pkgImage);
                }
                $filename = time() . '_' . Str::slug($slug) . '_pkg_' . ($index + 1) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move($path, $filename);
                $pkgImage = $filename;
            }

            $finalPackages[] = [
                'name' => $pkg['name'],
                'price' => $pkg['price'],
                'tag' => $pkg['tag'],
                'description' => $pkg['description'] ?? null,
                'features' => array_values($featuresArray),
                'image' => $pkgImage,
            ];
        }
        $dbService->packages = $finalPackages;

        // Process Work Items
        $inputWork = $request->input('work', []);
        $existingWork = $dbService->work ?? $page['work'] ?? [];
        $finalWork = [];

        foreach ($inputWork as $index => $wk) {
            $wkImage = $existingWork[$index]['image'] ?? null;
            if ($request->hasFile("work.{$index}.image")) {
                $imageFile = $request->file("work.{$index}.image");
                if ($wkImage && File::exists($path . '/' . $wkImage)) {
                    File::delete($path . '/' . $wkImage);
                }
                $filename = time() . '_' . Str::slug($slug) . '_work_' . ($index + 1) . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move($path, $filename);
                $wkImage = $filename;
            }

            $finalWork[] = [
                'label' => $wk['label'],
                'name' => $wk['name'],
                'text' => $wk['text'],
                'image' => $wkImage,
            ];
        }
        $dbService->work = $finalWork;

        $dbService->save();

        return redirect()->route('admin.services.index')->with('success', 'Service page content updated successfully.');
    }
}
