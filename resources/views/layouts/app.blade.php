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

    @include('partials.header')

    <main>
      @yield('content')
    </main>

    @include('partials.footer')

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
    <script id="form-loader-script">
      document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
          form.addEventListener('submit', function(e) {
            // Prevent multiple submissions
            if (this.dataset.submitting) {
                e.preventDefault();
                return;
            }
            this.dataset.submitting = 'true';
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
              // Save original content in case we need to restore (though page will likely redirect/reload)
              if (!submitBtn.dataset.originalHtml) {
                  submitBtn.dataset.originalHtml = submitBtn.innerHTML;
              }
              submitBtn.innerHTML = '<i class="ri-loader-4-line animate-spin text-lg"></i> <span class="ml-2">Sending...</span>';
              submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
            }
          });
        });
      });
    </script>
  </body>
</html>
