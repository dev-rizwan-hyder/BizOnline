@extends('layouts.app')

@section('content')
    <section id="home" class="relative min-h-[92vh] max-w-8xl overflow-hidden bg-[#081223]">
        <div class="absolute inset-0 hidden md:block bg-cover bg-center"
            style="background-image: url('{{ asset('hero.png') }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#040a18]/92 via-[#07153a]/74 to-[#0a1933]/32"></div>
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(56,189,248,0.18),transparent_40%),radial-gradient(circle_at_70%_75%,rgba(99,102,241,0.18),transparent_35%)]">
        </div>
        <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-b from-transparent via-[#120f49]/35 to-[#1c216a]/92">
        </div>

        <div
            class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-[92vh] grid lg:grid-cols-2 gap-12 items-center pt-56 lg:pt-64 pb-20">
            <div class="text-white">
                <p
                    class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.22em] bg-[#12305a]/80 border border-cyan-300/35 rounded-full px-4 py-2 mb-6">
                    <span class="w-2 h-2 rounded-full bg-cyan-300"></span>
                    AI Powered Digital Solutions
                </p>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-[1.05] mb-6">Crafting Bold <br> Digital
                    Presence <br> For Brands <br> That Want To Lead</h2>
                <p class="text-base sm:text-lg text-blue-100/90 leading-relaxed mb-9 max-w-2xl">We combine strategy, premium
                    design, and high-performance development to deliver portfolio-grade websites that look exceptional and
                    convert visitors into clients.</p>
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="#contact"
                        class="hero-cta text-white px-8 py-4 !rounded-button text-base font-semibold inline-flex items-center justify-center gap-2 whitespace-nowrap min-h-[56px]">
                        Launch Your Project
                        <i class="ri-arrow-right-up-line"></i>
                    </a>
                    <a href="#portfolio"
                        class="hero-cta-secondary text-cyan-100 px-8 py-4 !rounded-button text-base font-semibold inline-flex items-center justify-center gap-2 whitespace-nowrap min-h-[56px]">
                        <span>Explore Portfolio</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </a>
                </div>
                <div class="flex flex-wrap items-center gap-6 text-blue-100/90">
                    <div class="flex items-center gap-2 text-sm"><span class="w-2 h-2 rounded-full bg-cyan-300"></span> 200+
                        Projects Delivered</div>
                    <div class="flex items-center gap-2 text-sm"><span class="w-2 h-2 rounded-full bg-indigo-300"></span>
                        Performance Focused Builds</div>
                    <div class="flex items-center gap-2 text-sm"><span class="w-2 h-2 rounded-full bg-violet-300"></span>
                        End-to-End Creative Team</div>
                </div>
            </div>

            <div class="hidden lg:block"></div>
        </div>
    </section>

    <section id="portfolio" max-w-8xl class="portfolio-stage relative py-20 overflow-hidden -mt-8 pt-24">
        <div class="absolute inset-0 bg-cover bg-right"
            style="background-image: url('{{ asset('portfolio_section.png') }}');"></div>
        <div
            class="absolute inset-0 bg-[linear-gradient(120deg,rgba(3,10,33,0.86),rgba(10,17,61,0.70),rgba(22,14,69,0.45))]">
        </div>
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_24%_20%,rgba(93,203,255,0.16),transparent_33%),radial-gradient(circle_at_75%_62%,rgba(174,97,255,0.20),transparent_33%)]">
        </div>
        <div class="portfolio-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-10">
                <p
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#111a4b]/70 text-[11px] uppercase tracking-[0.22em] text-cyan-100 mb-4">
                    Our Work</p>
                <h3 class="text-5xl md:text-6xl font-bold text-white mb-2 leading-none">Our Portfolio</h3>
                <p class="text-blue-100/85 text-sm md:text-base max-w-2xl mx-auto">Showcasing successful projects across all
                    our service areas</p>
            </div>
            <div class="portfolio-cards relative z-10 transition-transform">
                <div class="overflow-hidden" id="portfolio-carousel-window">
                    <div class="flex transition-transform duration-500 ease-out" id="portfolio-carousel-track">
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('our_services.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-indigo-300/20 text-indigo-100 border border-indigo-300/30">Branding</span>
                                        <span class="text-blue-200/90">Urban Cafe</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Complete Brand
                                        Identity</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Craft a modern, memorable brand
                                        identity that elevates Urban Cafe's presence.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+78%</span><span>100%</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('our_services_2.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-fuchsia-300/20 text-fuchsia-100 border border-fuchsia-300/30">App
                                            Development</span>
                                        <span class="text-blue-200/90">DeliveryPro</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Mobile App
                                        Development</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Designed and developed a
                                        powerful mobile delivery app for iOS and Android.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>10K+</span><span>4.8</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('portfolio_section.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-amber-300/20 text-amber-100 border border-amber-300/30">Content</span>
                                        <span class="text-blue-200/90">TechStartup Inc</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Content Marketing
                                    </h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Built a content engine that
                                        drives organic growth.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+200%</span><span>+95%</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('hero.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-cyan-300/20 text-cyan-100 border border-cyan-300/30">Web
                                            Development</span>
                                        <span class="text-blue-200/90">Nova Traders</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Corporate Website
                                        Revamp</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Redesigned the full digital
                                        presence with faster performance and better conversion flow.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+140%</span><span>3.1s</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('contact_us.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-violet-300/20 text-violet-100 border border-violet-300/30">Lead
                                            Generation</span>
                                        <span class="text-blue-200/90">SkillBridge Academy</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">High-Converting
                                        Funnel</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Built campaign landing pages
                                        with for admissions.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+220%</span><span>42%</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('our_services.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-emerald-300/20 text-emerald-100 border border-emerald-300/30">Custom
                                            Software</span>
                                        <span class="text-blue-200/90">EnterprisePro</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Custom Business
                                        Software</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Delivered a complete ERP and
                                        CRM platform for streamlined operations.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+35%</span><span>92%</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('hero.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-cyan-300/20 text-cyan-100 border border-cyan-300/30">Backend</span>
                                        <span class="text-blue-200/90">CloudCore</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Backend & Cloud
                                        Infrastructure</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Built a resilient API backend
                                        and
                                        cloud deployment pipeline for scale.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>99.9%</span><span>1.2s</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('our_services_2.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-fuchsia-300/20 text-fuchsia-100 border border-fuchsia-300/30">Digital
                                            Marketing</span>
                                        <span class="text-blue-200/90">MarketPulse</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Digital Campaign
                                        Strategy</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Created ad and social media
                                        campaigns to boost acquisition and conversions.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+180%</span><span>+62%</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('portfolio_section.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-amber-300/20 text-amber-100 border border-amber-300/30">Creative</span>
                                        <span class="text-blue-200/90">PixelCraft</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Creative Asset
                                        Production</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Produced visual content and
                                        branding assets for stronger digital storytelling.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+75%</span><span>8x</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('contact_us.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-cyan-300/20 text-cyan-100 border border-cyan-300/30">Support</span>
                                        <span class="text-blue-200/90">SecureOps</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Maintenance &
                                        Support</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Maintained performance and
                                        security for ongoing product operations.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>99.8%</span><span>0</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('our_services_2.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-violet-300/20 text-violet-100 border border-violet-300/30">Advanced</span>
                                        <span class="text-blue-200/90">AIMatrix</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Modern Services
                                        Innovation</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Delivered AI workflows,
                                        analytics dashboards, and SaaS integrations.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+45%</span><span>98%</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                            <div
                                class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                                <div class="h-44 bg-cover bg-center"
                                    style="background-image:url('{{ asset('portfolio_section.png') }}');"></div>
                                <div class="p-4">
                                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-rose-300/20 text-rose-100 border border-rose-300/30">Design</span>
                                        <span class="text-blue-200/90">DesignHub</span>
                                    </div>
                                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Complete UX/UI
                                        Overhaul</h4>
                                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Full design system and
                                        interface
                                        redesign that improved user engagement and accessibility.</p>
                                    <div
                                        class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3">
                                        <span>+88%</span><span>9.2</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="mt-8 flex items-center justify-center gap-4">
                    <button id="portfolio-prev"
                        class="w-11 h-11 rounded-full border border-cyan-300/45 bg-[#162463]/80 text-white hover:bg-[#24357f] transition-colors"><i
                            class="ri-arrow-left-s-line text-lg"></i></button>
                    <button id="portfolio-next"
                        class="w-11 h-11 rounded-full border border-cyan-300/45 bg-[#162463]/80 text-white hover:bg-[#24357f] transition-colors"><i
                            class="ri-arrow-right-s-line text-lg"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 max-w-8xl relative overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(145deg,#030d32_0%,#08184a_42%,#1d1657_100%)]"></div>
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_14%_16%,rgba(88,210,255,0.16),transparent_34%),radial-gradient(circle_at_88%_12%,rgba(169,116,255,0.17),transparent_33%),radial-gradient(circle_at_52%_90%,rgba(75,122,255,0.16),transparent_36%)]">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p
                    class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#0e235f]/75 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100 mb-5">
                    Why Choose Bizz Online?</p>
                <h3 class="text-4xl sm:text-5xl font-bold text-white mb-4">Why <span class="text-cyan-300">Choose</span>
                    Bizz Online?</h3>
                <p class="text-blue-100/90 text-lg max-w-3xl mx-auto">We deliver comprehensive digital solutions with
                    proven results</p>
                <div class="mt-5 flex items-center justify-center gap-3">
                    <span class="w-20 h-px bg-gradient-to-r from-transparent via-cyan-300/70 to-transparent"></span>
                    <span class="w-2 h-2 rounded-full bg-cyan-300 shadow-[0_0_10px_rgba(85,214,255,0.9)]"></span>
                    <span class="w-20 h-px bg-gradient-to-r from-transparent via-indigo-300/70 to-transparent"></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <article
                    class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
                    <span
                        class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-cyan-300 to-indigo-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(84,178,255,0.55)]">01</span>
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-full border border-cyan-300/30 bg-[#132862]/75 flex items-center justify-center shadow-[0_0_20px_rgba(80,170,255,0.28)]">
                        <i class="ri-award-line text-4xl text-cyan-200"></i>
                    </div>
                    <h4 class="text-4xl leading-none font-bold text-white mb-3">5+ Years Experience</h4>
                    <p class="text-blue-100/80 text-sm leading-relaxed">Proven track record with 200+ successful projects
                        delivered across various industries.</p>
                    <span
                        class="mt-5 block h-0.5 w-full bg-gradient-to-r from-cyan-400/0 via-cyan-300/70 to-cyan-400/0"></span>
                </article>

                <article
                    class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
                    <span
                        class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-indigo-300 to-violet-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(124,130,255,0.6)]">02</span>
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-full border border-indigo-300/35 bg-[#1c2462]/75 flex items-center justify-center shadow-[0_0_20px_rgba(124,130,255,0.3)]">
                        <i class="ri-team-line text-4xl text-indigo-200"></i>
                    </div>
                    <h4 class="text-4xl leading-none font-bold text-white mb-3">Expert Team</h4>
                    <p class="text-blue-100/80 text-sm leading-relaxed">Certified professionals across all digital
                        disciplines dedicated to your success.</p>
                    <span
                        class="mt-5 block h-0.5 w-full bg-gradient-to-r from-violet-400/0 via-violet-300/70 to-violet-400/0"></span>
                </article>

                <article
                    class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
                    <span
                        class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-cyan-300 to-blue-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(84,178,255,0.55)]">03</span>
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-full border border-cyan-300/30 bg-[#132862]/75 flex items-center justify-center shadow-[0_0_20px_rgba(80,170,255,0.28)]">
                        <i class="ri-customer-service-2-line text-4xl text-cyan-200"></i>
                    </div>
                    <h4 class="text-4xl leading-none font-bold text-white mb-3">24/7 Support</h4>
                    <p class="text-blue-100/80 text-sm leading-relaxed">Round-the-clock assistance for all your needs. We
                        are always here to help.</p>
                    <span
                        class="mt-5 block h-0.5 w-full bg-gradient-to-r from-cyan-400/0 via-blue-300/70 to-cyan-400/0"></span>
                </article>

                <article
                    class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
                    <span
                        class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-violet-300 to-fuchsia-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(176,120,255,0.62)]">04</span>
                    <div
                        class="w-20 h-20 mx-auto mb-5 rounded-full border border-violet-300/35 bg-[#242064]/75 flex items-center justify-center shadow-[0_0_20px_rgba(176,120,255,0.3)]">
                        <i class="ri-money-dollar-circle-line text-4xl text-violet-200"></i>
                    </div>
                    <h4 class="text-4xl leading-none font-bold text-white mb-3">Competitive Pricing</h4>
                    <p class="text-blue-100/80 text-sm leading-relaxed">Best value packages with transparent pricing and no
                        hidden costs.</p>
                    <span
                        class="mt-5 block h-0.5 w-full bg-gradient-to-r from-fuchsia-400/0 via-violet-300/70 to-fuchsia-400/0"></span>
                </article>
            </div>

            <div
                class="grid grid-cols-2 lg:grid-cols-4 gap-4 rounded-2xl border border-cyan-300/25 bg-[#0a1847]/70 p-4 shadow-[0_0_24px_rgba(66,121,255,0.22)] mb-8">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-cyan-400/20 text-cyan-200 flex items-center justify-center"><i
                            class="ri-briefcase-4-line"></i></div>
                    <div>
                        <p class="text-white font-semibold text-sm">200+</p>
                        <p class="text-blue-100/70 text-xs">Projects Completed</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-400/20 text-indigo-200 flex items-center justify-center">
                        <i class="ri-emotion-happy-line"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">150+</p>
                        <p class="text-blue-100/70 text-xs">Happy Clients</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-cyan-400/20 text-cyan-200 flex items-center justify-center"><i
                            class="ri-trophy-line"></i></div>
                    <div>
                        <p class="text-white font-semibold text-sm">98%</p>
                        <p class="text-blue-100/70 text-xs">Client Satisfaction</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-violet-400/20 text-violet-200 flex items-center justify-center">
                        <i class="ri-line-chart-line"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">5+</p>
                        <p class="text-blue-100/70 text-xs">Years of Excellence</p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="#contact"
                    class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white font-semibold shadow-[0_0_20px_rgba(129,97,255,0.45)] hover:brightness-110 transition-all">Let's
                    Build Something Amazing <i class="ri-arrow-right-line"></i></a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white max-w-8xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-gray-900 mb-4">What Our Clients Say</h3>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto"> Real success stories from businesses across Pakistan
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-semibold">AH</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Ahmed Hussain</h5>
                            <p class="text-gray-600 text-sm">Founder, Lahore Electronics</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">"Bizz Online helped us build a powerful online store. Within a few
                        months, our customer base grew significantly, and our online orders increased by 250%."</p>
                    <div class="flex text-yellow-400">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                    </div>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-semibold">SZ</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Sara Zubair</h5>
                            <p class="text-gray-600 text-sm">Owner, Karachi Fitness Studio</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">"Their social media marketing strategy was a game-changer. We gained over
                        1,000 new clients in 90 days. Highly professional and responsive team."</p>
                    <div class="flex text-yellow-400">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                    </div>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mr-4">
                            <span class="text-white font-semibold">MT</span>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-900">Mohsin Tariq</h5>
                            <p class="text-gray-600 text-sm">CEO, Islamabad Tea House</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">"Their branding services gave our café a fresh new identity. Our foot
                        traffic and customer engagement both improved noticeably."</p>
                    <div class="flex text-yellow-400">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-20 relative overflow-hidden max-w-8xl"
        style="background-image: url('{{ asset('our_services_2.png') }}'); background-size: cover; background-position: center;">
        <div
            class="absolute inset-0 bg-[linear-gradient(150deg,rgba(3,11,40,0.82),rgba(8,24,76,0.72),rgba(18,24,89,0.78))]">
        </div>
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_18%_15%,rgba(78,208,255,0.14),transparent_33%),radial-gradient(circle_at_82%_28%,rgba(170,108,255,0.18),transparent_34%)]">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p
                    class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#0f225f]/70 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100 mb-4">
                    Our Services</p>
                <h3 class="text-4xl md:text-5xl font-bold text-white mb-3">We Build Digital Solutions</h3>
                <p class="text-blue-100/90 max-w-xl mx-auto text-lg leading-relaxed">Powerful, scalable and result-driven
                    services to grow your business online.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-paint-brush-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Branding & Design</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>Logo design</li>
                        <li>Brand identity (colors, typography, style guide)</li>
                        <li>Business card design</li>
                        <li>Social media kit (banners, post templates)</li>
                        <li>UI/UX design for apps & websites</li>
                        <li>Product packaging design (if needed)</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm shadow-[0_6px_18px_rgba(79,160,255,0.14)]">Get
                            Started <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-global-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Website Development</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>Business websites (company, portfolio, landing pages)</li>
                        <li>E-commerce websites (online stores)</li>
                        <li>Custom web applications (dashboards, CRM)</li>
                        <li>CMS development (WordPress, custom CMS)</li>
                        <li>Website redesign & optimization</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Request
                            Quote <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-smartphone-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Mobile App Development</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>Android apps</li>
                        <li>iOS apps</li>
                        <li>Cross-platform apps (Flutter / React Native)</li>
                        <li>App UI/UX design</li>
                        <li>App maintenance & updates</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Let's
                            Talk <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-tools-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Custom Software</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>ERP systems</li>
                        <li>CRM systems</li>
                        <li>Inventory & HRM systems</li>
                        <li>Billing & invoicing software</li>
                        <li>School / hospital management systems</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Explore
                            Options <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-cloud-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Backend & Cloud</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>API development</li>
                        <li>Database design & management</li>
                        <li>Cloud hosting setup (AWS, Google, Azure)</li>
                        <li>Server deployment & maintenance</li>
                        <li>DevOps automation</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Deploy
                            Now <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-megaphone-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Digital Marketing</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>SEO (Search Engine Optimization)</li>
                        <li>Social media marketing (Facebook, Instagram, TikTok)</li>
                        <li>Google Ads / PPC campaigns</li>
                        <li>Content marketing</li>
                        <li>Email marketing campaigns</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Grow
                            Traffic <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-image-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Graphic & Creative</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>Posters, banners, flyers</li>
                        <li>YouTube thumbnails</li>
                        <li>Video editing & motion graphics</li>
                        <li>Company presentations (PPT design)</li>
                        <li>UI mockups</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Creative
                            Work <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-settings-2-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Maintenance & Support</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>Bug fixing</li>
                        <li>Website updates</li>
                        <li>Security patches</li>
                        <li>Performance optimization</li>
                        <li>Backup management</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Support
                            Plans <i class="ri-arrow-right-line"></i></a></div>
                </article>

                <article
                    class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="w-14 h-14 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl">
                            <i class="ri-robot-line"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white">Advanced / Modern Services</h4>
                    </div>
                    <ul class="text-blue-100/75 text-sm leading-relaxed mb-5 list-disc list-inside">
                        <li>AI chatbot integration</li>
                        <li>Automation systems (WhatsApp, email, workflows)</li>
                        <li>Data analytics dashboards</li>
                        <li>SaaS product development</li>
                        <li>API integrations (payments, SMS, WhatsApp)</li>
                    </ul>
                    <div class="text-right"><a href="#contact"
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-sm">Innovate
                            <i class="ri-arrow-right-line"></i></a></div>
                </article>
            </div>

            <div
                class="rounded-2xl border border-indigo-300/25 bg-[#10225f]/78 p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="flex items-start gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">Secure Solutions</p>
                        <p class="text-blue-100/70 text-xs">We build secure and reliable systems to protect your data.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200">
                        <i class="ri-rocket-line"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">High Performance</p>
                        <p class="text-blue-100/70 text-xs">Optimized solutions for speed, scalability and performance.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200">
                        <i class="ri-customer-service-2-line"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">24/7 Support</p>
                        <p class="text-blue-100/70 text-xs">Our support team is always here to help you.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200">
                        <i class="ri-award-line"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm">Quality Guaranteed</p>
                        <p class="text-blue-100/70 text-xs">We deliver quality that you can trust and rely on.</p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="#contact"
                    class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white font-semibold shadow-[0_0_20px_rgba(129,97,255,0.45)] hover:brightness-110 transition-all">Let's
                    Build Something Amazing <i class="ri-arrow-right-line"></i></a>
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 relative overflow-hidden max-w-8xl"
        style="background-image: url('{{ asset('contact_us.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div
            class="absolute inset-0 bg-[linear-gradient(110deg,rgba(3,10,36,0.82)_0%,rgba(10,18,62,0.68)_44%,rgba(22,16,72,0.34)_100%)]">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-4xl md:text-5xl font-bold text-white mb-4">Ready to Start Your Project?</h3>
                <p class="text-lg text-blue-100/95 max-w-3xl mx-auto">Get in touch today for a free consultation and
                    discover how we can help grow your business.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
                <div
                    class="rounded-2xl border border-cyan-300/35 bg-[#0a1546]/82 shadow-[0_0_30px_rgba(72,126,255,0.32)] p-6 sm:p-8">
                    <div class="flex items-start gap-3 mb-5">
                        <div
                            class="w-10 h-10 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 flex items-center justify-center text-white">
                            <i class="ri-send-plane-line"></i>
                        </div>
                        <div>
                            <h4 class="text-2xl font-semibold text-white">Send us a Message</h4>
                            <p class="text-blue-100/80 text-sm">We'll get back to you as soon as possible.</p>
                        </div>
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

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm text-blue-100 mb-2">First Name</label>
                                <div class="relative">
                                    <i
                                        class="ri-user-3-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                                        placeholder="First Name"
                                        class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-blue-100 mb-2">Last Name</label>
                                <div class="relative">
                                    <i
                                        class="ri-user-3-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                                        placeholder="Last Name"
                                        class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Email</label>
                            <div class="relative">
                                <i
                                    class="ri-mail-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="you@example.com"
                                    class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Phone</label>
                            <div class="relative">
                                <i
                                    class="ri-phone-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    placeholder="+92 300 1234567"
                                    class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-blue-100 mb-2">Message</label>
                            <div class="relative">
                                <i class="ri-message-2-line absolute left-3 top-3 text-blue-200/80 text-sm"></i>
                                <textarea name="message" rows="4" placeholder="Tell us about your project..."
                                    class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">{{ old('message') }}</textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-cyan-400 via-blue-500 to-fuchsia-500 text-white py-3 px-6 !rounded-button hover:brightness-110 transition-all font-semibold whitespace-nowrap">
                            Send Message <i class="ri-arrow-right-line ml-1"></i>
                        </button>
                        <p class="text-xs text-blue-100/70 text-center">Your information is secure and confidential.</p>
                    </form>
                </div>

                <div class="pt-2 lg:pl-2">
                    <h4 class="text-4xl font-bold text-white mb-6">Get in Touch</h4>
                    <div class="space-y-4 max-w-sm">
                        <div class="flex items-center gap-4 p-3 rounded-xl border border-cyan-300/35 bg-[#101f5a]/70">
                            <div
                                class="w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-r from-indigo-500 to-cyan-400 text-white">
                                <i class="ri-phone-line"></i>
                            </div>
                            <div>
                                <p class="text-blue-100 text-sm">Phone</p>
                                <a href="tel:+923152457703" class="text-white font-semibold">+92 315 2457703</a>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 rounded-xl border border-cyan-300/35 bg-[#101f5a]/70">
                            <div
                                class="w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-r from-violet-500 to-indigo-500 text-white">
                                <i class="ri-map-pin-line"></i>
                            </div>
                            <div>
                                <p class="text-blue-100 text-sm">Address</p>
                                <p class="text-white font-semibold">Karachi, Pakistan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
