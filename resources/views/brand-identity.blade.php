@extends('layouts.app')

@section('content')

<!-- Brand Identity Page -->
<section class="relative overflow-hidden pt-28 mt-32 pb-24 bg-[#0e173e]">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.18),transparent_30%),radial-gradient(circle_at_right,_rgba(45,212,255,0.15),transparent_40%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="inline-flex items-center px-4 py-2 rounded-full border border-orange-300/30 bg-orange-500/10 text-[11px] font-semibold tracking-[0.18em] uppercase text-orange-200">Brand Identity Services</p>
                <h1 class="mt-6 text-4xl md:text-6xl font-bold text-white">Build A Powerful Brand Identity Customers Instantly Recognize</h1>
                <p class="mt-6 text-lg text-blue-100/80">We create complete brand identity systems including logo design, colors, typography, guidelines, stationery, and visual assets that help businesses stand out.</p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="{{ route('contact.show') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)]">Build My Brand</a>
                    <a href="{{ route('work') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)]">View Portfolio</a>
                </div>
            </div>
            <div class="rounded-[2rem] border border-white/10 bg-[#141a3f]/95 h-96"></div>
        </div>
    </div>
</section>

<section class="py-20 bg-[#0b1234]">
<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center mb-12">
<h2 class="text-4xl font-bold text-white">Brand Identity Solutions</h2>
</div>
<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
@foreach([
'Brand Strategy','Logo Design','Color Systems',
'Typography','Brand Guidelines','Stationery Design'
] as $service)
<div class="rounded-[2rem] border border-white/10 bg-[#111739]/95 p-8">
<h3 class="text-2xl font-semibold text-white">{{ $service }}</h3>
<p class="mt-4 text-blue-100/75">Professional identity development designed to build trust and recognition.</p>
</div>
@endforeach
</div>
</div>
</section>

<section class="py-20 bg-[#0e173e]">
<div class="max-w-7xl mx-auto px-4">
<div class="text-center mb-12">
<h2 class="text-4xl font-bold text-white">Our Process</h2>
</div>
<div class="grid md:grid-cols-5 gap-6">
@foreach(['Discovery','Research','Strategy','Design','Delivery'] as $step)
<div class="rounded-[2rem] bg-[#141a3f]/95 border border-white/10 p-6 text-center">
<h3 class="text-white font-semibold">{{ $step }}</h3>
</div>
@endforeach
</div>
</div>
</section>

<section class="py-20 bg-[#0b1234]">
<div class="max-w-7xl mx-auto px-4">
<div class="grid md:grid-cols-4 gap-6">
<div class="rounded-[2rem] p-8 bg-[#141a3f] text-center"><h3 class="text-5xl text-white font-bold">75%</h3></div>
<div class="rounded-[2rem] p-8 bg-[#141a3f] text-center"><h3 class="text-5xl text-white font-bold">3X</h3></div>
<div class="rounded-[2rem] p-8 bg-[#141a3f] text-center"><h3 class="text-5xl text-white font-bold">90%</h3></div>
<div class="rounded-[2rem] p-8 bg-[#141a3f] text-center"><h3 class="text-5xl text-white font-bold">24/7</h3></div>
</div>
</div>
</section>

@php
    $brandPackages = [
        [
            'name' => 'Starter Identity',
            'tag' => 'Launch kit',
            'price' => '$249',
            'image' => 'our_services_2.png',
            'sample' => 'Fresh Cafe Identity',
            'sample_type' => 'Logo, color, typography',
            'description' => 'A clean starter system for small businesses that need the basics aligned before launch.',
            'features' => ['Logo refinement', 'Color palette', 'Font pairing', 'Social profile mockup'],
        ],
        [
            'name' => 'Professional Identity',
            'tag' => 'Popular',
            'price' => '$599',
            'image' => 'portfolio_section.png',
            'sample' => 'Realty Brand Suite',
            'sample_type' => 'Stationery + digital assets',
            'description' => 'A stronger identity system with brand assets for print, web, and consistent customer touchpoints.',
            'features' => ['Logo system', 'Brand guidelines', 'Business card set', 'Letterhead design'],
        ],
        [
            'name' => 'Complete Brand System',
            'tag' => 'Full system',
            'price' => '$999',
            'image' => 'hero.png',
            'sample' => 'AM Autos Visual System',
            'sample_type' => 'Complete identity mockup',
            'description' => 'A full visual identity package for businesses that need a cohesive brand across every channel.',
            'features' => ['Brand strategy board', 'Stationery suite', 'Social media kit', 'Mini brand book'],
        ],
    ];
@endphp

<section class="relative py-20 bg-[#0e173e] overflow-hidden">
<div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top,_rgba(81,214,255,0.14),transparent_55%)]"></div>
<div class="relative max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-12">
<div>
<p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/25 bg-cyan-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-100 mb-4">Brand Packages</p>
<h2 class="text-4xl md:text-5xl font-bold text-white">Identity Packages With Sample Work</h2>
<p class="mt-4 max-w-2xl text-blue-100/75 text-sm md:text-base leading-relaxed">Dummy package previews show how each identity level can look across logo, stationery, social media, and guideline assets.</p>
</div>
<a href="{{ route('contact.show') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold shadow-[0_0_20px_rgba(145,92,255,0.45)]">Discuss Package <i class="ri-arrow-right-line"></i></a>
</div>
<div class="grid lg:grid-cols-3 gap-6">
@foreach($brandPackages as $package)
<article class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.22)] transition-transform duration-300 hover:-translate-y-2">
<div class="relative h-64 bg-cover bg-center" style="background-image: url('{{ asset($package['image']) }}');">
<div class="absolute inset-0 bg-gradient-to-t from-[#07102f] via-[#07102f]/45 to-transparent"></div>
<span class="absolute left-5 top-5 inline-flex items-center rounded-full border border-white/15 bg-black/35 px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-100">{{ $package['tag'] }}</span>
<div class="absolute inset-x-5 bottom-5">
<p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-orange-200">{{ $package['sample_type'] }}</p>
<h3 class="mt-2 text-2xl font-semibold text-white">{{ $package['sample'] }}</h3>
</div>
</div>
<div class="p-8">
<div class="flex items-start justify-between gap-4">
<div>
<h3 class="text-2xl font-semibold text-white">{{ $package['name'] }}</h3>
<p class="mt-3 text-sm leading-relaxed text-blue-100/75">{{ $package['description'] }}</p>
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

<section class="py-20 bg-[#0b1234]">
<div class="max-w-7xl mx-auto px-4 text-center">
<h2 class="text-4xl font-bold text-white mb-10">Ready To Build A Brand Customers Trust?</h2>
<a href="{{ route('contact.show') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-8 py-4 rounded-full font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)]">Start Your Brand Project</a>
</div>
</section>

@endsection
