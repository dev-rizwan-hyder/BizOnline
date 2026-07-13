@extends('layouts.app')

@section('content')
@php
    $contactCards = [
        ['icon' => 'ri-phone-line', 'label' => 'Phone', 'value' => '+92 315 2457703', 'href' => 'tel:+923152457703', 'accent' => 'from-cyan-400 to-indigo-500'],
        ['icon' => 'ri-mail-line', 'label' => 'Email', 'value' => 'hello@bizzonline.com', 'href' => 'mailto:hello@bizzonline.com', 'accent' => 'from-violet-400 to-fuchsia-500'],
        ['icon' => 'ri-map-pin-line', 'label' => 'Location', 'value' => 'Karachi, Pakistan', 'href' => null, 'accent' => 'from-orange-400 to-pink-500'],
    ];

    $services = [
        'Branding & Design',
        'Website Development',
        'Mobile App Development',
        'Software & ERP',
        'Backend & Cloud',
        'Digital Marketing',
        'Advanced / Modern Services',
        'Maintenance & Support',
    ];

    $steps = [
        ['title' => 'Share Your Goals', 'text' => 'Tell us what you want to build, improve, or launch.'],
        ['title' => 'Get A Clear Plan', 'text' => 'We review the details and recommend the best next step.'],
        ['title' => 'Start The Project', 'text' => 'Once the scope is clear, we move into design, development, or campaign setup.'],
    ];
@endphp

<section class="relative overflow-hidden pt-28 mt-20 pb-24 bg-[#0e173e]">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.18),transparent_30%),radial-gradient(circle_at_right,_rgba(45,212,255,0.15),transparent_40%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-2 items-center">
            <div class="space-y-6">
                <p class="inline-flex items-center px-4 py-2 rounded-full border border-orange-300/30 bg-orange-500/10 text-[11px] font-semibold tracking-[0.18em] uppercase text-orange-200">Contact Biz Online</p>
                <h1 class="text-4xl md:text-5xl font-bold text-white max-w-3xl">Let's Talk About Your Next Digital Project</h1>
                <p class="max-w-2xl text-blue-100/80 text-lg leading-relaxed">Send us your project details and we will help you choose the right plan for branding, websites, apps, software, marketing, or support.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#contact-form" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">Send Message <i class="ri-arrow-right-line"></i></a>
                    <a href="{{ route('work') }}" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-3 rounded-full whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-105 transition-all duration-300">View Our Work</a>
                </div>
            </div>
            <div class="relative rounded-[2rem] overflow-hidden border border-white/10 bg-[#141a3f]/95 shadow-[0_30px_80px_rgba(4,14,54,0.35)]">
                <div class="relative h-96 bg-cover bg-center" style="background-image: url('{{ asset('contact_us.png') }}');">
                    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
                    <div class="absolute left-6 bottom-6 right-6 rounded-3xl bg-white/10 border border-white/10 p-6">
                        <p class="text-sm uppercase tracking-[0.24em] text-orange-200">Fast response</p>
                        <h2 class="mt-3 text-3xl font-semibold text-white">Tell us what you need and we'll shape the next step.</h2>
                        <p class="mt-3 text-blue-100/80 text-sm">From quick design tasks to full digital systems, our team can help you scope the right solution.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative py-20 bg-[#0b1234]">
    <div class="absolute inset-x-0 top-0 h-36 bg-[radial-gradient(circle_at_top,_rgba(255,146,77,0.16),transparent_50%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 md:grid-cols-3">
            @foreach($contactCards as $card)
                <article class="rounded-[2rem] border border-white/10 bg-[#111739]/95 p-8 shadow-[0_20px_60px_rgba(0,0,0,0.2)] transition-transform duration-300 hover:-translate-y-2">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r {{ $card['accent'] }} text-white text-xl shadow-[0_0_20px_rgba(145,92,255,0.35)]">
                        <i class="{{ $card['icon'] }}"></i>
                    </div>
                    <p class="mt-6 text-sm uppercase tracking-[0.18em] text-orange-200">{{ $card['label'] }}</p>
                    @if($card['href'])
                        <a href="{{ $card['href'] }}" class="mt-2 block text-2xl font-semibold text-white hover:text-cyan-100">{{ $card['value'] }}</a>
                    @else
                        <p class="mt-2 text-2xl font-semibold text-white">{{ $card['value'] }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="contact-form" class="relative py-20 bg-[#0e173e]">
    <div class="absolute inset-x-0 top-0 h-36 bg-[radial-gradient(circle_at_top,_rgba(81,214,255,0.14),transparent_50%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] items-start">
            <div class="space-y-6">
                <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-orange-300/20 bg-orange-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-orange-200">Project Inquiry</p>
                <h2 class="text-4xl md:text-5xl font-bold text-white">Ready To Start?</h2>
                <p class="text-blue-100/80 text-lg leading-relaxed">Use the form to share your goals, preferred service, and project details. We will review it and get back with a clear recommendation.</p>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($services as $service)
                        <div class="rounded-2xl border border-cyan-300/25 bg-[#101f56]/75 px-4 py-3 text-sm font-semibold text-cyan-100">
                            <i class="ri-check-line text-cyan-300 mr-2"></i>{{ $service }}
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-[#111739]/95 p-6 sm:p-8 shadow-[0_20px_60px_rgba(0,0,0,0.22)]">
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

                <form method="post" action="{{ route('contact.submit') }}" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+92 300 1234567" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Business Name</label>
                            <input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="Your Business Name" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Service</label>
                            <select name="service" class="w-full rounded-3xl border border-white/10 bg-[#08112b] px-5 py-4 text-white focus:border-orange-400 focus:outline-none">
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service }}" @selected(old('service') === $service)>{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-blue-100 mb-2">Message</label>
                        <textarea name="message" rows="7" placeholder="Tell us about your project..." class="w-full rounded-[2rem] border border-white/10 bg-[#08112b] px-5 py-4 text-white placeholder:text-blue-200/70 focus:border-orange-400 focus:outline-none">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center w-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-6 py-4 rounded-full font-semibold shadow-[0_0_20px_rgba(145,92,255,0.45)] hover:scale-[1.02] transition-all duration-300">Send Message <i class="ri-arrow-right-line ml-2"></i></button>
                    <p class="text-sm text-blue-100/70 text-center">Your information is secure and confidential.</p>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-[#0b1234]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/25 bg-cyan-500/10 text-[11px] font-semibold uppercase tracking-[0.18em] text-cyan-100 mb-4">Next Steps</p>
            <h2 class="text-4xl md:text-5xl font-bold text-white">What Happens After You Send It</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            @foreach($steps as $step)
                <article class="rounded-[2rem] border border-white/10 bg-[#141a3f]/95 p-8 text-center transition-transform duration-300 hover:-translate-y-2">
                    <div class="mx-auto mb-5 flex h-12 w-12 items-center justify-center rounded-full border border-cyan-300/25 bg-cyan-400/10 text-cyan-200 font-semibold">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3 class="text-2xl font-semibold text-white">{{ $step['title'] }}</h3>
                    <p class="mt-4 text-sm leading-relaxed text-blue-100/75">{{ $step['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
