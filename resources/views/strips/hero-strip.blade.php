@php
    $headingClasses = 'hero-heading block w-full
                       font-sans tracking-[-0.015em] text-secondary-900 font-semibold
                       text-3xl lg:text-5xl leading-[1.1]
                       text-center text-balance';
@endphp

<section class="hero relative
                py-16 lg:py-24">

    <x-container class="relative flex flex-col justify-center items-center max-w-[760px]">

        <span class="hero-eyebrow
                     inline-flex items-center gap-2
                     mb-6
                     text-[10px] font-semibold uppercase tracking-[0.24em]
                     text-secondary-800/55"
              aria-hidden="true">
            <span class="hero-eyebrow__dot
                         inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"></span>
            <span>Moz Kids</span>
            <span class="hero-eyebrow__line
                         inline-block w-6 h-px
                         bg-gradient-to-r from-secondary-900/25 to-transparent"></span>
        </span>

        @if ($heading)
            @switch($heading_number)
                @case('1')
                <h1 class="{{ $headingClasses }}" data-highlightable>{{ $content }}</h1>
                @break
                @case('2')
                <h2 class="{{ $headingClasses }}" data-highlightable>{{ $content }}</h2>
                @break
                @case('3')
                <h3 class="{{ $headingClasses }}" data-highlightable>{{ $content }}</h3>
                @break
                @case('4')
                <h4 class="{{ $headingClasses }}" data-highlightable>{{ $content }}</h4>
                @break
                @case('5')
                <h5 class="{{ $headingClasses }}" data-highlightable>{{ $content }}</h5>
                @break
                @case('6')
                <h6 class="{{ $headingClasses }}" data-highlightable>{{ $content }}</h6>
                @break
            @endswitch
        @else
            <span class="{{ $headingClasses }}" data-highlightable>{{ $content }}</span>
        @endif

        @if (!empty($buttons))
            <div class="hero-buttons
                        mt-10 flex flex-row flex-wrap justify-center gap-3">
                @foreach ($buttons as $button)
                    <x-cta
                        :color="$button['color']"
                        :href="Cms::url($button['website_link'])"
                        class="hero-button"
                        style="--hero-button-delay: {{ 600 + ($loop->index * 80) }}ms"
                    >
                        {{ $button['label'] }}
                    </x-cta>
                @endforeach
            </div>
        @endif

    </x-container>
</section>
