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
        $categories = config('service_pages.categories');
        abort_unless(array_key_exists($slug, $configPages), 404);

        $page = $configPages[$slug];
        $categoryKey = $page['category'] ?? 'general';
        $category = $categories[$categoryKey] ?? [];

        $dbService = Service::where('slug', $slug)->first();

        // Load packages with fallback and prepare features text
        $packages = ($dbService && $dbService->packages) ? $dbService->packages : ($page['packages'] ?? []);
        foreach ($packages as $index => $package) {
            $packages[$index]['features_text'] = implode("\n", $package['features'] ?? []);
        }

        // Load work with fallback
        $work = ($dbService && $dbService->work) ? $dbService->work : ($page['work'] ?? []);

        // Load features with fallback
        $features = ($dbService && $dbService->features) ? $dbService->features : ($page['features'] ?? []);

        // Load meta fields with fallback
        $meta = ($dbService && $dbService->meta) ? $dbService->meta : [];
        $meta['badge'] = $meta['badge'] ?? ($category['badge'] ?? 'DIGITAL PERFORMANCE LAB');
        $meta['hero_pills'] = $meta['hero_pills'] ?? 'High Performance, Scalable Architecture, Modern UI/UX, Custom Features, Conversion Ready';
        $meta['work_kicker'] = $meta['work_kicker'] ?? 'WHAT MAKES IT WORK';
        $meta['work_title'] = $meta['work_title'] ?? ('What Makes ' . ($dbService->title ?? $page['title'] ?? '') . ' Work?');
        $meta['work_intro'] = $meta['work_intro'] ?? 'Strong strategic execution turns standard assets into high-converting experiences. We blend real market insights, structured design, and channel-ready deliverables so every solution drives measurable sales and growth.';
        $meta['system_kicker'] = $meta['system_kicker'] ?? 'HOW IT WORKS';
        $meta['system_title'] = $meta['system_title'] ?? 'A Complete System, Not A Quick Fix';
        $meta['system_intro'] = $meta['system_intro'] ?? 'We turn project briefs into a smooth pipeline of structured concepts, clean deliverables, and high-performance outcomes your business can count on.';
        $meta['system_pills'] = $meta['system_pills'] ?? 'Corporate, E-Commerce, SaaS & Tech, Growth Brands, Enterprise';
        $meta['step_01_title'] = $meta['step_01_title'] ?? 'Match & Strategy';
        $meta['step_01_text'] = $meta['step_01_text'] ?? 'Find the right frameworks, code architectures, and visual styles that fit your category, target audience, and growth targets.';
        $meta['step_02_title'] = $meta['step_02_title'] ?? 'Direct & Build';
        $meta['step_02_text'] = $meta['step_02_text'] ?? 'Shape user journeys, proof points, responsive layouts, and clean codebase standards before full deployment begins.';
        $meta['step_03_title'] = $meta['step_03_title'] ?? 'Package & Scale';
        $meta['step_03_text'] = $meta['step_03_text'] ?? 'Deliver organized deliverables, documentation, asset guidelines, and performance metrics for your team.';

        $service = (object)[
            'slug' => $slug,
            'title' => ($dbService && $dbService->title) ? $dbService->title : ($page['title'] ?? Str::headline($slug)),
            'headline' => ($dbService && $dbService->headline) ? $dbService->headline : ($page['headline'] ?? ''),
            'intro' => ($dbService && $dbService->intro) ? $dbService->intro : ($page['intro'] ?? ''),
            'category' => $categoryKey,
            'default_image' => $page['image'] ?? 'portfolio_section.png',
            'custom_image' => $dbService ? $dbService->image : null,
            'packages' => $packages,
            'work' => $work,
            'features' => $features,
            'meta' => $meta,
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
            
            // Validate Meta fields
            'meta.badge' => 'nullable|string|max:255',
            'meta.hero_pills' => 'nullable|string|max:500',
            'meta.work_kicker' => 'nullable|string|max:255',
            'meta.work_title' => 'nullable|string|max:500',
            'meta.work_intro' => 'nullable|string',
            'meta.system_kicker' => 'nullable|string|max:255',
            'meta.system_title' => 'nullable|string|max:500',
            'meta.system_intro' => 'nullable|string',
            'meta.system_pills' => 'nullable|string|max:500',
            'meta.step_01_title' => 'nullable|string|max:255',
            'meta.step_01_text' => 'nullable|string|max:1000',
            'meta.step_02_title' => 'nullable|string|max:255',
            'meta.step_02_text' => 'nullable|string|max:1000',
            'meta.step_03_title' => 'nullable|string|max:255',
            'meta.step_03_text' => 'nullable|string|max:1000',

            // Validate Features
            'features' => 'nullable|array',
            'features.*.icon' => 'required_with:features|string|max:255',
            'features.*.title' => 'required_with:features|string|max:255',
            'features.*.text' => 'required_with:features|string|max:1000',

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

        // Process Main Hero Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($dbService->image && File::exists($path . '/' . $dbService->image)) {
                File::delete($path . '/' . $dbService->image);
            }
            $filename = time() . '_' . Str::slug($slug) . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $dbService->image = $filename;
        }

        // Process Meta Fields
        $metaInput = $request->input('meta', []);
        $dbService->meta = $metaInput;

        // Process Features
        $inputFeatures = $request->input('features', []);
        $finalFeatures = [];
        foreach ($inputFeatures as $feature) {
            if (!empty($feature['title']) && !empty($feature['text'])) {
                $finalFeatures[] = [
                    'icon' => $feature['icon'] ?? 'ri-zap-line',
                    'title' => $feature['title'],
                    'text' => $feature['text'],
                ];
            }
        }
        $dbService->features = $finalFeatures;

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

        // Process Work Showcase Items
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
