@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden pt-28 mt-20 pb-24 bg-[#0e173e]">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.18),transparent_30%),radial-gradient(circle_at_right,_rgba(45,212,255,0.15),transparent_40%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2 items-center">
            <div class="space-y-6">
                <p class="inline-flex items-center px-4 py-2 rounded-full border border-orange-300/30 bg-orange-500/10 text-[11px] font-semibold tracking-[0.18em] uppercase text-orange-200">Graphic Design Services</p>
                <h1 class="text-4xl md:text-5xl font-bold text-white max-w-3xl">Get Appealing Yet Engaging Logo Designs, Banner Designs, Stationery and Infographic Design Services</h1>
                <p class="max-w-2xl text-blue-100/80 text-lg leading-relaxed">We create high-impact brand visuals, marketing layouts, and identity systems that capture attention and convert visitors into customers.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact.show') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Get Started <i class="ri-arrow-right-line"></i></a>
                    <a href="{{ route('work') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">View Our Work</a>
                </div>
            </div>
            <div class="relative rounded-[2rem] overflow-hidden border border-white/10 bg-[#141a3f]/95 shadow-[0_30px_80px_rgba(4,14,54,0.35)]">
                <div class="relative h-96 bg-cover bg-center" style="background-image: url('{{ asset('logo_design_hero.png') }}');">
                    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
                    <div class="absolute left-6 bottom-6 right-6 rounded-3xl bg-white/10 border border-white/10 p-6">
                        <p class="text-sm uppercase tracking-[0.24em] text-orange-200">Design for brands</p>
                        <h2 class="mt-3 text-3xl font-semibold text-white">Creative visuals that elevate every campaign</h2>
                        <p class="mt-3 text-blue-100/80 text-sm">From logo concepts to full stationery suites, we deliver professional design with modern polish.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0b1234]">
    <div class="absolute inset-x-0 top-0 h-36 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.16),transparent_50%)]"></div>
    <div class="relative max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-3">
            <article class="group rounded-[2rem] border border-white/10 bg-[#111739]/95 p-8 shadow-[0_20px_60px_rgba(0,0,0,0.2)] transition-transform duration-300 hover:-translate-y-2">
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-orange-500/10 text-orange-300 text-xl border border-orange-500/20">
                    <i class="ri-paint-brush-line"></i>
                </div>
                <h3 class="mt-6 text-2xl font-semibold text-white">Logo Design</h3>
                <p class="mt-4 text-blue-100/75 text-sm leading-relaxed">Get an artistic representation of your brand with a modern, memorable logo that works across web and print.</p>
            </article>
            <article class="group rounded-[2rem] border border-white/10 bg-[#111739]/95 p-8 shadow-[0_20px_60px_rgba(0,0,0,0.2)] transition-transform duration-300 hover:-translate-y-2">
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-violet-500/10 text-violet-300 text-xl border border-violet-500/20">
                    <i class="ri-layout-masonry-line"></i>
                </div>
                <h3 class="mt-6 text-2xl font-semibold text-white">Banner Design</h3>
                <p class="mt-4 text-blue-100/75 text-sm leading-relaxed">Convey your message with beautifully designed banners for social media, ads, websites, and events.</p>
            </article>
            <article class="group rounded-[2rem] border border-white/10 bg-[#111739]/95 p-8 shadow-[0_20px_60px_rgba(0,0,0,0.2)] transition-transform duration-300 hover:-translate-y-2">
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-cyan-500/10 text-cyan-300 text-xl border border-cyan-500/20">
                    <i class="ri-archive-line"></i>
                </div>
                <h3 class="mt-6 text-2xl font-semibold text-white">Stationary Designs</h3>
                <p class="mt-4 text-blue-100/75 text-sm leading-relaxed">Stationery like business cards, letterheads, and envelopes created to reinforce your brand identity.</p>
            </article>
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0e173e]">
    <div class="absolute inset-x-0 top-0 h-36 bg-[radial-gradient(circle_at_top,_rgba(81,214,255,0.14),transparent_50%)]"></div>
    <div class="relative max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-orange-300/20 bg-orange-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-orange-200 mb-4">Our Work</p>
            <h2 class="text-4xl md:text-5xl font-bold text-white">Have a Look</h2>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.2)]">
                <div class="h-72 bg-gradient-to-br from-[#3d0f6b] via-[#642d9d] to-[#d454a4] flex items-end p-6">
                    <div class="bg-black/40 rounded-3xl px-4 py-3 text-white">
                        <p class="text-xs uppercase tracking-[0.2em] text-orange-200">Logo</p>
                        <h3 class="mt-2 text-xl font-semibold">Dog World</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.2)]">
                <div class="h-72 bg-gradient-to-br from-[#4d1466] via-[#683b9b] to-[#e1797c] flex items-end p-6">
                    <div class="bg-black/40 rounded-3xl px-4 py-3 text-white">
                        <p class="text-xs uppercase tracking-[0.2em] text-orange-200">Logo</p>
                        <h3 class="mt-2 text-xl font-semibold">Realty Solutions</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.2)]">
                <div class="h-72 bg-gradient-to-br from-[#253a7b] via-[#5c4fc3] to-[#ff7f4c] flex items-end p-6">
                    <div class="bg-black/40 rounded-3xl px-4 py-3 text-white">
                        <p class="text-xs uppercase tracking-[0.2em] text-orange-200">Logo</p>
                        <h3 class="mt-2 text-xl font-semibold">AM Autos</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.2)]">
                <div class="h-72 bg-gradient-to-br from-[#2a2c6f] via-[#7b4cbe] to-[#ff8a5e] flex items-end p-6">
                    <div class="bg-black/40 rounded-3xl px-4 py-3 text-white">
                        <p class="text-xs uppercase tracking-[0.2em] text-orange-200">Stationery</p>
                        <h3 class="mt-2 text-xl font-semibold">Business Card Set</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.2)]">
                <div class="h-72 bg-gradient-to-br from-[#1d2f6e] via-[#6a4cb0] to-[#ff9660] flex items-end p-6">
                    <div class="bg-black/40 rounded-3xl px-4 py-3 text-white">
                        <p class="text-xs uppercase tracking-[0.2em] text-orange-200">Mockup</p>
                        <h3 class="mt-2 text-xl font-semibold">Brand Bundle</h3>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-[#141a3f]/95 shadow-[0_20px_60px_rgba(0,0,0,0.2)]">
                <div class="h-72 bg-gradient-to-br from-[#3f1f72] via-[#8651d9] to-[#ff9b69] flex items-end p-6">
                    <div class="bg-black/40 rounded-3xl px-4 py-3 text-white">
                        <p class="text-xs uppercase tracking-[0.2em] text-orange-200">Mockup</p>
                        <h3 class="mt-2 text-xl font-semibold">Office Merch</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('contact.show') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-8 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Get a Quote</a>
        </div>
    </div>
</section>

@php
    $logoPackages = [
        [
            'name' => 'Starter Logo Package',
            'tag' => 'New business',
            'price' => '$149',
            'image' => 'our_services.png',
            'sample' => 'Cafe Mark Concept',
            'sample_type' => 'Logo + avatar preview',
            'description' => 'A focused logo package for founders who need a clean, memorable brand mark to launch quickly.',
            'features' => ['2 logo concepts', '2 revision rounds', 'Primary logo files', 'PNG and JPG delivery'],
        ],
        [
            'name' => 'Growth Logo Package',
            'tag' => 'Most popular',
            'price' => '$299',
            'image' => 'portfolio_section.png',
            'sample' => 'Realty Solutions',
            'sample_type' => 'Logo + stationery mockup',
            'description' => 'A polished visual identity starter pack with more concepts, color direction, and print-ready assets.',
            'features' => ['4 logo concepts', '4 revision rounds', 'Color palette', 'Business card mockup'],
        ],
        [
            'name' => 'Premium Graphics Package',
            'tag' => 'Full creative kit',
            'price' => '$499',
            'image' => 'hero.png',
            'sample' => 'AM Autos Brand Kit',
            'sample_type' => 'Logo + banners + socials',
            'description' => 'A complete creative bundle for businesses that need logo, banners, stationery, and social graphics together.',
            'features' => ['6 logo concepts', 'Stationery design', 'Banner design set', 'Editable source files'],
        ],
    ];
@endphp

<section class="relative py-20 bg-[#0b1234] overflow-hidden">
    <div class="absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.16),transparent_55%)]"></div>
    <div class="relative max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-12">
            <div>
                <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-orange-300/20 bg-orange-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-orange-200 mb-4">Logo Packages</p>
                <h2 class="text-4xl md:text-5xl font-bold text-white">Choose A Design Package</h2>
                <p class="mt-4 max-w-2xl text-blue-100/75 text-sm md:text-base leading-relaxed">Simple package options with dummy work previews, so clients can quickly understand the style, deliverables, and value.</p>
            </div>
            <a href="{{ route('contact.show') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Request Custom Quote <i class="ri-arrow-right-line"></i></a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($logoPackages as $package)
                <article class="group overflow-hidden rounded-[2rem] border border-white/10 bg-[#111739]/95 shadow-[0_20px_60px_rgba(0,0,0,0.22)] transition-transform duration-300 hover:-translate-y-2">
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
                                <p class="mt-3 text-blue-100/75 text-sm leading-relaxed">{{ $package['description'] }}</p>
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

<section class="relative py-20 bg-[#0b1135]">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-orange-300/20 bg-orange-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-orange-200 mb-4">Contact Us</p>
            <h2 class="text-4xl md:text-5xl font-bold text-white">Get In Touch</h2>
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
                    <option value="">Select Service</option>
                    <option value="logo-design">Logo Design</option>
                    <option value="banner-design">Banner Design</option>
                    <option value="stationery-design">Stationery Designs</option>
                    <option value="infographic-design">Infographic Design</option>
                </select>
            </div>
            <div class="space-y-4">
                <textarea name="message" rows="10" placeholder="Your Message" class="w-full rounded-[2rem] border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none"></textarea>
                <button type="submit" class="inline-flex items-center justify-center w-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-4 rounded-full font-semibold shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-[1.02] transition-all duration-300">Get Quote</button>
                <p class="text-sm text-blue-100/70">Please provide your initial requirements details here to get an instant quote. We will reply as soon as possible. Thank you!</p>
            </div>
        </form>
    </div>
</section>
@endsection
