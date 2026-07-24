@extends('layouts.app')

@section('content')
@php
    $workImages = $page['work_images'] ?? [$page['image']];
    $packages = $page['packages'] ?? $category['packages'];
    $packageLabel = $page['package_label'] ?? $category['label'] . ' Packages';
    
    // Dynamic Hero & Section Metadata (Editable via Admin Panel)
    $badge = $page['badge'] ?? ($category['badge'] ?? 'DIGITAL PERFORMANCE LAB');

    $heroPills = isset($page['hero_pills']) && is_string($page['hero_pills']) 
        ? array_filter(array_map('trim', explode(',', $page['hero_pills']))) 
        : ($page['hero_pills'] ?? ['High Performance', 'Scalable Architecture', 'Modern UI/UX', 'Custom Features', 'Conversion Ready']);

    $workKicker = $page['work_kicker'] ?? 'WHAT MAKES IT WORK';
    $workTitle = $page['work_title'] ?? ('What Makes ' . $page['title'] . ' Work?');
    $workIntro = $page['work_intro'] ?? 'Strong strategic execution turns standard assets into high-converting experiences. We blend real market insights, structured design, and channel-ready deliverables so every solution drives measurable sales and growth.';

    $systemKicker = $page['system_kicker'] ?? 'HOW IT WORKS';
    $systemTitle = $page['system_title'] ?? 'A Complete System, Not A Quick Fix';
    $systemIntro = $page['system_intro'] ?? 'We turn project briefs into a smooth pipeline of structured concepts, clean deliverables, and high-performance outcomes your business can count on.';

    $systemTags = isset($page['system_pills']) && is_string($page['system_pills'])
        ? array_filter(array_map('trim', explode(',', $page['system_pills'])))
        : ($page['system_pills'] ?? ['Corporate', 'E-Commerce', 'SaaS & Tech', 'Growth Brands', 'Enterprise']);

    $step01Title = $page['step_01_title'] ?? 'Match & Strategy';
    $step01Text = $page['step_01_text'] ?? 'Find the right frameworks, code architectures, and visual styles that fit your category, target audience, and growth targets.';

    $step02Title = $page['step_02_title'] ?? 'Direct & Build';
    $step02Text = $page['step_02_text'] ?? 'Shape user journeys, proof points, responsive layouts, and clean codebase standards before full deployment begins.';

    $step03Title = $page['step_03_title'] ?? 'Package & Scale';
    $step03Text = $page['step_03_text'] ?? 'Deliver organized deliverables, documentation, asset guidelines, and performance metrics for your team.';
@endphp

<!-- SECTION 1: HERO SECTION (Reference Image Top Section) -->
<section class="relative overflow-hidden pt-28 mt-16 pb-20 bg-[#060c29]">
    <!-- Ambient Background Glows -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,_rgba(85,214,255,0.15),transparent_45%),radial-gradient(circle_at_75%_35%,_rgba(176,123,255,0.18),transparent_50%)]"></div>
    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(6,12,41,0.4)_0%,#060c29_100%)]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-12 items-center">
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-cyan-400/30 bg-[#0f225f]/70 text-[11px] font-semibold tracking-[0.2em] uppercase text-cyan-200 shadow-[0_0_15px_rgba(85,214,255,0.15)]">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    {{ strtoupper($badge) }}
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.15]">
                    {{ $page['headline'] }}
                </h1>

                <p class="max-w-2xl text-blue-100/85 text-base sm:text-lg leading-relaxed font-normal">
                    {{ $page['intro'] }}
                </p>

                <!-- CTA Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="#contact-form" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white font-bold text-sm shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">
                        <span>Get Started</span>
                        <i class="ri-arrow-right-line"></i>
                    </a>

                    <a href="#system-section" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full border border-blue-300/30 bg-white/5 backdrop-blur-md text-white font-semibold text-sm hover:bg-white/10 hover:border-cyan-300/50 transition-all duration-300">
                        <span>Explore System</span>
                        <i class="ri-compass-3-line"></i>
                    </a>
                </div>

                <!-- Trust Stack Bar -->
                <div class="pt-4 flex items-center gap-4 border-t border-indigo-300/15">
                    <div class="flex -space-x-2 overflow-hidden">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[#060c29]" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Client Avatar">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[#060c29]" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="Client Avatar">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[#060c29]" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" alt="Client Avatar">
                    </div>
                    <p class="text-xs text-blue-200/80 font-medium">
                        Trusted by <strong class="text-white font-bold">200+ businesses</strong> & enterprise clients worldwide
                    </p>
                </div>
            </div>

            <!-- Right Hero Media Card (Reference Image Style) -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-[2.5rem] overflow-hidden border border-cyan-300/30 bg-[#0c1844]/90 p-3 shadow-[0_20px_60px_rgba(0,0,0,0.45)]">
                    <div class="relative h-[420px] rounded-[2rem] overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset($page['image']) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#060c29] via-black/20 to-transparent"></div>
                        
                        <!-- Floating Feature Pills overlay at bottom of image -->
                        <div class="absolute inset-x-4 bottom-4 p-3 rounded-2xl border border-white/20 bg-black/40 backdrop-blur-md">
                            <div class="flex flex-wrap gap-1.5 justify-center">
                                @foreach($heroPills as $pill)
                                    <span class="px-3 py-1 rounded-full bg-white/20 border border-white/20 text-white text-[11px] font-medium backdrop-blur-sm shadow-sm hover:bg-cyan-400 hover:text-black transition-all cursor-default">
                                        {{ $pill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: WORK SHOWCASE CAROUSEL (Reference Image Middle Section: "What Makes UGC Work?") -->
<section class="relative py-20 bg-[#04081e] border-t border-indigo-300/10">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 md:grid-cols-12 items-end mb-12">
            <div class="md:col-span-7">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-cyan-400 mb-2">{{ $workKicker }}</p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">
                    {{ $workTitle }}
                </h2>
            </div>
            <div class="md:col-span-5">
                <p class="text-blue-100/75 text-sm sm:text-base leading-relaxed">
                    {{ $workIntro }}
                </p>
            </div>
        </div>

        <!-- Cards Showcase Row -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($page['work'] as $item)
                @php
                    $workImage = isset($item['image']) && $item['image']
                        ? (str_starts_with($item['image'], 'services/') ? $item['image'] : 'services/' . $page['category'] . '/' . $item['image'])
                        : ($workImages[$loop->index % count($workImages)] ?? 'portfolio_section.png');
                @endphp
                <article class="group relative rounded-[2rem] overflow-hidden border border-indigo-300/20 bg-[#0b153d]/80 p-3 transition-all duration-300 hover:-translate-y-2 hover:border-cyan-300/40 hover:shadow-[0_0_30px_rgba(85,214,255,0.2)]">
                    <div class="relative h-72 rounded-[1.5rem] overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset($workImage) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#04081e] via-[#04081e]/40 to-transparent opacity-90 transition-opacity group-hover:opacity-75"></div>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full border border-cyan-300/30 bg-[#09153e]/80 backdrop-blur-md text-[10px] font-bold uppercase tracking-wider text-cyan-200">
                                {{ $item['label'] }}
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <h3 class="text-xl font-bold leading-snug text-white group-hover:text-cyan-200 transition-colors">{{ $item['name'] }}</h3>
                            <p class="mt-1 text-xs text-blue-100/75 line-clamp-2 leading-relaxed">{{ $item['text'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 3: SYSTEM CARD WITH FLOATING TILTED CARDS (Reference Image Bottom Container Section) -->
<section id="system-section" class="relative py-20 bg-[#060c29] overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Large System Container -->
        <div class="relative rounded-[3rem] overflow-hidden border border-indigo-400/30 bg-gradient-to-br from-[#2e1c9e] via-[#1b1454] to-[#0d092e] p-8 sm:p-12 shadow-[0_30px_90px_rgba(0,0,0,0.5)]">
            <!-- Background Abstract Geometry -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-cyan-400/20 via-indigo-500/10 to-transparent rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative text-center max-w-3xl mx-auto mb-10">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-cyan-300 mb-3">{{ $systemKicker }}</p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                    {{ $systemTitle }}
                </h2>
                <p class="mt-4 text-blue-100/85 text-sm sm:text-base leading-relaxed">
                    {{ $systemIntro }}
                </p>

                <!-- System Industry Filter Pills -->
                <div class="mt-6 flex flex-wrap justify-center gap-2">
                    @foreach($systemTags as $stag)
                        <span class="px-4 py-1.5 rounded-full border border-white/20 bg-white/10 text-xs font-semibold text-white backdrop-blur-md hover:bg-cyan-400 hover:text-black transition-all cursor-default">
                            {{ $stag }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- 3 Floating Tilted Step Cards (Exact Reference Image Card Style) -->
            <div class="relative mt-12 grid gap-6 md:grid-cols-3 items-stretch">
                <!-- Card 1: Signature Gradient Accent (Tilted Left) -->
                <div class="group relative rounded-3xl p-6 bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white shadow-[0_0_25px_rgba(145,92,255,0.45)] md:-rotate-2 transition-transform duration-300 hover:rotate-0 hover:scale-105 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-white/20 flex items-center justify-center font-extrabold text-lg mb-4 text-white">
                            01
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">{{ $step01Title }}</h3>
                        <p class="text-xs sm:text-sm font-medium text-blue-50/90 leading-relaxed">
                            {{ $step01Text }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white/20 flex items-center justify-between text-xs font-bold text-white">
                        <span>Phase 01</span>
                        <i class="ri-arrow-right-line"></i>
                    </div>
                </div>

                <!-- Card 2: High-Contrast Dark Glass (Center Card) -->
                <div class="group relative rounded-3xl p-6 bg-[#0c194a]/95 border border-cyan-300/35 text-white shadow-2xl transition-transform duration-300 hover:scale-105 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-cyan-400/20 border border-cyan-400/40 flex items-center justify-center font-extrabold text-lg mb-4 text-cyan-200">
                            02
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">{{ $step02Title }}</h3>
                        <p class="text-xs sm:text-sm font-medium text-blue-100/90 leading-relaxed">
                            {{ $step02Text }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-cyan-300/20 flex items-center justify-between text-xs font-bold text-cyan-200">
                        <span>Phase 02</span>
                        <i class="ri-arrow-right-line"></i>
                    </div>
                </div>

                <!-- Card 3: Electric Cyan (Tilted Right) -->
                <div class="group relative rounded-3xl p-6 bg-gradient-to-br from-[#06b6d4] to-[#0284c7] text-white shadow-xl md:rotate-2 transition-transform duration-300 hover:rotate-0 hover:scale-105 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-white/20 flex items-center justify-center font-extrabold text-lg mb-4 text-white">
                            03
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">{{ $step03Title }}</h3>
                        <p class="text-xs sm:text-sm font-medium text-cyan-50 leading-relaxed">
                            {{ $step03Text }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white/20 flex items-center justify-between text-xs font-bold text-white">
                        <span>Phase 03</span>
                        <i class="ri-arrow-right-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: MONOCHROMATIC TRUST LOGOS BAR (Bottom of Reference Image) -->
        <div class="mt-16 pt-8 border-t border-indigo-300/15">
            <p class="text-center text-xs font-bold tracking-[0.2em] text-blue-200/50 uppercase mb-8">POWERING INNOVATION WITH MODERN TECH & TRUSTED STANDARDS</p>
            <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <span class="text-xl sm:text-2xl font-black tracking-widest text-white hover:text-cyan-400">NVIDIA</span>
                <span class="text-xl sm:text-2xl font-extrabold tracking-tight text-white hover:text-cyan-400">amazon</span>
                <span class="text-xl sm:text-2xl font-bold tracking-normal text-white hover:text-cyan-400">Google</span>
                <span class="text-xl sm:text-2xl font-black tracking-wider text-white hover:text-cyan-400">META</span>
                <span class="text-xl sm:text-2xl font-extrabold tracking-widest text-white hover:text-cyan-400">NETFLIX</span>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 5: FEATURES & CAPABILITIES -->
<section class="relative py-20 bg-[#04081e]">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/30 bg-[#0f225f]/70 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-200 mb-3">KEY CAPABILITIES</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">Core Features Included</h2>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($page['features'] as $feature)
                <article class="group rounded-[2rem] border border-indigo-300/20 bg-[#0b153d]/80 p-8 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:border-cyan-300/40 hover:shadow-[0_0_25px_rgba(85,214,255,0.18)]">
                    <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-cyan-400/10 text-cyan-300 text-2xl border border-cyan-400/25 group-hover:scale-110 transition-transform">
                        <i class="{{ $feature['icon'] }}"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-white group-hover:text-cyan-200 transition-colors">{{ $feature['title'] }}</h3>
                    <p class="mt-3 text-blue-100/75 text-sm leading-relaxed">{{ $feature['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 6: PACKAGES & PRICING -->
<section class="relative py-20 bg-[#060c29] border-t border-indigo-300/10">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/30 bg-[#0f225f]/70 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-200 mb-3">{{ $packageLabel }}</p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">Choose Your Package</h2>
                <p class="mt-3 max-w-2xl text-blue-100/75 text-sm sm:text-base leading-relaxed">Tailored packages designed for different business stages with clear deliverables and transparent options.</p>
            </div>
            <a href="#contact-form" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3.5 rounded-full font-bold shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Request Custom Quote <i class="ri-arrow-right-line"></i></a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($packages as $package)
                @php
                    $packageImage = isset($package['image']) && $package['image']
                        ? (str_starts_with($package['image'], 'services/') ? $package['image'] : 'services/' . $page['category'] . '/' . $package['image'])
                        : ($workImages[$loop->index % count($workImages)] ?? 'portfolio_section.png');
                @endphp
                <article class="group overflow-hidden rounded-[2.5rem] border border-indigo-300/20 bg-[#0b153d]/85 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:border-cyan-300/40">
                    <div class="relative h-48 bg-cover bg-center" style="background-image: url('{{ asset($packageImage) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0b153d] via-[#0b153d]/50 to-transparent"></div>
                        <span class="absolute left-5 top-5 inline-flex items-center rounded-full border border-white/20 bg-black/40 px-3.5 py-1 text-[10px] font-bold uppercase tracking-wider text-cyan-200 backdrop-blur-md">{{ $package['tag'] }}</span>
                        <div class="absolute inset-x-5 bottom-4">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-cyan-400">{{ $page['title'] }}</p>
                            <h3 class="mt-1 text-2xl font-bold text-white">{{ $package['name'] }}</h3>
                        </div>
                    </div>
                    <div class="p-6 sm:p-8">
                        <div class="flex items-start justify-between gap-4 pb-4 border-b border-indigo-300/15">
                            <div>
                                <p class="text-xs text-blue-200/70">Starting Investment</p>
                                <p class="text-3xl font-extrabold text-white mt-1">{{ $package['price'] }}</p>
                            </div>
                        </div>
                        <p class="mt-4 text-blue-100/75 text-xs sm:text-sm leading-relaxed">{{ $package['description'] ?? ('Complete ' . strtolower($page['title']) . ' package tailored for growth.') }}</p>
                        
                        <ul class="mt-6 space-y-3">
                            @foreach($package['features'] as $feature)
                                <li class="flex items-center gap-3 text-xs sm:text-sm text-blue-100/85">
                                    <i class="ri-checkbox-circle-fill text-cyan-400 text-base"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <a href="#contact-form" class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-full border border-cyan-400/40 bg-cyan-400/10 px-5 py-3.5 text-sm font-bold text-cyan-200 hover:bg-cyan-400 hover:text-black transition-all duration-300">
                            Choose {{ $package['name'] }} <i class="ri-arrow-right-up-line"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 7: CONTACT FORM -->
<section id="contact-form" class="relative py-20 bg-[#04081e] overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/30 bg-[#0f225f]/70 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-200 mb-3">GET IN TOUCH</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">Start Your {{ $page['title'] }} Project</h2>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-400/30 bg-emerald-400/10 px-5 py-4 text-sm text-emerald-200 font-semibold">{{ session('success') }}</div>
        @endif

        <form class="grid gap-6 lg:grid-cols-2 max-w-5xl mx-auto" method="post" action="{{ route('contact.submit') }}">
            @csrf
            <div class="space-y-4">
                <input type="text" name="name" placeholder="Your Name *" required class="w-full rounded-2xl border border-indigo-300/20 bg-[#0c1844] px-5 py-4 text-white placeholder:text-blue-200/50 focus:border-cyan-400 focus:outline-none transition-colors text-sm" />
                <input type="text" name="business_name" placeholder="Your Business Name" class="w-full rounded-2xl border border-indigo-300/20 bg-[#0c1844] px-5 py-4 text-white placeholder:text-blue-200/50 focus:border-cyan-400 focus:outline-none transition-colors text-sm" />
                <input type="email" name="email" placeholder="Your Email Address *" required class="w-full rounded-2xl border border-indigo-300/20 bg-[#0c1844] px-5 py-4 text-white placeholder:text-blue-200/50 focus:border-cyan-400 focus:outline-none transition-colors text-sm" />
                <input type="text" name="phone" placeholder="Your Phone Number" class="w-full rounded-2xl border border-indigo-300/20 bg-[#0c1844] px-5 py-4 text-white placeholder:text-blue-200/50 focus:border-cyan-400 focus:outline-none transition-colors text-sm" />
                <select name="service" class="w-full rounded-2xl border border-indigo-300/20 bg-[#0c1844] px-5 py-4 text-white focus:border-cyan-400 focus:outline-none transition-colors text-sm">
                    <option value="{{ $slug }}" selected>{{ $page['title'] }}</option>
                    <option value="logo-visual-identity">Logo & Visual Identity</option>
                    <option value="corporate-websites">Corporate Websites</option>
                    <option value="android-development">Android Development</option>
                    <option value="erp-solutions">ERP Solutions</option>
                    <option value="rest-api-development">REST API Development</option>
                    <option value="ai-chatbots">AI Chatbots</option>
                    <option value="search-engine-optimization">Search Engine Optimization</option>
                </select>
            </div>

            <div class="space-y-4 flex flex-col justify-between">
                <textarea name="message" rows="8" placeholder="Tell us about your project goals, timelines, and ideas... *" required class="w-full rounded-2xl border border-indigo-300/20 bg-[#0c1844] px-5 py-4 text-white placeholder:text-blue-200/50 focus:border-cyan-400 focus:outline-none transition-colors text-sm"></textarea>
                <button type="submit" class="w-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-4 rounded-2xl font-bold shadow-[0_0_25px_rgba(145,92,255,0.45)] hover:scale-[1.02] transition-all duration-300">
                    Submit Request <i class="ri-send-plane-fill ml-1"></i>
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
