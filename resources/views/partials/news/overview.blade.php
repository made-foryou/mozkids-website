@props([
    'paddingTop' => true,
    'paddingBottom' => true,
    'posts' => collect([]),
])

<section
    class="news-overview relative w-full
           @if ($paddingTop && $paddingBottom)
           py-8 lg:py-12
           @elseif ($paddingTop)
           pt-8 lg:pt-12
           @elseif ($paddingBottom)
           pb-8 lg:pb-12
           @endif"
>
    <x-container class="max-w-6xl">

        @if ($posts->isNotEmpty())
            <div class="news-overview__grid
                        grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3
                        gap-6 lg:gap-7
                        items-stretch">

                @foreach ($posts as $index => $post)
                    <div class="h-full"
                         data-reveal="fade-up"
                         style="--reveal-delay: {{ 60 + ($index * 80) }}ms">
                        <x-news.overview-item :post="$post" />
                    </div>
                @endforeach
            </div>

            @if ($posts->lastPage() > 1)
                <nav class="news-overview__pagination
                            mt-10 lg:mt-14
                            flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-4"
                     aria-label="Berichten paginatie"
                     data-reveal="fade-up"
                     style="--reveal-delay: {{ 60 + ($posts->count() * 80) + 40 }}ms">

                    @if ($posts->currentPage() > 1)
                        <a href="?page={{ $posts->currentPage() - 1 }}"
                           class="news-pager group/pager
                                  relative inline-flex items-center gap-2.5
                                  pl-4 pr-5 py-2.5 rounded-full
                                  bg-transparent text-secondary-900
                                  ring-1 ring-secondary-900/12
                                  text-[11px] font-semibold tracking-[0.1em] uppercase
                                  transition-[background-color,color,box-shadow,transform,ring-color] duration-300 ease-out
                                  hover:-translate-y-0.5
                                  hover:bg-primary-500 hover:text-white hover:ring-primary-500
                                  hover:shadow-[0_12px_24px_-10px_rgba(228,35,19,0.5)]
                                  focus-visible:outline-2 focus-visible:outline-offset-2
                                  focus-visible:outline-primary-500"
                           rel="prev">
                            <span class="inline-flex
                                         transition-transform duration-300 ease-out
                                         group-hover/pager:-translate-x-1"
                                  aria-hidden="true">
                                @include('svg.arrow-right', ['rotate' => true])
                            </span>
                            <span>Nieuwere berichten</span>
                        </a>
                    @else
                        <span></span>
                    @endif

                    <span class="news-overview__count
                                 text-[11px] font-semibold uppercase tracking-[0.18em]
                                 text-secondary-900/55
                                 tabular-nums
                                 self-center"
                          aria-hidden="true">
                        Pagina {{ $posts->currentPage() }} / {{ $posts->lastPage() }}
                    </span>

                    @if ($posts->currentPage() < $posts->lastPage())
                        <a href="?page={{ $posts->currentPage() + 1 }}"
                           class="news-pager group/pager
                                  relative inline-flex items-center gap-2.5
                                  pl-5 pr-4 py-2.5 rounded-full
                                  bg-primary-500 text-white
                                  text-[11px] font-semibold tracking-[0.1em] uppercase
                                  overflow-hidden
                                  transition-[transform,box-shadow] duration-300 ease-out
                                  hover:-translate-y-0.5
                                  hover:shadow-[0_14px_28px_-10px_rgba(228,35,19,0.6)]
                                  focus-visible:outline-2 focus-visible:outline-offset-2
                                  focus-visible:outline-primary-500"
                           rel="next">
                            <span class="absolute inset-0
                                         bg-gradient-to-r from-transparent via-white/22 to-transparent
                                         -translate-x-full
                                         transition-transform duration-700 ease-out
                                         group-hover/pager:translate-x-full"
                                  aria-hidden="true"></span>
                            <span class="relative">Oudere berichten</span>
                            <span class="relative inline-flex
                                         transition-transform duration-300 ease-out
                                         group-hover/pager:translate-x-1"
                                  aria-hidden="true">
                                @include('svg.arrow-right')
                            </span>
                        </a>
                    @else
                        <span></span>
                    @endif
                </nav>
            @endif
        @else
            <div class="news-overview__empty
                        max-w-md mx-auto text-center
                        py-16 lg:py-20"
                 data-reveal="fade-up"
                 style="--reveal-delay: 60ms">

                <span class="inline-flex items-center justify-center
                             w-14 h-14 rounded-2xl
                             bg-primary-500/8 text-primary-500
                             mb-5">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="w-7 h-7" aria-hidden="true">
                        <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                        <path d="M18 14h-8M15 18h-5M10 6h8v4h-8z"/>
                    </svg>
                </span>

                <p class="text-secondary-900 font-semibold text-lg mb-2">
                    Nog geen berichten
                </p>
                <p class="text-secondary-900/65 text-sm leading-relaxed">
                    Er zijn nog geen berichten beschikbaar. Kom binnenkort terug voor het laatste nieuws van Stichting Moz Kids.
                </p>
            </div>
        @endif

    </x-container>
</section>
