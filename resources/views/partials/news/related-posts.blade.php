@props([
    'posts' => collect([]),
])

@if ($posts->isNotEmpty())

<section class="related-posts relative w-full
                pt-8 pb-8
                lg:pt-12 lg:pb-12">

    <span class="related-posts__divider
                 pointer-events-none absolute top-0 left-0 right-0
                 h-px
                 bg-gradient-to-r from-transparent via-secondary-900/12 to-transparent"
          aria-hidden="true"></span>

    <x-container class="max-w-6xl relative">

        <header class="related-posts__header
                       max-w-2xl mx-auto text-center
                       mb-10 lg:mb-14"
                data-reveal="fade-up"
                style="--reveal-delay: 0ms">

            <span class="related-posts__eyebrow
                         inline-flex items-center gap-2
                         mb-4
                         text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                         text-primary-500">
                <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                      aria-hidden="true"></span>
                <span>Meer lezen</span>
                <span class="ml-1 inline-block w-6 h-px
                             bg-gradient-to-r from-primary-500/40 to-transparent"
                      aria-hidden="true"></span>
            </span>

            <h2 class="related-posts__title
                       text-2xl md:text-3xl
                       text-secondary-900 font-semibold
                       tracking-[-0.018em] leading-[1.15] text-balance">
                Gerelateerde nieuwsberichten
            </h2>
        </header>

        <div class="related-posts__grid
                    grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3
                    gap-6 lg:gap-7
                    items-stretch">

            @foreach ($posts as $index => $post)
                <div class="h-full"
                     data-reveal="fade-up"
                     style="--reveal-delay: {{ 80 + ($index * 90) }}ms">
                    <x-news.overview-item :post="$post" />
                </div>
            @endforeach
        </div>

        <div class="related-posts__back
                    mt-10 lg:mt-14
                    flex justify-center"
             data-reveal="fade-up"
             style="--reveal-delay: {{ 80 + ($posts->count() * 90) + 60 }}ms">

            <a href="{{ Cms::url($newsPage) }}"
               class="related-posts__back-link group/back
                      relative inline-flex items-center gap-2.5
                      pl-4 pr-5 py-3 rounded-full
                      bg-transparent text-secondary-900
                      ring-1 ring-secondary-900/12
                      text-[11px] font-semibold tracking-[0.1em] uppercase
                      transition-[background-color,color,box-shadow,transform,ring-color] duration-300 ease-out
                      hover:-translate-y-0.5
                      hover:bg-primary-500 hover:text-white hover:ring-primary-500
                      hover:shadow-[0_14px_28px_-10px_rgba(228,35,19,0.5)]
                      focus-visible:outline-2 focus-visible:outline-offset-2
                      focus-visible:outline-primary-500">
                <span class="inline-flex
                             transition-transform duration-300 ease-out
                             group-hover/back:-translate-x-1"
                      aria-hidden="true">
                    @include('svg.arrow-right', ['rotate' => true])
                </span>
                <span>Terug naar het nieuwsoverzicht</span>
            </a>
        </div>

    </x-container>
</section>

@endif
