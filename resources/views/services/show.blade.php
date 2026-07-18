@extends('layouts.app')

@section('content')
@php
    $workImages = $page['work_images'] ?? [$page['image']];
    $packages = $page['packages'] ?? $category['packages'];
    $packageLabel = $page['package_label'] ?? $category['label'] . ' Packages';
@endphp

<section class="relative overflow-hidden pt-28 mt-20 pb-24 bg-[#0e173e]">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.18),transparent_30%),radial-gradient(circle_at_right,_rgba(45,212,255,0.15),transparent_40%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2 items-center">
            <div class="space-y-6">
                <p class="inline-flex items-center px-4 py-2 rounded-full border border-orange-300/30 bg-orange-500/10 text-[11px] font-semibold tracking-[0.18em] uppercase text-orange-200">{{ $category['badge'] }}</p>
                <h1 class="text-4xl md:text-5xl font-bold text-white max-w-3xl">{{ $page['headline'] }}</h1>
                <p class="max-w-2xl text-blue-100/80 text-lg leading-relaxed">{{ $page['intro'] }}</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact.show') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Get Started <i class="ri-arrow-right-line"></i></a>
                    <a href="{{ route('work') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">View Our Work</a>
                </div>
            </div>
            <div class="relative rounded-[2rem] overflow-hidden border border-white/10 bg-[#141a3f]/95 shadow-[0_30px_80px_rgba(4,14,54,0.35)]">
                <div class="relative h-96 bg-cover bg-center" style="background-image: url('{{ asset($page['image']) }}');">
                    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
                    <div class="absolute left-6 bottom-6 right-6 rounded-3xl bg-white/10 border border-white/10 p-6">
                        <p class="text-sm uppercase tracking-[0.24em] text-orange-200">{{ $category['hero_kicker'] }}</p>
                        <h2 class="mt-3 text-3xl font-semibold text-white">{{ $category['hero_title'] }}</h2>
                        <p class="mt-3 text-blue-100/80 text-sm">{{ $category['hero_text'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0b1234]">
    <div class="absolute inset-x-0 top-0 h-36 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.16),transparent_50%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($page['features'] as $feature)
                <article class="group rounded-[2rem] border border-white/10 bg-[#111739]/95 p-8 shadow-[0_20px_60px_rgba(0,0,0,0.2)] transition-transform duration-300 hover:-translate-y-2">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full bg-cyan-500/10 text-cyan-300 text-xl border border-cyan-500/20">
                        <i class="{{ $feature['icon'] }}"></i>
                    </div>
                    <h3 class="mt-6 text-2xl font-semibold text-white">{{ $feature['title'] }}</h3>
                    <p class="mt-4 text-blue-100/75 text-sm leading-relaxed">{{ $feature['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0e173e]">
    <div class="absolute inset-x-0 top-0 h-36 bg-[radial-gradient(circle_at_top,_rgba(81,214,255,0.14),transparent_50%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-orange-300/20 bg-orange-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-orange-200 mb-4">Dummy Work</p>
            <h2 class="text-4xl md:text-5xl font-bold text-white">Have a Look</h2>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($page['work'] as $item)
                @php
                    $workImage = isset($item['image']) && $item['image']
                        ? (str_starts_with($item['image'], 'services/') ? $item['image'] : 'services/' . $page['category'] . '/' . $item['image'])
                        : ($workImages[$loop->index % count($workImages)] ?? 'portfolio_section.png');
                @endphp
                <article class="overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.2)] transition-transform duration-300 hover:-translate-y-2">
                    <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset($workImage) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-[#020917]/35 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 rounded-3xl bg-black/35 border border-white/10 px-4 py-3 text-white">
                            <p class="text-xs uppercase tracking-[0.2em] text-orange-200">{{ $item['label'] }}</p>
                            <h3 class="mt-2 text-xl font-semibold">{{ $item['name'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-blue-100/80">{{ $item['text'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('contact.show') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-8 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Get a Quote <i class="ri-arrow-right-line"></i></a>
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0b1234] overflow-hidden">
    <div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.16),transparent_55%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-orange-300/20 bg-orange-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-orange-200 mb-4">{{ $packageLabel }}</p>
                <h2 class="text-4xl md:text-5xl font-bold text-white">Choose A Package</h2>
                <p class="mt-4 max-w-2xl text-blue-100/75 text-sm md:text-base leading-relaxed">Simple package options with practical deliverables, sample work previews, and clear starting points for your project.</p>
            </div>
            <a href="{{ route('contact.show') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Request Custom Quote <i class="ri-arrow-right-line"></i></a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($packages as $package)
                @php
                    $packageImage = isset($package['image']) && $package['image']
                        ? (str_starts_with($package['image'], 'services/') ? $package['image'] : 'services/' . $page['category'] . '/' . $package['image'])
                        : ($workImages[$loop->index % count($workImages)] ?? 'portfolio_section.png');
                @endphp
                <article class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#111739]/95 shadow-[0_20px_60px_rgba(0,0,0,0.22)] transition-transform duration-300 hover:-translate-y-2">
                    <div class="relative h-56 bg-cover bg-center" style="background-image: url('{{ asset($packageImage) }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#07102f] via-[#07102f]/45 to-transparent"></div>
                        <span class="absolute left-5 top-5 inline-flex items-center rounded-full border border-white/15 bg-black/35 px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-100">{{ $package['tag'] }}</span>
                        <div class="absolute inset-x-5 bottom-5">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-orange-200">{{ $page['title'] }}</p>
                            <h3 class="mt-2 text-2xl font-semibold text-white">{{ $package['name'] }}</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-semibold text-white">{{ $package['name'] }}</h3>
                                <p class="mt-3 text-blue-100/75 text-sm leading-relaxed">{{ $package['description'] ?? ('A focused ' . strtolower($page['title']) . ' package prepared for business-ready delivery.') }}</p>
                            </div>
                            <p class="shrink-0 text-2xl font-bold text-cyan-200">{{ $package['price'] }}</p>
                        </div>
                        <ul class="mt-6 space-y-3">
                            @foreach($package['features'] as $feature)
                                <li class="flex items-center gap-3 text-sm text-blue-100/80">
                                    <i class="ri-check-line text-cyan-300"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('contact.show') }}" class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-full border border-cyan-300/35 bg-cyan-400/10 px-5 py-3 text-sm font-semibold text-cyan-100 transition-all duration-300 hover:bg-cyan-400/20">Choose Package <i class="ri-arrow-right-up-line"></i></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0e173e]">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/25 bg-cyan-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-100 mb-4">Process</p>
            <h2 class="text-4xl md:text-5xl font-bold text-white">How We Work</h2>
        </div>
        <div class="grid md:grid-cols-5 gap-6">
            @foreach($category['process'] as $step)
                <div class="rounded-[2rem] bg-[#141a3f]/95 border border-white/10 p-6 text-center transition-transform duration-300 hover:-translate-y-2">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full border border-cyan-300/25 bg-cyan-400/10 text-cyan-200 font-semibold">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3 class="text-white font-semibold">{{ $step }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-[#0b1234]">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-6">
            @foreach($category['metrics'] as $metric)
                <div class="rounded-[2rem] p-8 bg-[#141a3f] text-center border border-white/10">
                    <h3 class="text-5xl text-white font-bold">{{ $metric['value'] }}</h3>
                    <p class="mt-3 text-sm text-blue-100/70">{{ $metric['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0b1135]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-orange-300/20 bg-orange-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-orange-200 mb-4">Contact Us</p>
            <h2 class="text-4xl md:text-5xl font-bold text-white">Start Your {{ $page['title'] }} Project</h2>
        </div>
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-300/30 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">{{ session('success') }}</div>
        @endif
        @if (isset($errors) && $errors->any())
            <div class="mb-6 rounded-2xl border border-red-300/30 bg-red-400/10 px-4 py-3 text-sm text-red-100">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="grid gap-6 lg:grid-cols-2" method="post" action="{{ route('contact.submit') }}">
            @csrf
            <div class="space-y-4">
                <input type="text" name="name" placeholder="Your Name" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                <input type="text" name="business_name" placeholder="Your Business Name" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                <input type="email" name="email" placeholder="Your Email Address" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                <input type="text" name="phone" placeholder="Your Phone" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                <select name="service" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white focus:border-orange-400 focus:outline-none">
                    <option value="{{ $slug }}" selected>{{ $page['title'] }}</option>
                    <option value="logo-design">Logo Design</option>
                    <option value="brand-identity">Brand Identity</option>
                    <option value="website-development">Website Development</option>
                    <option value="digital-marketing">Digital Marketing</option>
                    <option value="custom-software">Custom Software</option>
                </select>
            </div>
            <div class="space-y-4">
                <textarea name="message" rows="10" placeholder="Your Message" class="w-full rounded-[2rem] border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none"></textarea>
                <button type="submit" class="inline-flex items-center justify-center w-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-4 rounded-full font-semibold shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-[1.02] transition-all duration-300">Get Quote</button>
                <p class="text-sm text-blue-100/70">Share your goals and we will recommend the best package, timeline, and next step for your project.</p>
            </div>
        </form>
    </div>
</section>
@endsection
