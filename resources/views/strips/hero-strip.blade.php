@php
    $live = $live ?? false;
@endphp

@if ($live === false)
    <style>
        {!! \Illuminate\Support\Facades\Vite::content('resources/css/app.css') !!}
    </style>
@endif

<section
    class="relative
           py-12
           lg:py-18
           @if (!$live) overflow-hidden bg-secondary @endif"
>
    <x-container class="flex flex-col justify-center items-center max-w-[730px]">

        <div
            class="font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
        >
            {!! $content !!}
        </div>

        @if (!empty($buttons))

        <div
            class="mt-8 flex flex-row gap-4"
        >
            @foreach ($buttons as $button)
                @if ($live)
                <x-button :color="$button['color']" :href="Cms::url($button['website_link'])">
                    {{ $button['label'] }}
                    <x-slot:icon>
                        @include('svg.arrow-right')
                    </x-slot:icon>
                </x-button>
                @else
                <x-button :color="$button['color']">
                    {{ $button['label'] }}
                    <x-slot:icon>
                        @include('svg.arrow-right')
                    </x-slot:icon>
                </x-button>
                @endif
            @endforeach
        </div>

        @endif

    </x-container>
</section>
