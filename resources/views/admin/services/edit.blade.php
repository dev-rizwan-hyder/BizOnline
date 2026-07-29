@extends('layouts.dashboard')

@section('content')
<div class="max-w-5xl mx-auto pb-16">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.services.index') }}" class="p-2.5 text-slate-400 hover:text-slate-600 bg-white border border-slate-200 rounded-xl transition-colors shadow-sm">
            <i class="ri-arrow-left-line text-xl"></i>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Service Page Content</h1>
            <p class="text-slate-500 text-sm mt-1">Customize all text fields, hero overlay tags, work showcase items, system step cards, and packages for this service.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
            <p class="font-bold mb-2">Please fix the following validation errors:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Edit Form -->
    <form action="{{ route('admin.services.update', $service->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-8" hx-boost="false">
        @csrf
        @method('PUT')
        
        <!-- Service Route Metadata -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-slate-900 text-white p-6 rounded-2xl shadow-sm">
            <div>
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Service Category</span>
                <span class="inline-flex items-center px-3 py-1 mt-2 rounded-full text-xs font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 capitalize">
                    {{ $service->category }}
                </span>
            </div>
            <div>
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Live URL Slug</span>
                <span class="text-cyan-300 font-mono text-sm block mt-2">/services/{{ $service->slug }}</span>
            </div>
        </div>

        <!-- TAB 1: HERO SECTION -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold">1</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Hero Header Section</h2>
                    <p class="text-xs text-slate-500">Edit hero badge, main headline, intro text, hero image and overlay pills.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Service Title / Name *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-semibold" required />
                </div>

                <div>
                    <label for="meta_badge" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Hero Badge Pill Text</label>
                    <input type="text" name="meta[badge]" id="meta_badge" value="{{ old('meta.badge', $service->meta['badge'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-semibold" placeholder="e.g. CREATIVE SERVICE" />
                </div>
            </div>

            <div>
                <label for="headline" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Main Hero Headline *</label>
                <input type="text" name="headline" id="headline" value="{{ old('headline', $service->headline) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-semibold" required />
            </div>

            <div>
                <label for="intro" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Hero Intro / Description Paragraph *</label>
                <textarea name="intro" id="intro" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm" required>{{ old('intro', $service->intro) }}</textarea>
            </div>

            <div>
                <label for="meta_hero_pills" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Hero Image Overlay Floating Pills (Comma-Separated)</label>
                <input type="text" name="meta[hero_pills]" id="meta_hero_pills" value="{{ old('meta.hero_pills', $service->meta['hero_pills'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-medium" placeholder="High Performance, Scalable Architecture, Modern UI/UX, Custom Features, Conversion Ready" />
                <p class="text-xs text-slate-400 mt-1">These tags float over the bottom of the hero card image on the service page.</p>
            </div>

            <!-- Hero Image File Upload -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Hero Featured Image</label>
                <div class="flex items-start gap-6 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                    <div class="w-48 h-32 rounded-xl overflow-hidden border border-slate-300 bg-slate-200 shrink-0">
                        @if($service->custom_image)
                            <img src="{{ asset('services/' . $service->category . '/' . $service->custom_image) }}" alt="Current Hero" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset($service->default_image) }}" alt="Default Hero" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-600">Upload New Hero Image File</label>
                        <input type="file" name="image" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        <p class="text-xs text-slate-400">PNG, JPG, GIF, WebP up to 5MB. Replaces current hero graphic.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: SHOWCASE SECTION ("WHAT MAKES IT WORK" & 3 CARDS BELOW HERO) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="w-9 h-9 rounded-xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-600 font-bold">2</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Showcase Cards Section ("What Makes It Work?")</h2>
                    <p class="text-xs text-slate-500">Edit the subheadline text and the 3 cards displayed directly below the hero image.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="meta_work_kicker" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Section Kicker Text</label>
                    <input type="text" name="meta[work_kicker]" id="meta_work_kicker" value="{{ old('meta.work_kicker', $service->meta['work_kicker'] ?? 'WHAT MAKES IT WORK') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-semibold" />
                </div>

                <div>
                    <label for="meta_work_title" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Section Headline</label>
                    <input type="text" name="meta[work_title]" id="meta_work_title" value="{{ old('meta.work_title', $service->meta['work_title'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-semibold" />
                </div>
            </div>

            <div>
                <label for="meta_work_intro" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Section Description Paragraph</label>
                <textarea name="meta[work_intro]" id="meta_work_intro" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm">{{ old('meta.work_intro', $service->meta['work_intro'] ?? '') }}</textarea>
            </div>

            <!-- 3 WORK SHOWCASE CARDS -->
            <div class="pt-4 space-y-6 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">The 3 Showcase Cards</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @for($i = 0; $i < 3; $i++)
                        @php
                            $wItem = $service->work[$i] ?? [
                                'label' => 'CARD ' . ($i + 1),
                                'name' => 'Showcase Item ' . ($i + 1),
                                'text' => 'Description for showcase item ' . ($i + 1),
                                'image' => null,
                            ];
                        @endphp
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
                            <span class="inline-block px-2.5 py-1 rounded-md bg-cyan-100 text-cyan-800 text-[10px] font-extrabold uppercase">Card {{ $i + 1 }}</span>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Badge Tag</label>
                                <input type="text" name="work[{{ $i }}][label]" value="{{ old("work.{$i}.label", $wItem['label'] ?? '') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-800" required />
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Card Title</label>
                                <input type="text" name="work[{{ $i }}][name]" value="{{ old("work.{$i}.name", $wItem['name'] ?? '') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" required />
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Card Text</label>
                                <textarea name="work[{{ $i }}][text]" rows="3" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700" required>{{ old("work.{$i}.text", $wItem['text'] ?? '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Card Graphic/Image</label>
                                @if(!empty($wItem['image']))
                                    <div class="w-full h-24 rounded-lg overflow-hidden border border-slate-200 mb-2">
                                        <img src="{{ asset(str_starts_with($wItem['image'], 'services/') ? $wItem['image'] : 'services/' . $service->category . '/' . $wItem['image']) }}" alt="Card Image" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <input type="file" name="work[{{ $i }}][image]" accept="image/*" class="block w-full text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-semibold file:bg-cyan-50 file:text-cyan-700" />
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- TAB 3: SYSTEM SECTION & 3 STEP CARDS -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="w-9 h-9 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 font-bold">3</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">System Container & Step Cards Section</h2>
                    <p class="text-xs text-slate-500">Edit "A Complete System, Not A Quick Fix" container text, industry pills, and Phase 01, 02, 03 step cards.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="meta_system_kicker" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">System Kicker Text</label>
                    <input type="text" name="meta[system_kicker]" id="meta_system_kicker" value="{{ old('meta.system_kicker', $service->meta['system_kicker'] ?? 'HOW IT WORKS') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-semibold" />
                </div>

                <div>
                    <label for="meta_system_title" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">System Headline</label>
                    <input type="text" name="meta[system_title]" id="meta_system_title" value="{{ old('meta.system_title', $service->meta['system_title'] ?? 'A Complete System, Not A Quick Fix') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-semibold" />
                </div>
            </div>

            <div>
                <label for="meta_system_intro" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">System Intro Paragraph</label>
                <textarea name="meta[system_intro]" id="meta_system_intro" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm">{{ old('meta.system_intro', $service->meta['system_intro'] ?? '') }}</textarea>
            </div>

            <div>
                <label for="meta_system_pills" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">System Filter Pills (Comma-Separated)</label>
                <input type="text" name="meta[system_pills]" id="meta_system_pills" value="{{ old('meta.system_pills', $service->meta['system_pills'] ?? 'Corporate, E-Commerce, SaaS & Tech, Growth Brands, Enterprise') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none bg-slate-50/50 text-sm font-medium" />
            </div>

            <!-- 3 STEP CARDS EDIT -->
            <div class="pt-4 space-y-6 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">The 3 System Step Cards</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Step 01 -->
                    <div class="bg-indigo-50/50 p-5 rounded-2xl border border-indigo-100 space-y-4">
                        <span class="inline-block px-2.5 py-1 rounded-md bg-indigo-600 text-white text-[10px] font-extrabold uppercase">Step 01</span>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Title</label>
                            <input type="text" name="meta[step_01_title]" value="{{ old('meta.step_01_title', $service->meta['step_01_title'] ?? 'Match & Strategy') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Description</label>
                            <textarea name="meta[step_01_text]" rows="4" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700">{{ old('meta.step_01_text', $service->meta['step_01_text'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Step 02 -->
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
                        <span class="inline-block px-2.5 py-1 rounded-md bg-slate-800 text-white text-[10px] font-extrabold uppercase">Step 02</span>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Title</label>
                            <input type="text" name="meta[step_02_title]" value="{{ old('meta.step_02_title', $service->meta['step_02_title'] ?? 'Direct & Build') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Description</label>
                            <textarea name="meta[step_02_text]" rows="4" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700">{{ old('meta.step_02_text', $service->meta['step_02_text'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Step 03 -->
                    <div class="bg-cyan-50/50 p-5 rounded-2xl border border-cyan-100 space-y-4">
                        <span class="inline-block px-2.5 py-1 rounded-md bg-cyan-600 text-white text-[10px] font-extrabold uppercase">Step 03</span>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Title</label>
                            <input type="text" name="meta[step_03_title]" value="{{ old('meta.step_03_title', $service->meta['step_03_title'] ?? 'Package & Scale') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Description</label>
                            <textarea name="meta[step_03_text]" rows="4" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700">{{ old('meta.step_03_text', $service->meta['step_03_text'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 4: CORE FEATURES SECTION -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="w-9 h-9 rounded-xl bg-orange-50 border border-orange-100 flex items-center justify-center text-orange-600 font-bold">4</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Core Features Section</h2>
                    <p class="text-xs text-slate-500">Edit the "Key Capabilities" features displayed on the service page.</p>
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-xs text-slate-600 font-medium">Add or edit features that appear in the "Core Features Included" section.</p>
                
                <div id="features-container" class="space-y-3">
                    @php
                        $features = $service->features ?? [
                            ['icon' => 'ri-zap-line', 'title' => 'High Performance', 'text' => 'Lightning-fast load times and responsive interactions optimized for conversions.'],
                            ['icon' => 'ri-shield-check-line', 'title' => 'Secure & Reliable', 'text' => 'Enterprise-grade security with 99.9% uptime guarantee and automatic backups.'],
                            ['icon' => 'ri-customize-line', 'title' => 'Fully Customizable', 'text' => 'Tailored solutions built to match your brand identity and business goals.'],
                        ];
                    @endphp
                    
                    @foreach($features as $index => $feature)
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3" data-feature-index="{{ $index }}">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-600 uppercase">Feature {{ $index + 1 }}</span>
                                <button type="button" class="remove-feature text-xs px-2 py-1 text-rose-600 hover:bg-rose-50 rounded transition-colors">Remove</button>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Icon Class (Remixicon)</label>
                                    <input type="text" name="features[{{ $index }}][icon]" value="{{ $feature['icon'] }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-800" placeholder="ri-zap-line" />
                                    <p class="text-[10px] text-slate-400 mt-1">e.g. ri-zap-line, ri-shield-check-line, ri-customize-line</p>
                                </div>
                                
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Feature Title</label>
                                    <input type="text" name="features[{{ $index }}][title]" value="{{ $feature['title'] }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" required />
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Feature Description</label>
                                <textarea name="features[{{ $index }}][text]" rows="2" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700" required>{{ $feature['text'] }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="add-feature" class="w-full mt-4 px-4 py-2 rounded-lg border-2 border-dashed border-slate-300 text-slate-600 hover:border-slate-400 hover:text-slate-800 text-xs font-bold uppercase transition-colors">+ Add Feature</button>
            </div>
        </div>

        <!-- TAB 5: PACKAGES & PRICING -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-bold">5</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Packages & Pricing Cards</h2>
                    <p class="text-xs text-slate-500">Edit package names, prices, tags, feature checklists, and card banner images.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for($i = 0; $i < 3; $i++)
                    @php
                        $pkg = $service->packages[$i] ?? [
                            'name' => 'Package ' . ($i + 1),
                            'price' => '$' . (299 * ($i + 1)),
                            'tag' => 'TIER ' . ($i + 1),
                            'description' => '',
                            'features_text' => '',
                            'image' => null,
                        ];
                    @endphp
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-4">
                        <span class="inline-block px-2.5 py-1 rounded-md bg-emerald-600 text-white text-[10px] font-extrabold uppercase">Package {{ $i + 1 }}</span>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Package Name *</label>
                            <input type="text" name="packages[{{ $i }}][name]" value="{{ old("packages.{$i}.name", $pkg['name'] ?? '') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" required />
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Price *</label>
                                <input type="text" name="packages[{{ $i }}][price]" value="{{ old("packages.{$i}.price", $pkg['price'] ?? '') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-emerald-700" required />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Tag/Badge *</label>
                                <input type="text" name="packages[{{ $i }}][tag]" value="{{ old("packages.{$i}.tag", $pkg['tag'] ?? '') }}" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" required />
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Description</label>
                            <textarea name="packages[{{ $i }}][description]" rows="2" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700">{{ old("packages.{$i}.description", $pkg['description'] ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Features (One feature per line) *</label>
                            <textarea name="packages[{{ $i }}][features_text]" rows="5" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-mono text-slate-700" required>{{ old("packages.{$i}.features_text", $pkg['features_text'] ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Package Banner Graphic</label>
                            @if(!empty($pkg['image']))
                                <div class="w-full h-24 rounded-lg overflow-hidden border border-slate-200 mb-2">
                                    <img src="{{ asset(str_starts_with($pkg['image'], 'services/') ? $pkg['image'] : 'services/' . $service->category . '/' . $pkg['image']) }}" alt="Package Image" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input type="file" name="packages[{{ $i }}][image]" accept="image/*" class="block w-full text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-semibold file:bg-emerald-50 file:text-emerald-700" />
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="sticky bottom-4 z-40 bg-slate-900/90 backdrop-blur-md text-white p-4 rounded-2xl shadow-2xl flex items-center justify-between border border-slate-700">
            <span class="text-xs text-slate-300 font-medium">Click Save Changes to push edits live to the website.</span>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-300 hover:text-white hover:bg-white/10 transition-colors">Cancel</a>
                <button type="submit" class="px-7 py-2.5 bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white rounded-xl text-sm font-extrabold shadow-lg hover:scale-105 transition-all">Save Changes</button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addFeatureBtn = document.getElementById('add-feature');
    const featuresContainer = document.getElementById('features-container');
    let featureCount = {{ count($service->features ?? []) }};

    addFeatureBtn?.addEventListener('click', function(e) {
        e.preventDefault();
        const newFeature = document.createElement('div');
        newFeature.className = 'bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-3';
        newFeature.setAttribute('data-feature-index', featureCount);
        newFeature.innerHTML = `
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-600 uppercase">Feature ${featureCount + 1}</span>
                <button type="button" class="remove-feature text-xs px-2 py-1 text-rose-600 hover:bg-rose-50 rounded transition-colors">Remove</button>
            </div>
            
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Icon Class (Remixicon)</label>
                    <input type="text" name="features[${featureCount}][icon]" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-800" placeholder="ri-zap-line" />
                    <p class="text-[10px] text-slate-400 mt-1">e.g. ri-zap-line, ri-shield-check-line, ri-customize-line</p>
                </div>
                
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Feature Title</label>
                    <input type="text" name="features[${featureCount}][title]" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-800" required />
                </div>
            </div>
            
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Feature Description</label>
                <textarea name="features[${featureCount}][text]" rows="2" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700" required></textarea>
            </div>
        `;
        
        featuresContainer.appendChild(newFeature);
        featureCount++;
        attachRemoveListeners();
    });

    function attachRemoveListeners() {
        document.querySelectorAll('.remove-feature').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                this.closest('[data-feature-index]').remove();
            });
        });
    }

    attachRemoveListeners();
});
</script>
@endsection
