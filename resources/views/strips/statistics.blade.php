@php
    $live = $live ?? false;
@endphp

@if (! empty($stats)) 
    
<section class="relative
                w-full
                py-12
                lg:py-18">

    <x-container
        class="max-w-6xl"
    >   

        <div 
            class="grid grid-cols-{{ $mobileColumns }} gap-8  
                   py-10 
                   border-t border-b border-white
                   md:py-11.5 md:pr-8.5 md:grid-cols-{{ $columns }} md:gap-14"
        >

        @foreach ($stats as $stat) 

            @if (empty($stat['icon'])) 
                @continue;
            @endif

            @php($image = ($live) ? asset("storage/{$stat['icon']}") : asset('storage/' . array_pop($stat['icon'])))

            <div class="flex flex-col">
                <figure 
                    class="aspect-77/59 mb-4.5
                           flex items-center justify-start"
                >
                    <img class="object-contain" src="{{ $image }}" alt="{{ $stat['label'] }}" />
                </figure>
                <span 
                    class="block 
                           mb-1
                           text-lg font-sans tracking-wide text-black
                           md:text-2xl"
                >
                    {{ $stat['label'] }}
                </span>
                <p 
                    class="block 
                           text-xs font-sans text-black
                           md:text-sm"
                >
                    {!! nl2br($stat['description']) !!}
                </p>
            </div>

        @endforeach

        </div>

    </x-container>

</section>

@endif