@php
    $serviceMenus = [
        [
            'label' => 'Branding & Creative',
            'href' => route('services.show', 'logo-visual-identity'),
            'items' => [
                ['label' => 'Logo & Visual Identity', 'href' => route('services.show', 'logo-visual-identity')],
                ['label' => 'Brand Guidelines', 'href' => route('services.show', 'brand-guidelines')],
                ['label' => 'Marketing Collateral', 'href' => route('services.show', 'marketing-collateral')],
                ['label' => 'Social Media Assets', 'href' => route('services.show', 'social-media-assets')],
                ['label' => 'Packaging & Print Design', 'href' => route('services.show', 'packaging-print-design')],
            ],
        ],
        [
            'label' => 'Web Solutions',
            'href' => route('services.show', 'corporate-websites'),
            'items' => [
                ['label' => 'Corporate Websites', 'href' => route('services.show', 'corporate-websites')],
                ['label' => 'E-Commerce Stores', 'href' => route('services.show', 'ecommerce-stores')],
                ['label' => 'Custom Web Applications', 'href' => route('services.show', 'custom-web-applications')],
                ['label' => 'CMS Development', 'href' => route('services.show', 'cms-development-services')],
                ['label' => 'Website Revamps & Optimization', 'href' => route('services.show', 'website-revamps-optimization')],
            ],
        ],
        [
            'label' => 'Mobile Applications',
            'href' => route('services.show', 'android-development'),
            'items' => [
                ['label' => 'Android Development', 'href' => route('services.show', 'android-development')],
                ['label' => 'iOS Development', 'href' => route('services.show', 'ios-development')],
                ['label' => 'Cross-Platform Apps', 'href' => route('services.show', 'cross-platform-apps-dev')],
                ['label' => 'UI/UX Design', 'href' => route('services.show', 'mobile-ui-ux-design')],
                ['label' => 'App Support & Maintenance', 'href' => route('services.show', 'app-support-maintenance')],
            ],
        ],
        [
            'label' => 'Business Software',
            'href' => route('services.show', 'erp-solutions'),
            'items' => [
                ['label' => 'ERP Solutions', 'href' => route('services.show', 'erp-solutions')],
                ['label' => 'CRM Platforms', 'href' => route('services.show', 'crm-platforms')],
                ['label' => 'HR & Inventory Management', 'href' => route('services.show', 'hr-inventory-management')],
                ['label' => 'Billing & Accounting Systems', 'href' => route('services.show', 'billing-accounting-systems')],
                ['label' => 'Industry-Specific Software', 'href' => route('services.show', 'industry-specific-software')],
            ],
        ],
        [
            'label' => 'Cloud & Infrastructure',
            'href' => route('services.show', 'rest-api-development'),
            'items' => [
                ['label' => 'REST API Development', 'href' => route('services.show', 'rest-api-development')],
                ['label' => 'Cloud Deployment', 'href' => route('services.show', 'cloud-deployment-services')],
                ['label' => 'Database Architecture', 'href' => route('services.show', 'database-architecture')],
                ['label' => 'Server Management', 'href' => route('services.show', 'server-management')],
                ['label' => 'DevOps & CI/CD', 'href' => route('services.show', 'devops-cicd')],
            ],
        ],
        [
            'label' => 'AI & Intelligent Automation',
            'href' => route('services.show', 'ai-chatbots'),
            'items' => [
                ['label' => 'AI Chatbots', 'href' => route('services.show', 'ai-chatbots')],
                ['label' => 'Business Process Automation', 'href' => route('services.show', 'business-process-automation')],
                ['label' => 'SaaS Development', 'href' => route('services.show', 'saas-development')],
                ['label' => 'AI Integrations', 'href' => route('services.show', 'ai-integrations')],
                ['label' => 'Analytics & Business Intelligence', 'href' => route('services.show', 'analytics-business-intelligence')],
            ],
        ],
        [
            'label' => 'Growth Marketing',
            'href' => route('services.show', 'search-engine-optimization'),
            'items' => [
                ['label' => 'Search Engine Optimization', 'href' => route('services.show', 'search-engine-optimization')],
                ['label' => 'Paid Advertising (Google & Meta)', 'href' => route('services.show', 'paid-advertising-google-meta')],
                ['label' => 'Social Media Marketing', 'href' => route('services.show', 'social-media-marketing-growth')],
                ['label' => 'Content Strategy', 'href' => route('services.show', 'content-strategy')],
                ['label' => 'Email Marketing & Automation', 'href' => route('services.show', 'email-marketing-automation')],
            ],
        ],
    ];

    $topLinks = [
        ['label' => 'Home', 'href' => url('/')],
        ['label' => 'About', 'href' => route('work')],
        ['label' => 'Blog', 'href' => route('blogs.index')],
        ['label' => 'Contact Us', 'href' => route('contact.show')],
    ];
@endphp

<header id="site-header" class="fixed top-0 left-0 w-full z-50 border-t border-transparent bg-transparent transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="min-h-20 lg:min-h-24 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3 group">
                <div class="min-w-0 flex items-center">
                    <img src="{{ asset('bizlogo.png') }}" alt="Biz Online Logo" class="h-20 sm:h-20 md:h-24 lg:h-28 w-auto object-contain">
                </div>
            </a>

            <!-- Desktop Navigation Sequence: Home -> About -> Services -> Blog -> Contact Us -->
            <nav
                class="hidden lg:flex items-center gap-1 rounded-full border border-indigo-300/35 bg-[#121f4e]/85 p-1 shadow-[0_0_20px_rgba(112,120,255,0.25)]">
                <!-- 1. Home -->
                <a href="{{ url('/') }}"
                    class="px-4 py-2 text-md font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full">Home</a>

                <!-- 2. About -->
                <a href="{{ route('work') }}"
                    class="px-4 py-2 text-md font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full">About</a>

                <!-- 3. Services Dropdown -->
                <div class="relative group">
                    <button type="button"
                        class="px-4 py-2 text-md font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full inline-flex items-center gap-1">
                        <span>Services</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </button>
                    <div
                        class="fixed left-1/2 top-[72px] z-[999] w-[calc(100vw-2rem)] max-w-[1220px] -translate-x-1/2 
            max-h-[72vh] overflow-y-auto rounded-2xl border border-indigo-300/35 
            bg-[#101d49]/95 p-5 opacity-0 invisible 
            shadow-[0_24px_70px_rgba(0,0,0,0.35)] 
            transition-all duration-200 
            group-hover:opacity-100 group-hover:visible">

                        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($serviceMenus as $menu)
                                <div class="rounded-2xl border border-cyan-300/20 bg-[#0b1948]/75 p-4">
                                    <a href="{{ $menu['href'] }}"
                                        class="flex items-center justify-between gap-3 text-sm font-semibold text-white hover:text-cyan-100">
                                        <span>{{ $menu['label'] }}</span>
                                        <i class="ri-arrow-right-up-line text-cyan-300"></i>
                                    </a>

                                    <div class="mt-3 space-y-1.5">
                                        @foreach ($menu['items'] as $item)
                                            <a href="{{ $item['href'] }}"
                                                class="block rounded-lg px-3 py-2 text-sm text-blue-100/85 hover:bg-white/10 hover:text-white">
                                                {{ $item['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 4. Blog -->
                <a href="{{ route('blogs.index') }}"
                    class="px-4 py-2 text-md font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full">Blog</a>

                <!-- 5. Contact Us -->
                <a href="{{ route('contact.show') }}"
                    class="px-4 py-2 text-md font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full whitespace-nowrap">Contact Us</a>
            </nav>

            <div class="flex shrink-0 items-center gap-2">
                <a href="{{ route('contact.show') }}"
                    class="hidden sm:inline-flex bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white px-4 lg:px-5 py-2.5 !rounded-button whitespace-nowrap font-semibold items-center gap-2 shadow-[0_0_20px_rgba(145,92,255,0.45)]">
                    <span>Book Free Call</span>
                    <i class="ri-arrow-right-up-line"></i>
                </a>
                <button type="button" id="site-mobile-menu-button"
                    class="lg:hidden inline-flex h-11 w-11 items-center justify-center rounded-xl border border-cyan-300/35 bg-[#12235f]/90 text-cyan-100"
                    aria-controls="site-mobile-menu" aria-expanded="false">
                    <i class="ri-menu-line text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Sequence: Home -> About -> Services -> Blog -> Contact Us -->
        <div id="site-mobile-menu" class="hidden lg:hidden pb-5">
            <div
                class="max-h-[calc(100vh-6rem)] overflow-y-auto rounded-2xl border border-cyan-300/25 bg-[#091741]/95 p-4 shadow-[0_24px_70px_rgba(0,0,0,0.35)]">
                <div class="grid gap-2 sm:grid-cols-2">
                    <a href="{{ url('/') }}" class="rounded-xl border border-cyan-300/20 bg-[#12235f]/75 px-4 py-3 text-sm font-semibold text-cyan-100">Home</a>
                    <a href="{{ route('work') }}" class="rounded-xl border border-cyan-300/20 bg-[#12235f]/75 px-4 py-3 text-sm font-semibold text-cyan-100">About</a>
                </div>

                <div class="mt-3 space-y-3">
                    <details class="group rounded-2xl border border-cyan-300/20 bg-[#0d1d51]/80">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-4 py-3 text-sm font-semibold text-white">
                            <span>Services</span>
                            <i class="ri-arrow-down-s-line text-cyan-200 transition-transform group-open:rotate-180"></i>
                        </summary>
                        <div class="border-t border-cyan-300/15 px-3 py-3 space-y-3">
                            @foreach ($serviceMenus as $menu)
                                <div>
                                    <a href="{{ $menu['href'] }}" class="mb-1 block text-xs font-bold uppercase tracking-wider text-cyan-300">{{ $menu['label'] }}</a>
                                    <div class="space-y-1">
                                        @foreach ($menu['items'] as $item)
                                            <a href="{{ $item['href'] }}" class="block rounded-lg px-3 py-1.5 text-xs text-blue-100/85 hover:bg-white/10 hover:text-white">{{ $item['label'] }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </details>
                </div>

                <div class="grid gap-2 sm:grid-cols-2 mt-3">
                    <a href="{{ route('blogs.index') }}" class="rounded-xl border border-cyan-300/20 bg-[#12235f]/75 px-4 py-3 text-sm font-semibold text-cyan-100">Blog</a>
                    <a href="{{ route('contact.show') }}" class="rounded-xl border border-cyan-300/20 bg-[#12235f]/75 px-4 py-3 text-sm font-semibold text-cyan-100">Contact Us</a>
                </div>

                <a href="{{ route('contact.show') }}"
                    class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 px-5 py-3 text-sm font-semibold text-white shadow-[0_0_20px_rgba(145,92,255,0.45)]">
                    Book Free Call <i class="ri-arrow-right-up-line"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var header = document.getElementById('site-header');
        var button = document.getElementById('site-mobile-menu-button');
        var menu = document.getElementById('site-mobile-menu');

        if (!button || !menu) {
            return;
        }

        function handleHeaderBackground() {
            if (!header) return;
            var isMenuOpen = !menu.classList.contains('hidden');
            if (window.scrollY > 10 || isMenuOpen) {
                header.classList.remove('bg-transparent', 'border-transparent');
                header.classList.add('bg-[#050d2a]/80', 'backdrop-blur-md', 'border-cyan-300/30');
            } else {
                header.classList.remove('bg-[#050d2a]/80', 'backdrop-blur-md', 'border-cyan-300/30');
                header.classList.add('bg-transparent', 'border-transparent');
            }
        }

        window.addEventListener('scroll', handleHeaderBackground);
        // Run immediately to set correct initial state
        handleHeaderBackground();

        button.addEventListener('click', function() {
            var isHidden = menu.classList.toggle('hidden');
            button.setAttribute('aria-expanded', String(!isHidden));
            var icon = button.querySelector('i');

            if (icon) {
                icon.className = isHidden ? 'ri-menu-line text-xl' : 'ri-close-line text-xl';
            }
            handleHeaderBackground();
        });

        menu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                menu.classList.add('hidden');
                button.setAttribute('aria-expanded', 'false');
                var icon = button.querySelector('i');

                if (icon) {
                    icon.className = 'ri-menu-line text-xl';
                }
                handleHeaderBackground();
            });
        });
    });
</script>
