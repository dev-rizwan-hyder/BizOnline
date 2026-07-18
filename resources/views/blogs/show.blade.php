@extends('layouts.app')

@section('content')
<section class="relative min-h-[92vh] max-w-8xl overflow-hidden pt-36 pb-20">
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6">
        <!-- Back Button -->
        <a href="{{ route('blogs.index') }}" class="inline-flex items-center gap-2 text-cyan-300 hover:text-white font-semibold mb-8 group transition-colors">
            <i class="ri-arrow-left-line transition-transform group-hover:-translate-x-1"></i>
            Back to Blog
        </a>

        <!-- Article Container -->
        <article class="rounded-2xl border border-cyan-300/25 bg-[#0d1d51]/75 shadow-[0_0_30px_rgba(90,118,255,0.2)] overflow-hidden">
            <!-- Hero Image -->
            @if($blog->image)
                <div class="w-full h-[350px] md:h-[450px] relative bg-slate-900">
                    <img src="{{ asset('blog/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0d1d51] via-transparent to-transparent"></div>
                </div>
            @endif

            <!-- Article Details -->
            <div class="p-6 md:p-10">
                <!-- Metadata -->
                <div class="flex items-center gap-4 text-xs text-blue-200/70 mb-6">
                    <span class="flex items-center gap-1.5 bg-[#0a1847]/80 border border-cyan-300/30 px-3 py-1 rounded-full font-semibold uppercase tracking-wider text-cyan-200">
                        <i class="ri-calendar-line"></i>
                        {{ $blog->created_at->format('M d, Y') }}
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="ri-time-line"></i>
                        @php
                            $wordCount = str_word_count(strip_tags($blog->content));
                            $readTime = ceil($wordCount / 200); // Average 200 words per minute
                        @endphp
                        {{ $readTime }} min read
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                    {{ $blog->title }}
                </h1>

                <!-- Summary (if present) -->
                @if($blog->summary)
                    <div class="border-l-4 border-cyan-300/60 pl-4 py-1.5 my-6 bg-[#0a1847]/40 rounded-r-lg">
                        <p class="text-blue-100/90 text-base md:text-lg italic leading-relaxed">
                            {{ $blog->summary }}
                        </p>
                    </div>
                @endif

                <!-- Divider -->
                <div class="h-px bg-cyan-300/20 my-8"></div>

                <!-- Main Content -->
                <div class="blog-content text-blue-100/90 text-base md:text-lg leading-relaxed space-y-6">
                    {!! nl2br($blog->content) !!}
                </div>
            </div>
        </article>
    </div>
</section>

<!-- Simple style tweaks for styling content if it contains basic tags -->
<style>
    .blog-content p {
        margin-bottom: 1.5rem;
    }
    .blog-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #ffffff;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .blog-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #ffffff;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .blog-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .blog-content ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .blog-content li {
        margin-bottom: 0.5rem;
    }
    .blog-content strong {
        color: #ffffff;
        font-weight: 600;
    }
    .blog-content a {
        color: #55d6ff;
        text-decoration: underline;
    }
    .blog-content a:hover {
        color: #ffffff;
    }
</style>
@endsection
