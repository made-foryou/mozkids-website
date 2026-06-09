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
                    @php
                        $variant = $button['color'] ?? 'primary';
                        $baseClasses = 'hero-cta group relative inline-flex items-center gap-2.5
                                        pl-5 pr-5 py-3 rounded-full
                                        text-[12px] font-semibold tracking-[0.08em] uppercase
                                        overflow-hidden
                                        transition-[transform,box-shadow,background-color,color] duration-300 ease-out
                                        hover:-translate-y-0.5
                                        focus-visible:outline-2 focus-visible:outline-offset-2
                                        focus-visible:outline-primary-500';
                        $variantClasses = match ($variant) {
                            'secondary' => 'hero-cta--ghost bg-transparent text-primary-500 ring-1 ring-primary-500/40
                                            hover:bg-primary-500 hover:text-white hover:ring-primary-500
                                            hover:shadow-[0_12px_28px_-8px_rgba(228,35,19,0.55)]',
                            'white' => 'hero-cta--white bg-white text-primary-500 ring-1 ring-secondary-900/5
                                        hover:bg-primary-500 hover:text-white
                                        hover:shadow-[0_12px_28px_-8px_rgba(228,35,19,0.55)]',
                            default => 'hero-cta--primary bg-primary-500 text-white
                                        hover:bg-primary-500
                                        hover:shadow-[0_12px_28px_-8px_rgba(228,35,19,0.55)]',
                        };
                    @endphp

                    <a
                        href="{{ Cms::url($button['website_link']) }}"
                        class="hero-button {{ $baseClasses }} {{ $variantClasses }}"
                        style="--hero-button-delay: {{ 600 + ($loop->index * 80) }}ms"
                    >
                        <span class="hero-cta__sheen absolute inset-0
                                     bg-gradient-to-r from-transparent via-white/25 to-transparent
                                     -translate-x-full
                                     transition-transform duration-700 ease-out
                                     group-hover:translate-x-full"></span>

                        <span class="relative">{{ $button['label'] }}</span>

                        <span class="hero-cta__arrow relative inline-flex translate-x-0
                                     transition-transform duration-300 ease-out
                                     group-hover:translate-x-1"
                              aria-hidden="true">
                            @include('svg.arrow-right')
                        </span>
                    </a>
                @endforeach
            </div>
        @endif

    </x-container>
</section>
