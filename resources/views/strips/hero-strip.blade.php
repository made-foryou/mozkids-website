<section
    class="relative
           py-12
           lg:py-18"
>
    <x-container class="flex flex-col justify-center items-center max-w-[730px]">

        <span
            class="block
                   font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
            data-highlightable
        >
            {{ $content }}
        </span>

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

    </x-container>
</section>
