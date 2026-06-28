@props(['data'])


@if ($data)
    <section class="w-full relative z-20 py-12 md:py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4 ">

            @for ($i = 1; $i <= 4; $i++)
                @php
                    $field = $i === 1 ? 'body' : "body_$i";
                @endphp

                @if (!empty($data->$field))
                    <div class="blog-content-area prose prose-slate max-w-none mb-12">
                        {!! $data->$field !!}
                    </div>
                @endif
            @endfor

        </div>
    </section>
@endif
