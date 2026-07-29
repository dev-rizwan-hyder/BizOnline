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
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-cyan-300/50 bg-gradient-to-r from-cyan-500/15 to-indigo-500/15 backdrop-blur-xl text-[10px] font-semibold tracking-[0.2em] uppercase text-cyan-100 shadow-[0_0_20px_rgba(85,214,255,0.2)] animate-fade-in">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    {{ strtoupper($badge) }}
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-[1.1] tracking-tight animate-slide-up">
                    {{ $page['headline'] }}
                </h1>

                <p class="max-w-2xl text-blue-100/90 text-base sm:text-lg leading-relaxed font-medium">
                    {{ $page['intro'] }}
                </p>

                <!-- CTA Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-3 animate-slide-in-left" style="animation-delay: 0.3s;">
                    <a href="#contact-form" class="inline-flex items-center gap-2 px-7 py-3 rounded-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white font-bold text-xs shadow-[0_0_25px_rgba(145,92,255,0.5)] hover:scale-110 transition-all duration-300 active:scale-95">
                        <span>Get Started</span>
                        <i class="ri-arrow-right-line text-sm"></i>
                    </a>

                    <a href="#system-section" class="inline-flex items-center gap-2 px-7 py-3 rounded-full border border-blue-300/40 bg-white/8 backdrop-blur-lg text-white font-semibold text-xs hover:bg-white/15 hover:border-cyan-300/70 transition-all duration-300">
                        <span>Explore System</span>
                        <i class="ri-compass-3-line text-sm"></i>
                    </a>
                </div>

                <!-- Trust Stack Bar -->
                <div class="pt-4 flex items-center gap-3 border-t border-indigo-300/20 animate-slide-in-left" style="animation-delay: 0.5s;">
                    <div class="flex -space-x-2 overflow-hidden">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[#060c29] shadow-lg" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Client Avatar">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[#060c29] shadow-lg" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="Client Avatar">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[#060c29] shadow-lg" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" alt="Client Avatar">
                    </div>
                    <p class="text-xs text-blue-200/90 font-medium">
                        Trusted by <strong class="text-white font-bold">200+ businesses</strong> worldwide
                    </p>
                </div>
            </div>

            <!-- Right Hero Media Card (Reference Image Style) -->
            <div class="lg:col-span-5 relative animate-slide-in-right">
                <div class="relative rounded-[2.5rem] overflow-hidden border border-cyan-300/40 bg-[#0c1844]/90 p-4 shadow-[0_25px_75px_rgba(0,0,0,0.5)] group hover:border-cyan-300/70 transition-all duration-500">
                    <div class="relative h-[420px] rounded-[2rem] overflow-hidden bg-cover bg-center shadow-inner" style="background-image: url('{{ asset($page['image']) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#060c29] via-black/30 to-transparent group-hover:via-black/20 transition-all duration-500"></div>
                        
                        <!-- Floating Feature Pills overlay at bottom of image -->
                        <div class="absolute inset-x-4 bottom-4 p-4 rounded-2xl border border-white/25 bg-black/50 backdrop-blur-xl transition-all duration-300 group-hover:border-white/40 group-hover:bg-black/60 animate-scale-in">
                            <div class="flex flex-wrap gap-2 justify-center">
                                @foreach($heroPills as $pill)
                                    <span class="px-3 py-1.5 rounded-full bg-white/20 border border-white/30 text-white text-[11px] font-semibold backdrop-blur-sm shadow-md hover:bg-cyan-400 hover:text-black transition-all cursor-default">
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
        <div class="grid gap-8 md:grid-cols-12 items-end mb-12">
            <div class="md:col-span-7">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-cyan-400 mb-2 animate-fade-in">{{ $workKicker }}</p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight animate-slide-up">
                    {{ $workTitle }}
                </h2>
            </div>
            <div class="md:col-span-5">
                <p class="text-blue-100/85 text-xs sm:text-sm leading-relaxed font-medium animate-slide-in-right">
                    {{ $workIntro }}
                </p>
            </div>
        </div>

        <!-- Cards Showcase Row -->
        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($page['work'] as $item)
                @php
                    $workImage = isset($item['image']) && $item['image']
                        ? (str_starts_with($item['image'], 'services/') ? $item['image'] : 'services/' . $page['category'] . '/' . $item['image'])
                        : ($workImages[$loop->index % count($workImages)] ?? 'portfolio_section.png');
                    $delay = $loop->index * 0.1;
                @endphp
                <article class="group relative rounded-[2rem] overflow-hidden border border-indigo-300/25 bg-[#0b153d]/80 p-3 transition-all duration-400 hover:-translate-y-3 hover:border-cyan-300/50 hover:shadow-[0_15px_40px_rgba(85,214,255,0.3)] animate-scale-in" style="animation-delay: {{ $delay }}s;">
                    <div class="relative h-64 rounded-[1.5rem] overflow-hidden bg-cover bg-center shadow-inner" style="background-image: url('{{ asset($workImage) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#04081e] via-[#04081e]/50 to-transparent opacity-85 group-hover:opacity-70 transition-opacity duration-400"></div>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full border border-cyan-300/40 bg-[#09153e]/90 backdrop-blur-lg text-[9px] font-bold uppercase tracking-wider text-cyan-200 shadow-md">
                                {{ $item['label'] }}
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <h3 class="text-lg font-bold leading-snug text-white group-hover:text-cyan-200 transition-colors duration-300">{{ $item['name'] }}</h3>
                            <p class="mt-1 text-xs text-blue-100/80 line-clamp-2 leading-relaxed font-medium">{{ $item['text'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 3: SYSTEM CARD WITH FLOATING TILTED CARDS (Reference Image Bottom Container Section) -->
<section id="system-section" class="relative py-24 bg-[#060c29] overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Large System Container -->
        <div class="relative rounded-[3rem] overflow-hidden border border-indigo-400/35 bg-gradient-to-br from-[#3a2a7f] via-[#1e1a5f] to-[#0d0a2e] p-10 sm:p-16 shadow-[0_35px_100px_rgba(0,0,0,0.6)] animate-scale-in">
            <!-- Background Abstract Geometry -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-cyan-400/25 via-indigo-500/15 to-transparent rounded-full blur-3xl pointer-events-none animate-fade-in"></div>

            <div class="relative text-center max-w-3xl mx-auto mb-12">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-cyan-300 mb-3 animate-fade-in">{{ $systemKicker }}</p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight animate-slide-up mb-4">
                    {{ $systemTitle }}
                </h2>
                <p class="text-blue-100/90 text-sm sm:text-base leading-relaxed font-medium animate-slide-in-left">
                    {{ $systemIntro }}
                </p>

                <!-- System Industry Filter Pills -->
                <div class="mt-6 flex flex-wrap justify-center gap-2">
                    @foreach($systemTags as $stag)
                        <span class="px-4 py-1.5 rounded-full border border-white/25 bg-white/12 text-xs font-semibold text-white/90 backdrop-blur-lg hover:bg-cyan-400/20 hover:text-cyan-100 hover:border-cyan-300/50 transition-all cursor-default shadow-sm">
                            {{ $stag }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- 3 Floating Tilted Step Cards (Exact Reference Image Card Style) -->
            <div class="relative mt-12 grid gap-6 md:grid-cols-3 items-stretch">
                <!-- Card 1: Signature Gradient Accent (Tilted Left) -->
                <div class="group relative rounded-3xl p-6 bg-gradient-to-br from-cyan-400 via-indigo-500 to-fuchsia-500 text-white shadow-[0_0_35px_rgba(145,92,255,0.55)] md:-rotate-2 transition-all duration-400 hover:rotate-0 hover:scale-105 hover:shadow-[0_0_50px_rgba(145,92,255,0.75)] flex flex-col justify-between animate-slide-in-left">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-white/25 backdrop-blur flex items-center justify-center font-extrabold text-xl mb-4 text-white shadow-lg group-hover:bg-white/35 transition-all">
                            01
                        </div>
                        <h3 class="text-xl font-black text-white mb-3">{{ $step01Title }}</h3>
                        <p class="text-xs font-medium text-white/95 leading-relaxed">
                            {{ $step01Text }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white/30 flex items-center justify-between text-xs font-bold text-white">
                        <span>Phase 01</span>
                        <i class="ri-arrow-right-line text-sm"></i>
                    </div>
                </div>

                <!-- Card 2: High-Contrast Dark Glass (Center Card) -->
                <div class="group relative rounded-3xl p-6 bg-[#0d1f54]/97 border border-cyan-300/45 text-white shadow-[0_0_40px_rgba(34,211,238,0.3)] transition-all duration-400 hover:scale-105 hover:shadow-[0_0_60px_rgba(34,211,238,0.5)] flex flex-col justify-between animate-scale-in">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-cyan-400/30 border border-cyan-400/60 flex items-center justify-center font-extrabold text-xl mb-4 text-cyan-100 shadow-lg group-hover:bg-cyan-400/40 transition-all">
                            02
                        </div>
                        <h3 class="text-xl font-black text-white mb-3">{{ $step02Title }}</h3>
                        <p class="text-xs font-medium text-blue-100/95 leading-relaxed">
                            {{ $step02Text }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-cyan-300/30 flex items-center justify-between text-xs font-bold text-cyan-200">
                        <span>Phase 02</span>
                        <i class="ri-arrow-right-line text-sm"></i>
                    </div>
                </div>

                <!-- Card 3: Electric Cyan (Tilted Right) -->
                <div class="group relative rounded-3xl p-6 bg-gradient-to-br from-[#06b6d4] to-[#0284c7] text-white shadow-[0_0_35px_rgba(34,211,238,0.6)] md:rotate-2 transition-all duration-400 hover:rotate-0 hover:scale-105 hover:shadow-[0_0_50px_rgba(34,211,238,0.8)] flex flex-col justify-between animate-slide-in-right">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-white/25 backdrop-blur flex items-center justify-center font-extrabold text-xl mb-4 text-white shadow-lg group-hover:bg-white/35 transition-all">
                            03
                        </div>
                        <h3 class="text-xl font-black text-white mb-3">{{ $step03Title }}</h3>
                        <p class="text-xs font-medium text-cyan-50 leading-relaxed">
                            {{ $step03Text }}
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white/30 flex items-center justify-between text-xs font-bold text-white">
                        <span>Phase 03</span>
                        <i class="ri-arrow-right-line text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: MONOCHROMATIC TRUST LOGOS BAR (Bottom of Reference Image) -->
        <div class="mt-16 pt-8 border-t border-indigo-300/20">
            <p class="text-center text-xs font-bold tracking-[0.2em] text-blue-200/60 uppercase mb-8">POWERING INNOVATION WITH MODERN TECH & TRUSTED STANDARDS</p>
            <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12 md:gap-16 opacity-70 grayscale hover:grayscale-0 transition-all duration-700">
                <span class="text-lg sm:text-xl font-black tracking-widest text-white hover:text-cyan-400 cursor-default transition-colors">NVIDIA</span>
                <span class="text-lg sm:text-xl font-extrabold tracking-tight text-white hover:text-cyan-400 cursor-default transition-colors">amazon</span>
                <span class="text-lg sm:text-xl font-bold tracking-normal text-white hover:text-cyan-400 cursor-default transition-colors">Google</span>
                <span class="text-lg sm:text-xl font-black tracking-wider text-white hover:text-cyan-400 cursor-default transition-colors">META</span>
                <span class="text-lg sm:text-xl font-extrabold tracking-widest text-white hover:text-cyan-400 cursor-default transition-colors">NETFLIX</span>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 5: FEATURES & CAPABILITIES -->
<section class="relative py-20 bg-[#04081e]">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/40 bg-[#0f2260]/80 text-[10px] font-semibold tracking-[0.18em] uppercase text-cyan-200 mb-3 animate-fade-in">KEY CAPABILITIES</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-3 animate-slide-up">Core Features Included</h2>
            <p class="text-blue-100/80 text-sm sm:text-base max-w-2xl mx-auto animate-slide-in-left">Comprehensive tools and features designed to maximize performance and drive measurable results</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($page['features'] as $feature)
                <article class="group rounded-[2rem] border border-indigo-300/25 bg-[#0b153d]/85 p-6 shadow-xl transition-all duration-400 hover:-translate-y-3 hover:border-cyan-300/50 hover:shadow-[0_15px_40px_rgba(85,214,255,0.3)] animate-scale-in">
                    <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-cyan-400/15 text-cyan-300 text-2xl border border-cyan-400/35 group-hover:scale-125 group-hover:bg-cyan-400/25 transition-all duration-300 shadow-lg">
                        <i class="{{ $feature['icon'] }}"></i>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-white group-hover:text-cyan-200 transition-colors duration-300">{{ $feature['title'] }}</h3>
                    <p class="mt-3 text-blue-100/80 text-xs leading-relaxed font-medium">{{ $feature['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 6: PACKAGES & PRICING -->
<section class="relative py-20 bg-[#060c29] border-t border-indigo-300/15">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/40 bg-[#0f2260]/80 text-[10px] font-semibold uppercase tracking-[0.18em] text-cyan-200 mb-3 animate-fade-in">{{ $packageLabel }}</p>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-3 animate-slide-up">Choose Your Package</h2>
                <p class="max-w-2xl text-blue-100/85 text-sm sm:text-base leading-relaxed font-medium animate-slide-in-left">Tailored packages designed for different business stages with clear deliverables and transparent pricing options.</p>
            </div>
            <a href="#contact-form" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full font-bold text-xs shadow-[0_0_25px_rgba(145,92,255,0.5)] hover:scale-110 transition-all duration-300 active:scale-95 whitespace-nowrap">Request Custom Quote <i class="ri-arrow-right-line text-sm"></i></a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($packages as $package)
                @php
                    $packageImage = isset($package['image']) && $package['image']
                        ? (str_starts_with($package['image'], 'services/') ? $package['image'] : 'services/' . $page['category'] . '/' . $package['image'])
                        : ($workImages[$loop->index % count($workImages)] ?? 'portfolio_section.png');
                    $delay = $loop->index * 0.15;
                @endphp
                <article class="group overflow-hidden rounded-[2.5rem] border border-indigo-300/25 bg-[#0b153d]/90 shadow-xl transition-all duration-400 hover:-translate-y-3 hover:border-cyan-300/50 hover:shadow-[0_20px_50px_rgba(85,214,255,0.3)] animate-scale-in" style="animation-delay: {{ $delay }}s;">
                    <div class="relative h-48 bg-cover bg-center shadow-inner overflow-hidden" style="background-image: url('{{ asset($packageImage) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0b153d] via-[#0b153d]/60 to-transparent group-hover:via-[#0b153d]/40 transition-all duration-400"></div>
                        <span class="absolute left-5 top-5 inline-flex items-center rounded-full border border-white/30 bg-black/50 px-3.5 py-1 text-[9px] font-bold uppercase tracking-wider text-cyan-200 backdrop-blur-lg shadow-lg">{{ $package['tag'] }}</span>
                        <div class="absolute inset-x-5 bottom-4">
                            <p class="text-[9px] font-bold uppercase tracking-widest text-cyan-400">{{ $page['title'] }}</p>
                            <h3 class="mt-1 text-2xl font-black text-white leading-tight">{{ $package['name'] }}</h3>
                        </div>
                    </div>
                    <div class="p-6 sm:p-7">
                        <div class="flex items-start justify-between gap-4 pb-4 border-b border-indigo-300/20">
                            <div>
                                <p class="text-xs text-blue-200/75 font-semibold uppercase tracking-wider">Starting Investment</p>
                                <p class="text-3xl font-black text-transparent bg-gradient-to-r from-cyan-400 to-indigo-500 bg-clip-text mt-1">{{ $package['price'] }}</p>
                            </div>
                        </div>
                        <p class="mt-4 text-blue-100/85 text-xs leading-relaxed font-medium">{{ $package['description'] ?? ('Complete ' . strtolower($page['title']) . ' package tailored for growth.') }}</p>
                        
                        <ul class="mt-5 space-y-3">
                            @foreach($package['features'] as $feature)
                                <li class="flex items-start gap-2.5 text-xs text-blue-100/90 font-medium">
                                    <i class="ri-checkbox-circle-fill text-cyan-400 text-sm shrink-0 mt-0.5"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <a href="#contact-form" class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-full border border-cyan-400/50 bg-cyan-400/15 px-5 py-3 text-xs font-bold text-cyan-200 hover:bg-cyan-400 hover:text-black hover:border-cyan-400 transition-all duration-300 active:scale-95 shadow-lg">
                            Choose {{ $package['name'] }} <i class="ri-arrow-right-up-line text-sm"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 7: CONTACT FORM -->
<section id="contact-form" class="relative py-20 bg-[#04081e] overflow-hidden">
    <!-- Background Ambient Effects -->
    <div class="absolute top-0 left-1/4 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl opacity-40 pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/40 bg-[#0f2260]/80 text-[10px] font-semibold uppercase tracking-[0.18em] text-cyan-200 mb-3 animate-fade-in">GET IN TOUCH</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-2 animate-slide-up">Start Your {{ $page['title'] }} Project</h2>
            <p class="text-blue-100/80 text-sm sm:text-base max-w-2xl mx-auto animate-slide-in-left">Get in touch with our team to discuss your project requirements and receive a personalized proposal within 24 hours.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-400/40 bg-emerald-400/15 px-5 py-4 text-xs text-emerald-200 font-semibold animate-scale-in" role="alert">
                <i class="ri-check-double-line mr-2 text-sm"></i>{{ session('success') }}
            </div>
        @endif

        <form class="grid gap-6 lg:grid-cols-2 max-w-5xl mx-auto" method="post" action="{{ route('contact.submit') }}">
            @csrf
            <div class="space-y-4">
                <div class="relative group animate-slide-in-left" style="animation-delay: 0.1s;">
                    <label class="block text-xs font-bold uppercase tracking-wider text-blue-200/70 mb-2">Full Name *</label>
                    <input type="text" name="name" placeholder="John Doe" required class="w-full rounded-2xl border border-indigo-300/25 bg-[#0c1844]/80 backdrop-blur px-5 py-3 text-white placeholder:text-blue-200/40 focus:border-cyan-400/70 focus:bg-[#0c1844] focus:outline-none focus:shadow-[0_0_20px_rgba(34,211,238,0.2)] transition-all text-sm font-medium" />
                </div>
                <div class="relative group animate-slide-in-left" style="animation-delay: 0.15s;">
                    <label class="block text-xs font-bold uppercase tracking-wider text-blue-200/70 mb-2">Business Name</label>
                    <input type="text" name="business_name" placeholder="Your Company" class="w-full rounded-2xl border border-indigo-300/25 bg-[#0c1844]/80 backdrop-blur px-5 py-3 text-white placeholder:text-blue-200/40 focus:border-cyan-400/70 focus:bg-[#0c1844] focus:outline-none focus:shadow-[0_0_20px_rgba(34,211,238,0.2)] transition-all text-sm font-medium" />
                </div>
                <div class="relative group animate-slide-in-left" style="animation-delay: 0.2s;">
                    <label class="block text-xs font-bold uppercase tracking-wider text-blue-200/70 mb-2">Email Address *</label>
                    <input type="email" name="email" placeholder="you@company.com" required class="w-full rounded-2xl border border-indigo-300/25 bg-[#0c1844]/80 backdrop-blur px-5 py-3 text-white placeholder:text-blue-200/40 focus:border-cyan-400/70 focus:bg-[#0c1844] focus:outline-none focus:shadow-[0_0_20px_rgba(34,211,238,0.2)] transition-all text-sm font-medium" />
                </div>
                <div class="relative group animate-slide-in-left" style="animation-delay: 0.25s;">
                    <label class="block text-xs font-bold uppercase tracking-wider text-blue-200/70 mb-2">Phone Number</label>
                    <input type="text" name="phone" placeholder="+1 (555) 123-4567" class="w-full rounded-2xl border border-indigo-300/25 bg-[#0c1844]/80 backdrop-blur px-5 py-3 text-white placeholder:text-blue-200/40 focus:border-cyan-400/70 focus:bg-[#0c1844] focus:outline-none focus:shadow-[0_0_20px_rgba(34,211,238,0.2)] transition-all text-sm font-medium" />
                </div>
                <div class="relative group animate-slide-in-left" style="animation-delay: 0.3s;">
                    <label class="block text-xs font-bold uppercase tracking-wider text-blue-200/70 mb-2">Service Interest</label>
                    <select name="service" class="w-full rounded-2xl border border-indigo-300/25 bg-[#0c1844]/80 backdrop-blur px-5 py-3 text-white focus:border-cyan-400/70 focus:bg-[#0c1844] focus:outline-none focus:shadow-[0_0_20px_rgba(34,211,238,0.2)] transition-all text-sm font-medium">
                        <option value="{{ $slug }}" selected class="bg-[#0c1844]">{{ $page['title'] }}</option>
                        <option value="logo-visual-identity" class="bg-[#0c1844]">Logo & Visual Identity</option>
                        <option value="corporate-websites" class="bg-[#0c1844]">Corporate Websites</option>
                        <option value="android-development" class="bg-[#0c1844]">Android Development</option>
                        <option value="erp-solutions" class="bg-[#0c1844]">ERP Solutions</option>
                        <option value="rest-api-development" class="bg-[#0c1844]">REST API Development</option>
                        <option value="ai-chatbots" class="bg-[#0c1844]">AI Chatbots</option>
                        <option value="search-engine-optimization" class="bg-[#0c1844]">Search Engine Optimization</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4 flex flex-col justify-between animate-slide-in-right">
                <div class="relative group" style="animation-delay: 0.1s;">
                    <label class="block text-xs font-bold uppercase tracking-wider text-blue-200/70 mb-2">Project Message *</label>
                    <textarea name="message" rows="8" placeholder="Tell us about your project goals, scope, timeline, and any specific requirements..." required class="w-full rounded-2xl border border-indigo-300/25 bg-[#0c1844]/80 backdrop-blur px-5 py-3 text-white placeholder:text-blue-200/40 focus:border-cyan-400/70 focus:bg-[#0c1844] focus:outline-none focus:shadow-[0_0_20px_rgba(34,211,238,0.2)] transition-all text-sm font-medium resize-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3.5 rounded-2xl font-bold text-sm shadow-[0_0_30px_rgba(145,92,255,0.5)] hover:scale-105 transition-all duration-300 active:scale-95 flex items-center justify-center gap-2">
                    Submit Request <i class="ri-send-plane-fill text-sm"></i>
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
