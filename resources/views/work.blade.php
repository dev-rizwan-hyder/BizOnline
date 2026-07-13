@extends('layouts.app')

@section('content')
<section class="relative overflow-hidden pt-24 sm:pt-28 lg:pt-36 pb-14 sm:pb-20">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(67,56,255,0.22),transparent_35%),radial-gradient(circle_at_right,_rgba(45,212,255,0.17),transparent_30%)]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 sm:gap-10 lg:grid-cols-2 lg:items-center">

            <!-- Left Content -->
            <div class="space-y-5 sm:space-y-6 text-center lg:text-left">
                <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/30 bg-[#0c1e54]/70 text-[10px] sm:text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100">
                    Our Work
                </p>

                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white max-w-3xl mx-auto lg:mx-0 leading-tight">
                    Work That Reflects Our Services and Drives Business Growth
                </h1>

                <p class="max-w-2xl mx-auto lg:mx-0 text-blue-100/85 text-base sm:text-lg leading-relaxed">
                    Explore service-led portfolio examples built for branding, websites, apps, software, and digital marketing.
                    Each project shows how we turn strategy into polished digital experiences.
                </p>

                <div class="flex flex-col sm:flex-row flex-wrap justify-center lg:justify-start gap-3 pt-2">
                    <a href="{{ route('contact.show') }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white font-semibold shadow-[0_18px_30px_rgba(79,160,255,0.14)]">
                        Talk to Sales
                        <i class="ri-arrow-right-line"></i>
                    </a>

                    <a href="{{ route('work') }}#projects"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full border border-cyan-300/30 text-cyan-100 hover:text-white hover:bg-white/10 transition">
                        View Projects
                    </a>
                </div>
            </div>

            <!-- Right Image Card -->
            <div class="w-full rounded-[1.5rem] sm:rounded-[2rem] overflow-hidden border border-cyan-300/20 shadow-[0_20px_60px_rgba(27,50,130,0.35)] bg-[#07143e]/90">
                <div class="relative min-h-[300px] sm:min-h-[380px] lg:min-h-[480px] bg-cover bg-center"
                     style="background-image: url('{{ asset('hero.png') }}');">

                    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(10,18,60,0.10),rgba(3,9,34,0.88))]"></div>

                    <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6 p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-black/25 backdrop-blur-sm border border-white/10">
                        <p class="text-[10px] sm:text-sm uppercase tracking-[0.18em] sm:tracking-[0.24em] text-cyan-200">
                            Featured case study
                        </p>

                        <h2 class="mt-2 sm:mt-3 text-xl sm:text-2xl lg:text-3xl font-semibold text-white leading-tight">
                            Brand Refresh + Website Launch
                        </h2>

                        <p class="mt-2 sm:mt-3 text-xs sm:text-sm text-blue-100/80 leading-relaxed">
                            Complete identity, digital brand kit, and high-converting website designed for a fast-growing local business.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="projects" class="relative py-20">
    <div class="absolute inset-x-0 top-0 h-60 bg-[radial-gradient(circle_at_top,_rgba(81,214,255,0.18),transparent_40%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#0f1f56]/70 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100 mb-4">Project Portfolio</p>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-3">Projects Built Around Our Core Services</h2>
            <p class="max-w-3xl mx-auto text-blue-100/80 text-lg">These service-focused examples show how Biz Online delivers modern digital solutions across every industry need.</p>
        </div>

        <div class="grid gap-6 xl:grid-cols-3 lg:grid-cols-2">
            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('portfolio_section.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/15 text-xs uppercase tracking-[0.2em]">Branding</span>
                        <h3 class="mt-3 text-2xl font-semibold">Visual Identity for Boutique Retail</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Logo, packaging concepts, print assets, and branded social media templates created for a premium retail launch.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-flashlight-line"></i>
                        <span>Strategy, Design, Launch</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('our_services.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/15 text-xs uppercase tracking-[0.2em]">Website</span>
                        <h3 class="mt-3 text-2xl font-semibold">E-commerce Platform for Retail Growth</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Fast checkout, mobile-friendly storefront, and conversion-led landing pages built to sell products instantly.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-global-line"></i>
                        <span>UX, Development, Optimization</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('our_services_2.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-500/15 text-xs uppercase tracking-[0.2em]">App</span>
                        <h3 class="mt-3 text-2xl font-semibold">Mobile App Launch for Service Business</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">A clean cross-platform app powered with simple onboarding, booking flow, and branded customer experience.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-smartphone-line"></i>
                        <span>Apps, UI/UX, Conversion</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('hero.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/15 text-xs uppercase tracking-[0.2em]">Website</span>
                        <h3 class="mt-3 text-2xl font-semibold">Corporate Website Revamp</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Redesigned the full digital presence with faster performance and better conversion flow.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-global-line"></i>
                        <span>Performance, UX, Launch</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('contact_us.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-500/15 text-xs uppercase tracking-[0.2em]">Lead Generation</span>
                        <h3 class="mt-3 text-2xl font-semibold">High-Converting Funnel</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Built campaign landing pages to improve admissions performance and lead capture.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-flashlight-line"></i>
                        <span>Conversion, Campaign, Growth</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('our_services.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/15 text-xs uppercase tracking-[0.2em]">Software</span>
                        <h3 class="mt-3 text-2xl font-semibold">Custom Business Software</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Delivered a complete ERP and CRM platform designed to streamline operations.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-tools-line"></i>
                        <span>ERP, CRM, Efficiency</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('hero.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/15 text-xs uppercase tracking-[0.2em]">Backend</span>
                        <h3 class="mt-3 text-2xl font-semibold">Backend & Cloud Infrastructure</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Built a resilient API backend and cloud deployment pipeline for growing product scale.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-cloud-line"></i>
                        <span>API, Cloud, Deployment</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('our_services_2.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-fuchsia-500/15 text-xs uppercase tracking-[0.2em]">Marketing</span>
                        <h3 class="mt-3 text-2xl font-semibold">Digital Campaign Strategy</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Created ad and social media campaigns to grow acquisition and conversions.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-megaphone-line"></i>
                        <span>Campaigns, Traffic, Leads</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('portfolio_section.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/15 text-xs uppercase tracking-[0.2em]">Creative</span>
                        <h3 class="mt-3 text-2xl font-semibold">Creative Asset Production</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Produced visual content and branding assets for stronger digital storytelling.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-image-line"></i>
                        <span>Design, Content, Visuals</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('contact_us.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/15 text-xs uppercase tracking-[0.2em]">Support</span>
                        <h3 class="mt-3 text-2xl font-semibold">Maintenance & Support</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Maintained performance and security for ongoing product operations.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-settings-2-line"></i>
                        <span>Support, Updates, Security</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('our_services_2.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-500/15 text-xs uppercase tracking-[0.2em]">Advanced</span>
                        <h3 class="mt-3 text-2xl font-semibold">Modern Services Innovation</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Delivered AI workflows, analytics dashboards, and SaaS integrations for smarter operations.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-robot-line"></i>
                        <span>AI, Automation, Dashboards</span>
                    </div>
                </div>
            </article>

            <article class="group overflow-hidden rounded-[2rem] border border-cyan-300/20 bg-[#0b1b4a]/90 shadow-[0_16px_40px_rgba(18,40,97,0.28)] transition-transform duration-300 hover:-translate-y-1">
                <div class="relative h-72 bg-cover bg-center" style="background-image: url('{{ asset('portfolio_section.png') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020917]/95 via-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/15 text-xs uppercase tracking-[0.2em]">Design</span>
                        <h3 class="mt-3 text-2xl font-semibold">Complete UX/UI Overhaul</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <p class="text-blue-100/80 text-sm leading-relaxed">Full design system and interface redesign that improved user engagement and accessibility across all platforms.</p>
                    <div class="flex items-center gap-2 text-xs uppercase tracking-[0.2em] text-cyan-200">
                        <i class="ri-palette-line"></i>
                        <span>Design, UX, Accessibility</span>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

@endsection
