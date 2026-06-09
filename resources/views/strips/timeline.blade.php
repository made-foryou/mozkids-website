@php
    $live = $live ?? false;
    $items = $items ?? [];
    $subtitle = $subtitle ?? null;
    $title = $title ?? null;
@endphp

@if (!empty($items))

<section class="timeline-strip relative
                w-full
                py-8 lg:py-12">

    <x-container class="relative max-w-5xl">

        @if (!empty($subtitle) || !empty($title))
            <header class="timeline-strip__header
                           mb-10 lg:mb-14
                           max-w-2xl mx-auto text-center"
                    data-reveal="fade-up"
                    style="--reveal-delay: 0ms">

                @if (!empty($subtitle))
                    <span class="timeline-strip__eyebrow
                                 inline-flex items-center gap-2
                                 mb-4
                                 text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                                 text-primary-500">
                        <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                              aria-hidden="true"></span>
                        <span>{{ $subtitle }}</span>
                        <span class="ml-1 inline-block w-6 h-px
                                     bg-gradient-to-r from-primary-500/40 to-transparent"
                              aria-hidden="true"></span>
                    </span>
                @endif

                @if (!empty($title))
                    <h2 class="timeline-strip__title
                               text-2xl md:text-3xl lg:text-4xl
                               text-secondary-900 font-semibold
                               tracking-[-0.018em] leading-[1.15] text-balance">
                        {{ $title }}
                    </h2>
                @endif
            </header>
        @endif

        <ol class="timeline-list relative
                   grid grid-cols-1 md:grid-cols-2
                   gap-y-6 md:gap-y-0
                   list-none">

            <span class="timeline-list__rail
                         pointer-events-none absolute top-2 bottom-2
                         left-3 md:left-1/2
                         -translate-x-1/2
                         w-px
                         bg-gradient-to-b from-primary-500/40 via-secondary-900/20 to-transparent"
                  aria-hidden="true"></span>

            @foreach ($items as $index => $item)

                @php
                    $isLeft = $index % 2 === 0;
                    $reveal = $isLeft ? 'slide-right' : 'slide-left';
                    $image = null;
                    if (!empty($item['image'])) {
                        $image = $live
                            ? asset("storage/{$item['image']}")
                            : asset('storage/' . array_pop($item['image']));
                    }
                @endphp

                <li class="timeline-item group relative
                           pl-10 md:pl-0
                           {{ $isLeft ? 'md:col-start-1 md:pr-10 lg:pr-14' : 'md:col-start-2 md:pl-10 lg:pl-14' }}"
                    style="grid-row: {{ $index + 1 }}; --reveal-delay: {{ 60 + ($index * 90) }}ms"
                    data-reveal="{{ $reveal }}">

                    <span class="timeline-item__marker
                                 absolute top-1 z-10
                                 left-3 -translate-x-1/2
                                 {{ $isLeft ? 'md:left-auto md:right-0 md:translate-x-1/2' : 'md:left-0 md:-translate-x-1/2' }}
                                 inline-flex items-center justify-center
                                 w-6 h-6 md:w-7 md:h-7 rounded-full
                                 bg-secondary-500
                                 ring-1 ring-secondary-900/10
                                 shadow-[0_4px_12px_-4px_rgba(49,48,47,0.25)]
                                 transition-transform duration-500 ease-out
                                 group-hover:scale-110"
                          aria-hidden="true">
                        <span class="block w-2 h-2 md:w-2.5 md:h-2.5 rounded-full
                                     bg-primary-500
                                     transition-[transform,box-shadow] duration-500
                                     group-hover:shadow-[0_0_0_4px_rgba(228,35,19,0.18)]"></span>
                    </span>

                    <span class="timeline-item__name
                                 flex items-center gap-2
                                 mb-3
                                 {{ $isLeft ? 'md:justify-end' : 'md:justify-start' }}
                                 text-[11px] md:text-xs font-semibold uppercase tracking-[0.18em]
                                 text-primary-500">
                        {{ $item['name'] }}
                    </span>

                    <article class="timeline-item__card relative
                                    overflow-hidden
                                    rounded-2xl
                                    bg-white/82 backdrop-blur-md
                                    ring-1 ring-secondary-900/5
                                    shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
                                    transition-[transform,box-shadow] duration-500 ease-out
                                    group-hover:-translate-y-1
                                    group-hover:shadow-[0_28px_60px_-26px_rgba(49,48,47,0.4)]">

                        @if ($image)
                            <figure class="timeline-item__media
                                           relative
                                           overflow-hidden
                                           aspect-[4/3] md:aspect-[16/9]">

                                <img src="{{ $image }}"
                                     alt="{{ $item['name'] }}"
                                     class="timeline-item__img
                                            absolute inset-0
                                            w-full h-full
                                            object-cover object-center
                                            transition-transform duration-700 ease-out
                                            group-hover:scale-[1.035]" />

                                <span class="timeline-item__shade
                                             pointer-events-none absolute inset-0
                                             bg-gradient-to-t from-secondary-900/35 via-transparent to-transparent"
                                      aria-hidden="true"></span>
                            </figure>
                        @endif

                        <div class="timeline-item__body
                                    px-6 py-6 md:px-7 md:py-7">

                            <div class="timeline-item__content
                                        prose max-w-none
                                        text-strip__prose
                                        text-secondary-900/82
                                        [&>p:first-child]:mt-0"
                                 data-timeline-content>
                                {!! str($item['content'])->sanitizeHtml() !!}
                            </div>

                            <button type="button"
                                    class="timeline-item__toggle group/toggle
                                           relative z-10
                                           mt-4
                                           inline-flex items-center gap-1.5
                                           text-[11px] font-semibold uppercase tracking-[0.14em]
                                           text-primary-500
                                           transition-colors duration-200 ease-out
                                           hover:text-primary-700
                                           focus-visible:outline-2 focus-visible:outline-offset-2
                                           focus-visible:outline-primary-500 focus-visible:rounded-sm"
                                    data-timeline-toggle
                                    aria-expanded="false">
                                <span class="timeline-item__toggle-label--collapsed">Lees meer</span>
                                <span class="timeline-item__toggle-label--expanded">Inklappen</span>
                                <span class="timeline-item__toggle-chevron inline-flex
                                             transition-transform duration-300 ease-out"
                                      aria-hidden="true">
                                    <svg viewBox="0 0 12 12" class="w-2.5 h-2.5 fill-none stroke-current"
                                         stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 4.5 6 7.5 9 4.5" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </article>
                </li>

            @endforeach
        </ol>

    </x-container>
</section>

@endif
