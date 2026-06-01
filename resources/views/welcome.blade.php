<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bizz Online - Complete Digital Solutions for Your Business Growth</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#3B82F6',
              secondary: '#1E40AF'
            },
            borderRadius: {
              'none': '0px',
              'sm': '4px',
              DEFAULT: '8px',
              'md': '12px',
              'lg': '16px',
              'xl': '20px',
              '2xl': '24px',
              '3xl': '32px',
              'full': '9999px',
              'button': '8px'
            }
          }
        }
      }
    </script>
    <style>
      :where([class^="ri-"])::before {
        content: "\f3c2";
      }
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      @keyframes floatUpDown {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
      }
      @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.25); }
        50% { box-shadow: 0 0 0 14px rgba(59, 130, 246, 0); }
      }
      .hero-float {
        animation: floatUpDown 4.2s ease-in-out infinite;
      }
      .hero-pulse {
        animation: pulseGlow 2.8s ease-in-out infinite;
      }
      .site-theme {
        --mx-bg-1: #060b25;
        --mx-bg-2: #0e1d4f;
        --mx-bg-3: #3d1a67;
        --mx-accent-cyan: #55d6ff;
        --mx-accent-indigo: #7a8cff;
        --mx-accent-violet: #b07bff;
        --mx-accent-pink: #f06bff;
        background:
          radial-gradient(circle at 15% 10%, rgba(85, 214, 255, 0.16), transparent 34%),
          radial-gradient(circle at 80% 20%, rgba(176, 123, 255, 0.18), transparent 35%),
          radial-gradient(circle at 60% 85%, rgba(240, 107, 255, 0.14), transparent 38%),
          linear-gradient(180deg, var(--mx-bg-1) 0%, #090f34 35%, #13134a 70%, #140f3f 100%);
      }
      .site-theme section:not(#home):not(#services):not(#portfolio):not(#contact) {
        background:
          radial-gradient(circle at 8% 25%, rgba(85, 214, 255, 0.12), transparent 32%),
          radial-gradient(circle at 92% 18%, rgba(176, 123, 255, 0.15), transparent 30%),
          linear-gradient(140deg, #060f32 0%, #13235b 42%, #311f64 100%) !important;
      }
      .site-theme .bg-white,
      .site-theme .bg-gray-50 {
        background:
          linear-gradient(145deg, rgba(11, 25, 70, 0.94), rgba(29, 22, 72, 0.92)) !important;
      }
      .site-theme .text-gray-900 {
        color: #ecf4ff !important;
      }
      .site-theme .text-gray-700,
      .site-theme .text-gray-600,
      .site-theme .text-gray-500,
      .site-theme .text-gray-400 {
        color: #c7d4f8 !important;
      }
      .site-theme .border-gray-200,
      .site-theme .border-gray-300,
      .site-theme .border-gray-700,
      .site-theme .border-gray-800 {
        border-color: rgba(140, 140, 255, 0.32) !important;
      }
      .site-theme .service-card,
      .site-theme .service-detail,
      .site-theme .shadow-sm,
      .site-theme .shadow-md {
        box-shadow: 0 12px 30px rgba(10, 13, 55, 0.5), 0 0 28px rgba(122, 140, 255, 0.15) !important;
      }
      .site-theme input,
      .site-theme textarea {
        background: linear-gradient(145deg, rgba(12, 22, 62, 0.95), rgba(28, 21, 64, 0.95)) !important;
        color: #e6efff !important;
        border-color: rgba(143, 157, 255, 0.35) !important;
      }
      .site-theme input::placeholder,
      .site-theme textarea::placeholder {
        color: #b8c6ef !important;
      }
      .site-theme .bg-primary,
      .site-theme .from-primary,
      .site-theme .to-secondary {
        background-image: linear-gradient(90deg, var(--mx-accent-cyan), var(--mx-accent-indigo), var(--mx-accent-violet)) !important;
      }
      .site-theme .text-primary {
        color: #8cc7ff !important;
      }
      .support-fab {
        box-shadow: 0 0 18px rgba(98, 143, 255, 0.45);
      }
      .support-panel {
        box-shadow: 0 0 28px rgba(124, 110, 255, 0.35);
      }
      .hero-cta {
        position: relative;
        overflow: hidden;
        background-image: linear-gradient(90deg, #1d4ed8 0%, #4338ca 50%, #7e22ce 100%);
        box-shadow: 0 12px 28px rgba(48, 45, 120, 0.5);
        transition: transform 220ms ease, box-shadow 220ms ease, filter 220ms ease;
      }
      .hero-cta::after {
        content: "";
        position: absolute;
        top: -120%;
        left: -35%;
        width: 42%;
        height: 340%;
        transform: rotate(22deg);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0));
        opacity: 0;
        transition: left 320ms ease, opacity 320ms ease;
        pointer-events: none;
      }
      .hero-cta:hover {
        transform: translateY(-2px);
        filter: brightness(1.07);
        box-shadow: 0 16px 34px rgba(72, 54, 160, 0.62), 0 0 20px rgba(122, 92, 255, 0.45);
      }
      .hero-cta:hover::after {
        left: 120%;
        opacity: 1;
      }
      .hero-cta-secondary {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(34, 71, 157, 0.35), rgba(74, 38, 146, 0.35));
        border: 1px solid rgba(117, 218, 255, 0.55);
        box-shadow: inset 0 0 0 1px rgba(126, 98, 255, 0.2), 0 10px 24px rgba(24, 39, 105, 0.45);
        transition: transform 220ms ease, box-shadow 220ms ease, background 220ms ease;
      }
      .hero-cta-secondary:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, rgba(52, 103, 215, 0.45), rgba(120, 52, 195, 0.42));
        box-shadow: inset 0 0 0 1px rgba(168, 210, 255, 0.35), 0 14px 30px rgba(40, 67, 162, 0.5), 0 0 18px rgba(94, 175, 255, 0.35);
      }
      .hover-glow-card {
        position: relative;
        overflow: hidden;
        transition: transform 220ms ease, box-shadow 220ms ease, border-color 220ms ease, filter 220ms ease;
      }
      .hover-glow-card::after {
        content: "";
        position: absolute;
        top: -135%;
        left: -30%;
        width: 38%;
        height: 360%;
        transform: rotate(20deg);
        background: linear-gradient(180deg, rgba(180, 240, 255, 0), rgba(180, 240, 255, 0.45), rgba(180, 240, 255, 0));
        opacity: 0;
        transition: left 340ms ease, opacity 340ms ease;
        pointer-events: none;
      }
      .hover-glow-card:hover {
        transform: translateY(-5px);
        filter: brightness(1.08);
        border-color: rgba(156, 230, 255, 0.7) !important;
        box-shadow: 0 18px 36px rgba(72, 108, 190, 0.35), 0 0 26px rgba(132, 208, 255, 0.5) !important;
      }
      .hover-glow-card:hover::after {
        left: 118%;
        opacity: 1;
      }
      .portfolio-stage {
        --robot-space: clamp(170px, 24vw, 340px);
        --cards-shift: clamp(10px, 2.8vw, 56px);
      }
      @media (min-width: 1024px) {
        .portfolio-stage .portfolio-content {
          padding-right: var(--robot-space);
        }
        .portfolio-stage .portfolio-cards {
          transform: translateX(calc(-1 * var(--cards-shift)));
        }
      }
      .site-preloader {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at 20% 20%, rgba(78,196,255,0.16), transparent 32%), radial-gradient(circle at 80% 18%, rgba(180,105,255,0.2), transparent 35%), linear-gradient(180deg, #040b28 0%, #07133b 55%, #0d1d53 100%);
        transition: opacity 500ms ease, visibility 500ms ease;
      }
      .site-preloader.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
      }
      .loader-ring {
        width: 84px;
        height: 84px;
        border-radius: 9999px;
        border: 3px solid rgba(102, 145, 255, 0.25);
        border-top-color: #53d6ff;
        border-right-color: #b07bff;
        animation: loaderSpin 1s linear infinite;
        box-shadow: 0 0 24px rgba(115, 137, 255, 0.45);
      }
      .loader-core {
        width: 54px;
        height: 54px;
        border-radius: 9999px;
        background: linear-gradient(135deg, #2bc4ff, #6f7dff, #c06eff);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 24px rgba(120, 126, 255, 0.6);
      }
      @keyframes loaderSpin {
        to { transform: rotate(360deg); }
      }
    </style>
  </head>
  <body class="site-theme bg-white">
    <div id="site-preloader" class="site-preloader" role="status" aria-live="polite">
      <div class="text-center text-white">
        <div class="mx-auto relative w-[84px] h-[84px] mb-5">
          <div class="loader-ring"></div>
          <div class="loader-core absolute inset-0 m-auto"><i class="ri-robot-2-line text-white text-2xl"></i></div>
        </div>
        <p class="text-sm tracking-[0.25em] uppercase text-cyan-100/90">Preparing Experience...</p>
      </div>
    </div>
    <header class="fixed top-0 left-0 w-full z-50 border-t border-cyan-300/30 bg-[#050d2a]/55 backdrop-blur-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-28 flex items-center justify-between gap-4">
          <a href="#home" class="flex items-center gap-3 group">
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gradient-to-br from-cyan-400 via-indigo-500 to-fuchsia-500 shadow-[0_0_18px_rgba(110,132,255,0.55)]">
              <i class="ri-rocket-fill text-white text-base"></i>
            </div>
            <div>
              <h1 class="text-2xl font-['Pacifico'] text-white leading-none">Biz Online</h1>
              <p class="text-[10px] tracking-[0.22em] text-cyan-200/90 uppercase mt-1">Digital Growth Studio</p>
            </div>
          </a>

          <nav class="hidden lg:flex items-center gap-1 p-1 rounded-full border border-indigo-300/35 bg-[#121f4e]/85 shadow-[0_0_20px_rgba(112,120,255,0.25)]">
            <a href="#home" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full">Home</a>
            <a href="#portfolio" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full">Work</a>

            <div class="relative group">
              <a href="#services" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full inline-flex items-center gap-1">Web Design <i class="ri-arrow-down-s-line"></i></a>
              <div class="absolute top-full left-0 mt-3 w-[220px] rounded-xl border border-indigo-300/35 bg-[#101d49]/95 p-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Responsive Website</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Content Management System (CMS)</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">E-commerce Website</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Magento Website</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Web Applications</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Web Maintenance</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Domain & Hosting</a>
              </div>
            </div>

            <div class="relative group">
              <a href="#services" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full inline-flex items-center gap-1">Digital Marketing <i class="ri-arrow-down-s-line"></i></a>
              <div class="absolute top-full left-0 mt-3 w-[220px] rounded-xl border border-indigo-300/35 bg-[#101d49]/95 p-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Search Engine Optimization (SEO)</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Social Media Optimization (SMO)</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Pay-Per-Click Advertising (PPC)</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">SMS Marketing</a>
              </div>
            </div>

            <div class="relative group">
              <a href="#services" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full inline-flex items-center gap-1">Software <i class="ri-arrow-down-s-line"></i></a>
              <div class="absolute top-full left-0 mt-3 w-[220px] rounded-xl border border-indigo-300/35 bg-[#101d49]/95 p-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Transport Management System</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">School Management System</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Pharmacy Store Management System</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Export Management System</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Digitizing Portal</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Accounts Software</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Point of Sale (POS)</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">ERP Solution</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">CRM Development</a>
              </div>
            </div>

            <div class="relative group">
              <a href="#services" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full inline-flex items-center gap-1">Mobile <i class="ri-arrow-down-s-line"></i></a>
              <div class="absolute top-full left-0 mt-3 w-[220px] rounded-xl border border-indigo-300/35 bg-[#101d49]/95 p-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Android Apps</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">iOS Apps</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Flutter Apps</a>
              </div>
            </div>

            <div class="relative group">
              <a href="#services" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full inline-flex items-center gap-1">Branding <i class="ri-arrow-down-s-line"></i></a>
              <div class="absolute top-full left-0 mt-3 w-[220px] rounded-xl border border-indigo-300/35 bg-[#101d49]/95 p-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Logo Design</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Brand Identity</a>
                <a href="#services" class="block px-3 py-2 text-sm text-blue-100 hover:bg-white/10 rounded-lg">Packaging</a>
              </div>
            </div>

            <a href="#contact" class="px-4 py-2 text-xs font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full">Contact Us</a>
          </nav>

          <div class="flex items-center gap-3">
         
            <a href="#contact" class="bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-5 py-2.5 !rounded-button whitespace-nowrap font-semibold inline-flex items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)]">
              <span>Book Free Call</span>
              <i class="ri-arrow-right-up-line"></i>
            </a>
          </div>
        </div>

        <div class="lg:hidden pb-4">
          <div class="flex gap-2 overflow-x-auto no-scrollbar">
            <a href="#home" class="px-4 py-2 text-sm font-semibold bg-cyan-400/20 border border-cyan-300/40 text-cyan-100 rounded-full whitespace-nowrap">Home</a>
            <a href="#services" class="px-4 py-2 text-sm font-semibold bg-[#243c5f]/90 border border-cyan-300/30 text-cyan-100 rounded-full whitespace-nowrap">Services</a>
            <a href="#portfolio" class="px-4 py-2 text-sm font-semibold bg-[#243c5f]/90 border border-cyan-300/30 text-cyan-100 rounded-full whitespace-nowrap">Portfolio</a>
            <a href="#contact" class="px-4 py-2 text-sm font-semibold bg-[#243c5f]/90 border border-cyan-300/30 text-cyan-100 rounded-full whitespace-nowrap">Contact</a>
          </div>
        </div>
      </div>
    </header>
    <section id="home" class="relative min-h-[92vh] overflow-hidden bg-[#081223]">
      <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('hero.png') }}');"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-[#040a18]/92 via-[#07153a]/74 to-[#0a1933]/32"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(56,189,248,0.18),transparent_40%),radial-gradient(circle_at_70%_75%,rgba(99,102,241,0.18),transparent_35%)]"></div>
      <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-b from-transparent via-[#120f49]/35 to-[#1c216a]/92"></div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-[92vh] grid lg:grid-cols-2 gap-12 items-center pt-56 lg:pt-64 pb-20">
        <div class="text-white">
          <p class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.22em] bg-[#12305a]/80 border border-cyan-300/35 rounded-full px-4 py-2 mb-6">
            <span class="w-2 h-2 rounded-full bg-cyan-300"></span>
            AI Powered Digital Solutions
          </p>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-[1.05] mb-6">Crafting Bold <br> Digital Presence <br> For Brands That Want To Lead</h2>
          <p class="text-base sm:text-lg text-blue-100/90 leading-relaxed mb-9 max-w-2xl">We combine strategy, premium design, and high-performance development to deliver portfolio-grade websites that look exceptional and convert visitors into clients.</p>
          <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <a href="#contact" class="hero-cta text-white px-8 py-4 !rounded-button text-base font-semibold inline-flex items-center justify-center gap-2 whitespace-nowrap min-h-[56px]">
              Launch Your Project
              <i class="ri-arrow-right-up-line"></i>
            </a>
            <a href="#portfolio" class="hero-cta-secondary text-cyan-100 px-8 py-4 !rounded-button text-base font-semibold inline-flex items-center justify-center gap-2 whitespace-nowrap min-h-[56px]">
              <span>Explore Portfolio</span>
              <i class="ri-arrow-right-up-line"></i>
            </a>
          </div>
          <div class="flex flex-wrap items-center gap-6 text-blue-100/90">
            <div class="flex items-center gap-2 text-sm"><span class="w-2 h-2 rounded-full bg-cyan-300"></span> 200+ Projects Delivered</div>
            <div class="flex items-center gap-2 text-sm"><span class="w-2 h-2 rounded-full bg-indigo-300"></span> Performance Focused Builds</div>
            <div class="flex items-center gap-2 text-sm"><span class="w-2 h-2 rounded-full bg-violet-300"></span> End-to-End Creative Team</div>
          </div>
        </div>

        <div class="hidden lg:block"></div>
      </div>
    </section>

    <section id="portfolio" class="portfolio-stage relative py-20 overflow-hidden -mt-8 pt-24">
      <div class="absolute inset-0 bg-cover bg-right" style="background-image: url('{{ asset('portfolio_section.png') }}');"></div>
      <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(3,10,33,0.86),rgba(10,17,61,0.70),rgba(22,14,69,0.45))]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_24%_20%,rgba(93,203,255,0.16),transparent_33%),radial-gradient(circle_at_75%_62%,rgba(174,97,255,0.20),transparent_33%)]"></div>
      <div class="portfolio-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-10">
          <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#111a4b]/70 text-[11px] uppercase tracking-[0.22em] text-cyan-100 mb-4">Our Work</p>
          <h3 class="text-5xl md:text-6xl font-bold text-white mb-2 leading-none">Our Portfolio</h3>
          <p class="text-blue-100/85 text-sm md:text-base max-w-2xl mx-auto">Showcasing successful projects across all our service areas</p>
        </div>
        <div class="portfolio-cards relative z-10 transition-transform">
          <div class="overflow-hidden" id="portfolio-carousel-window">
            <div class="flex transition-transform duration-500 ease-out" id="portfolio-carousel-track">
              <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                <div class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                  <div class="h-44 bg-cover bg-center" style="background-image:url('{{ asset('our_services.png') }}');"></div>
                  <div class="p-4">
                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                      <span class="px-2 py-0.5 rounded-full bg-indigo-300/20 text-indigo-100 border border-indigo-300/30">Branding</span>
                      <span class="text-blue-200/90">Urban Cafe</span>
                    </div>
                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Complete Brand Identity</h4>
                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Craft a modern, memorable brand identity that elevates Urban Cafe's presence.</p>
                    <div class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3"><span>+78%</span><span>100%</span></div>
                  </div>
                </div>
              </article>
              <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                <div class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                  <div class="h-44 bg-cover bg-center" style="background-image:url('{{ asset('our_services_2.png') }}');"></div>
                  <div class="p-4">
                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                      <span class="px-2 py-0.5 rounded-full bg-fuchsia-300/20 text-fuchsia-100 border border-fuchsia-300/30">App Development</span>
                      <span class="text-blue-200/90">DeliveryPro</span>
                    </div>
                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Mobile App Development</h4>
                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Designed and developed a powerful mobile delivery app for iOS and Android.</p>
                    <div class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3"><span>10K+</span><span>4.8</span></div>
                  </div>
                </div>
              </article>
              <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                <div class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                  <div class="h-44 bg-cover bg-center" style="background-image:url('{{ asset('portfolio_section.png') }}');"></div>
                  <div class="p-4">
                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                      <span class="px-2 py-0.5 rounded-full bg-amber-300/20 text-amber-100 border border-amber-300/30">Content</span>
                      <span class="text-blue-200/90">TechStartup Inc</span>
                    </div>
                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Content Marketing </h4>
                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Built a content engine that drives organic growth.</p>
                    <div class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3"><span>+200%</span><span>+95%</span></div>
                  </div>
                </div>
              </article>
              <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                <div class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                  <div class="h-44 bg-cover bg-center" style="background-image:url('{{ asset('hero.png') }}');"></div>
                  <div class="p-4">
                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                      <span class="px-2 py-0.5 rounded-full bg-cyan-300/20 text-cyan-100 border border-cyan-300/30">Web Development</span>
                      <span class="text-blue-200/90">Nova Traders</span>
                    </div>
                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">Corporate Website Revamp</h4>
                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Redesigned the full digital presence with faster performance and better conversion flow.</p>
                    <div class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3"><span>+140%</span><span>3.1s</span></div>
                  </div>
                </div>
              </article>
              <article class="portfolio-slide w-full md:w-1/2 lg:w-1/3 shrink-0 px-3">
                <div class="rounded-2xl border border-indigo-300/45 bg-[#11184c]/88 shadow-[0_0_24px_rgba(120,127,255,0.35)] overflow-hidden">
                  <div class="h-44 bg-cover bg-center" style="background-image:url('{{ asset('contact_us.png') }}');"></div>
                  <div class="p-4">
                    <div class="flex items-center gap-2 mb-2 text-[10px]">
                      <span class="px-2 py-0.5 rounded-full bg-violet-300/20 text-violet-100 border border-violet-300/30">Lead Generation</span>
                      <span class="text-blue-200/90">SkillBridge Academy</span>
                    </div>
                    <h4 class="text-[29px] leading-none font-semibold text-white mb-2">High-Converting Funnel</h4>
                    <p class="text-blue-100/80 text-xs leading-relaxed mb-4">Built campaign landing pages with for admissions.</p>
                    <div class="flex items-center justify-between text-[11px] text-blue-200/90 border-t border-indigo-300/20 pt-3"><span>+220%</span><span>42%</span></div>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <div class="mt-8 flex items-center justify-center gap-4">
            <button id="portfolio-prev" class="w-11 h-11 rounded-full border border-cyan-300/45 bg-[#162463]/80 text-white hover:bg-[#24357f] transition-colors"><i class="ri-arrow-left-s-line text-lg"></i></button>
            <button id="portfolio-next" class="w-11 h-11 rounded-full border border-cyan-300/45 bg-[#162463]/80 text-white hover:bg-[#24357f] transition-colors"><i class="ri-arrow-right-s-line text-lg"></i></button>
          </div>
        </div>
      </div>
    </section>
    <section class="py-24 relative overflow-hidden">
      <div class="absolute inset-0 bg-[linear-gradient(145deg,#030d32_0%,#08184a_42%,#1d1657_100%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_14%_16%,rgba(88,210,255,0.16),transparent_34%),radial-gradient(circle_at_88%_12%,rgba(169,116,255,0.17),transparent_33%),radial-gradient(circle_at_52%_90%,rgba(75,122,255,0.16),transparent_36%)]"></div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
          <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#0e235f]/75 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100 mb-5">Why Choose Bizz Online?</p>
          <h3 class="text-4xl sm:text-5xl font-bold text-white mb-4">Why <span class="text-cyan-300">Choose</span> Bizz Online?</h3>
          <p class="text-blue-100/90 text-lg max-w-3xl mx-auto">We deliver comprehensive digital solutions with proven results</p>
          <div class="mt-5 flex items-center justify-center gap-3">
            <span class="w-20 h-px bg-gradient-to-r from-transparent via-cyan-300/70 to-transparent"></span>
            <span class="w-2 h-2 rounded-full bg-cyan-300 shadow-[0_0_10px_rgba(85,214,255,0.9)]"></span>
            <span class="w-20 h-px bg-gradient-to-r from-transparent via-indigo-300/70 to-transparent"></span>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <article class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
            <span class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-cyan-300 to-indigo-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(84,178,255,0.55)]">01</span>
            <div class="w-20 h-20 mx-auto mb-5 rounded-full border border-cyan-300/30 bg-[#132862]/75 flex items-center justify-center shadow-[0_0_20px_rgba(80,170,255,0.28)]"><i class="ri-award-line text-4xl text-cyan-200"></i></div>
            <h4 class="text-4xl leading-none font-bold text-white mb-3">5+ Years Experience</h4>
            <p class="text-blue-100/80 text-sm leading-relaxed">Proven track record with 200+ successful projects delivered across various industries.</p>
            <span class="mt-5 block h-0.5 w-full bg-gradient-to-r from-cyan-400/0 via-cyan-300/70 to-cyan-400/0"></span>
          </article>

          <article class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
            <span class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-indigo-300 to-violet-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(124,130,255,0.6)]">02</span>
            <div class="w-20 h-20 mx-auto mb-5 rounded-full border border-indigo-300/35 bg-[#1c2462]/75 flex items-center justify-center shadow-[0_0_20px_rgba(124,130,255,0.3)]"><i class="ri-team-line text-4xl text-indigo-200"></i></div>
            <h4 class="text-4xl leading-none font-bold text-white mb-3">Expert Team</h4>
            <p class="text-blue-100/80 text-sm leading-relaxed">Certified professionals across all digital disciplines dedicated to your success.</p>
            <span class="mt-5 block h-0.5 w-full bg-gradient-to-r from-violet-400/0 via-violet-300/70 to-violet-400/0"></span>
          </article>

          <article class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
            <span class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-cyan-300 to-blue-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(84,178,255,0.55)]">03</span>
            <div class="w-20 h-20 mx-auto mb-5 rounded-full border border-cyan-300/30 bg-[#132862]/75 flex items-center justify-center shadow-[0_0_20px_rgba(80,170,255,0.28)]"><i class="ri-customer-service-2-line text-4xl text-cyan-200"></i></div>
            <h4 class="text-4xl leading-none font-bold text-white mb-3">24/7 Support</h4>
            <p class="text-blue-100/80 text-sm leading-relaxed">Round-the-clock assistance for all your needs. We are always here to help.</p>
            <span class="mt-5 block h-0.5 w-full bg-gradient-to-r from-cyan-400/0 via-blue-300/70 to-cyan-400/0"></span>
          </article>

          <article class="hover-glow-card relative rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 p-6 text-center shadow-[0_0_22px_rgba(90,118,255,0.22)]">
            <span class="absolute -top-4 left-4 w-10 h-10 rounded-full bg-gradient-to-br from-violet-300 to-fuchsia-500 text-white text-sm font-bold flex items-center justify-center shadow-[0_0_18px_rgba(176,120,255,0.62)]">04</span>
            <div class="w-20 h-20 mx-auto mb-5 rounded-full border border-violet-300/35 bg-[#242064]/75 flex items-center justify-center shadow-[0_0_20px_rgba(176,120,255,0.3)]"><i class="ri-money-dollar-circle-line text-4xl text-violet-200"></i></div>
            <h4 class="text-4xl leading-none font-bold text-white mb-3">Competitive Pricing</h4>
            <p class="text-blue-100/80 text-sm leading-relaxed">Best value packages with transparent pricing and no hidden costs.</p>
            <span class="mt-5 block h-0.5 w-full bg-gradient-to-r from-fuchsia-400/0 via-violet-300/70 to-fuchsia-400/0"></span>
          </article>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 rounded-2xl border border-cyan-300/25 bg-[#0a1847]/70 p-4 shadow-[0_0_24px_rgba(66,121,255,0.22)]">
          <div class="hover-glow-card flex items-center gap-3 rounded-xl border border-cyan-300/20 bg-[#12255f]/70 px-4 py-3">
            <span class="w-10 h-10 rounded-full bg-cyan-400/20 text-cyan-200 flex items-center justify-center"><i class="ri-briefcase-4-line text-lg"></i></span>
            <p class="text-blue-100 text-sm"><span class="block text-2xl font-bold text-cyan-200">200+</span>Projects Completed</p>
          </div>
          <div class="hover-glow-card flex items-center gap-3 rounded-xl border border-indigo-300/25 bg-[#172360]/70 px-4 py-3">
            <span class="w-10 h-10 rounded-full bg-indigo-400/20 text-indigo-200 flex items-center justify-center"><i class="ri-emotion-happy-line text-lg"></i></span>
            <p class="text-blue-100 text-sm"><span class="block text-2xl font-bold text-indigo-200">150+</span>Happy Clients</p>
          </div>
          <div class="hover-glow-card flex items-center gap-3 rounded-xl border border-cyan-300/25 bg-[#12255f]/70 px-4 py-3">
            <span class="w-10 h-10 rounded-full bg-cyan-400/20 text-cyan-200 flex items-center justify-center"><i class="ri-trophy-line text-lg"></i></span>
            <p class="text-blue-100 text-sm"><span class="block text-2xl font-bold text-cyan-200">98%</span>Client Satisfaction</p>
          </div>
          <div class="hover-glow-card flex items-center gap-3 rounded-xl border border-violet-300/25 bg-[#1e2362]/70 px-4 py-3">
            <span class="w-10 h-10 rounded-full bg-violet-400/20 text-violet-200 flex items-center justify-center"><i class="ri-line-chart-line text-lg"></i></span>
            <p class="text-blue-100 text-sm"><span class="block text-2xl font-bold text-violet-200">5+</span>Years of Excellence</p>
          </div>
        </div>
      </div>
    </section>
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h3 class="text-4xl font-bold text-gray-900 mb-4">What Our Clients Say</h3>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto"> Real success stories from businesses across Pakistan </p>
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
        <p class="text-gray-700 mb-4">"Bizz Online helped us build a powerful online store. Within a few months, our customer base grew significantly, and our online orders increased by 250%."</p>
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
        <p class="text-gray-700 mb-4">"Their social media marketing strategy was a game-changer. We gained over 1,000 new clients in 90 days. Highly professional and responsive team."</p>
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
        <p class="text-gray-700 mb-4">"Their branding services gave our café a fresh new identity. Our foot traffic and customer engagement both improved noticeably."</p>
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
    <section id="services" class="py-20 relative overflow-hidden" style="background-image: url('{{ asset('our_services_2.png') }}'); background-size: cover; background-position: center;">
      <div class="absolute inset-0 bg-[linear-gradient(150deg,rgba(3,11,40,0.82),rgba(8,24,76,0.72),rgba(18,24,89,0.78))]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_15%,rgba(78,208,255,0.14),transparent_33%),radial-gradient(circle_at_82%_28%,rgba(170,108,255,0.18),transparent_34%)]"></div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <p class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#0f225f]/70 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100 mb-4">Our Services</p>
          <h3 class="text-4xl md:text-5xl font-bold text-white mb-3">We Build Digital Solutions</h3>
          <p class="text-blue-100/90 max-w-xl mx-auto text-lg leading-relaxed">Powerful, scalable and result-driven services to grow your business online.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
          <article class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-5 text-center transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 flex items-center justify-center mb-4"><i class="ri-building-4-line text-cyan-200 text-2xl"></i></div>
            <h4 class="text-2xl font-bold text-white mb-3">ERP</h4>
            <p class="text-blue-100/75 text-sm leading-relaxed mb-5">Streamline operations, manage resources and increase efficiency across your business.</p>
            <button class="mx-auto w-8 h-8 rounded-full border border-cyan-300/35 bg-[#122765] text-cyan-100 transition-all duration-300 group-hover:bg-cyan-400 group-hover:text-[#07173f] group-hover:scale-110 group-hover:shadow-[0_0_16px_rgba(85,214,255,0.7)]"><i class="ri-arrow-right-line"></i></button>
          </article>

          <article class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-5 text-center transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 flex items-center justify-center mb-4"><i class="ri-calculator-line text-cyan-200 text-2xl"></i></div>
            <h4 class="text-2xl font-bold text-white mb-3">POS</h4>
            <p class="text-blue-100/75 text-sm leading-relaxed mb-5">Fast, secure and reliable point of sale solutions for your retail business.</p>
            <button class="mx-auto w-8 h-8 rounded-full border border-cyan-300/35 bg-[#122765] text-cyan-100 transition-all duration-300 group-hover:bg-cyan-400 group-hover:text-[#07173f] group-hover:scale-110 group-hover:shadow-[0_0_16px_rgba(85,214,255,0.7)]"><i class="ri-arrow-right-line"></i></button>
          </article>

          <article class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-5 text-center transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 flex items-center justify-center mb-4"><i class="ri-team-line text-cyan-200 text-2xl"></i></div>
            <h4 class="text-2xl font-bold text-white mb-3">CRM</h4>
            <p class="text-blue-100/75 text-sm leading-relaxed mb-5">Build stronger customer relationships and grow your business with smart CRM tools.</p>
            <button class="mx-auto w-8 h-8 rounded-full border border-cyan-300/35 bg-[#122765] text-cyan-100 transition-all duration-300 group-hover:bg-cyan-400 group-hover:text-[#07173f] group-hover:scale-110 group-hover:shadow-[0_0_16px_rgba(85,214,255,0.7)]"><i class="ri-arrow-right-line"></i></button>
          </article>

          <article class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-5 text-center transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 flex items-center justify-center mb-4"><i class="ri-graduation-cap-line text-cyan-200 text-2xl"></i></div>
            <h4 class="text-2xl font-bold text-white mb-3">LMS</h4>
            <p class="text-blue-100/75 text-sm leading-relaxed mb-5">Create, manage and deliver engaging online learning experiences with ease.</p>
            <button class="mx-auto w-8 h-8 rounded-full border border-cyan-300/35 bg-[#122765] text-cyan-100 transition-all duration-300 group-hover:bg-cyan-400 group-hover:text-[#07173f] group-hover:scale-110 group-hover:shadow-[0_0_16px_rgba(85,214,255,0.7)]"><i class="ri-arrow-right-line"></i></button>
          </article>

          <article class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/78 p-5 text-center transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_22px_rgba(96,157,255,0.28)]">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 flex items-center justify-center mb-4"><i class="ri-file-list-3-line text-cyan-200 text-2xl"></i></div>
            <h4 class="text-2xl font-bold text-white mb-3">CMS</h4>
            <p class="text-blue-100/75 text-sm leading-relaxed mb-5">Easily manage your website content and keep your digital presence up to date.</p>
            <button class="mx-auto w-8 h-8 rounded-full border border-cyan-300/35 bg-[#122765] text-cyan-100 transition-all duration-300 group-hover:bg-cyan-400 group-hover:text-[#07173f] group-hover:scale-110 group-hover:shadow-[0_0_16px_rgba(85,214,255,0.7)]"><i class="ri-arrow-right-line"></i></button>
          </article>
        </div>

        <div class="rounded-2xl border border-indigo-300/25 bg-[#10225f]/78 p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200"><i class="ri-shield-check-line"></i></div>
            <div><p class="text-white font-semibold text-sm">Secure Solutions</p><p class="text-blue-100/70 text-xs">We build secure and reliable systems to protect your data.</p></div>
          </div>
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200"><i class="ri-rocket-line"></i></div>
            <div><p class="text-white font-semibold text-sm">High Performance</p><p class="text-blue-100/70 text-xs">Optimized solutions for speed, scalability and performance.</p></div>
          </div>
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200"><i class="ri-customer-service-2-line"></i></div>
            <div><p class="text-white font-semibold text-sm">24/7 Support</p><p class="text-blue-100/70 text-xs">Our support team is always here to help you.</p></div>
          </div>
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-[#1a2f78]/80 border border-cyan-300/30 flex items-center justify-center text-cyan-200"><i class="ri-award-line"></i></div>
            <div><p class="text-white font-semibold text-sm">Quality Guaranteed</p><p class="text-blue-100/70 text-xs">We deliver quality that you can trust and rely on.</p></div>
          </div>
        </div>

        <div class="text-center">
          <a href="#contact" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white font-semibold shadow-[0_0_20px_rgba(129,97,255,0.45)] hover:brightness-110 transition-all">Let's Build Something Amazing <i class="ri-arrow-right-line"></i></a>
        </div>
      </div>
    </section>
    <section id="contact" class="py-20 relative overflow-hidden" style="background-image: url('{{ asset('contact_us.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="absolute inset-0 bg-[linear-gradient(110deg,rgba(3,10,36,0.82)_0%,rgba(10,18,62,0.68)_44%,rgba(22,16,72,0.34)_100%)]"></div>
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h3 class="text-4xl md:text-5xl font-bold text-white mb-4">Ready to Start Your Project?</h3>
          <p class="text-lg text-blue-100/95 max-w-3xl mx-auto">Get in touch today for a free consultation and discover how we can help grow your business.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
          <div class="rounded-2xl border border-cyan-300/35 bg-[#0a1546]/82 shadow-[0_0_30px_rgba(72,126,255,0.32)] p-6 sm:p-8">
            <div class="flex items-start gap-3 mb-5">
              <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 flex items-center justify-center text-white">
                <i class="ri-send-plane-line"></i>
              </div>
              <div>
                <h4 class="text-2xl font-semibold text-white">Send us a Message</h4>
                <p class="text-blue-100/80 text-sm">We'll get back to you as soon as possible.</p>
              </div>
            </div>

            @if(session('success'))
              <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
              <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
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
                    <i class="ri-user-3-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                  </div>
                </div>
                <div>
                  <label class="block text-sm text-blue-100 mb-2">Last Name</label>
                  <div class="relative">
                    <i class="ri-user-3-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                  </div>
                </div>
              </div>
              <div>
                <label class="block text-sm text-blue-100 mb-2">Email</label>
                <div class="relative">
                  <i class="ri-mail-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                </div>
              </div>
              <div>
                <label class="block text-sm text-blue-100 mb-2">Phone</label>
                <div class="relative">
                  <i class="ri-phone-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
                  <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+92 300 1234567" class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">
                </div>
              </div>
              <div>
                <label class="block text-sm text-blue-100 mb-2">Message</label>
                <div class="relative">
                  <i class="ri-message-2-line absolute left-3 top-3 text-blue-200/80 text-sm"></i>
                  <textarea name="message" rows="4" placeholder="Tell us about your project..." class="w-full pl-9 pr-3 py-3 border border-blue-300/30 bg-[#0d1f56]/85 text-blue-50 rounded-lg focus:ring-2 focus:ring-cyan-300/60 focus:border-cyan-300/60 text-sm">{{ old('message') }}</textarea>
                </div>
              </div>
              <button type="submit" class="w-full bg-gradient-to-r from-cyan-400 via-blue-500 to-fuchsia-500 text-white py-3 px-6 !rounded-button hover:brightness-110 transition-all font-semibold whitespace-nowrap">
                Send Message <i class="ri-arrow-right-line ml-1"></i>
              </button>
              <p class="text-xs text-blue-100/70 text-center">Your information is secure and confidential.</p>
            </form>
          </div>

          <div class="pt-2 lg:pl-2">
            <h4 class="text-4xl font-bold text-white mb-6">Get in Touch</h4>
            <div class="space-y-4 max-w-sm">
              <div class="flex items-center gap-4 p-3 rounded-xl border border-cyan-300/35 bg-[#101f5a]/70">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-r from-indigo-500 to-cyan-400 text-white">
                  <i class="ri-phone-line"></i>
                </div>
                <div>
                  <p class="text-blue-100 text-sm">Phone</p>
                  <a href="tel:+923152457703" class="text-white font-semibold">+92 315 2457703</a>
                </div>
              </div>
              <div class="flex items-center gap-4 p-3 rounded-xl border border-cyan-300/35 bg-[#101f5a]/70">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gradient-to-r from-violet-500 to-indigo-500 text-white">
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
    <footer class="relative w-full overflow-hidden text-white">
      <div class="absolute inset-0 bg-[linear-gradient(180deg,#030b27_0%,#06123a_52%,#030d2f_100%)]"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_15%_20%,rgba(73,178,255,0.12),transparent_34%),radial-gradient(circle_at_88%_16%,rgba(169,109,255,0.16),transparent_34%)]"></div>
      <div class="relative w-full border-t border-indigo-300/25">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-9">
          <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr_0.8fr_1fr] gap-8 items-start">
            <div>
              <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-cyan-400 via-indigo-500 to-fuchsia-500 flex items-center justify-center">
                  <i class="ri-hexagon-fill text-white"></i>
                </div>
                <div>
                  <h3 class="text-2xl font-['Pacifico'] leading-none">Bizz Online</h3>
                  <p class="text-[10px] tracking-[0.22em] text-cyan-200/85 uppercase mt-1">Digital Growth Studio</p>
                </div>
              </div>
              <p class="text-blue-100/72 text-sm leading-relaxed max-w-sm mb-5">We help ambitious businesses build a powerful online presence, attract the right audience and achieve measurable growth through innovative digital solutions.</p>
              <div class="flex flex-wrap items-center gap-3 text-xs text-blue-100/80">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-300/30 bg-[#12235f]/70"><i class="ri-mail-line"></i>hello@bizzonline.com</span>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-300/30 bg-[#12235f]/70"><i class="ri-phone-line"></i>+1 (555) 123-4567</span>
              </div>
            </div>

            <div>
              <h4 class="text-white font-semibold mb-4">Services</h4>
              <ul class="space-y-2.5 text-sm text-blue-100/80">
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Website Development</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Digital Marketing</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Branding & Design</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Content Creation</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Business Solutions</a></li>
              </ul>
            </div>

            <div>
              <h4 class="text-white font-semibold mb-4">Company</h4>
              <ul class="space-y-2.5 text-sm text-blue-100/80">
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>About Us</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Portfolio</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Careers</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Blog</a></li>
                <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i class="ri-arrow-right-s-line text-cyan-300"></i>Contact</a></li>
              </ul>
            </div>

            <div class="rounded-2xl border border-indigo-300/30 bg-[#0e1a4d]/70 p-5 shadow-[0_0_20px_rgba(118,121,255,0.25)]">
              <h4 class="text-white font-semibold mb-3">Newsletter</h4>
              <p class="text-blue-100/70 text-sm mb-4">Subscribe for expert insights, digital marketing tips and exclusive updates.</p>
              <div class="flex gap-2">
                <input type="email" placeholder="Your email address" class="flex-1 px-3 py-2 rounded-lg border border-indigo-300/30 bg-[#11245d]/70 text-blue-50 text-sm focus:ring-2 focus:ring-cyan-300/50 focus:border-cyan-300/50">
                <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white text-sm font-medium whitespace-nowrap">Subscribe</button>
              </div>
            </div>
          </div>

          <div class="mt-8 pt-5 border-t border-indigo-300/20 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-blue-100/75">Follow us</div>
            <div class="flex items-center gap-3">
              <a href="#" class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i class="ri-facebook-fill text-xs"></i></a>
              <a href="#" class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i class="ri-instagram-line text-xs"></i></a>
              <a href="#" class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i class="ri-linkedin-fill text-xs"></i></a>
              <a href="#" class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i class="ri-twitter-x-fill text-xs"></i></a>
            </div>
            <div class="text-xs text-blue-100/55">&nbsp;</div>
          </div>
        </div>

        <div class="border-t border-indigo-300/20">
          <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between text-xs text-blue-100/60">
            <p>� 2024 Bizz Online. All rights reserved.</p>
            <div class="flex items-center gap-5 mt-2 sm:mt-0">
              <a href="#" class="hover:text-white">Privacy Policy</a>
              <a href="#" class="hover:text-white">Terms of Service</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <div class="fixed right-4 lg:right-6 bottom-6 z-[60]">
      <div class="flex flex-col items-end gap-3">
        <div id="support-panel" class="support-panel w-[300px] max-w-[85vw] rounded-2xl border border-indigo-300/35 bg-[#101b4e]/95 p-4 hidden">
          <div class="flex items-center justify-between mb-3">
            <h5 class="text-white font-semibold">Chat Support</h5>
            <button id="support-close" class="w-7 h-7 rounded-full bg-white/10 text-blue-100 hover:text-white">
              <i class="ri-close-line"></i>
            </button>
          </div>
          <p class="text-blue-100/75 text-xs mb-3">Send us a quick message and we will get back shortly.</p>
          <div class="grid grid-cols-2 gap-2 mb-3">
            <a href="tel:+923152457703" class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg border border-indigo-300/35 bg-[#12245d]/70 text-cyan-100 text-xs font-medium hover:text-white">
              <i class="ri-phone-line"></i>
              <span>Call</span>
            </a>
            <a href="mailto:hello@bizzonline.com" class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg border border-indigo-300/35 bg-[#12245d]/70 text-cyan-100 text-xs font-medium hover:text-white">
              <i class="ri-mail-line"></i>
              <span>Email</span>
            </a>
          </div>
          <div class="space-y-2">
            <div class="relative">
              <i class="ri-user-3-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
              <input id="support-name" type="text" placeholder="Your name" class="w-full pl-9 pr-3 py-2 rounded-lg border border-indigo-300/30 bg-[#12245d]/70 text-blue-50 text-sm">
            </div>
            <div class="relative">
              <i class="ri-mail-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
              <input id="support-email" type="email" placeholder="Your email" class="w-full pl-9 pr-3 py-2 rounded-lg border border-indigo-300/30 bg-[#12245d]/70 text-blue-50 text-sm">
            </div>
            <div class="relative">
              <i class="ri-phone-line absolute left-3 top-1/2 -translate-y-1/2 text-blue-200/80 text-sm"></i>
              <input id="support-phone" type="text" placeholder="Your phone" class="w-full pl-9 pr-3 py-2 rounded-lg border border-indigo-300/30 bg-[#12245d]/70 text-blue-50 text-sm">
            </div>
            <div class="relative">
              <i class="ri-message-2-line absolute left-3 top-3 text-blue-200/80 text-sm"></i>
              <textarea id="support-message" rows="3" placeholder="Type your message..." class="w-full pl-9 pr-3 py-2 rounded-lg border border-indigo-300/30 bg-[#12245d]/70 text-blue-50 text-sm"></textarea>
            </div>
            <button id="support-send" class="w-full px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white text-sm font-semibold">Send via Email</button>
          </div>
        </div>

        <div class="flex flex-col gap-2 items-center">
          <a href="tel:+923152457703" class="support-fab w-11 h-11 rounded-full border border-cyan-300/40 bg-[#12255f]/85 text-cyan-100 flex items-center justify-center hover:text-white">
            <i class="ri-phone-fill"></i>
          </a>
          <a href="#contact" class="support-fab w-11 h-11 rounded-full border border-cyan-300/40 bg-[#12255f]/85 text-cyan-100 flex items-center justify-center hover:text-white">
            <i class="ri-customer-service-2-fill"></i>
          </a>
          <button id="support-toggle" class="support-fab w-12 h-12 rounded-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white flex items-center justify-center">
            <i class="ri-message-3-fill text-lg"></i>
          </button>
        </div>
      </div>
    </div>
    <script id="service-navigation">
      document.addEventListener('DOMContentLoaded', function() {
        const serviceCards = document.querySelectorAll('.service-card');
        const serviceDetails = document.querySelectorAll('.service-detail');
        serviceCards.forEach(card => {
          card.addEventListener('click', function() {
            const service = this.dataset.service;
            serviceDetails.forEach(detail => {
              detail.classList.add('hidden');
            });
            serviceCards.forEach(c => {
              c.classList.remove('ring-2', 'ring-primary');
            });
            const targetDetail = document.getElementById(`${service}-details`);
            if (targetDetail) {
              targetDetail.classList.remove('hidden');
              this.classList.add('ring-2', 'ring-primary');
            }
          });
        });
      });
    </script>
    <script id="portfolio-carousel-script">
      document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('portfolio-carousel-track');
        const slides = document.querySelectorAll('.portfolio-slide');
        const prev = document.getElementById('portfolio-prev');
        const next = document.getElementById('portfolio-next');
        if (!track || !slides.length || !prev || !next) return;

        let index = 0;
        let timer;

        function perView() {
          if (window.innerWidth >= 1024) return 2;
          if (window.innerWidth >= 768) return 2;
          return 1;
        }

        function maxIndex() {
          return Math.max(0, slides.length - perView());
        }

        function update() {
          const width = slides[0].getBoundingClientRect().width;
          track.style.transform = `translateX(-${index * width}px)`;
        }

        function start() {
          clearInterval(timer);
          timer = setInterval(() => {
            index = index >= maxIndex() ? 0 : index + 1;
            update();
          }, 4200);
        }

        prev.addEventListener('click', () => {
          index = index <= 0 ? maxIndex() : index - 1;
          update();
          start();
        });

        next.addEventListener('click', () => {
          index = index >= maxIndex() ? 0 : index + 1;
          update();
          start();
        });

        window.addEventListener('resize', () => {
          if (index > maxIndex()) index = maxIndex();
          update();
        });

        update();
        start();
      });
    </script>
    <script id="smooth-scroll">
      document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('a[href^="#"]');
        navLinks.forEach(link => {
          link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
              targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
              });
            }
          });
        });
      });
    </script>
    <script id="support-widget-script">
      document.addEventListener('DOMContentLoaded', function() {
        const panel = document.getElementById('support-panel');
        const toggle = document.getElementById('support-toggle');
        const closeBtn = document.getElementById('support-close');
        const sendBtn = document.getElementById('support-send');
        const nameInput = document.getElementById('support-name');
        const emailInput = document.getElementById('support-email');
        const phoneInput = document.getElementById('support-phone');
        const messageInput = document.getElementById('support-message');

        if (!panel || !toggle || !closeBtn || !sendBtn || !nameInput || !emailInput || !phoneInput || !messageInput) return;

        toggle.addEventListener('click', function() {
          panel.classList.toggle('hidden');
        });

        closeBtn.addEventListener('click', function() {
          panel.classList.add('hidden');
        });

        sendBtn.addEventListener('click', function() {
          const name = nameInput.value.trim() || 'Visitor';
          const email = emailInput.value.trim() || 'Not provided';
          const phone = phoneInput.value.trim() || 'Not provided';
          const message = messageInput.value.trim();
          if (!message) return;
          const text = encodeURIComponent(`Support request from ${name}\nEmail: ${email}\nPhone: ${phone}\n\nMessage:\n${message}`);
          window.location.href = `mailto:hello@bizzonline.com?subject=Chat Support Request&body=${text}`;
        });
      });
    </script>
    <script id="preloader-script">
      (function () {
        const hideLoader = () => {
          const preloader = document.getElementById('site-preloader');
          if (!preloader) return;
          preloader.classList.add('hidden');
          setTimeout(() => preloader.remove(), 650);
        };

        window.addEventListener('load', hideLoader);
        setTimeout(hideLoader, 7000);
      })();
    </script>
  </body>
</html>
