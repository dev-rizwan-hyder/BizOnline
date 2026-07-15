<footer class="relative w-full overflow-hidden text-white">
    <div class="absolute inset-0 bg-[linear-gradient(180deg,#030b27_0%,#06123a_52%,#030d2f_100%)]"></div>
    <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_15%_20%,rgba(73,178,255,0.12),transparent_34%),radial-gradient(circle_at_88%_16%,rgba(169,109,255,0.16),transparent_34%)]">
    </div>
    <div class="relative w-full border-t border-indigo-300/25">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-9">
            <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr_0.8fr_1fr] gap-8 items-start">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="min-w-0 flex items-center">
                            <img src="bizlogo.png" alt="Biz Online Logo"
                                class="h-20 sm:h-20 md:h-24 lg:h-28 w-auto object-contain">
                        </div>
                    </div>
                    <p class="text-blue-100/72 text-sm leading-relaxed max-w-sm mb-5">We help ambitious businesses build
                        a powerful online presence, attract the right audience and achieve measurable growth through
                        innovative digital solutions.</p>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-blue-100/80">
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-300/30 bg-[#12235f]/70"><i
                                class="ri-mail-line"></i>info@biztechsolutions.com</span>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-300/30 bg-[#12235f]/70"><i
                                class="ri-phone-line"></i>+1 (555) 123-4567</span>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Services</h4>
                    <ul class="space-y-2.5 text-sm text-blue-100/80">
                        <li><a href="{{ route('services.show', 'business-websites') }}"
                                class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Website Development</a></li>
                        <li><a href="{{ route('services.show', 'seo') }}"
                                class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Digital Marketing</a></li>
                        <li><a href="{{ route('logo.design') }}"
                                class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Branding & Design</a></li>
                        <li><a href="{{ route('services.show', 'graphic-creative') }}"
                                class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Content Creation</a></li>
                        <li><a href="{{ route('services.show', 'erp-systems') }}"
                                class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Business Solutions</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2.5 text-sm text-blue-100/80">
                        <li><a href="{{ url('/') }}" class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>About Us</a></li>
                        <li><a href="{{ route('work') }}" class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Portfolio</a></li>
                        <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Careers</a></li>
                        <li><a href="#" class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Blog</a></li>
                        <li><a href="{{ route('contact.show') }}"
                                class="inline-flex items-center gap-2 hover:text-white"><i
                                    class="ri-arrow-right-s-line text-cyan-300"></i>Contact</a></li>
                    </ul>
                </div>

                <div
                    class="rounded-2xl border border-indigo-300/30 bg-[#0e1a4d]/70 p-5 shadow-[0_0_20px_rgba(118,121,255,0.25)]">
                    <h4 class="text-white font-semibold mb-3">Newsletter</h4>
                    <p class="text-blue-100/70 text-sm mb-4">Subscribe for expert insights, digital marketing tips and
                        exclusive updates.</p>
                    <div class="flex gap-2">
                        <input type="email" placeholder="Your email address"
                            class="flex-1 px-3 py-2 rounded-lg border border-indigo-300/30 bg-[#11245d]/70 text-blue-50 text-sm focus:ring-2 focus:ring-cyan-300/50 focus:border-cyan-300/50">
                        <button
                            class="px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500 text-white text-sm font-medium whitespace-nowrap">Subscribe</button>
                    </div>
                </div>
            </div>

            <div
                class="mt-8 pt-5 border-t border-indigo-300/20 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-blue-100/75">Follow us</div>
                <div class="flex items-center gap-3">
                    <a href="#"
                        class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i
                            class="ri-facebook-fill text-xs"></i></a>
                    <a href="#"
                        class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i
                            class="ri-instagram-line text-xs"></i></a>
                    <a href="#"
                        class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i
                            class="ri-linkedin-fill text-xs"></i></a>
                    <a href="#"
                        class="w-8 h-8 rounded-full border border-indigo-300/35 bg-[#142663]/70 flex items-center justify-center text-blue-100 hover:text-white"><i
                            class="ri-twitter-x-fill text-xs"></i></a>
                </div>
                <div class="text-xs text-blue-100/55">&nbsp;</div>
            </div>
        </div>

        <div class="border-t border-indigo-300/20">
            <div
                class="max-w-7xl mx-auto px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between text-xs text-blue-100/60">
                <p>© 2024 Bizz Online. All rights reserved.</p>
                <div class="flex items-center gap-5 mt-2 sm:mt-0">
                    <a href="#" class="hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>
