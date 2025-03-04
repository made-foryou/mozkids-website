@php
    $live = $live ?? false;

    $image = ($live) ? url($image) : url(array_pop($image));
@endphp

<section
    class="relative
           py-12
           bg-secondary
           lg:py-18"
>
    <x-container
        class="max-w-6xl grid md:grid-cols-2"
    >

        <div
            class="py-10
                   text-sm text-black font-sans
                   md:py-15 md:pr-28"
        >
            <span
                class="block
                       mb-4
                       text-xs text-primary font-sans tracking-wide uppercase
                       md:text-sm"
            >
                {{ $subtitle }}
            </span>

            <h2
                class="block
                       mb-9
                       tracking-wide text-lg 
                       md:text-2xl"
                data-highlightable
            >
                {{ $title }}
            </h2>

            <div class="text-xs md:text-sm">
                {!! $content !!}
            </div>

            @if (!empty($buttons))

            <div
                class="mt-8 flex flex-row gap-4"
            >
                @foreach ($buttons as $button)
                    
                    <x-button :color="$button['color']" :href="Cms::url($button['website_link'])">
                        {{ $button['label'] }}
                        <x-slot:icon>
                            @include('svg.arrow-right')
                        </x-slot:icon>
                    </x-button>
                    
                @endforeach
            </div>

            @endif
        </div>
        <figure class="aspect-134/125">
            <img src="{{ $image }}" alt="test" />
        </figure>

    </x-container>

</section>

