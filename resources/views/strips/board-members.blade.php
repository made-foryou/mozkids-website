@php
    $live = $live ?? false;
    $members = $members ?? [];
    $subtitle = $subtitle ?? null;
    $title = $title ?? null;
    $description = $description ?? null;
    $hasHeaderDescription = !empty(trim(strip_tags((string) $description)));
    $totalMembers = collect($members)->count();
@endphp

@if (!empty($members))

<section class="board-members-strip relative
                w-full
                py-8 lg:py-12">

    @if (!empty($subtitle) || !empty($title) || $hasHeaderDescription)
        <x-container class="mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl w-full text-center mb-12 lg:mb-16"
                     data-reveal="fade-up"
                     style="--reveal-delay: 0ms">

            @if (!empty($subtitle))
                <span class="board-members-strip__eyebrow
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
                <h2 class="board-members-strip__title
                           text-2xl md:text-3xl lg:text-4xl
                           text-secondary-900 font-semibold
                           tracking-[-0.018em] leading-[1.15] text-balance">
                    {{ $title }}
                </h2>
            @endif

            @if ($hasHeaderDescription)
                <div class="board-members-strip__description
                            mt-5 mx-auto max-w-2xl
                            prose max-w-none text-strip__prose
                            text-secondary-900/72
                            [&>p:first-child]:mt-0
                            [&>p:last-child]:mb-0
                            [&>p]:text-sm md:[&>p]:text-[15px]
                            [&>p]:leading-relaxed
                            [&_a]:text-primary-500 [&_a]:underline [&_a]:underline-offset-2 hover:[&_a]:text-primary-700">
                    {!! str($description)->sanitizeHtml() !!}
                </div>
            @endif
        </x-container>
    @endif

    <x-container class="mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl w-full" :full-screen-mobile="true">

        <div class="swiper made-team-slider
                    overflow-visible!
                    mx-4! md:mx-0!"
             data-reveal="fade-up"
             style="--reveal-delay: 100ms">

            <ul class="swiper-wrapper list-none">

                @foreach ($members as $index => $member)

                    @php
                        $image = null;
                        if (!empty($member['image'])) {
                            $image = $live
                                ? asset("storage/{$member['image']}")
                                : asset('storage/' . array_pop($member['image']));
                        }
                        $hasImage = !is_null($image);
                        $hasDescription = !empty(trim(strip_tags((string) ($member['description'] ?? ''))));
                    @endphp

                    <li class="team-member swiper-slide group/member
                               h-auto flex flex-col">

                        <figure class="team-member__portrait
                                       relative
                                       overflow-hidden
                                       aspect-[3/2]
                                       rounded-2xl
                                       bg-secondary-500/60
                                       ring-1 ring-secondary-900/8
                                       shadow-[0_22px_50px_-28px_rgba(49,48,47,0.4)]
                                       transition-[transform,box-shadow,ring-color] duration-500 ease-out
                                       group-hover/member:-translate-y-1
                                       group-hover/member:shadow-[0_34px_70px_-28px_rgba(49,48,47,0.5)]
                                       group-hover/member:ring-secondary-900/14">

                            @if ($hasImage)
                                <img src="{{ $image }}"
                                     alt="{{ $member['name'] ?? '' }}"
                                     class="team-member__img
                                            absolute inset-0 w-full h-full
                                            object-cover object-center
                                            transition-transform duration-700 ease-out
                                            group-hover/member:scale-[1.04]" />
                            @else
                                <span class="team-member__placeholder
                                             absolute inset-0
                                             flex items-center justify-center
                                             text-primary-500/25"
                                      aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                                         class="w-20 h-20">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8" />
                                    </svg>
                                </span>
                            @endif

                            <span class="team-member__shade
                                         pointer-events-none absolute inset-0
                                         bg-gradient-to-t from-secondary-900/40 via-secondary-900/0 to-transparent
                                         opacity-0
                                         transition-opacity duration-500
                                         group-hover/member:opacity-100"
                                  aria-hidden="true"></span>
                        </figure>

                        <div class="team-member__body
                                    relative
                                    mt-6 lg:mt-7">

                            @if (!empty($member['role']))
                                <span class="team-member__role
                                             inline-flex items-center gap-2
                                             mb-3
                                             text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                                             text-primary-500">
                                    <span class="inline-block w-1 h-1 rounded-full
                                                 bg-primary-500
                                                 transition-transform duration-500
                                                 group-hover/member:scale-150"
                                          aria-hidden="true"></span>
                                    <span>{{ $member['role'] }}</span>
                                    <span class="ml-1 inline-block w-6 h-px
                                                 bg-gradient-to-r from-primary-500/50 to-transparent
                                                 transition-[width] duration-500
                                                 group-hover/member:w-10"
                                          aria-hidden="true"></span>
                                </span>
                            @endif

                            <h3 class="team-member__name
                                       text-xl md:text-2xl lg:text-[1.6rem]
                                       text-secondary-900 font-semibold
                                       tracking-[-0.018em] leading-[1.15] text-balance">
                                {{ $member['name'] ?? '' }}
                            </h3>

                            @if ($hasDescription)
                                <div class="team-member__bio
                                            relative mt-3"
                                     data-team-bio>
                                    <div class="team-member__bio-content
                                                prose max-w-none text-strip__prose
                                                text-secondary-900/75
                                                [&>p:first-child]:mt-0
                                                [&>p]:text-[13px] md:[&>p]:text-sm
                                                [&>p]:leading-relaxed">
                                        {!! str($member['description'])->sanitizeHtml() !!}
                                    </div>
                                </div>

                                <button type="button"
                                        class="team-member__toggle group/toggle
                                               relative z-10
                                               mt-3
                                               inline-flex items-center gap-1.5
                                               text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.14em]
                                               text-primary-500
                                               transition-colors duration-200 ease-out
                                               hover:text-primary-700
                                               focus-visible:outline-2 focus-visible:outline-offset-2
                                               focus-visible:outline-primary-500 focus-visible:rounded-sm"
                                        data-team-toggle
                                        aria-expanded="false">
                                    <span class="team-member__toggle-label--collapsed">Lees meer</span>
                                    <span class="team-member__toggle-label--expanded">Inklappen</span>
                                    <span class="team-member__toggle-chevron inline-flex
                                                 transition-transform duration-300 ease-out"
                                          aria-hidden="true">
                                        <svg viewBox="0 0 12 12" class="w-2.5 h-2.5 fill-none stroke-current"
                                             stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 4.5 6 7.5 9 4.5" />
                                        </svg>
                                    </span>
                                </button>
                            @endif
                        </div>
                    </li>

                @endforeach

            </ul>
        </div>

        <div class="team-slider__controls
                    relative mt-10
                    flex items-center justify-center gap-5 lg:gap-7"
             data-reveal="fade-up"
             style="--reveal-delay: 200ms">

            <button type="button"
                    class="team-slider__btn team-slider__prev
                           group relative
                           inline-flex items-center justify-center
                           w-12 h-12 rounded-full
                           bg-primary-500 text-white
                           overflow-hidden
                           transition-[transform,box-shadow,opacity] duration-300 ease-out
                           hover:-translate-y-0.5
                           hover:shadow-[0_14px_30px_-8px_rgba(228,35,19,0.55)]
                           focus-visible:outline-2 focus-visible:outline-offset-2
                           focus-visible:outline-primary-500"
                    aria-label="Vorige bestuursleden">
                <span class="team-slider__sheen absolute inset-0
                             bg-gradient-to-r from-transparent via-white/25 to-transparent
                             -translate-x-full
                             transition-transform duration-700 ease-out
                             group-hover:translate-x-full"></span>
                <span class="relative inline-flex
                             transition-transform duration-300 ease-out
                             group-hover:-translate-x-0.5">
                    @include('svg.arrow-right', ['rotate' => true])
                </span>
            </button>

            <div class="team-slider__counter
                        inline-flex items-center gap-2.5
                        text-[12px] font-semibold tracking-[0.18em] uppercase
                        text-secondary-900/70
                        tabular-nums"
                 aria-live="polite">
                <span class="team-slider__counter-current text-secondary-900">01</span>
                <span class="team-slider__counter-bar
                             relative inline-block
                             w-12 h-px
                             bg-secondary-900/15
                             overflow-hidden"
                      aria-hidden="true">
                    <span class="team-slider__counter-fill
                                 absolute left-0 top-0
                                 h-full
                                 bg-primary-500
                                 transition-[width] duration-500 ease-out"
                          style="width: {{ $totalMembers > 0 ? (int) ((1 / $totalMembers) * 100) : 0 }}%"></span>
                </span>
                <span class="team-slider__counter-total text-secondary-900/55">{{ str_pad((string) $totalMembers, 2, '0', STR_PAD_LEFT) }}</span>
            </div>

            <button type="button"
                    class="team-slider__btn team-slider__next
                           group relative
                           inline-flex items-center justify-center
                           w-12 h-12 rounded-full
                           bg-primary-500 text-white
                           overflow-hidden
                           transition-[transform,box-shadow,opacity] duration-300 ease-out
                           hover:-translate-y-0.5
                           hover:shadow-[0_14px_30px_-8px_rgba(228,35,19,0.55)]
                           focus-visible:outline-2 focus-visible:outline-offset-2
                           focus-visible:outline-primary-500"
                    aria-label="Volgende bestuursleden">
                <span class="team-slider__sheen absolute inset-0
                             bg-gradient-to-r from-transparent via-white/25 to-transparent
                             -translate-x-full
                             transition-transform duration-700 ease-out
                             group-hover:translate-x-full"></span>
                <span class="relative inline-flex
                             transition-transform duration-300 ease-out
                             group-hover:translate-x-0.5">
                    @include('svg.arrow-right')
                </span>
            </button>
        </div>

    </x-container>
</section>

@endif
