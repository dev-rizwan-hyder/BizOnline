@php
    $serviceMenus = [
        [
            'label' => 'Branding & Design',
            'href' => route('logo.design'),
            'items' => [
                ['label' => 'Logo design', 'href' => route('logo.design')],
                ['label' => 'Brand identity', 'href' => route('brand.identity')],
                ['label' => 'Business cards', 'href' => route('services.show', 'business-cards')],
                ['label' => 'Social media kit', 'href' => route('services.show', 'social-media-kit')],
                ['label' => 'UI/UX design', 'href' => route('services.show', 'ui-ux-design')],
                ['label' => 'Packaging design', 'href' => route('services.show', 'packaging-design')],
            ],
        ],
        [
            'label' => 'Website Development',
            'href' => route('services.show', 'business-websites'),
            'items' => [
                ['label' => 'Business websites', 'href' => route('services.show', 'business-websites')],
                ['label' => 'E-commerce websites', 'href' => route('services.show', 'ecommerce-websites')],
                ['label' => 'Custom web apps', 'href' => route('services.show', 'custom-web-apps')],
                ['label' => 'CMS development', 'href' => route('services.show', 'cms-development')],
                ['label' => 'Website redesign', 'href' => route('services.show', 'website-redesign')],
            ],
        ],
        [
            'label' => 'Mobile Apps',
            'href' => route('services.show', 'android-apps'),
            'items' => [
                ['label' => 'Android apps', 'href' => route('services.show', 'android-apps')],
                ['label' => 'iOS apps', 'href' => route('services.show', 'ios-apps')],
                ['label' => 'Cross-platform apps', 'href' => route('services.show', 'cross-platform-apps')],
                ['label' => 'App UI/UX design', 'href' => route('services.show', 'app-ui-ux-design')],
                ['label' => 'App maintenance', 'href' => route('services.show', 'app-maintenance')],
            ],
        ],
        [
            'label' => 'Software & ERP',
            'href' => route('services.show', 'erp-systems'),
            'items' => [
                ['label' => 'ERP systems', 'href' => route('services.show', 'erp-systems')],
                ['label' => 'CRM systems', 'href' => route('services.show', 'crm-systems')],
                ['label' => 'Inventory & HRM', 'href' => route('services.show', 'inventory-hrm')],
                ['label' => 'Billing & invoicing', 'href' => route('services.show', 'billing-invoicing')],
                ['label' => 'School / hospital software', 'href' => route('services.show', 'school-hospital-software')],
            ],
        ],
        [
            'label' => 'Backend & Cloud',
            'href' => route('services.show', 'api-development'),
            'items' => [
                ['label' => 'API development', 'href' => route('services.show', 'api-development')],
                ['label' => 'Database design', 'href' => route('services.show', 'database-design')],
                ['label' => 'Cloud hosting setup', 'href' => route('services.show', 'cloud-hosting-setup')],
                ['label' => 'Server deployment', 'href' => route('services.show', 'server-deployment')],
                ['label' => 'DevOps automation', 'href' => route('services.show', 'devops-automation')],
            ],
        ],
        [
            'label' => 'Advanced / Modern Services',
            'href' => route('services.show', 'ai-chatbot-integration'),
            'items' => [
                ['label' => 'AI chatbot integration', 'href' => route('services.show', 'ai-chatbot-integration')],
                ['label' => 'Automation systems', 'href' => route('services.show', 'automation-systems')],
                ['label' => 'Data analytics dashboards', 'href' => route('services.show', 'data-analytics-dashboards')],
                ['label' => 'SaaS product development', 'href' => route('services.show', 'saas-product-development')],
                ['label' => 'API integrations', 'href' => route('services.show', 'api-integrations')],
            ],
        ],
        [
            'label' => 'Digital Marketing',
            'href' => route('services.show', 'seo'),
            'items' => [
                ['label' => 'SEO', 'href' => route('services.show', 'seo')],
                ['label' => 'Social media marketing', 'href' => route('services.show', 'social-media-marketing')],
                ['label' => 'Google Ads / PPC', 'href' => route('services.show', 'google-ads-ppc')],
                ['label' => 'Content marketing', 'href' => route('services.show', 'content-marketing')],
                ['label' => 'Email campaigns', 'href' => route('services.show', 'email-campaigns')],
            ],
        ],
    ];

    $topLinks = [
        ['label' => 'Home', 'href' => url('/')],
        ['label' => 'About', 'href' => route('work')],
        ['label' => 'Blog', 'href' => route('blogs.index')],
        ['label' => 'Contact', 'href' => route('contact.show')],
    ];
@endphp

<header class="fixed top-0 left-0 w-full z-50 border-t border-cyan-300/30 bg-[#050d2a]/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="min-h-20 lg:min-h-24 flex items-center justify-between gap-4">
            <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3 group">
                <div class="min-w-0 flex items-center">
                    <img src="bizlogo.png" alt="Biz Online Logo" class="h-20 sm:h-20 md:h-24 lg:h-28 w-auto object-contain">
                </div>
            </a>

            <nav
                class="hidden lg:flex items-center gap-1 rounded-full border border-indigo-300/35 bg-[#121f4e]/85 p-1 shadow-[0_0_20px_rgba(112,120,255,0.25)]">
                @foreach ($topLinks as $link)
                    <a href="{{ $link['href'] }}"
                        class="px-4 py-2 text-md font-semibold text-blue-100 hover:text-white hover:bg-white/10 rounded-full">{{ $link['label'] }}</a>
                @endforeach

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

        <div id="site-mobile-menu" class="hidden lg:hidden pb-5">
            <div
                class="max-h-[calc(100vh-6rem)] overflow-y-auto rounded-2xl border border-cyan-300/25 bg-[#091741]/95 p-4 shadow-[0_24px_70px_rgba(0,0,0,0.35)]">
                <div class="grid gap-2 sm:grid-cols-3">
                    @foreach ($topLinks as $link)
                        <a href="{{ $link['href'] }}"
                            class="rounded-xl border border-cyan-300/20 bg-[#12235f]/75 px-4 py-3 text-sm font-semibold text-cyan-100">{{ $link['label'] }}</a>
                    @endforeach
                </div>

                <div class="mt-4 space-y-3">
                    @foreach ($serviceMenus as $menu)
                        <details class="group rounded-2xl border border-cyan-300/20 bg-[#0d1d51]/80">
                            <summary
                                class="flex cursor-pointer list-none items-center justify-between gap-3 px-4 py-3 text-sm font-semibold text-white">
                                <span>{{ $menu['label'] }}</span>
                                <i
                                    class="ri-arrow-down-s-line text-cyan-200 transition-transform group-open:rotate-180"></i>
                            </summary>
                            <div class="border-t border-cyan-300/15 px-3 py-3">
                                <a href="{{ $menu['href'] }}"
                                    class="mb-2 block rounded-xl bg-cyan-400/10 px-3 py-2 text-sm font-semibold text-cyan-100">Overview</a>
                                @foreach ($menu['items'] as $item)
                                    <a href="{{ $item['href'] }}"
                                        class="block rounded-xl px-3 py-2 text-sm text-blue-100/85 hover:bg-white/10 hover:text-white">{{ $item['label'] }}</a>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
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
        var button = document.getElementById('site-mobile-menu-button');
        var menu = document.getElementById('site-mobile-menu');

        if (!button || !menu) {
            return;
        }

        button.addEventListener('click', function() {
            var isHidden = menu.classList.toggle('hidden');
            button.setAttribute('aria-expanded', String(!isHidden));
            var icon = button.querySelector('i');

            if (icon) {
                icon.className = isHidden ? 'ri-menu-line text-xl' : 'ri-close-line text-xl';
            }
        });

        menu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                menu.classList.add('hidden');
                button.setAttribute('aria-expanded', 'false');
                var icon = button.querySelector('i');

                if (icon) {
                    icon.className = 'ri-menu-line text-xl';
                }
            });
        });
    });
</script>
