@extends('layouts.app')

@section('content')
<section class="relative min-h-[92vh] max-w-8xl overflow-hidden pt-36 pb-20">
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-cyan-300/35 bg-[#0e235f]/75 text-[11px] font-semibold tracking-[0.18em] uppercase text-cyan-100 mb-5">
                <span class="w-2 h-2 rounded-full bg-cyan-300 shadow-[0_0_10px_rgba(85,214,255,0.9)]"></span>
                Insightful Articles
            </p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-indigo-500 to-fuchsia-500">Blog</span></h1>
            <p class="text-blue-100/90 text-lg max-w-3xl mx-auto">Explore latest trends, tutorials, and business growth strategies curated by our experts.</p>
            <div class="mt-5 flex items-center justify-center gap-3">
                <span class="w-20 h-px bg-gradient-to-r from-transparent via-cyan-300/70 to-transparent"></span>
                <span class="w-2 h-2 rounded-full bg-cyan-300 shadow-[0_0_10px_rgba(85,214,255,0.9)]"></span>
                <span class="w-20 h-px bg-gradient-to-r from-transparent via-indigo-300/70 to-transparent"></span>
            </div>
        </div>

        <!-- Blog Grid -->
        @if($blogs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($blogs as $blog)
                    <article class="hover-glow-card flex flex-col justify-between rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 overflow-hidden shadow-[0_0_24px_rgba(90,118,255,0.15)] transition-all">
                        <div>
                            <!-- Blog Image -->
                            <div class="h-52 w-full overflow-hidden relative bg-slate-900 flex items-center justify-center">
                                @if($blog->image)
                                    <img src="{{ asset('blog/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                @else
                                    <div class="flex flex-col items-center justify-center text-cyan-300/50">
                                        <i class="ri-article-line text-5xl"></i>
                                        <span class="text-xs mt-2">No Image Preview</span>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4 bg-[#0a1847]/80 backdrop-blur-md border border-cyan-300/30 px-3 py-1 rounded-full text-[10px] text-cyan-200 font-semibold uppercase tracking-wider">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </div>
                            </div>

                            <!-- Blog Body -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-3 hover:text-cyan-300 transition-colors">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>
                                <p class="text-blue-100/80 text-sm leading-relaxed mb-4 line-clamp-3">
                                    {{ $blog->summary ?: Str::limit(strip_tags($blog->content), 120) }}
                                </p>
                            </div>
                        </div>

                        <!-- Read More Link -->
                        <div class="px-6 pb-6 pt-2 border-t border-cyan-300/10">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="inline-flex items-center gap-2 text-cyan-300 hover:text-white text-sm font-semibold group">
                                Read Full Article 
                                <i class="ri-arrow-right-line transition-transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <div class="bg-[#0a1847]/80 backdrop-blur-md border border-cyan-300/25 p-2 rounded-xl text-white">
                    {{ $blogs->links() }}
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 rounded-2xl border border-cyan-300/20 bg-[#0d1d51]/50 shadow-[0_0_24px_rgba(90,118,255,0.1)]">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full border border-cyan-300/30 bg-[#132862]/75 flex items-center justify-center">
                    <i class="ri-article-line text-4xl text-cyan-300/60"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">No Articles Found</h3>
                <p class="text-blue-100/70 text-sm max-w-md mx-auto">We haven't published any articles yet. Check back soon for exciting updates and tech insights!</p>
            </div>
        @endif
    </div>
</section>
@endsection
