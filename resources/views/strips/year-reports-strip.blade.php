@php
    $live = $live ?? false;
    $reports = $reports ?? collect();
    $subtitle = $subtitle ?? null;
    $title = $title ?? null;
@endphp

<section class="year-reports-strip relative
                w-full
                py-8 lg:py-12">

    <x-container class="max-w-4xl">

        @if (!empty($subtitle) || !empty($title))
            <header class="year-reports-strip__header
                           mb-10 lg:mb-12
                           text-center max-w-2xl mx-auto"
                    data-reveal="fade-up"
                    style="--reveal-delay: 0ms">

                @if (!empty($subtitle))
                    <span class="year-reports-strip__eyebrow
                                 inline-flex items-center gap-2
                                 mb-3
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
                    <h2 class="year-reports-strip__title
                               text-2xl md:text-3xl
                               text-secondary-900 font-semibold
                               tracking-[-0.018em] leading-[1.15] text-balance"
                        data-highlightable>
                        {{ $title }}
                    </h2>
                @endif
            </header>
        @endif

        @if ($reports->isNotEmpty())
            <ul class="year-reports-list
                       divide-y divide-secondary-900/8
                       list-none"
                data-reveal="fade-up"
                style="--reveal-delay: 60ms">

                @foreach ($reports as $entry)
                    @php
                        $file = $live
                            ? asset("storage/{$entry->file}")
                            : asset('storage/' . array_pop($entry->file));
                    @endphp

                    <li class="year-report-item
                               group/item
                               flex flex-col md:flex-row md:items-center gap-4 md:gap-6
                               py-4 md:py-5">

                        <div class="year-report-item__info
                                    flex items-start gap-3
                                    flex-1 min-w-0">

                            <span class="year-report-item__icon
                                         relative shrink-0
                                         inline-flex items-center justify-center
                                         w-10 h-10 rounded-xl
                                         bg-primary-500/8 text-primary-500
                                         transition-[background-color,transform] duration-300 ease-out
                                         group-hover/item:bg-primary-500/15
                                         group-hover/item:scale-[1.05]"
                                  aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                     class="w-5 h-5">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <path d="M14 2v6h6"/>
                                    <path d="M9 13h6M9 17h6"/>
                                </svg>
                            </span>

                            <div class="min-w-0 flex-1 pt-0.5">
                                <span class="year-report-item__year
                                             block mb-1.5
                                             text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.2em]
                                             text-primary-500
                                             tabular-nums">
                                    {{ $entry->year }}
                                </span>

                                <h4 class="year-report-item__title
                                           text-base md:text-lg
                                           text-secondary-900 font-semibold
                                           tracking-[-0.01em] leading-snug">
                                    {{ $entry->title }}
                                </h4>

                                @if (!empty($entry->description))
                                    <div class="year-report-item__desc
                                                mt-1
                                                text-[13px] md:text-sm
                                                text-secondary-900/65 leading-relaxed
                                                [&>p]:m-0 [&>p+p]:mt-1">
                                        {!! str($entry->description)->sanitizeHtml() !!}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <a href="{{ $file }}"
                           target="_blank"
                           rel="noopener"
                           class="year-report-item__download group/pill
                                  relative shrink-0 self-start md:self-center
                                  inline-flex items-center gap-2
                                  pl-4 pr-4 py-2.5 rounded-full
                                  bg-transparent text-secondary-900
                                  ring-1 ring-secondary-900/12
                                  text-[11px] font-semibold tracking-[0.08em] uppercase
                                  transition-[background-color,color,box-shadow,transform,ring-color] duration-300 ease-out
                                  hover:bg-primary-500 hover:text-white hover:ring-primary-500
                                  hover:-translate-y-0.5
                                  hover:shadow-[0_12px_24px_-10px_rgba(228,35,19,0.5)]
                                  focus-visible:outline-2 focus-visible:outline-offset-2
                                  focus-visible:outline-primary-500">
                            <span>Download</span>
                            <span class="year-report-item__size
                                         pl-2 ml-1
                                         border-l border-current/30
                                         text-[10px] font-normal tracking-normal
                                         opacity-70 group-hover/pill:opacity-100
                                         tabular-nums">
                                {{ $entry->fileSize }}
                            </span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="w-3.5 h-3.5
                                        transition-transform duration-300 ease-out
                                        group-hover/pill:translate-y-0.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

    </x-container>
</section>
