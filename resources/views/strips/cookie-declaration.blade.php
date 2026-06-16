@php
    $subtitle = $subtitle ?? null;
    $title = $title ?? null;
    $url = $url ?? null;
@endphp

<section class="text-strip relative
                w-full
                pt-3 pb-8
                lg:pt-4 lg:pb-12
                [&:first-child]:pt-12 lg:[&:first-child]:pt-16">

    <x-container class="max-w-6xl">

        @if (!empty($subtitle))
            <span class="text-strip__eyebrow
                         inline-flex items-center gap-2
                         mb-4
                         text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                         text-primary-500"
                  data-reveal="fade-up"
                  style="--reveal-delay: 0ms">
                <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                      aria-hidden="true"></span>
                <span>{{ $subtitle }}</span>
                <span class="ml-1 inline-block w-6 h-px
                             bg-gradient-to-r from-primary-500/40 to-transparent"
                      aria-hidden="true"></span>
            </span>
        @endif

        @if (!empty($title))
            <h1 class="text-strip__title
                       block mb-6
                       text-3xl lg:text-4xl
                       text-secondary-900 font-semibold
                       tracking-[-0.018em] leading-[1.15]
                       text-balance"
                data-reveal="fade-up"
                style="--reveal-delay: {{ !empty($subtitle) ? 120 : 0 }}ms">
                {{ $title }}
            </h1>
        @endif

        @if (!empty($url))
            <div class="prose max-w-none text-strip__prose
                        text-secondary-900/82
                        [&>p:first-child]:mt-0"
                 data-reveal="fade-up"
                 style="--reveal-delay: {{ !empty($title) ? 240 : 0 }}ms">
                <script id="CookieDeclaration" src="{{ $url }}" data-culture="NL" type="text/javascript" async></script>
            </div>
        @endif

    </x-container>
</section>
