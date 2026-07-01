@props(['data'])

@if ($data)
    @php
        $isAdmin = auth()->check();
        $extra = is_array($data->extra) ? $data->extra : (json_decode($data->extra, true) ?? []);
    @endphp

    <section class="w-full relative z-20 py-10 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col gap-6">

                @for ($i = 1; $i <= 4; $i++)
                    @php
                        $field = $i === 1 ? 'body' : "body_$i";
                        $content = $data->$field;

                        $titleKey = "title_$field";
                        $statusKey = "status_$field";

                        $sectionTitle = $extra[$titleKey] ?? "Read More Details";
                        $sectionStatus = $extra[$statusKey] ?? '1';

                        $hasContent = !empty(trim(strip_tags($content)));

                        $canSee = $hasContent && ($sectionStatus == '1' || $isAdmin);
                    @endphp

                    @if ($canSee)
                        <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm transition-all duration-300">
                            <details class="group {{ ($isAdmin && $sectionStatus == '0') ? 'border-2 border-dashed border-red-300 bg-red-50' : '' }}">

                                <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer list-none select-none bg-white hover:bg-gray-50 transition-colors">
                                    <div class="flex flex-col items-start">
                                        @if($isAdmin && $sectionStatus == '0')
                                            <div class="text-xs text-red-500 font-semibold mb-1 uppercase tracking-widest"></div>
                                        @endif

                                        <span class="text-gray-900 font-semibold text-lg md:text-2xl tracking-tight">
                                            {{ $sectionTitle }}
                                        </span>
                                    </div>

                                    <span class="text-gray-400 transition-transform duration-500 group-open:rotate-180">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </summary>

                                <div class="p-6 md:p-10 border-t border-gray-100 bg-white">
                                    <div class="blog-content-area prose prose-slate max-w-none text-gray-700">
                                        {!! $content !!}
                                    </div>
                                </div>
                            </details>
                        </div>
                    @endif
                @endfor

            </div>
        </div>
    </section>

    <style>
        details summary::-webkit-details-marker { display: none; }
        details summary { list-style: none; outline: none; }

        details[open] summary ~ * {
            animation: slideDown 0.4s ease-out;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endif
