@php
    $live = $live ?? false;
    $items = $items ?? [];
    $subtitle = $subtitle ?? null;
    $title = $title ?? null;
@endphp

@if (!empty($items))

<section class="faq-strip relative
                w-full
                py-8 lg:py-12">

    @if (!empty($subtitle) || !empty($title))
        <x-container class="max-w-3xl mx-auto text-center mb-10 lg:mb-14"
                     data-reveal="fade-up"
                     style="--reveal-delay: 0ms">

            @if (!empty($subtitle))
                <span class="faq-strip__eyebrow
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
                <h2 class="faq-strip__title
                           text-2xl md:text-3xl lg:text-4xl
                           text-secondary-900 font-semibold
                           tracking-[-0.018em] leading-[1.15] text-balance">
                    {{ $title }}
                </h2>
            @endif
        </x-container>
    @endif

    <x-container class="max-w-3xl">

        <ul class="faq-list flex flex-col gap-3 list-none">

            @foreach ($items as $index => $item)

                @php
                    $image = null;
                    if (!empty($item['image'])) {
                        $image = $live
                            ? asset("storage/{$item['image']}")
                            : asset('storage/' . array_pop($item['image']));
                    }
                    $hasImage = !is_null($image);
                @endphp

                <li class="faq-item group/item relative
                           bg-white/82 backdrop-blur-md
                           rounded-2xl
                           ring-1 ring-secondary-900/5
                           shadow-[0_14px_36px_-22px_rgba(49,48,47,0.28)]
                           overflow-hidden
                           transition-[box-shadow,ring-color] duration-500 ease-out
                           hover:ring-secondary-900/10"
                    data-reveal="fade-up"
                    style="--reveal-delay: {{ 60 + ($index * 70) }}ms">

                    <button type="button"
                            class="faq-item__question
                                   group/q relative w-full
                                   flex items-center gap-4 md:gap-5
                                   px-5 py-4 md:px-7 md:py-5
                                   text-left
                                   cursor-pointer
                                   transition-colors duration-200 ease-out
                                   hover:bg-primary-500/3
                                   focus-visible:outline-2 focus-visible:outline-offset-[-2px]
                                   focus-visible:outline-primary-500
                                   focus-visible:rounded-2xl"
                            data-faq-toggle
                            aria-expanded="false">

                        <span class="faq-item__number
                                     shrink-0
                                     inline-flex items-center justify-center
                                     w-8 md:w-10
                                     text-[11px] md:text-xs font-semibold uppercase tracking-[0.14em]
                                     text-primary-500
                                     tabular-nums
                                     transition-transform duration-300
                                     group-hover/q:scale-110">
                            {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <span class="faq-item__title flex-1 min-w-0
                                     text-[15px] md:text-base lg:text-[17px]
                                     text-secondary-900 font-semibold
                                     tracking-[-0.01em] leading-snug text-balance">
                            {{ $item['title'] }}
                        </span>

                        <span class="faq-item__chevron
                                     shrink-0
                                     inline-flex items-center justify-center
                                     w-9 h-9 md:w-10 md:h-10 rounded-full
                                     bg-primary-500/8 text-primary-500
                                     ring-1 ring-primary-500/0
                                     transition-[background-color,ring-color,transform] duration-500 ease-out
                                     group-hover/q:bg-primary-500/15"
                              aria-hidden="true">
                            <svg viewBox="0 0 12 12"
                                 class="faq-item__chevron-icon w-3 h-3
                                        transition-transform duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]"
                                 fill="none" stroke="currentColor"
                                 stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 4.5 6 7.5 9 4.5" />
                            </svg>
                        </span>
                    </button>

                    <div class="faq-item__answer relative"
                         data-faq-content>

                        <div class="faq-item__answer-inner
                                    flex flex-col md:flex-row md:items-start gap-5 md:gap-6
                                    px-5 pt-1 pb-5 md:px-7 md:pb-6 md:pt-2">

                            <span class="faq-item__divider
                                         block md:hidden
                                         h-px w-12
                                         bg-gradient-to-r from-primary-500/40 to-transparent"
                                  aria-hidden="true"></span>

                            @if ($hasImage)
                                <figure class="faq-item__media
                                               md:w-2/5 lg:w-[42%] shrink-0
                                               overflow-hidden rounded-xl
                                               ring-1 ring-secondary-900/5
                                               shadow-[0_14px_30px_-18px_rgba(49,48,47,0.3)]">
                                    <img src="{{ $image }}"
                                         alt="{{ $item['title'] }}"
                                         class="faq-item__img
                                                block w-full h-auto
                                                transition-transform duration-700 ease-out
                                                group-hover/item:scale-[1.025]" />
                                </figure>
                            @endif

                            <div class="faq-item__copy flex-1 min-w-0
                                        md:pl-{{ $hasImage ? '0' : '14' }}
                                        {{ $hasImage ? '' : 'md:pl-14' }}">

                                <div class="faq-item__content
                                            prose max-w-none text-strip__prose
                                            text-secondary-900/82
                                            [&>p:first-child]:mt-0
                                            [&>p]:text-[13px] md:[&>p]:text-sm
                                            [&>p]:leading-relaxed">
                                    {!! str($item['content'])->sanitizeHtml() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            @endforeach

        </ul>
    </x-container>
</section>

@endif
