@extends('layouts.front')
@section('meta')
    @include('partials.meta', ['pageKey' => 'event'])
@endsection
@push('styles')
    <style>
        .blog-content-area hr {
            display: none !important;
        }

        /* মেইন ব্লগ কন্টেন্ট এরিয়া */
        .blog-content-area {
            line-height: 1.8;
            font-size: 17px;
            color: #333;
            font-family: 'Ubuntu', sans-serif;
        }

        /* হেডিং স্টাইল */
        .blog-content-area h1,
        .blog-content-area h2,
        .blog-content-area h3,
        .blog-content-area h4 {
            color: #111;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .blog-content-area h1 {
            font-size: 2.2rem;
        }

        .blog-content-area h2 {
            font-size: 1.8rem;
            border-left: 5px solid #ce9131;
            padding-left: 15px;
        }

        .blog-content-area h3 {
            font-size: 1.5rem;
        }

        /* প্যারাগ্রাফ */
        .blog-content-area p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        /* লিস্ট (Tailwind এ ডিফল্টভাবে ডট দেখায় না, এটি সেটি ঠিক করবে) */
        .blog-content-area ul {
            list-style-type: disc !important;
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .blog-content-area ol {
            list-style-type: decimal !important;
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .blog-content-area li {
            margin-bottom: 0.5rem;
        }

        /* ইমেজ স্টাইল */
        .blog-content-area img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 2rem auto;
            display: block;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* টেবিল স্টাইল */
        .blog-content-area table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
        }

        .blog-content-area table th,
        .blog-content-area table td {
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
            text-align: left;
        }

        .blog-content-area table th {
            background-color: #f8fafc;
            font-weight: 700;
        }

        /* ব্লককোট (Quotes) */
        .blog-content-area blockquote {
            border-left: 4px solid #ce9131;
            background: #fff9f0;
            padding: 20px;
            font-style: italic;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        /* লিংক স্টাইল */
        .blog-content-area a {
            color: #ce9131;
            text-decoration: underline;
            font-weight: 500;
        }

        .news-item-type {
            text-transform: capitalize;
        }
    </style>
@endpush
@section('content')
    <!-- ===== HERO ===== -->
    <section class="hero-fixed fixed top-0 left-0 w-full overflow-hidden h-[600px] md:h-[700px] lg:h-[900px]">
        <!-- Background Image -->
        <img src="{{ $eventHero->img_path ?? '' }}" alt="interior" class="absolute inset-0 w-full h-full object-cover" />

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Text -->
        <div class="absolute inset-0 flex items-center px-6 sm:px-10 md:px-20">
            <!-- pl-12 কে md:pl-12 pl-0 এবং pt-32 কে md:pt-32 pt-20 করা হয়েছে। ফন্ট সাইজে clamp ব্যবহার করা হয়েছে -->
            <h1 class="text-white font-light md:pl-12 pt-20 md:pt-32 tracking-normal md:tracking-[-3px]"
                style="font-size: clamp(32px, 3.85vw, 74px); line-height: 1.2;">
                Stay informed with<br>
                <span class="font-migra-italic">Bhaiya Housing Ltd.</span>
            </h1>
        </div>

    </section>
    <div class="h-[600px] md:h-[700px] lg:h-[900px] w-full pointer-events-none" style="position: relative; z-index: 2;">
    </div>

    <section class="w-full min-h-screen relative z-10 overflow-hidden py-10 md:py-16" style="background:#FFFDFA;">

        <!-- BG texture -->
        <div class="absolute inset-0 pointer-events-none" style="z-index:0;">
            <img src="{{ asset('assets/images/bg-news.webp') }}" alt="bg news" class="w-1/3 h-full object-cover opacity-50"
                onerror="this.style.display='none';" />
        </div>

        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-14 ">

            <!-- Mobile: horizontal filter row -->
            <div class="flex md:hidden gap-3 justify-center mb-8">
                <button onclick="setFilter('all', this)"
                    class="filter-btn active-filter w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-gray-300 text-xs sm:text-sm font-light tracking-wide transition-all duration-300 flex items-center justify-center">
                    All
                </button>
                <button onclick="setFilter('events', this)"
                    class="filter-btn w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-gray-300 text-xs sm:text-sm font-light tracking-wide transition-all duration-300 flex items-center justify-center">
                    Events
                </button>
                <button onclick="setFilter('news', this)"
                    class="filter-btn w-20 h-20 sm:w-24 sm:h-24 rounded-full border border-gray-300 text-xs sm:text-sm font-light tracking-wide transition-all duration-300 flex items-center justify-center">
                    News
                </button>
            </div>

            <!-- Desktop: side-by-side layout -->
            <div class="flex gap-8 lg:gap-16 items-start">

                <!-- ── Left: Filter Buttons (desktop only) ── -->
                <div class="hidden md:flex flex-col items-center gap-3 pt-8 flex-shrink-0" style="min-width:120px;">
                    <button onclick="setFilter('all', this)"
                        class="filter-btn active-filter w-24 h-24 lg:w-28 lg:h-28 rounded-full border border-gray-300 text-sm font-light tracking-wide transition-all duration-300 flex items-center justify-center"
                        style="margin-bottom:-12px; position:relative; z-index:3;">
                        All
                    </button>
                    <button onclick="setFilter('events', this)"
                        class="filter-btn w-24 h-24 lg:w-28 lg:h-28 rounded-full border border-gray-300 text-sm font-light tracking-wide transition-all duration-300 flex items-center justify-center"
                        style="margin-bottom:-12px; position:relative; z-index:2;">
                        Events
                    </button>
                    <button onclick="setFilter('news', this)"
                        class="filter-btn w-24 h-24 lg:w-28 lg:h-28 rounded-full border border-gray-300 text-sm font-light tracking-wide transition-all duration-300 flex items-center justify-center"
                        style="position:relative; z-index:1;">
                        News
                    </button>
                </div>

                <!-- ── Right: News List ── -->
                <div class="flex-1 pt-0 md:ml-10 lg:ml-28">
                    <div style="border-top:1px solid #c8c0b4;"></div>
                    <div id="newsList"></div>

                    <!-- No results -->
                    <p id="noResults" class="text-center text-gray-400 py-16 hidden">
                        No Data Found
                    </p>
                </div>

            </div>

        </div>

    </section>
    <x-extra-content :data="$content" />
    <div class="cursor-dot" id="cursor-dot"></div>

@endsection
@push('scripts')
    <script>
        (function () {
            const ALL_ITEMS = @json($newsEvents);
            let active = 'all';

            function capitalize(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }

            function render(filter) {
                const list = document.getElementById('newsList');
                const noRes = document.getElementById('noResults');
                const items = filter === 'all' ?
                    ALL_ITEMS :
                    ALL_ITEMS.filter(i => i.type === filter);

                if (!items.length) {
                    list.innerHTML = '';
                    noRes.classList.remove('hidden');
                    return;
                }

                noRes.classList.add('hidden');
                list.innerHTML = items.map(item => {

                    const mySlug = item.name;

                    const finalSlug = mySlug ? mySlug : item.id;

                    const typePath = (item.type === 'events' || item.type === 'event') ? 'event' : 'news';
                    const finalUrl = `/${typePath}/${finalSlug}`;

                    return `
                            <a href="${finalUrl}" class="news-item">
                                <div class="news-item-meta">
                                    <p class="news-item-type">${item.type}</p>
                                    <p class="news-item-date">${item.date || ''}</p>
                                </div>
                                <div class="flex-1">
                                    <h3 class="news-item-title">${item.title}</h3>
                                </div>
                            </a>
                        `;
                }).join('');
            }

            window.setFilter = function (filter, btn) {
                active = filter;

                // Active button style
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active-filter');
                });
                btn.classList.add('active-filter');

                render(filter);
            };

            // Initial render
            render('all');
        })();
    </script>
@endpush
