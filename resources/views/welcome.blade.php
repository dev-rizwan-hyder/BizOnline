@extends('layouts.app')

@section('content')
    <section id="home" class="relative min-h-[92vh] max-w-8xl overflow-hidden bg-[#081223]">
        <div class="absolute inset-0 hidden md:block bg-cover bg-center"
            style="background-image: url('{{ asset('home.png') }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#040a18]/92 via-[#07153a]/74 to-[#0a1933]/32"></div>
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(56,189,248,0.22),transparent_40%),radial-gradient(circle_at_70%_75%,rgba(99,102,241,0.22),transparent_35%)]">
        </div>

        <!-- 3D Floating Geometric Shapes for Hero -->
        <div class="absolute top-28 right-12 w-48 h-48 rounded-full border-2 border-indigo-400/25 bg-gradient-to-tr from-indigo-500/10 via-purple-500/5 to-transparent backdrop-blur-md animate-spin-orbit pointer-events-none hidden md:block"></div>
        <div class="absolute bottom-24 left-12 w-32 h-32 rounded-3xl border border-cyan-300/30 bg-gradient-to-br from-cyan-400/15 via-indigo-500/10 to-transparent backdrop-blur-sm rotate-45 animate-bg-shape-1 pointer-events-none hidden md:block shadow-[0_0_25px_rgba(56,189,248,0.15)]"></div>
        <div class="absolute top-1/2 right-1/3 w-[550px] h-[2px] bg-gradient-to-r from-transparent via-cyan-400/35 to-transparent transform -rotate-45 pointer-events-none hidden lg:block"></div>

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
                <h1 class="text-4xl sm:text-5xl lg:text-5xl font-bold leading-[1.05] mb-6">Professional Web & Software Development for Digital Growth</h1>
                <p class="text-base sm:text-lg text-blue-100/90 leading-relaxed mb-9 max-w-2xl">We combine strategy, premium
                    design, and <br> high-performance development to deliver <br> portfolio-grade websites that look exceptional and <br>
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

    <!-- Trusted Brands / Sliding Logo Banner Section -->
    <section class="relative z-20 overflow-hidden bg-gradient-to-r from-[#4338ca] via-[#6d28d9] to-[#3b82f6] py-10 sm:py-14 lg:py-16 shadow-[0_12px_36px_rgba(67,56,202,0.5)]">
        <style>
            @keyframes logoMarquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-logo-marquee {
                animation: logoMarquee 20s linear infinite;
            }
            .animate-logo-marquee:hover {
                animation-play-state: paused;
            }
        </style>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(255,255,255,0.18),transparent_50%),radial-gradient(circle_at_75%_50%,rgba(56,189,248,0.20),transparent_45%)] pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(255,255,255,0.05)_25%,transparent_25%,transparent_50%,rgba(255,255,255,0.05)_50%,rgba(255,255,255,0.05)_75%,transparent_75%)] bg-[size:28px_28px] pointer-events-none opacity-60"></div>
        <div class="absolute -top-12 -left-12 w-40 h-40 rounded-full bg-cyan-300/20 blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -right-12 w-44 h-44 rounded-full bg-purple-400/25 blur-2xl pointer-events-none"></div>
        <div class="absolute inset-x-0 top-0 h-px bg-white/25"></div>
        <div class="absolute inset-x-0 bottom-0 h-px bg-black/25"></div>

        <div class="relative w-full overflow-hidden select-none">
            <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-[#4338ca] to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-[#3b82f6] to-transparent z-10 pointer-events-none"></div>

            <div class="flex w-max items-center animate-logo-marquee whitespace-nowrap">
                <!-- Group 1 of Brand Logos -->
                <div class="flex items-center gap-16 sm:gap-24 px-8 shrink-0">
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-triangle-fill text-cyan-300 text-2xl sm:text-3xl"></i>
                        <span>True Corners</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-black text-xl sm:text-2xl uppercase tracking-wider opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-shield-flash-fill text-yellow-300 text-2xl sm:text-3xl"></i>
                        <span>PROSITES</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-github-fill text-indigo-200 text-2xl sm:text-3xl"></i>
                        <span>alpaca</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-cloud-line text-cyan-200 text-3xl sm:text-4xl"></i>
                        <span>CoinCloud</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-compass-3-fill text-fuchsia-300 text-2xl sm:text-3xl"></i>
                        <span>Acutrack</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-cpu-line text-emerald-300 text-3xl sm:text-4xl"></i>
                        <span>TechCore</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-rocket-2-fill text-rose-300 text-2xl sm:text-3xl"></i>
                        <span>ApexDigital</span>
                    </div>
                </div>

                <!-- Group 2 (Duplicate for Seamless Infinite Loop) -->
                <div class="flex items-center gap-16 sm:gap-24 px-8 shrink-0">
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-triangle-fill text-cyan-300 text-2xl sm:text-3xl"></i>
                        <span>True Corners</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-black text-xl sm:text-2xl uppercase tracking-wider opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-shield-flash-fill text-yellow-300 text-2xl sm:text-3xl"></i>
                        <span>PROSITES</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-github-fill text-indigo-200 text-2xl sm:text-3xl"></i>
                        <span>alpaca</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-cloud-line text-cyan-200 text-3xl sm:text-4xl"></i>
                        <span>CoinCloud</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-compass-3-fill text-fuchsia-300 text-2xl sm:text-3xl"></i>
                        <span>Acutrack</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-cpu-line text-emerald-300 text-3xl sm:text-4xl"></i>
                        <span>TechCore</span>
                    </div>
                    <div class="flex items-center gap-3 text-white font-bold text-xl sm:text-2xl tracking-tight opacity-90 hover:opacity-100 transition-opacity">
                        <i class="ri-rocket-2-fill text-rose-300 text-2xl sm:text-3xl"></i>
                        <span>ApexDigital</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Extended Services Interactive Wheel Section -->
    <section id="extended-services" class="relative py-20 lg:py-24 overflow-hidden bg-[#07112d]">
        <style>
            @keyframes floatBgShape1 {
                0%, 100% { transform: translateY(0px) rotate(45deg) scale(1); }
                50% { transform: translateY(-28px) rotate(55deg) scale(1.08); }
            }
            @keyframes floatBgShape2 {
                0%, 100% { transform: translateY(0px) rotate(-15deg) scale(1); }
                50% { transform: translateY(22px) rotate(-5deg) scale(0.92); }
            }
            @keyframes spinOrbit {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            .animate-bg-shape-1 {
                animation: floatBgShape1 8s ease-in-out infinite;
            }
            .animate-bg-shape-2 {
                animation: floatBgShape2 9s ease-in-out infinite 1s;
            }
            .animate-spin-orbit {
                animation: spinOrbit 25s linear infinite;
            }
        </style>

        <!-- Ambient Background Gradients & Grids -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#081223] via-[#09153a] to-[#040a18]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_40%,rgba(99,102,241,0.22),transparent_45%),radial-gradient(circle_at_80%_60%,rgba(56,189,248,0.20),transparent_40%)]"></div>
        <div class="absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-[#081223] to-transparent"></div>

        <!-- Professional 3D Geometric Floating Shapes -->
        <!-- 3D Floating Glass Diamond Top-Left -->
        <div class="absolute top-10 left-6 sm:left-14 w-32 sm:w-40 h-32 sm:h-40 rounded-3xl border border-cyan-300/30 bg-gradient-to-tr from-cyan-500/15 via-indigo-500/10 to-transparent backdrop-blur-md animate-bg-shape-1 pointer-events-none shadow-[0_0_30px_rgba(56,189,248,0.15)]"></div>

        <!-- 3D Glowing Torus Ring Bottom-Left -->
        <div class="absolute -bottom-10 left-1/3 w-48 h-48 rounded-full border-4 border-dashed border-indigo-400/25 bg-gradient-to-br from-purple-500/10 via-indigo-500/5 to-transparent backdrop-blur-sm animate-spin-orbit pointer-events-none"></div>

        <!-- 3D Glowing Sphere Top-Right -->
        <div class="absolute top-12 right-10 sm:right-20 w-36 h-36 rounded-full bg-gradient-to-br from-indigo-400/30 via-cyan-400/20 to-purple-500/25 blur-2xl animate-bg-shape-2 pointer-events-none"></div>

        <!-- Laser Light Streak Background Beam -->
        <div class="absolute top-1/3 -right-20 w-[600px] h-[2px] bg-gradient-to-r from-transparent via-cyan-400/40 to-transparent transform -rotate-45 pointer-events-none"></div>
        <div class="absolute bottom-1/4 -left-20 w-[500px] h-[2px] bg-gradient-to-r from-transparent via-indigo-400/35 to-transparent transform rotate-12 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Left Column: Content & CTA -->
                <div class="lg:col-span-6 text-left">
                    <p class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.2em] bg-[#12305a]/80 border border-cyan-300/35 text-cyan-300 rounded-full px-4 py-1.5 mb-6">
                        <span class="w-2 h-2 rounded-full bg-cyan-300 animate-pulse"></span>
                        Complementary Expertise
                    </p>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.15] mb-6">
                        Comprehensive Digital Services Beyond Web Development
                    </h2>
                    <p class="text-base sm:text-lg text-blue-100/85 leading-relaxed mb-8 max-w-xl">
                        While our primary service at Biz Tech Solution is website design and development, we also provide a number of complementary services that give your website that extra something special it needs to succeed. You can get real benefits for your company whether you use these services alone or in tandem with others.
                    </p>
                    <div>
                        <a href="#contact"
                            class="hero-cta text-white px-8 py-4 !rounded-button text-base font-semibold inline-flex items-center justify-center gap-2 whitespace-nowrap min-h-[54px] uppercase tracking-wide">
                            DISCUSS YOUR IDEA
                            <i class="ri-arrow-right-up-line text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Circular Interactive Services Wheel -->
                <div class="lg:col-span-6 flex justify-center items-center py-6">
                    <div id="service-wheel-container" class="relative w-[320px] h-[320px] sm:w-[420px] sm:h-[420px] flex items-center justify-center select-none">
                        
                        <!-- Outer Ambient Glow -->
                        <div class="absolute inset-0 rounded-full bg-indigo-500/15 blur-2xl pointer-events-none"></div>

                        <!-- Outer Ring Boundary -->
                        <div class="absolute inset-0 rounded-full border border-indigo-300/30 bg-[#0a1642]/65 backdrop-blur-md shadow-[0_0_40px_rgba(79,70,229,0.3)] pointer-events-none"></div>

                        <!-- Inner Dashed Ring -->
                        <div class="absolute inset-8 sm:inset-12 rounded-full border border-dashed border-cyan-300/20 pointer-events-none"></div>

                        <!-- Center Information Display -->
                        <div class="relative z-10 w-[210px] sm:w-[270px] text-center p-3 sm:p-5 transition-all duration-300" id="wheel-center-box">
                            <span id="wheel-kicker" class="text-xs font-bold uppercase tracking-[0.22em] text-[#818cf8] block mb-2">OUR SERVICES</span>
                            <h4 id="wheel-title" class="text-2xl sm:text-3xl font-bold text-white mb-3 transition-all duration-200">Software & ERP Development</h4>
                            <p id="wheel-desc" class="text-blue-100/80 text-xs sm:text-sm leading-relaxed transition-all duration-200">
                                We engineer customized software applications and enterprise ERP solutions tailored to automate workflows, streamline operations, and boost productivity.
                            </p>
                        </div>

                        <!-- 4 Interactive Node Buttons around circle ring -->
                        <!-- Node 0: Top-Left (Software & ERP Development) -->
                        <button type="button" 
                                data-wheel-index="0"
                                class="wheel-node-btn absolute top-[14%] left-[14%] -translate-x-1/2 -translate-y-1/2 w-14 h-14 sm:w-16 sm:h-16 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 z-20 focus:outline-none"
                                aria-label="Software & ERP Development">
                            <i class="ri-code-s-slash-line text-xl sm:text-2xl"></i>
                        </button>

                        <!-- Node 1: Top-Right (Website Development) -->
                        <button type="button" 
                                data-wheel-index="1"
                                class="wheel-node-btn absolute top-[14%] left-[86%] -translate-x-1/2 -translate-y-1/2 w-14 h-14 sm:w-16 sm:h-16 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 z-20 focus:outline-none"
                                aria-label="Website Development">
                            <i class="ri-macbook-line text-xl sm:text-2xl"></i>
                        </button>

                        <!-- Node 2: Bottom-Left (Logo & Brand Design) -->
                        <button type="button" 
                                data-wheel-index="2"
                                class="wheel-node-btn absolute top-[86%] left-[14%] -translate-x-1/2 -translate-y-1/2 w-14 h-14 sm:w-16 sm:h-16 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 z-20 focus:outline-none"
                                aria-label="Logo Design">
                            <i class="ri-palette-line text-xl sm:text-2xl"></i>
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script id="extended-services-wheel-script">
      document.addEventListener('DOMContentLoaded', function () {
        const wheelData = [
          {
            kicker: "OUR SERVICES",
            title: "Custom ERP & Software Solutions",
            desc: "We engineer enterprise-grade software and ERP systems tailored to automate workflows, streamline operations, and maximize productivity."
          },
          {
            kicker: "OUR SERVICES",
            title: "Professional Website Design & Development",
            desc: "We create custom, responsive websites optimized for conversions. Each site is tailored to your industry with compelling layouts that engage your target market."
          },
          {
            kicker: "OUR SERVICES",
            title: "Logo & Brand Identity Design",
            desc: "We create distinctive, memorable brand identities and logos. Each design reflects your brand essence with attention to detail, strategic color selection, and professional aesthetics."
          }
        ];

        const nodes = document.querySelectorAll('.wheel-node-btn');
        const kickerEl = document.getElementById('wheel-kicker');
        const titleEl = document.getElementById('wheel-title');
        const descEl = document.getElementById('wheel-desc');
        const centerBox = document.getElementById('wheel-center-box');
        const wheelContainer = document.getElementById('service-wheel-container');

        if (!nodes.length || !titleEl || !descEl) return;

        let activeIdx = 0;
        let autoRotateTimer = null;

        const activeClasses = ['bg-[#6366f1]', 'text-white', 'shadow-[0_0_28px_rgba(99,102,241,0.85)]', 'scale-110', 'border-2', 'border-white', 'ring-4', 'ring-indigo-500/35'];
        const inactiveClasses = ['bg-white', 'text-[#6366f1]', 'shadow-[0_4px_20px_rgba(0,0,0,0.18)]', 'hover:scale-105', 'border', 'border-indigo-100'];

        function setActiveNode(index) {
          activeIdx = index;

          nodes.forEach((node, idx) => {
            if (idx === index) {
              node.classList.remove(...inactiveClasses);
              node.classList.add(...activeClasses);
            } else {
              node.classList.remove(...activeClasses);
              node.classList.add(...inactiveClasses);
            }
          });

          if (centerBox) {
            centerBox.style.opacity = '0';
            centerBox.style.transform = 'scale(0.95)';
            setTimeout(() => {
              const item = wheelData[index];
              if (kickerEl) kickerEl.textContent = item.kicker;
              if (titleEl) titleEl.textContent = item.title;
              if (descEl) descEl.textContent = item.desc;
              centerBox.style.opacity = '1';
              centerBox.style.transform = 'scale(1)';
            }, 220);
          }
        }

        nodes.forEach((node, idx) => {
          node.addEventListener('click', () => {
            setActiveNode(idx);
            resetAutoRotate();
          });
          node.addEventListener('mouseenter', () => {
            setActiveNode(idx);
            resetAutoRotate();
          });
        });

        function startAutoRotate() {
          autoRotateTimer = setInterval(() => {
            const nextIdx = (activeIdx + 1) % wheelData.length;
            setActiveNode(nextIdx);
          }, 4000);
        }

        function resetAutoRotate() {
          clearInterval(autoRotateTimer);
          startAutoRotate();
        }

        if (wheelContainer) {
          wheelContainer.addEventListener('mouseenter', () => clearInterval(autoRotateTimer));
          wheelContainer.addEventListener('mouseleave', () => startAutoRotate());
        }

        setActiveNode(0);
        startAutoRotate();
      });
    </script>

    <!-- Expert Web Layout & 3D Mobile Showcase Section -->
    <section id="web-layout-expert" class="relative py-24 lg:py-32 overflow-hidden bg-gradient-to-r from-[#1c0847] via-[#350f75] to-[#21064e]">
        <style>
            @keyframes float3dPhone {
                0%, 100% {
                    transform: perspective(1200px) rotateY(-14deg) rotateX(7deg) rotateZ(2deg) translateY(0px);
                }
                50% {
                    transform: perspective(1200px) rotateY(-18deg) rotateX(11deg) rotateZ(4deg) translateY(-22px);
                }
            }
            @keyframes floatBadge1 {
                0%, 100% { transform: translateY(0px) rotate(-2deg); }
                50% { transform: translateY(-12px) rotate(1deg); }
            }
            @keyframes floatBadge2 {
                0%, 100% { transform: translateY(0px) rotate(3deg); }
                50% { transform: translateY(-16px) rotate(-1deg); }
            }
            @keyframes leafSway1 {
                0%, 100% { transform: rotate(-10deg) scale(1); }
                50% { transform: rotate(-3deg) scale(1.05); }
            }
            @keyframes leafSway2 {
                0%, 100% { transform: rotate(35deg) scale(1); }
                50% { transform: rotate(42deg) scale(1.08); }
            }
            .animate-phone-3d {
                animation: float3dPhone 6s ease-in-out infinite;
                transform-style: preserve-3d;
            }
            .animate-badge-1 {
                animation: floatBadge1 4.5s ease-in-out infinite;
            }
            .animate-badge-2 {
                animation: floatBadge2 5.2s ease-in-out infinite 0.5s;
            }
            .animate-leaf-1 {
                animation: leafSway1 7s ease-in-out infinite;
            }
            .animate-leaf-2 {
                animation: leafSway2 8s ease-in-out infinite 0.8s;
            }
        </style>

        <!-- Background Wave & Ambient Grid overlays -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_25%_35%,rgba(168,85,247,0.28),transparent_48%),radial-gradient(circle_at_75%_65%,rgba(56,189,248,0.25),transparent_45%),radial-gradient(circle_at_50%_90%,rgba(99,102,241,0.20),transparent_50%)] pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.04)_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_70%_60%_at_50%_50%,#000_70%,transparent_100%)] pointer-events-none"></div>
        <div class="absolute inset-x-0 top-0 h-20 bg-gradient-to-b from-[#07112d] to-transparent"></div>
        <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#030a21] to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Left Column: Content & Action Buttons -->
                <div class="lg:col-span-6 text-left">
                    <p class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold uppercase tracking-[0.22em] text-cyan-300 bg-white/10 backdrop-blur-md border border-cyan-300/35 rounded-full px-4 py-1.5 mb-6 shadow-[0_0_15px_rgba(56,189,248,0.2)]">
                        <span class="w-2.5 h-2.5 rounded-full bg-cyan-300 animate-ping"></span>
                        Expert in Web Page Layout
                    </p>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.12] mb-6 drop-shadow-md">
                        Responsive Web Design & Development for All Devices
                    </h2>
                    <p class="text-base sm:text-lg text-purple-100/90 leading-relaxed mb-9 max-w-xl">
                        Our web development team is here to assist you in reaching your business goals through the creation of an interesting and functional website.
                    </p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="#contact"
                            class="hero-cta text-white px-8 py-4 !rounded-button text-base font-semibold inline-flex items-center justify-center gap-2 whitespace-nowrap min-h-[54px] shadow-[0_12px_30px_rgba(99,102,241,0.6)]">
                            Let's Get Started
                            <i class="ri-arrow-right-line text-lg"></i>
                        </a>
                        <a href="https://wa.me/923152457703" target="_blank" rel="noopener noreferrer"
                            class="px-8 py-4 rounded-xl border border-white/40 bg-white/10 hover:bg-white/20 text-white font-semibold text-base inline-flex items-center justify-center gap-2 backdrop-blur-md transition-all min-h-[54px] shadow-lg">
                            <i class="ri-whatsapp-line text-cyan-300 text-xl"></i>
                            Chat With Us
                        </a>
                    </div>
                </div>

                <!-- Right Column: 3D Animated Mobile Phone Showcase -->
                <div class="lg:col-span-6 flex justify-center items-center relative py-10" id="3d-phone-interactive-zone">
                    
                    <!-- 3D Glass Geometric Shapes Behind Phone (Site Palette) -->
                    <!-- Glowing 3D Glass Orbit Circle Left -->
                    <div class="absolute -left-8 sm:left-2 top-1/2 -translate-y-1/2 w-64 sm:w-72 h-64 sm:h-72 rounded-full border border-cyan-300/30 bg-gradient-to-tr from-cyan-500/20 via-indigo-500/10 to-transparent backdrop-blur-md pointer-events-none z-0 animate-spin-orbit shadow-[0_0_35px_rgba(56,189,248,0.25)]"></div>

                    <!-- Glowing 3D Glass Ring Right -->
                    <div class="absolute -right-8 sm:right-2 top-1/2 -translate-y-1/2 w-64 sm:w-72 h-64 sm:h-72 rounded-full border border-purple-400/30 bg-gradient-to-br from-purple-600/20 via-indigo-500/10 to-transparent backdrop-blur-md pointer-events-none z-0 animate-bg-shape-1 shadow-[0_0_35px_rgba(168,85,247,0.25)]"></div>

                    <!-- Glowing Indigo/Cyan Backlight Aura -->
                    <div class="absolute inset-0 m-auto w-80 h-[450px] rounded-full bg-gradient-to-r from-indigo-500/35 via-cyan-400/30 to-purple-600/35 blur-3xl pointer-events-none"></div>

                    <!-- Floating 3D Badge 1: Top Left -->
                    <div class="absolute top-4 left-0 sm:left-4 z-30 animate-badge-1">
                        <div class="px-4 py-2.5 rounded-2xl bg-slate-900/90 border border-cyan-300/40 backdrop-blur-xl shadow-[0_15px_30px_rgba(0,0,0,0.5)] text-white text-xs font-semibold flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-cyan-500/20 border border-cyan-400/50 flex items-center justify-center text-cyan-300"><i class="ri-flashlight-line"></i></div>
                            <div>
                                <p class="text-[10px] text-cyan-200 uppercase tracking-widest font-bold">Speed Optimized</p>
                                <p class="text-white font-bold text-xs">99.8% Performance</p>
                            </div>
                        </div>
                    </div>

                    <!-- Floating 3D Badge 2: Bottom Right -->
                    <div class="absolute bottom-6 right-0 sm:right-4 z-30 animate-badge-2">
                        <div class="px-4 py-2.5 rounded-2xl bg-slate-900/90 border border-purple-300/40 backdrop-blur-xl shadow-[0_15px_30px_rgba(0,0,0,0.5)] text-white text-xs font-semibold flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-purple-500/20 border border-purple-400/50 flex items-center justify-center text-purple-300"><i class="ri-paint-brush-line"></i></div>
                            <div>
                                <p class="text-[10px] text-purple-200 uppercase tracking-widest font-bold">Responsive Layout</p>
                                <p class="text-white font-bold text-xs">Custom UI/UX Design</p>
                            </div>
                        </div>
                    </div>

                    <!-- Floating 3D Badge 3: Top Right Rating Badge -->
                    <div class="absolute top-12 right-2 sm:right-8 z-30 animate-bounce-slow">
                        <div class="px-3.5 py-1.5 rounded-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-purple-500 text-white font-extrabold text-xs flex items-center gap-1.5 shadow-[0_0_20px_rgba(56,189,248,0.6)] border border-white/30">
                            <i class="ri-star-fill text-yellow-300"></i>
                            <span>4.9 Rating</span>
                        </div>
                    </div>

                    <!-- 3D Smartphone Container -->
                    <div id="phone-3d-wrapper" class="relative z-20 animate-phone-3d transition-transform duration-300 ease-out">
                        <div class="relative w-[270px] sm:w-[315px] h-[540px] sm:h-[610px] bg-slate-950 rounded-[46px] p-3.5 border-[6px] border-slate-800 shadow-[-25px_30px_60px_rgba(0,0,0,0.75),0_0_40px_rgba(99,102,241,0.35)] flex flex-col overflow-hidden">
                            
                            <!-- Metallic Glass Reflection Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/20 via-transparent to-white/5 opacity-60 pointer-events-none z-30"></div>

                            <!-- Phone Top Speaker Notch -->
                            <div class="absolute top-4 left-1/2 -translate-x-1/2 w-28 h-4 bg-slate-900 rounded-full z-40 flex items-center justify-center border border-slate-800/80">
                                <div class="w-3 h-3 rounded-full bg-slate-950 border border-slate-800"></div>
                            </div>

                            <!-- Screen Container (Dark Navy Site Palette) -->
                            <div class="w-full h-full bg-[#07133b] rounded-[34px] overflow-hidden text-white text-left pt-7 pb-4 px-3 flex flex-col font-sans select-none overflow-y-auto no-scrollbar relative z-10">
                                
                                <!-- Top App Bar -->
                                <div class="flex items-center justify-between border-b border-cyan-300/20 pb-2.5 mb-3 px-1">
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-cyan-300 flex items-center gap-1.5">
                                        <i class="ri-global-line text-cyan-400"></i> BIZZ ONLINE
                                    </span>
                                    <div class="w-6 h-6 rounded-full bg-cyan-400/20 border border-cyan-300/40 text-cyan-300 flex items-center justify-center text-[10px]">
                                        <i class="ri-shield-check-fill"></i>
                                    </div>
                                </div>

                                <!-- App Hero Banner (Dark Indigo Gradient matching site hero) -->
                                <div class="bg-gradient-to-br from-[#4338ca] via-[#6d28d9] to-[#3b82f6] rounded-xl p-3 mb-3 border border-indigo-400/40 text-center relative overflow-hidden shadow-lg">
                                    <p class="text-[8px] font-bold text-cyan-200 uppercase tracking-widest mb-0.5">Custom Digital Solutions</p>
                                    <h5 class="text-xs font-bold text-white leading-snug mb-2">High Performance<br><span class="text-cyan-300 font-black">Web & ERP Apps</span></h5>
                                    <span class="inline-block px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-[8px] font-bold border border-white/30 shadow-sm">Explore Layouts</span>
                                </div>

                                <!-- Services Header inside Screen -->
                                <p class="text-[9px] font-extrabold text-cyan-200/90 mb-2 px-1 text-center uppercase tracking-wider">Expertise & Services</p>

                                <!-- Service Cards Grid Inside Screen -->
                                <div class="grid grid-cols-2 gap-2 mb-3">
                                    <div class="bg-[#0f2156] rounded-xl p-2 border border-cyan-300/25 shadow-sm text-center transform hover:scale-105 transition-transform">
                                        <div class="h-20 bg-[#162d74]/80 rounded-lg mb-1.5 flex items-center justify-center border border-cyan-300/20">
                                            <i class="ri-code-s-slash-line text-2xl text-cyan-300"></i>
                                        </div>
                                        <p class="text-[9px] font-bold text-white truncate">Software & ERP</p>
                                        <p class="text-[8px] font-semibold text-cyan-300">Custom Systems</p>
                                    </div>
                                    <div class="bg-[#0f2156] rounded-xl p-2 border border-cyan-300/25 shadow-sm text-center transform hover:scale-105 transition-transform">
                                        <div class="h-20 bg-[#162d74]/80 rounded-lg mb-1.5 flex items-center justify-center border border-cyan-300/20">
                                            <i class="ri-layout-4-line text-2xl text-indigo-300"></i>
                                        </div>
                                        <p class="text-[9px] font-bold text-white truncate">Web Layout</p>
                                        <p class="text-[8px] font-semibold text-indigo-300">UI/UX Design</p>
                                    </div>
                                </div>

                                <!-- Bottom App Floating Action Bar -->
                                <div class="mt-auto bg-[#11245e] border border-cyan-300/30 text-white text-[9px] py-2 px-3 rounded-xl text-center font-bold tracking-wide shadow-md flex items-center justify-between">
                                    <span class="text-cyan-200">Responsive Layout Ready</span>
                                    <i class="ri-arrow-right-s-line text-cyan-300 text-xs"></i>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Mouse Interactive 3D Tilt Script -->
    <script id="web-layout-3d-script">
      document.addEventListener('DOMContentLoaded', function () {
        const zone = document.getElementById('3d-phone-interactive-zone');
        const phone = document.getElementById('phone-3d-wrapper');

        if (!zone || !phone) return;

        zone.addEventListener('mousemove', function (e) {
          const rect = zone.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          const centerX = rect.width / 2;
          const centerY = rect.height / 2;

          const rotateY = ((x - centerX) / centerX) * 22 - 14;
          const rotateX = -((y - centerY) / centerY) * 16 + 7;

          phone.style.animation = 'none';
          phone.style.transform = `perspective(1200px) rotateY(${rotateY}deg) rotateX(${rotateX}deg) rotateZ(2deg)`;
        });

        zone.addEventListener('mouseleave', function () {
          phone.style.animation = 'float3dPhone 6s ease-in-out infinite';
        });
      });
    </script>

    <!-- New Portfolio Section with Image-Only Cards & Smooth Scroll-Down on Hover -->
    <section id="portfolio" class="relative py-24 overflow-hidden bg-[#040b21] max-w-8xl">
        <style>
            .portfolio-card-frame {
                height: 450px;
                position: relative;
                overflow: hidden;
                border-radius: 1.25rem;
                border: 1px solid rgba(56, 189, 248, 0.3);
                background-color: #07112d;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                transition: border-color 0.4s ease, box-shadow 0.4s ease, transform 0.4s ease;
                cursor: pointer;
            }
            .portfolio-card-frame:hover {
                border-color: rgba(56, 189, 248, 0.75);
                box-shadow: 0 0 45px rgba(56, 189, 248, 0.45), 0 20px 60px rgba(0, 0, 0, 0.6);
                transform: translateY(-8px);
            }
            .portfolio-scroll-img {
                width: 100%;
                height: auto;
                min-height: 100%;
                object-fit: cover;
                object-position: top center;
                transition: transform 8s cubic-bezier(0.22, 1, 0.36, 1);
                transform: translateY(0%);
                will-change: transform;
            }
            .portfolio-card-frame:hover .portfolio-scroll-img {
                transform: translateY(calc(-100% + 450px));
            }
            /* Bottom gradient fade hint — shows the image continues */
            .portfolio-card-frame::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 100px;
                background: linear-gradient(to top, rgba(4, 11, 33, 0.92) 0%, rgba(4, 11, 33, 0.5) 40%, transparent 100%);
                z-index: 15;
                pointer-events: none;
                transition: opacity 0.4s ease;
            }
            .portfolio-card-frame:hover::after {
                opacity: 0;
            }
            /* Project name overlay at the bottom */
            .portfolio-project-name {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 18;
                padding: 16px 16px 14px;
                background: linear-gradient(to top, rgba(4, 11, 33, 0.95) 0%, rgba(4, 11, 33, 0.7) 60%, transparent 100%);
                transition: opacity 0.4s ease, transform 0.4s ease;
            }
            .portfolio-card-frame:hover .portfolio-project-name {
                opacity: 0;
                transform: translateY(10px);
            }
            /* Scroll indicator animation */
            @keyframes scrollHint {
                0%, 100% { transform: translateY(0); opacity: 0.6; }
                50% { transform: translateY(6px); opacity: 1; }
            }
            .portfolio-scroll-hint {
                animation: scrollHint 1.8s ease-in-out infinite;
            }
        </style>

        <!-- Ambient Background Overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_25%_20%,rgba(99,102,241,0.22),transparent_40%),radial-gradient(circle_at_75%_65%,rgba(56,189,248,0.20),transparent_40%),radial-gradient(circle_at_50%_90%,rgba(168,85,247,0.18),transparent_45%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] pointer-events-none"></div>

        <!-- 3D Geometric Floating Background Shapes for Portfolio -->
        <div class="absolute top-16 right-10 w-48 h-48 rounded-3xl border border-purple-300/25 bg-gradient-to-br from-purple-500/10 via-cyan-400/5 to-transparent backdrop-blur-md rotate-12 animate-bg-shape-2 pointer-events-none hidden md:block"></div>
        <div class="absolute bottom-16 left-10 w-40 h-40 rounded-full border-2 border-dashed border-cyan-300/25 bg-cyan-400/5 backdrop-blur-sm animate-spin-orbit pointer-events-none hidden md:block"></div>
        <div class="absolute top-1/3 left-0 w-[550px] h-[2px] bg-gradient-to-r from-transparent via-cyan-400/35 to-transparent transform -rotate-12 pointer-events-none hidden lg:block"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 text-center">
            
            <!-- Header Section -->
            <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border text-xs sm:text-sm font-semibold uppercase tracking-[0.22em] text-cyan-300 mb-4 shadow-[0_0_15px_rgba(244,114,182,0.2)]">
                THE REMARKABLE PORTFOLIO OF OURS
            </p>
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-4 tracking-tight">
                Our Professional Portfolio: Web, Software & Digital Projects
            </h2>
            <p class="text-blue-100/85 text-sm sm:text-base max-w-3xl mx-auto leading-relaxed mb-6">
                Explore our diverse portfolio of completed projects: custom software solutions, responsive websites, e-commerce platforms, brand design, and digital marketing campaigns that delivered measurable results.
            </p>
            
            <!-- Hover-to-scroll tip -->
            <div class="flex items-center justify-center gap-2 text-blue-200/60 text-xs mb-10">
                <i class="ri-mouse-line text-sm portfolio-scroll-hint"></i>
                <span>Hover over cards to scroll through full page designs</span>
            </div>

            <!-- Service Filter Tabs -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-3.5 mb-12 max-w-5xl mx-auto" id="portfolio-tab-buttons">
                <!-- Tab 1: Software & ERP (Default Active) -->
                <button data-filter="software-erp" class="portfolio-tab-btn active px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-gradient-to-r from-purple-600 via-indigo-600 to-cyan-500 text-white shadow-[0_0_20px_rgba(99,102,241,0.6)] border border-indigo-300/40 flex items-center gap-2">
                    <i class="ri-code-s-slash-line text-cyan-300"></i>
                    <span>Software & ERP Development</span>
                </button>

                <!-- Tab 2: Website Design -->
                <button data-filter="website-design" class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#0f1f56]/70 hover:bg-[#162a74] text-blue-100 border border-cyan-300/25 flex items-center gap-2">
                    <i class="ri-layout-4-line text-cyan-300"></i>
                    <span>Website Design</span>
                </button>

                <!-- Tab 3: E-Commerce -->
                <button data-filter="e-commerce" class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#0f1f56]/70 hover:bg-[#162a74] text-blue-100 border border-cyan-300/25 flex items-center gap-2">
                    <i class="ri-shopping-cart-2-line text-cyan-300"></i>
                    <span>E-Commerce</span>
                </button>

                <!-- Tab 4: Logo Design & Branding -->
                <button data-filter="logo-branding" class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#0f1f56]/70 hover:bg-[#162a74] text-blue-100 border border-cyan-300/25 flex items-center gap-2">
                    <i class="ri-palette-line text-cyan-300"></i>
                    <span>Logo & Branding</span>
                </button>

                <!-- Tab 5: Mobile Apps -->
                <button data-filter="mobile-apps" class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#0f1f56]/70 hover:bg-[#162a74] text-blue-100 border border-cyan-300/25 flex items-center gap-2">
                    <i class="ri-smartphone-line text-cyan-300"></i>
                    <span>Mobile Apps</span>
                </button>

                <!-- Tab 6: Digital Marketing -->
                <button data-filter="digital-marketing" class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#0f1f56]/70 hover:bg-[#162a74] text-blue-100 border border-cyan-300/25 flex items-center gap-2">
                    <i class="ri-bar-chart-box-line text-cyan-300"></i>
                    <span>Digital Marketing</span>
                </button>

                <!-- Tab 7: All Projects -->
                <button data-filter="all" class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 bg-[#0f1f56]/70 hover:bg-[#162a74] text-blue-100 border border-cyan-300/25 flex items-center gap-2">
                    <i class="ri-grid-line text-cyan-300"></i>
                    <span>All Projects</span>
                </button>
            </div>

            <!-- Portfolio Cards Grid (Image Only Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-left" id="portfolio-grid-items">
                
                <!-- SOFTWARE & ERP ITEM 1 -->
                <div class="portfolio-grid-item software-erp portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-cyan-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-cyan-300 shadow-md">Software & ERP</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Project</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Business Management ERP</p>
                        <p class="text-cyan-300/80 text-[10px] font-medium mt-0.5">Enterprise Resource Planning</p>
                    </div>
                    <img src="{{ asset('software/denverdiscountcomputers.com_admin_dashboard.png') }}" alt="ERP Software Dashboard" class="portfolio-scroll-img" loading="lazy" fetchpriority="low">
                </div>

                <!-- SOFTWARE & ERP ITEM 2 -->
                <div class="portfolio-grid-item software-erp portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-cyan-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-cyan-300 shadow-md">Software & ERP</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Project</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Inventory Management System</p>
                        <p class="text-cyan-300/80 text-[10px] font-medium mt-0.5">Inventory & Stock Control</p>
                    </div>
                    <img src="{{ asset('software/denverdiscountcomputers.com_admin_inventory.png') }}" alt="Admin Inventory Management" class="portfolio-scroll-img" loading="lazy" fetchpriority="low">
                </div>

                <!-- SOFTWARE & ERP ITEM 3 -->
                <div class="portfolio-grid-item software-erp portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-cyan-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-cyan-300 shadow-md">Software & ERP</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Project</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Expense Tracker Pro</p>
                        <p class="text-cyan-300/80 text-[10px] font-medium mt-0.5">Finance & Expense Management</p>
                    </div>
                    <img src="{{ asset('software/denverdiscountcomputers.com_admin_expenses.png') }}" alt="Admin Expense Tracker" class="portfolio-scroll-img" loading="lazy" fetchpriority="low">
                </div>

                <!-- SOFTWARE & ERP ITEM 4 -->
                <div class="portfolio-grid-item software-erp portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-cyan-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-cyan-300 shadow-md">Software & ERP</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Project</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Policy & Compliance Suite</p>
                        <p class="text-cyan-300/80 text-[10px] font-medium mt-0.5">HR Policy Management System</p>
                    </div>
                    <img src="{{ asset('software/denverdiscountcomputers.com_admin_policies_type=company.png') }}" alt="Admin Policies Management" class="portfolio-scroll-img" loading="lazy" fetchpriority="low">
                </div>

                <!-- WEBSITE DESIGN ITEM 1: Solent Motors -->
                <div class="portfolio-grid-item website-design hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-indigo-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-indigo-300 shadow-md">Website Design</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-indigo-400 to-cyan-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Solent Motors</p>
                        <p class="text-indigo-300/80 text-[10px] font-medium mt-0.5">Car Dealership & Auto Sales</p>
                    </div>
                    <img src="{{ asset('website_design/aliceblue-loris-649082.hostingersite.com_.jpg') }}" alt="Solent Motors — Car Dealership Website" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- WEBSITE DESIGN ITEM 2: Right Car Detailing USA -->
                <div class="portfolio-grid-item website-design hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-indigo-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-indigo-300 shadow-md">Website Design</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-indigo-400 to-cyan-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Right Car Detailing USA</p>
                        <p class="text-indigo-300/80 text-[10px] font-medium mt-0.5">Mobile Car Detailing Service</p>
                    </div>
                    <img src="{{ asset('website_design/darkorange-cattle-846071.hostingersite.com_.jpg') }}" alt="Right Car Detailing USA — Mobile Detailing Website" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- WEBSITE DESIGN ITEM 3: Denver Discount Computers -->
                <div class="portfolio-grid-item website-design hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-indigo-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-indigo-300 shadow-md">Website Design</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-indigo-400 to-cyan-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Denver Discount Computers</p>
                        <p class="text-indigo-300/80 text-[10px] font-medium mt-0.5">Computer Store & IT Services</p>
                    </div>
                    <img src="{{ asset('website_design/denverdiscountcomputers.com_.jpg') }}" alt="Denver Discount Computers Website" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- WEBSITE DESIGN ITEM 4: IT Investment Recoveries -->
                <div class="portfolio-grid-item website-design hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-indigo-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-indigo-300 shadow-md">Website Design</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-indigo-400 to-cyan-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">IT Investment Recoveries</p>
                        <p class="text-indigo-300/80 text-[10px] font-medium mt-0.5">Electronics Recycling & IT Solutions</p>
                    </div>
                    <img src="{{ asset('website_design/it-investmentrecoveries.com_.jpg') }}" alt="IT Investment Recoveries Portal" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- E-COMMERCE ITEM 1: ShopKer Store -->
                <div class="portfolio-grid-item e-commerce hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-purple-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-purple-300 shadow-md">E-Commerce</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">ShopKer Store</p>
                        <p class="text-purple-300/80 text-[10px] font-medium mt-0.5">Keychains & Collectibles Store</p>
                    </div>
                    <img src="{{ asset('ecommerce/shopker.store_.jpg') }}" alt="ShopKer E-Commerce Store" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- E-COMMERCE ITEM 2: Zarvan Fashion -->
                <div class="portfolio-grid-item e-commerce hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-purple-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-purple-300 shadow-md">E-Commerce</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Zarvan Fashion</p>
                        <p class="text-purple-300/80 text-[10px] font-medium mt-0.5">Premium Men's Clothing & Prints</p>
                    </div>
                    <img src="{{ asset('ecommerce/zarvanfashion.shop_.jpg') }}" alt="Zarvan Fashion Store" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- E-COMMERCE ITEM 3: Zenvera Store -->
                <div class="portfolio-grid-item e-commerce hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-purple-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-purple-300 shadow-md">E-Commerce</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Zenvera Luxury</p>
                        <p class="text-purple-300/80 text-[10px] font-medium mt-0.5">Premium Handbags & Accessories</p>
                    </div>
                    <img src="{{ asset('ecommerce/zenvera.store_.jpg') }}" alt="Zenvera Online Store" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- E-COMMERCE ITEM 4: Denver Discount Computers Store -->
                <div class="portfolio-grid-item e-commerce hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-purple-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-purple-300 shadow-md">E-Commerce</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Full Page</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Denver Discount Computers</p>
                        <p class="text-purple-300/80 text-[10px] font-medium mt-0.5">Refurbished Tech E-Store</p>
                    </div>
                    <img src="{{ asset('ecommerce/denverdiscountcomputers.com_.jpg') }}" alt="Denver Computers E-Store" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- LOGO & BRANDING ITEM 1 -->
                <div class="portfolio-grid-item logo-branding hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-pink-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-pink-300 shadow-md">Logo & Branding</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-pink-500 to-purple-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Project</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">Urban Cafe</p>
                        <p class="text-pink-300/80 text-[10px] font-medium mt-0.5">Brand Identity Design</p>
                    </div>
                    <img src="{{ asset('contact_us.png') }}" alt="Urban Cafe Brand Identity" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- MOBILE APPS ITEM 1 -->
                <div class="portfolio-grid-item mobile-apps hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-cyan-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-cyan-300 shadow-md">Mobile App</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Project</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">DeliveryPro</p>
                        <p class="text-cyan-300/80 text-[10px] font-medium mt-0.5">Mobile Delivery Application</p>
                    </div>
                    <img src="{{ asset('hero.png') }}" alt="DeliveryPro Mobile App" class="portfolio-scroll-img" loading="lazy">
                </div>

                <!-- DIGITAL MARKETING ITEM 1 -->
                <div class="portfolio-grid-item digital-marketing hidden portfolio-card-frame group">
                    <span class="absolute top-3.5 left-3.5 z-20 px-3.5 py-1 rounded-full bg-slate-950/85 border border-amber-300/40 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider text-amber-300 shadow-md">Digital Marketing</span>
                    <div class="absolute bottom-3.5 right-3.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 px-3.5 py-1.5 rounded-xl bg-gradient-to-r from-amber-400 to-indigo-500 text-white text-xs font-bold shadow-lg flex items-center gap-1.5">
                        <span>Preview Project</span>
                        <i class="ri-arrow-right-up-line"></i>
                    </div>
                    <div class="portfolio-project-name">
                        <p class="text-white font-bold text-sm leading-tight">MarketPulse</p>
                        <p class="text-amber-300/80 text-[10px] font-medium mt-0.5">Digital Marketing Campaign</p>
                    </div>
                    <img src="{{ asset('home.png') }}" alt="MarketPulse Digital Campaign" class="portfolio-scroll-img" loading="lazy">
                </div>

            </div>
        </div>
    </section>

    <!-- Portfolio Full Page Preview Modal / Lightbox -->
    <div id="portfolio-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6 bg-slate-950/90 backdrop-blur-xl transition-opacity duration-300">
        <div class="relative w-full max-w-5xl bg-[#081338] rounded-3xl border border-cyan-300/40 shadow-[0_0_50px_rgba(56,189,248,0.3)] flex flex-col overflow-hidden max-h-[90vh]">
            
            <!-- Modal Header / Browser Frame Bar -->
            <div class="flex items-center justify-between px-5 py-3.5 border-b border-cyan-300/20 bg-[#0c1a4a]/90">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-rose-500/80"></span>
                    <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                    <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                    <span id="modal-project-title" class="ml-3 text-xs sm:text-sm font-bold text-white tracking-wide">Project Full Preview</span>
                </div>
                <div class="flex items-center gap-3">
                    <button id="modal-auto-scroll-btn" class="px-3 py-1 rounded-full bg-cyan-500/20 border border-cyan-400/50 text-cyan-300 text-xs font-semibold hover:bg-cyan-500/30 transition-all flex items-center gap-1.5 cursor-pointer">
                        <i class="ri-play-fill"></i> Auto Scroll
                    </button>
                    <button id="close-portfolio-modal" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors cursor-pointer">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content / Scrollable Full Length Image Container -->
            <div id="modal-scroll-viewport" class="w-full h-[80vh] overflow-y-auto bg-[#040b21] p-4 sm:p-6 space-y-4 scroll-smooth">
                <div class="w-full rounded-xl overflow-hidden border border-cyan-300/20 shadow-2xl bg-slate-900">
                    <img id="modal-full-img" src="" alt="Full Web Page Screenshot" class="w-full h-auto block">
                </div>
            </div>

        </div>
    </div>

    <!-- Portfolio Tab Filter & Full Page Click Modal Interactive Script -->
    <style>
      /* Use CSS visibility toggling — avoids layout recalculation lag from display:none */
      .portfolio-grid-item { display: block; }
      .portfolio-grid-item.pf-hidden {
        display: none;
        content-visibility: auto;
      }
    </style>
    <script id="portfolio-filter-script">
      (function () {
        // Run immediately — no need to wait for DOMContentLoaded since script is after the HTML
        function initPortfolio() {
          var buttons = document.querySelectorAll('.portfolio-tab-btn');
          var items   = document.querySelectorAll('.portfolio-grid-item');
          if (!buttons.length || !items.length) return;

          // Pre-build a map: filter -> NodeList for instant access
          var filterMap = {};
          items.forEach(function (item) {
            item.classList.forEach(function (cls) {
              if (cls !== 'portfolio-grid-item' && cls !== 'portfolio-card-frame' && cls !== 'group' && cls !== 'hidden' && cls !== 'pf-hidden') {
                if (!filterMap[cls]) filterMap[cls] = [];
                filterMap[cls].push(item);
              }
            });
            // Remove Tailwind hidden class — we manage visibility ourselves
            item.classList.remove('hidden');
            // Hide non-default tabs upfront
            if (!item.classList.contains('software-erp')) {
              item.classList.add('pf-hidden');
            }
          });

          // Active button style classes
          var activeClasses   = ['bg-gradient-to-r','from-purple-600','via-indigo-600','to-cyan-500','shadow-[0_0_20px_rgba(99,102,241,0.6)]','font-bold'];
          var inactiveClasses = ['bg-[#0f1f56]/70','hover:bg-[#162a74]','font-semibold'];

          var currentFilter = 'software-erp';

          buttons.forEach(function (btn) {
            btn.addEventListener('click', function () {
              var filter = this.getAttribute('data-filter');
              if (filter === currentFilter) return; // no-op if already active
              currentFilter = filter;

              // Swap button styles
              buttons.forEach(function (b) {
                activeClasses.forEach(function (c)   { b.classList.remove(c); });
                inactiveClasses.forEach(function (c) { b.classList.add(c); });
              });
              activeClasses.forEach(function (c)   { btn.classList.add(c); });
              inactiveClasses.forEach(function (c) { btn.classList.remove(c); });

              // Show/hide items — batch in one rAF to avoid repeated reflows
              requestAnimationFrame(function () {
                items.forEach(function (item) {
                  var show = filter === 'all' || item.classList.contains(filter);
                  if (show) {
                    item.classList.remove('pf-hidden');
                    // Lazy-load deferred images the first time they become visible
                    var img = item.querySelector('img[data-src]');
                    if (img) { img.src = img.dataset.src; img.removeAttribute('data-src'); }
                  } else {
                    item.classList.add('pf-hidden');
                  }
                });
              });
            }, { passive: true });
          });

          // ── Full Page Modal Preview ──────────────────────────────────────
          var modal         = document.getElementById('portfolio-modal');
          var modalImg      = document.getElementById('modal-full-img');
          var modalTitle    = document.getElementById('modal-project-title');
          var closeModalBtn = document.getElementById('close-portfolio-modal');
          var autoScrollBtn = document.getElementById('modal-auto-scroll-btn');
          var viewport      = document.getElementById('modal-scroll-viewport');
          var cards         = document.querySelectorAll('.portfolio-card-frame');

          var autoScrollRAF  = null;
          var isAutoScrolling = false;

          cards.forEach(function (card) {
            card.addEventListener('click', function () {
              var img           = this.querySelector('.portfolio-scroll-img');
              var categoryBadge = this.querySelector('span');
              if (!img || !modal || !modalImg) return;

              modalImg.src        = img.src;
              modalTitle.innerText = (categoryBadge ? categoryBadge.innerText : 'Portfolio Project') + ' — Full Page Preview';
              modal.classList.remove('hidden');
              modal.classList.add('flex');
              document.body.style.overflow = 'hidden';
              if (viewport) viewport.scrollTop = 0;
            });
          });

          function stopAutoScroll() {
            if (autoScrollRAF) { cancelAnimationFrame(autoScrollRAF); autoScrollRAF = null; }
            isAutoScrolling = false;
            if (autoScrollBtn) autoScrollBtn.innerHTML = '<i class="ri-play-fill"></i> Auto Scroll';
          }

          function closeModal() {
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            stopAutoScroll();
          }

          if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
          if (modal) modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
          document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

          // rAF-based smooth auto-scroll (no setInterval jank)
          if (autoScrollBtn && viewport) {
            autoScrollBtn.addEventListener('click', function () {
              if (isAutoScrolling) { stopAutoScroll(); return; }
              isAutoScrolling = true;
              autoScrollBtn.innerHTML = '<i class="ri-pause-fill"></i> Pause Scroll';
              function step() {
                viewport.scrollTop += 2;
                if (viewport.scrollTop + viewport.clientHeight >= viewport.scrollHeight - 5) {
                  stopAutoScroll(); return;
                }
                autoScrollRAF = requestAnimationFrame(step);
              }
              autoScrollRAF = requestAnimationFrame(step);
            });
          }
        }

        // Execute as soon as the DOM is ready (handles both inline and deferred cases)
        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', initPortfolio);
        } else {
          initPortfolio();
        }
      })();
    </script>

    <section class="py-24 max-w-8xl relative overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(145deg,#030d32_0%,#08184a_42%,#1d1657_100%)]"></div>
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_14%_16%,rgba(88,210,255,0.20),transparent_34%),radial-gradient(circle_at_88%_12%,rgba(169,116,255,0.20),transparent_33%),radial-gradient(circle_at_52%_90%,rgba(75,122,255,0.20),transparent_36%)]">
        </div>

        <!-- 3D Geometric Floating Background Shapes for Why Choose -->
        <div class="absolute top-16 left-12 w-40 h-40 rounded-full border-2 border-dashed border-cyan-300/30 bg-cyan-400/5 backdrop-blur-sm animate-spin-orbit pointer-events-none hidden md:block"></div>
        <div class="absolute bottom-20 right-14 w-36 h-36 rounded-3xl border border-indigo-300/30 bg-gradient-to-tr from-indigo-500/15 via-purple-500/10 to-transparent backdrop-blur-md rotate-45 animate-bg-shape-1 pointer-events-none hidden md:block shadow-[0_0_25px_rgba(99,102,241,0.2)]"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full bg-gradient-to-r from-cyan-400/10 via-indigo-500/10 to-purple-600/10 blur-3xl pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p
                    class="inline-flex items-center px-4 py-2 rounded-full border border-cyan-300/40 bg-gradient-to-r from-cyan-500/10 to-indigo-500/10 backdrop-blur-md text-[11px] font-semibold tracking-[0.2em] uppercase text-cyan-200 mb-6">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse mr-2"></span>
                    Why Choose Biz Tech Solution?
                </p>
                <h1 class="text-5xl sm:text-6xl lg:text-6xl font-black text-white mb-5 leading-[1.1]">
                    Why Choose Biz Tech Solution for Your Digital Success
                </h1>
                <p class="text-blue-100/85 text-lg sm:text-xl max-w-4xl mx-auto leading-relaxed font-light">
                    With over 5 years of expertise, we've helped 150+ businesses achieve their digital goals through innovative solutions, dedicated support, and proven results.
                </p>
                <div class="mt-8 flex items-center justify-center gap-4">
                    <span class="w-16 h-px bg-gradient-to-r from-transparent via-cyan-300/70 to-transparent"></span>
                    <span class="w-3 h-3 rounded-full bg-gradient-to-r from-cyan-300 to-indigo-300 shadow-[0_0_12px_rgba(56,189,248,0.8)]"></span>
                    <span class="w-16 h-px bg-gradient-to-r from-transparent via-indigo-300/70 to-transparent"></span>
                </div>
            </div>

            <!-- Main Features Grid with Enhanced Design -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Card 1: Experience -->
                <article
                    class="group relative rounded-3xl border border-cyan-300/30 bg-gradient-to-br from-[#0f2462]/90 via-[#0d1d51]/85 to-[#0a1847]/80 p-8 text-left transition-all duration-500 hover:-translate-y-2 hover:border-cyan-300/60 hover:shadow-[0_20px_45px_rgba(56,189,248,0.25)] backdrop-blur-md">
                    <!-- Gradient Line Top -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-300 via-blue-300 to-transparent rounded-t-3xl"></div>
                    
                    <!-- Icon Container -->
                    <div class="relative mb-6">
                        <div class="absolute -top-3 -left-3 w-24 h-24 bg-cyan-400/10 rounded-full blur-xl group-hover:bg-cyan-400/20 transition-all duration-500"></div>
                        <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500/30 to-cyan-400/10 border border-cyan-300/40 flex items-center justify-center group-hover:border-cyan-300/80 transition-all duration-300">
                            <i class="ri-award-line text-3xl text-cyan-300"></i>
                        </div>
                    </div>

                    <span class="inline-block px-3 py-1 rounded-full bg-cyan-500/15 border border-cyan-300/30 text-cyan-300 text-xs font-bold tracking-wider mb-4">EXPERIENCE</span>
                    
                    <h3 class="text-2xl sm:text-3xl font-bold text-white mb-3 leading-tight">5+ Years of Proven Excellence</h3>
                    <p class="text-blue-100/80 text-sm leading-relaxed mb-6">200+ successful projects delivered across diverse industries with proven results and client satisfaction.</p>
                    
                    <!-- Stats Row -->
                    <div class="pt-4 border-t border-cyan-300/20">
                        <p class="text-cyan-300 font-semibold text-lg">200+</p>
                        <p class="text-blue-100/70 text-xs">Projects Delivered</p>
                    </div>
                </article>

                <!-- Card 2: Expert Team -->
                <article
                    class="group relative rounded-3xl border border-indigo-300/30 bg-gradient-to-br from-[#1a2d78]/90 via-[#0f1f56]/85 to-[#0a1847]/80 p-8 text-left transition-all duration-500 hover:-translate-y-2 hover:border-indigo-300/60 hover:shadow-[0_20px_45px_rgba(99,102,241,0.25)] backdrop-blur-md">
                    <!-- Gradient Line Top -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-300 via-purple-300 to-transparent rounded-t-3xl"></div>
                    
                    <!-- Icon Container -->
                    <div class="relative mb-6">
                        <div class="absolute -top-3 -left-3 w-24 h-24 bg-indigo-400/10 rounded-full blur-xl group-hover:bg-indigo-400/20 transition-all duration-500"></div>
                        <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500/30 to-indigo-400/10 border border-indigo-300/40 flex items-center justify-center group-hover:border-indigo-300/80 transition-all duration-300">
                            <i class="ri-team-line text-3xl text-indigo-300"></i>
                        </div>
                    </div>

                    <span class="inline-block px-3 py-1 rounded-full bg-indigo-500/15 border border-indigo-300/30 text-indigo-300 text-xs font-bold tracking-wider mb-4">EXPERTISE</span>
                    
                    <h3 class="text-2xl sm:text-3xl font-bold text-white mb-3 leading-tight">Expert Team & Certified Professionals</h3>
                    <p class="text-blue-100/80 text-sm leading-relaxed mb-6">Expert team across design, development, marketing & strategy dedicated to your success.</p>
                    
                    <!-- Stats Row -->
                    <div class="pt-4 border-t border-indigo-300/20">
                        <p class="text-indigo-300 font-semibold text-lg">15+</p>
                        <p class="text-blue-100/70 text-xs">Specialists & Experts</p>
                    </div>
                </article>

                <!-- Card 3: 24/7 Support -->
                <article
                    class="group relative rounded-3xl border border-blue-300/30 bg-gradient-to-br from-[#0f2462]/90 via-[#0d1d51]/85 to-[#0a1847]/80 p-8 text-left transition-all duration-500 hover:-translate-y-2 hover:border-blue-300/60 hover:shadow-[0_20px_45px_rgba(59,130,246,0.25)] backdrop-blur-md">
                    <!-- Gradient Line Top -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-300 via-cyan-300 to-transparent rounded-t-3xl"></div>
                    
                    <!-- Icon Container -->
                    <div class="relative mb-6">
                        <div class="absolute -top-3 -left-3 w-24 h-24 bg-blue-400/10 rounded-full blur-xl group-hover:bg-blue-400/20 transition-all duration-500"></div>
                        <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500/30 to-blue-400/10 border border-blue-300/40 flex items-center justify-center group-hover:border-blue-300/80 transition-all duration-300">
                            <i class="ri-customer-service-2-line text-3xl text-blue-300"></i>
                        </div>
                    </div>

                    <span class="inline-block px-3 py-1 rounded-full bg-blue-500/15 border border-blue-300/30 text-blue-300 text-xs font-bold tracking-wider mb-4">SUPPORT</span>
                    
                    <h3 class="text-2xl sm:text-3xl font-bold text-white mb-3 leading-tight">24/7 Support & Dedicated Assistance</h3>
                    <p class="text-blue-100/80 text-sm leading-relaxed mb-6">24/7 dedicated assistance whenever you need us. Your success is our priority always.</p>
                    
                    <!-- Stats Row -->
                    <div class="pt-4 border-t border-blue-300/20">
                        <p class="text-blue-300 font-semibold text-lg">24/7</p>
                        <p class="text-blue-100/70 text-xs">Availability Guaranteed</p>
                    </div>
                </article>

                <!-- Card 4: Competitive Pricing -->
                <article
                    class="group relative rounded-3xl border border-purple-300/30 bg-gradient-to-br from-[#1c2d68]/90 via-[#131d54]/85 to-[#0a1847]/80 p-8 text-left transition-all duration-500 hover:-translate-y-2 hover:border-purple-300/60 hover:shadow-[0_20px_45px_rgba(168,85,247,0.25)] backdrop-blur-md">
                    <!-- Gradient Line Top -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-300 via-fuchsia-300 to-transparent rounded-t-3xl"></div>
                    
                    <!-- Icon Container -->
                    <div class="relative mb-6">
                        <div class="absolute -top-3 -left-3 w-24 h-24 bg-purple-400/10 rounded-full blur-xl group-hover:bg-purple-400/20 transition-all duration-500"></div>
                        <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500/30 to-purple-400/10 border border-purple-300/40 flex items-center justify-center group-hover:border-purple-300/80 transition-all duration-300">
                            <i class="ri-money-dollar-circle-line text-3xl text-purple-300"></i>
                        </div>
                    </div>

                    <span class="inline-block px-3 py-1 rounded-full bg-purple-500/15 border border-purple-300/30 text-purple-300 text-xs font-bold tracking-wider mb-4">PRICING</span>
                    
                    <h3 class="text-2xl sm:text-3xl font-bold text-white mb-3 leading-tight">Transparent & Competitive Pricing</h3>
                    <p class="text-blue-100/80 text-sm leading-relaxed mb-6">Best value packages with clear pricing structure and zero hidden fees ever.</p>
                    
                    <!-- Stats Row -->
                    <div class="pt-4 border-t border-purple-300/20">
                        <p class="text-purple-300 font-semibold text-lg">Flexible</p>
                        <p class="text-blue-100/70 text-xs">Budget Options</p>
                    </div>
                </article>
            </div>

            <!-- Stats & Achievements Box -->
            <div class="mb-12">
                <div class="rounded-3xl border border-cyan-300/30 bg-gradient-to-br from-[#0a1847]/80 via-[#0d1f56]/75 to-[#050f2e]/85 p-8 sm:p-10 shadow-[0_0_30px_rgba(56,189,248,0.15)] backdrop-blur-md">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8">
                        <!-- Stat 1 -->
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500/25 to-cyan-400/10 border border-cyan-300/40 mb-3 group-hover:border-cyan-300/80 transition-all">
                                <i class="ri-briefcase-4-line text-2xl text-cyan-300"></i>
                            </div>
                            <p class="text-3xl sm:text-4xl font-black text-transparent bg-gradient-to-r from-cyan-300 to-blue-300 bg-clip-text mb-1">200+</p>
                            <p class="text-blue-100/70 text-xs sm:text-sm font-medium">Projects Completed</p>
                        </div>
                        
                        <!-- Stat 2 -->
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500/25 to-indigo-400/10 border border-indigo-300/40 mb-3 group-hover:border-indigo-300/80 transition-all">
                                <i class="ri-emotion-happy-line text-2xl text-indigo-300"></i>
                            </div>
                            <p class="text-3xl sm:text-4xl font-black text-transparent bg-gradient-to-r from-indigo-300 to-purple-300 bg-clip-text mb-1">150+</p>
                            <p class="text-blue-100/70 text-xs sm:text-sm font-medium">Happy Clients</p>
                        </div>
                        
                        <!-- Stat 3 -->
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-500/25 to-yellow-400/10 border border-yellow-300/40 mb-3 group-hover:border-yellow-300/80 transition-all">
                                <i class="ri-trophy-line text-2xl text-yellow-300"></i>
                            </div>
                            <p class="text-3xl sm:text-4xl font-black text-transparent bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text mb-1">98%</p>
                            <p class="text-blue-100/70 text-xs sm:text-sm font-medium">Client Satisfaction</p>
                        </div>
                        
                        <!-- Stat 4 -->
                        <div class="text-center group">
                            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500/25 to-purple-400/10 border border-purple-300/40 mb-3 group-hover:border-purple-300/80 transition-all">
                                <i class="ri-line-chart-line text-2xl text-purple-300"></i>
                            </div>
                            <p class="text-3xl sm:text-4xl font-black text-transparent bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text mb-1">5+</p>
                            <p class="text-blue-100/70 text-xs sm:text-sm font-medium">Years of Excellence</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call-to-Action Section -->
            <div class="text-center">
                <a href="#contact"
                    class="inline-flex items-center gap-3 px-9 py-4 rounded-2xl bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white font-bold text-lg shadow-[0_15px_35px_rgba(56,189,248,0.4)] hover:shadow-[0_20px_50px_rgba(56,189,248,0.5)] hover:scale-105 transition-all duration-300">
                    <span>Start Your Project Today</span>
                    <i class="ri-arrow-right-line text-xl"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="py-24 relative overflow-hidden bg-[#07133b] max-w-8xl">
        <!-- Ambient Background Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#081542] via-[#0b1c54] to-[#061033]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(56,189,248,0.18),transparent_40%),radial-gradient(circle_at_80%_70%,rgba(168,85,247,0.18),transparent_40%)]"></div>

        <!-- 3D Geometric Floating Background Shapes for Testimonials -->
        <div class="absolute top-12 left-10 w-36 h-36 rounded-3xl border border-cyan-300/25 bg-gradient-to-br from-cyan-500/10 via-indigo-500/5 to-transparent backdrop-blur-md rotate-12 animate-bg-shape-1 pointer-events-none hidden md:block"></div>
        <div class="absolute bottom-12 right-12 w-44 h-44 rounded-full border-2 border-dashed border-purple-300/25 bg-purple-500/5 backdrop-blur-sm animate-spin-orbit pointer-events-none hidden md:block"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#111a4b]/70 text-[11px] font-semibold uppercase tracking-[0.22em] text-cyan-100 mb-4">
                    Client Testimonials
                </p>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Client Success Stories & Case Studies</h2>
                <p class="text-lg text-blue-100/85 max-w-3xl mx-auto">Real results and proven success from businesses across Pakistan</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="rounded-2xl border border-cyan-300/25 bg-[#0f1f56]/85 p-8 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_25px_rgba(96,157,255,0.28)] shadow-lg">
                    <div class="flex items-center mb-5">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-indigo-500 rounded-full flex items-center justify-center mr-4 shadow-md text-white font-bold text-base">
                            AH
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-lg leading-snug">Ahmed Hussain</h5>
                            <p class="text-cyan-200/80 text-xs font-medium">Founder, Lahore Electronics</p>
                        </div>
                    </div>
                    <p class="text-blue-100/90 text-sm leading-relaxed mb-5">"Biz Tech Solution helped us build a powerful online store. Within a few months, our customer base grew significantly, and our online orders increased by 250%."</p>
                    <div class="flex text-yellow-300 gap-1 text-sm">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                    </div>
                </div>

                <div class="rounded-2xl border border-cyan-300/25 bg-[#0f1f56]/85 p-8 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_25px_rgba(96,157,255,0.28)] shadow-lg">
                    <div class="flex items-center mb-5">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full flex items-center justify-center mr-4 shadow-md text-white font-bold text-base">
                            SZ
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-lg leading-snug">Sara Zubair</h5>
                            <p class="text-cyan-200/80 text-xs font-medium">Owner, Karachi Fitness Studio</p>
                        </div>
                    </div>
                    <p class="text-blue-100/90 text-sm leading-relaxed mb-5">"Their social media marketing strategy was a game-changer. We gained over 1,000 new clients in 90 days. Highly professional and responsive team."</p>
                    <div class="flex text-yellow-300 gap-1 text-sm">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                    </div>
                </div>

                <div class="rounded-2xl border border-cyan-300/25 bg-[#0f1f56]/85 p-8 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_25px_rgba(96,157,255,0.28)] shadow-lg">
                    <div class="flex items-center mb-5">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-cyan-500 rounded-full flex items-center justify-center mr-4 shadow-md text-white font-bold text-base">
                            MT
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-lg leading-snug">Mohsin Tariq</h5>
                            <p class="text-cyan-200/80 text-xs font-medium">CEO, Islamabad Tea House</p>
                        </div>
                    </div>
                    <p class="text-blue-100/90 text-sm leading-relaxed mb-5">"Their branding services gave our café a fresh new identity. Our foot traffic and customer engagement both improved noticeably."</p>
                    <div class="flex text-yellow-300 gap-1 text-sm">
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
            class="absolute inset-0 bg-[linear-gradient(150deg,rgba(3,11,40,0.88),rgba(8,24,76,0.82),rgba(18,24,89,0.85))]">
        </div>
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_18%_15%,rgba(78,208,255,0.20),transparent_35%),radial-gradient(circle_at_82%_28%,rgba(170,108,255,0.22),transparent_35%)]">
        </div>

        <!-- 3D Geometric Floating Background Shapes for Services -->
        <div class="absolute top-20 right-10 w-44 h-44 rounded-3xl border border-cyan-300/30 bg-gradient-to-br from-cyan-500/15 via-indigo-500/10 to-transparent backdrop-blur-md rotate-45 animate-bg-shape-1 pointer-events-none hidden md:block shadow-[0_0_25px_rgba(56,189,248,0.15)]"></div>
        <div class="absolute bottom-16 left-12 w-48 h-48 rounded-full border-4 border-dashed border-indigo-400/25 bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-sm animate-spin-orbit pointer-events-none hidden md:block"></div>
        <div class="absolute top-1/2 left-0 w-[600px] h-[2px] bg-gradient-to-r from-transparent via-purple-400/35 to-transparent transform rotate-45 pointer-events-none hidden lg:block"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p
                    class="inline-flex items-center px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#0f225f]/70 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100 mb-4">
                    Our Services</p>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-3">Complete Digital Solutions: Web, Software & Marketing Services</h2>
                <p class="text-blue-100/90 max-w-xl mx-auto text-lg leading-relaxed">Comprehensive, scalable, and results-driven services to accelerate your business growth online.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @php
                    $allCategories = config('service_pages.categories');
                    $allPages = config('service_pages.pages');
                @endphp

                @foreach ($allCategories as $catKey => $cat)
                    @php
                        $catPages = array_filter($allPages, fn($p) => ($p['category'] ?? '') === $catKey);
                    @endphp
                    <article
                        class="group rounded-2xl border border-cyan-300/20 bg-[#0f1f56]/85 p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300/45 hover:shadow-[0_0_24px_rgba(96,157,255,0.28)] flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                <div
                                    class="w-12 h-12 flex items-center justify-center rounded-2xl bg-[#1a2f78]/75 border border-cyan-300/30 text-cyan-200 text-2xl shrink-0">
                                    <i class="{{ $cat['icon'] }}"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white leading-tight">{{ $cat['label'] }}</h4>
                                    <p class="text-[11px] text-cyan-200/80 leading-tight mt-0.5">{{ $cat['hero_kicker'] }}</p>
                                </div>
                            </div>
                            
                            <ul class="text-blue-100/85 text-xs leading-relaxed my-4 space-y-1.5">
                                @foreach ($catPages as $slug => $pItem)
                                    <li>
                                        <a href="{{ route('services.show', $slug) }}" class="inline-flex items-center gap-1.5 hover:text-cyan-300 transition-colors">
                                            <i class="ri-arrow-right-s-line text-cyan-400"></i>
                                            <span>{{ $pItem['title'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="pt-3 border-t border-cyan-300/15 flex items-center justify-between text-xs">
                            <span class="text-blue-200/70">{{ count($catPages) }} Specialized Services</span>
                            @if(!empty($catPages))
                                @php $firstSlug = array_key_first($catPages); @endphp
                                <a href="{{ route('services.show', $firstSlug) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gradient-to-r from-cyan-400 to-indigo-500 text-white font-semibold shadow-[0_4px_12px_rgba(79,160,255,0.2)] hover:scale-105 transition-all">
                                    Explore <i class="ri-arrow-right-line"></i>
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
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
            class="absolute inset-0 bg-[linear-gradient(110deg,rgba(3,10,36,0.88)_0%,rgba(10,18,62,0.75)_44%,rgba(22,16,72,0.45)_100%)]">
        </div>

        <!-- 3D Geometric Floating Background Shapes for Contact -->
        <div class="absolute top-1/4 right-1/4 w-96 h-96 rounded-full bg-gradient-to-br from-cyan-400/20 via-indigo-500/20 to-purple-600/20 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-40 h-40 rounded-full border-2 border-dashed border-cyan-300/30 bg-cyan-400/5 backdrop-blur-md animate-spin-orbit pointer-events-none hidden md:block"></div>
        <div class="absolute top-12 right-12 w-32 h-32 rounded-3xl border border-indigo-300/25 bg-indigo-500/10 backdrop-blur-sm rotate-45 animate-bg-shape-1 pointer-events-none hidden md:block"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Get a Free Consultation: Start Your Digital Project Today</h2>
                <p class="text-lg text-blue-100/95 max-w-3xl mx-auto">Contact our team to discuss your project requirements and receive a personalized proposal tailored to your business goals.</p>
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
