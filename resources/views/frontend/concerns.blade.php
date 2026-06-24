 @extends('layouts.front')
 @section('meta')
    @include('partials.meta', ['pageKey' => 'concern'])
@endsection
 @section('content')

 {{-- ===== HERO ===== --}}
<section class="fixed hero-fixed top-0 left-0 w-full z-0 overflow-hidden h-[600px] md:h-[700px] lg:h-[900px]">
    <img src="{{ $concernHero?->img_path ?? asset('images/event.webp') }}"
        alt="interior" class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="absolute inset-0 flex items-center px-6 sm:px-10 md:px-20">
        <!-- pl-12 কে md:pl-12 pl-0 এবং pt-32 কে md:pt-32 pt-20 করা হয়েছে। ফন্ট সাইজে clamp ব্যবহার করা হয়েছে -->
        <h2 class="text-white font-light md:pl-12 pt-20 md:pt-32 tracking-normal md:tracking-[-3px]"
            style="font-size: clamp(32px, 3.85vw, 74px); line-height: 1.2;">
             Expanding Excellence<br><span class="font-migra-italic">Our Other Ventures</span>
        </h2>
    </div>

</section>
<div class="h-[600px] md:h-[700px] lg:h-[900px] w-full pointer-events-none"></div>

 {{-- ===== MAIN SECTION ===== --}}
 <section class="w-full relative z-10 py-10 md:py-16" style="background:#fff;">

     <div class="mx-auto px-4 sm:px-6 lg:px-14">

         <!-- Two column text -->
         <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10 mb-12 md:mb-16" style="font-size:16px;font-weight:400;letter-spacing:1px;color:#000">
             <p class=" prose prose-sm max-w-none   pl-10">
                 {{ $concern?->short ?? '' }}
             </p>
             <div class=" prose prose-sm max-w-none">
                 {!! $concern?->body ?? '' !!}
             </div>
         </div>

     </div>

     <!-- Logo Grid -->
     @if(count($rows) > 0)
     <div class="w-full" style="border-top:1px solid #d8d0c8;">

         {{-- ── Desktop: original row/col grid ── --}}
         <div class="hidden md:block">
             @foreach($rows as $rowIndex => $row)
             <div class="flex {{ $rowIndex > 0 ? 'border-t border-[#d8d0c8]' : '' }}">

                 @foreach($row as $colIndex => $logo)
                 <div class="logo-cell flex-1 flex items-center justify-center p-8 lg:p-10 group cursor-pointer transition-all duration-300 hover:bg-white"
                     style="{{ $colIndex < count($row) - 1 ? 'border-right:1px solid #d8d0c8;' : '' }} min-height:200px;">
                     <img src="{{ asset($logo->img_path) ?? ''}}"
                         alt="{{ $logo->title ?? 'Brand' }}"
                         class="w-auto object-contain grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300"
                         onerror="this.style.display='none';" />
                 </div>
                 @endforeach

                 @php
                 $expectedCount = ($rowIndex % 2 === 0) ? 5 : 4;
                 $emptyCount = $expectedCount - count($row);
                 @endphp
                 @if($emptyCount > 0)
                 @for($e = 0; $e < $emptyCount; $e++)
                     <div class="flex-1"
                     style="min-height:140px; {{ $rowIndex < count($rows) - 1 ? 'border-left:1px solid #d8d0c8;' : '' }}">
             </div>
             @endfor
             @endif

         </div>
         @endforeach
     </div>

     {{-- ── Mobile: flat 2-column grid ── --}}
     <div class="grid grid-cols-2 sm:grid-cols-3 md:hidden">
         @foreach($rows as $row)
         @foreach($row as $logo)
         <div class="flex items-center justify-center p-6 border-b border-r border-[#d8d0c8] group cursor-pointer transition-all duration-300 hover:bg-white"
             style="min-height:110px;">
             <img src="{{ asset($logo->img_path) ?? ''}}"
                 alt="{{ $logo->title ?? 'Brand' }}"
                 class="max-h-12 w-auto object-contain grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300"
                 onerror="this.style.display='none';" />
         </div>
         @endforeach
         @endforeach
     </div>

     </div>
     @endif

 </section>



 @endsection
