<section
    class="relative
           py-12
           lg:py-18"
>
    <x-container class="flex flex-col justify-center items-center max-w-[730px]">

        @if ($heading)
            @switch($heading_number)
                @case('1')
                <h1
                    class="block font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
                    data-highlightable
                >
                    {{ $content }}
                </h1>
                @break
                @case('2')
                <h2
                    class="block font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
                    data-highlightable
                >
                    {{ $content }}
                </h2>
                @break
                @case('3')
                <h3
                    class="block font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
                    data-highlightable
                >
                    {{ $content }}
                </h3>
                @break
                @case('4')
                <h4
                    class="block font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
                    data-highlightable
                >
                    {{ $content }}
                </h4>
                @break
                @case('5')
                <h5
                    class="block font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
                    data-highlightable
                >
                    {{ $content }}
                </h5>
                @break
                @case('6')
                <h6
                    class="block font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
                    data-highlightable
                >
                    {{ $content }}
                </h6>
                @break
            @endswitch
        @else
        <span
            class="block
                   font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
            data-highlightable
        >
            {{ $content }}
        </span>
        @endif

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
