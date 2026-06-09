@php
    $live = $live ?? false;
@endphp

<section class="core-values-strip relative
                w-full
                py-14 lg:py-22">

    <x-container class="max-w-6xl w-full
                        grid md:grid-cols-3
                        gap-6 lg:gap-7
                        items-stretch">

        <article class="core-card core-card--intro group relative
                        h-full flex flex-col
                        bg-white/82 backdrop-blur-md
                        rounded-2xl
                        ring-1 ring-secondary-900/5
                        shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
                        px-7 py-8 lg:px-8 lg:py-9
                        transition-[transform,box-shadow] duration-500 ease-out
                        hover:-translate-y-1
                        hover:shadow-[0_28px_60px_-26px_rgba(49,48,47,0.4)]"
                 data-reveal="slide-right"
                 style="--reveal-delay: 0ms">

            <span class="core-card__eyebrow
                         inline-flex items-center gap-2
                         mb-6
                         text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                         text-primary-500">
                <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                      aria-hidden="true"></span>
                <span>{{ $subtitle }}</span>
                <span class="ml-1 inline-block w-6 h-px
                             bg-gradient-to-r from-primary-500/40 to-transparent"
                      aria-hidden="true"></span>
            </span>

            <div class="core-card__title
                        flex-1
                        text-2xl md:text-[1.55rem]
                        text-secondary-900 font-semibold
                        tracking-[-0.018em] leading-[1.18] text-balance"
                 data-highlightable>
                {!! str($title)->sanitizeHtml() !!}
            </div>

            <span class="core-card__mark
                         pointer-events-none absolute -bottom-3 -right-3
                         w-24 h-24
                         rounded-full
                         bg-primary-500/8 blur-2xl
                         opacity-70
                         transition-opacity duration-500
                         group-hover:opacity-100"
                  aria-hidden="true"></span>
        </article>

        @foreach ($values as $value)
            <article class="core-card core-card--value group relative
                            h-full flex flex-col
                            bg-white/82 backdrop-blur-md
                            rounded-2xl
                            ring-1 ring-secondary-900/5
                            shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
                            px-7 py-8 lg:px-8 lg:py-9
                            transition-[transform,box-shadow] duration-500 ease-out
                            hover:-translate-y-1
                            hover:shadow-[0_28px_60px_-26px_rgba(49,48,47,0.4)]"
                     data-reveal="fade-up"
                     style="--reveal-delay: {{ 120 + ($loop->index * 90) }}ms">

                <div class="core-card__head flex items-center gap-4 mb-5">
                    <figure class="core-card__icon relative
                                   inline-flex items-center justify-center
                                   w-14 h-14 rounded-2xl
                                   bg-primary-500/8 text-primary-500
                                   p-3
                                   transition-[background-color,transform] duration-500 ease-out
                                   group-hover:bg-primary-500/15
                                   group-hover:scale-[1.06]">

                        <span class="pointer-events-none absolute -inset-1
                                     rounded-2xl
                                     bg-primary-500/12 blur-xl
                                     opacity-0
                                     transition-opacity duration-500
                                     group-hover:opacity-100"
                              aria-hidden="true"></span>

                        <span class="relative inline-flex w-full h-full
                                     [&_svg]:w-full [&_svg]:h-full
                                     [&_svg]:fill-current">
                            @include($value['icon']->icon())
                        </span>
                    </figure>

                    <h3 class="core-card__title
                               flex-1
                               text-lg md:text-xl
                               text-secondary-900 font-semibold
                               tracking-[-0.01em] leading-snug">
                        {{ $value['title'] }}
                    </h3>
                </div>

                <div class="core-card__content
                            flex-1
                            text-[13px] md:text-sm
                            text-secondary-900/70 leading-relaxed
                            [&_p]:mb-2 [&_p:last-child]:mb-0
                            [&_strong]:text-secondary-900 [&_strong]:font-semibold
                            [&_a]:text-primary-500 [&_a]:underline [&_a]:underline-offset-2">
                    {!! str($value['content'])->sanitizeHtml() !!}
                </div>
            </article>
        @endforeach

    </x-container>
</section>
