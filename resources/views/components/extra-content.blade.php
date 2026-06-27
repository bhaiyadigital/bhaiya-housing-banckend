@props(['data'])
<style>
    .blog-content-area {
        line-height: 1.8;
        font-size: 17px;
        color: #333;
    }

    /* --- আপনার আগের ডিজাইনগুলো অপরিবর্তিত রাখা হয়েছে --- */
    .blog-content-area h2 {
        font-size: 1.8rem;
        font-weight: 700;
        border-left: 5px solid #ce9131;
        padding-left: 15px;
        margin: 2.5rem 0 1.2rem;
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
        margin: 2.5rem auto;
        display: block;
    }

    /* --- নতুন প্রয়োজনীয় ডিজাইনগুলো নিচে যোগ করা হয়েছে --- */

    /* New Heading 3 Style (Sub-headings) */
    .blog-content-area h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 2rem 0 1rem;
        color: #041533;
        display: flex;
        align-items: center;
    }
    /* H3 এর পাশে একটি হালকা বর্ডার যা ডিজাইনকে মডার্ন করবে */
    .blog-content-area h3::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #eee;
        margin-left: 20px;
    }

    /* New Heading 4 Style (Minor sections) */
    .blog-content-area h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #66267b; /* ব্র্যান্ড পার্পল কালার */
        margin: 1.5rem 0 0.8rem;
    }

    /* Blockquote Style (হাইলাইটেড টেক্সট বা কোট এর জন্য) */
    .blog-content-area blockquote {
        background: #fdf8f1;
        border-left: 5px solid #ce9131;
        padding: 1.5rem 2rem;
        margin: 2rem 0;
        font-style: italic;
        font-size: 1.1rem;
        color: #555;
        border-radius: 0 12px 12px 0;
    }

    /* Links Style (ব্লগের ভেতরের লিঙ্কের জন্য) */
    .blog-content-area a {
        color: #ce9131;
        text-decoration: underline;
        font-weight: 600;
        transition: 0.3s;
    }
    .blog-content-area a:hover {
        color: #66267b;
    }

    /* Ordered List (1, 2, 3 স্টাইল লিস্ট) */
    .blog-content-area ol {
        list-style-type: decimal !important;
        margin-left: 2rem;
        margin-bottom: 1.5rem;
    }

    /* Table Style (যদি ব্লগে কোনো তথ্য বা তুলনা থাকে) */
    .blog-content-area table {
        width: 100%;
        border-collapse: collapse;
        margin: 2rem 0;
        background: white;
    }
    .blog-content-area th, .blog-content-area td {
        border: 1px solid #eee;
        padding: 12px 15px;
        text-align: left;
    }
    .blog-content-area th {
        background-color: #f9f9f9;
        font-weight: 700;
        color: #041533;
    }

    /* Bold Text */
    .blog-content-area strong, .blog-content-area b {
        font-weight: 700;
        color: #111;
    }
     .blog-content-area h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 2rem 0 1rem;
        color: #041533;
    }

    /* Small headings or purple accent */
    .blog-content-area h4 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #66267b; /* ব্র্যান্ড পার্পল */
        margin: 1.5rem 0 0.8rem;
    }

    /* Blockquote (উক্তি বা হাইলাইট করা টেক্সট) */
    .blog-content-area blockquote {
        background: #fdf8f1;
        border-left: 5px solid #ce9131;
        padding: 1.2rem 2rem;
        margin: 2rem 0;
        font-style: italic;
        color: #555;
        border-radius: 0 10px 10px 0;
    }

    /* Links (ব্লগের ভেতরের লিঙ্ক) */
    .blog-content-area a {
        color: #ce9131;
        text-decoration: underline;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .blog-content-area a:hover {
        color: #66267b;
    }

    /* Ordered List (১, ২, ৩ স্টাইল লিস্ট) */
    .blog-content-area ol {
        list-style-type: decimal !important;
        margin-left: 2rem;
        margin-bottom: 1.5rem;
    }

    /* Table (তথ্যের টেবিল) */
    .blog-content-area table {
        width: 100%;
        border-collapse: collapse;
        margin: 2rem 0;
    }

    .blog-content-area th, .blog-content-area td {
        border: 1px solid #eee;
        padding: 10px 15px;
        text-align: left;
    }

    .blog-content-area th {
        background: #f9f9f9;
        font-weight: 700;
    }

    /* Bold emphasis */
    .blog-content-area strong {
        font-weight: 800;
        color: #111;
    }
</style>

@if ($data)
    <section class="w-full relative z-20 py-12 md:py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4 ">

            @for ($i = 1; $i <= 4; $i++)
                @php
                    $field = $i === 1 ? 'body' : "body_$i";
                @endphp

                @if (!empty($data->$field))
                    <div class="blog-content-area mb-8">
                        {!! $data->$field !!}
                    </div>
                @endif
            @endfor

        </div>
    </section>
@endif
