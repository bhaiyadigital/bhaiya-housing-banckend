@props(['data'])
<style>
    .blog-content-area {
        line-height: 1.8;
        font-size: 17px;
        color: #333;
    }

    .blog-content-area h2 {
        font-size: 1.8rem;
        font-weight: 700;
        border-left: 5px solid #ce9131;
        padding-left: 15px;
        margin: 2rem 0 1rem;
    }

    .blog-content-area p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    .blog-content-area ul {
        list-style-type: disc !important;
        margin-left: 2rem;
        margin-bottom: 1.5rem;
    }

    .blog-content-area img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 2rem auto;
        display: block;
    }
</style>
@if ($data)
    <section class="w-full relative z-20 py-12 md:py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto">

            @for ($i = 1; $i <= 4; $i++)
                @php
                    $field = $i === 1 ? 'body' : "body_$i";
                @endphp

                @if (!empty($data->$field))
                    <div class="blog-content-area">
                        {!! $data->$field !!}
                    </div>
                @endif
            @endfor

        </div>
    </section>
@endif
