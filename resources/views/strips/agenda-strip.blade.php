@php
    $items = $items ?? collect();
    $title = $title ?? null;
@endphp

<section class="agenda-strip relative
                w-full
                py-8 lg:py-12">

    @if (!empty($title))
        <x-container class="max-w-3xl mx-auto text-center mb-10 lg:mb-14"
                     data-reveal="fade-up"
                     style="--reveal-delay: 0ms">

            <span class="agenda-strip__eyebrow
                         inline-flex items-center gap-2
                         mb-4
                         text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                         text-primary-500">
                <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                      aria-hidden="true"></span>
                <span>Agenda</span>
                <span class="ml-1 inline-block w-6 h-px
                             bg-gradient-to-r from-primary-500/40 to-transparent"
                      aria-hidden="true"></span>
            </span>

            <h1 class="agenda-strip__title
                       text-2xl md:text-3xl lg:text-4xl
                       text-secondary-900 font-semibold
                       tracking-[-0.018em] leading-[1.15] text-balance"
                data-highlightable>
                {{ $title }}
            </h1>
        </x-container>
    @endif

    @if ($items->isNotEmpty())
        <x-container class="max-w-3xl">

            <ol class="agenda-list relative
                       pl-10 md:pl-16
                       list-none">

                <span class="agenda-list__rail
                             pointer-events-none absolute top-3 bottom-3
                             left-3 md:left-6
                             w-px -translate-x-1/2
                             bg-gradient-to-b from-primary-500/40 via-secondary-900/20 to-transparent"
                      aria-hidden="true"></span>

                @php $revealDelay = 0; @endphp

                @foreach ($items as $year => $entries)
                    @php
                        $yearIndex = $loop->index;
                        $revealDelay += 60;
                    @endphp

                    @if ($yearIndex > 0)
                        <li class="agenda-list__spacer h-6 md:h-8"
                            aria-hidden="true"></li>
                    @endif

                    <li class="agenda-year relative
                               h-12 md:h-14 mb-2"
                        data-reveal="fade-up"
                        style="--reveal-delay: {{ $revealDelay }}ms">

                        <span class="agenda-year__marker
                                     absolute -left-7 md:-left-10
                                     -translate-x-1/2 top-0
                                     inline-flex items-center justify-center
                                     w-12 h-12 md:w-14 md:h-14 rounded-full
                                     bg-primary-500 text-white
                                     ring-4 ring-secondary-500
                                     shadow-[0_12px_28px_-10px_rgba(228,35,19,0.55)]
                                     text-[12px] md:text-[13px] font-semibold tracking-[0.05em] tabular-nums">
                            {{ $year }}
                        </span>

                        <span class="agenda-year__rule
                                     absolute left-0 right-0 top-1/2
                                     h-px
                                     bg-gradient-to-r from-secondary-900/15 via-secondary-900/8 to-transparent"
                              aria-hidden="true"></span>
                    </li>

                    @foreach ($entries as $entry)
                        @php
                            $revealDelay += 70;
                            $hasImage = $entry->hasMedia('image');
                            $imageUrl = $hasImage ? $entry->getFirstMediaUrl('image') : null;
                            $hasDescription = !empty(trim(strip_tags((string) $entry->description)));
                        @endphp

                        <li class="agenda-item group/item relative
                                   pt-5 lg:pt-6 pb-2"
                            data-reveal="fade-up"
                            style="--reveal-delay: {{ $revealDelay }}ms">

                            <span class="agenda-item__marker
                                         absolute -left-7 md:-left-10
                                         -translate-x-1/2 top-7
                                         inline-flex items-center justify-center
                                         w-5 h-5 md:w-6 md:h-6 rounded-full
                                         bg-secondary-500
                                         ring-1 ring-secondary-900/10
                                         shadow-[0_4px_10px_-4px_rgba(0,0,0,0.18)]
                                         transition-transform duration-300 ease-out
                                         group-hover/item:scale-110"
                                  aria-hidden="true">
                                <span class="block w-2 h-2 rounded-full
                                             bg-primary-500
                                             transition-[box-shadow] duration-300
                                             group-hover/item:shadow-[0_0_0_3px_rgba(228,35,19,0.18)]"></span>
                            </span>

                            <div class="agenda-item__layout
                                        flex flex-col md:flex-row md:items-start
                                        gap-4 md:gap-6">

                                @if ($imageUrl)
                                    <figure class="agenda-item__media
                                                   md:w-1/3 lg:w-2/5 shrink-0
                                                   overflow-hidden rounded-2xl
                                                   ring-1 ring-secondary-900/5
                                                   shadow-[0_18px_40px_-20px_rgba(49,48,47,0.32)]">
                                        <img src="{{ $imageUrl }}"
                                             alt="{{ $entry->name }}"
                                             class="agenda-item__img
                                                    block w-full h-auto
                                                    transition-transform duration-700 ease-out
                                                    group-hover/item:scale-[1.04]" />
                                    </figure>
                                @endif

                                <div class="agenda-item__body flex-1 min-w-0">

                                    <span class="agenda-item__date
                                                 inline-flex items-center gap-1.5
                                                 mb-1.5
                                                 text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.18em]
                                                 text-primary-500">
                                        <span class="tabular-nums">
                                            {{ $entry->start_date->translatedFormat('d F') }}
                                        </span>
                                        @if (!empty($entry->end_date) && $entry->end_date->format('Y-m-d') !== $entry->start_date->format('Y-m-d'))
                                            <span class="opacity-50">→</span>
                                            <span class="tabular-nums">{{ $entry->end_date->translatedFormat('d F') }}</span>
                                        @endif
                                    </span>

                                    <h3 class="agenda-item__name
                                               text-base md:text-lg
                                               text-secondary-900 font-semibold
                                               tracking-[-0.01em] leading-snug">
                                        {{ $entry->name }}
                                    </h3>

                                    @if ($hasDescription)
                                        <div class="agenda-item__content relative mt-2"
                                             data-agenda-content>

                                            <div class="agenda-item__desc
                                                        prose max-w-none text-strip__prose
                                                        text-secondary-900/70
                                                        [&>p:first-child]:mt-0
                                                        [&>p]:text-[13px] md:[&>p]:text-sm">
                                                {!! str($entry->description)->sanitizeHtml() !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if ($hasDescription)
                                <button type="button"
                                        class="agenda-item__toggle group/toggle
                                               relative z-10
                                               mt-3
                                               inline-flex items-center gap-1.5
                                               text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em]
                                               text-primary-500
                                               transition-colors duration-200 ease-out
                                               hover:text-primary-700
                                               focus-visible:outline-2 focus-visible:outline-offset-2
                                               focus-visible:outline-primary-500 focus-visible:rounded-sm"
                                        data-agenda-toggle
                                        aria-expanded="false">
                                    <span class="agenda-item__toggle-label--collapsed">Lees meer</span>
                                    <span class="agenda-item__toggle-label--expanded">Inklappen</span>
                                    <span class="agenda-item__toggle-chevron inline-flex
                                                 transition-transform duration-300 ease-out"
                                          aria-hidden="true">
                                        <svg viewBox="0 0 12 12"
                                             class="w-2.5 h-2.5 fill-none stroke-current"
                                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 4.5 6 7.5 9 4.5" />
                                        </svg>
                                    </span>
                                </button>
                            @endif
                        </li>
                    @endforeach
                @endforeach

            </ol>
        </x-container>
    @endif
</section>
