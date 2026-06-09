@php
    $live = $live ?? false;
    $items = $items ?? [];
    $subtitle = $subtitle ?? null;
    $content = $content ?? null;
@endphp

<section class="blocks-content-strip relative
                w-full
                py-8 lg:py-12">

    <x-container class="max-w-6xl w-full">

        @if (!empty($subtitle) || !empty($content))
            <header class="blocks-content-strip__header
                           mb-10 lg:mb-14
                           max-w-2xl mx-auto text-center"
                    data-reveal="fade-up"
                    style="--reveal-delay: 0ms">

                @if (!empty($subtitle))
                    <span class="blocks-content-strip__eyebrow
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

                @if (!empty($content))
                    <div class="blocks-content-strip__content
                                prose max-w-none text-strip__prose
                                text-secondary-900/85
                                [&>p:first-child]:mt-0
                                [&_h1]:text-3xl [&_h1]:lg:text-4xl [&_h1]:font-semibold
                                [&_h1]:tracking-[-0.018em] [&_h1]:leading-[1.15] [&_h1]:text-balance
                                [&_h1]:text-secondary-900
                                [&_h2]:text-balance"
                         data-highlightable>
                        {!! str($content)->sanitizeHtml() !!}
                    </div>
                @endif
            </header>
        @endif

        @if (!empty($items))
            <div class="blocks-content-strip__grid
                        grid grid-cols-1 md:grid-cols-3
                        gap-6 lg:gap-7
                        items-stretch">

                @foreach ($items as $index => $item)

                    @php
                        $image = null;
                        if (!empty($item['image'])) {
                            $image = $live
                                ? asset("storage/{$item['image']}")
                                : asset('storage/' . array_pop($item['image']));
                        }
                    @endphp

                    <article class="block-card group relative
                                    h-full flex flex-col
                                    overflow-hidden
                                    bg-white/82 backdrop-blur-md
                                    rounded-2xl
                                    ring-1 ring-secondary-900/5
                                    shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
                                    transition-[transform,box-shadow] duration-500 ease-out
                                    hover:-translate-y-1
                                    hover:shadow-[0_28px_60px_-26px_rgba(49,48,47,0.4)]"
                             data-reveal="fade-up"
                             style="--reveal-delay: {{ 80 + ($index * 90) }}ms">

                        @if ($image)
                            <figure class="block-card__media
                                           relative
                                           overflow-hidden
                                           aspect-35/24">
                                <img src="{{ $image }}"
                                     alt="{{ $item['title'] ?? '' }}"
                                     class="block-card__img
                                            absolute inset-0
                                            w-full h-full
                                            object-cover object-center
                                            transition-transform duration-700 ease-out
                                            group-hover:scale-[1.04]" />

                                <span class="block-card__shade
                                             pointer-events-none absolute inset-0
                                             bg-gradient-to-t from-secondary-900/30 via-transparent to-transparent
                                             opacity-0 transition-opacity duration-500
                                             group-hover:opacity-100"
                                      aria-hidden="true"></span>
                            </figure>
                        @endif

                        <div class="block-card__body
                                    flex-1 flex flex-col
                                    px-6 py-6 md:px-7 md:py-7">

                            @if (!empty($item['subtitle']))
                                <span class="block-card__eyebrow
                                             inline-flex items-center gap-2
                                             mb-3
                                             text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.2em]
                                             text-primary-500">
                                    <span class="inline-block w-1 h-1 rounded-full bg-primary-500"
                                          aria-hidden="true"></span>
                                    <span>{{ $item['subtitle'] }}</span>
                                </span>
                            @endif

                            @if (!empty($item['title']))
                                <h3 class="block-card__title
                                           mb-3
                                           text-lg md:text-xl
                                           text-secondary-900 font-semibold
                                           tracking-[-0.012em] leading-snug text-balance">
                                    {{ $item['title'] }}
                                </h3>
                            @endif

                            <div class="block-card__content
                                        flex-1
                                        prose max-w-none text-strip__prose
                                        text-secondary-900/72
                                        [&>p:first-child]:mt-0">
                                {!! str($item['content'])->sanitizeHtml() !!}
                            </div>
                        </div>
                    </article>

                @endforeach
            </div>
        @endif

    </x-container>
</section>
