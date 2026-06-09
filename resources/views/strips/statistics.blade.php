@php
    $live = $live ?? false;
@endphp

@if (! empty($stats))

<section class="statistics-strip relative
                w-full
                py-14 lg:py-22">

    <x-container class="relative max-w-6xl">

        <span class="statistics-strip__divider statistics-strip__divider--top
                     block w-full h-px
                     bg-gradient-to-r from-transparent via-secondary-900/18 to-transparent"
              aria-hidden="true"></span>

        <ul class="statistics-grid
                   list-none
                   grid grid-cols-{{ $mobileColumns }} gap-x-6 gap-y-12
                   py-12 lg:py-14
                   md:grid-cols-{{ $columns }} md:gap-x-10 md:gap-y-14">

            @foreach ($stats as $stat)

                @if (empty($stat['icon']))
                    @continue
                @endif

                @php($image = ($live) ? asset("storage/{$stat['icon']}") : asset('storage/' . array_pop($stat['icon'])))

                <li class="stat-item group relative
                           flex flex-col items-start
                           transition-transform duration-500 ease-out
                           hover:-translate-y-1"
                    data-reveal="fade-up"
                    style="--reveal-delay: {{ 80 + ($loop->index * 70) }}ms">

                    <div class="stat-item__icon relative
                                flex items-center justify-start
                                w-24 md:w-28 aspect-77/59
                                mb-6
                                transition-transform duration-500 ease-out
                                group-hover:scale-[1.05]">

                        <span class="stat-item__icon-halo
                                     pointer-events-none absolute
                                     left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2
                                     w-[140%] h-[140%]
                                     rounded-full
                                     bg-primary-500/12 blur-2xl
                                     opacity-55
                                     transition-opacity duration-500 ease-out
                                     group-hover:opacity-100"
                              aria-hidden="true"></span>

                        <img class="stat-item__icon-img
                                    relative
                                    w-full h-full object-contain object-left
                                    drop-shadow-[0_6px_18px_rgba(228,35,19,0.18)]"
                             src="{{ $image }}"
                             alt="{{ $stat['label'] }}" />
                    </div>

                    <span class="stat-item__label
                                 block mb-1.5
                                 text-2xl md:text-3xl
                                 font-semibold tracking-[-0.02em]
                                 text-secondary-900
                                 leading-[1.05]">
                        {{ $stat['label'] }}
                    </span>

                    @if (!empty($stat['description']))
                        <p class="stat-item__desc
                                  text-[13px] md:text-sm
                                  text-secondary-900/65
                                  leading-relaxed">
                            {!! nl2br($stat['description']) !!}
                        </p>
                    @endif

                </li>

            @endforeach

        </ul>

        <span class="statistics-strip__divider statistics-strip__divider--bottom
                     block w-full h-px
                     bg-gradient-to-r from-transparent via-secondary-900/18 to-transparent"
              aria-hidden="true"></span>

    </x-container>

</section>

@endif
