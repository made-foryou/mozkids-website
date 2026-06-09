@php
    $live = $live ?? false;
    $totalPhotos = collect($photos)->filter(fn ($p) => !empty($p['image']))->count();
@endphp

<section class="photo-slider-section relative
                w-full
                py-8 lg:py-12">

    <span class="photo-slider-glow
                 pointer-events-none absolute left-1/2 top-1/2
                 -translate-x-1/2 -translate-y-1/2
                 w-[78%] h-[60%]
                 rounded-[40%]
                 bg-primary-500/8 blur-3xl"
          aria-hidden="true"></span>

    <x-container class="relative max-w-7xl" :full-screen-mobile="true">

        <div class="swiper made-photo-slider
                    overflow-visible!
                    mx-4! md:mx-0!">
            <div class="swiper-wrapper">

                @foreach ($photos as $photo)

                    @if (empty($photo['image']))
                        @continue
                    @endif

                    @php($image = ($live) ? asset("storage/{$photo['image']}") : asset('storage/' . array_pop($photo['image'])))

                    <div
                        class="photo-slide swiper-slide
                               relative
                               bg-cover bg-center bg-no-repeat
                               aspect-248/139 w-[88.92%]! md:w-[78.61%]!
                               rounded-2xl
                               ring-1 ring-secondary-900/5
                               overflow-hidden"
                        style="background-image: url('{{ $image }}')"
                    >
                        <span class="photo-slide__shade
                                     pointer-events-none absolute inset-0
                                     bg-gradient-to-tr from-secondary-900/45 via-secondary-900/10 to-transparent
                                     transition-opacity duration-500 ease-out"
                              aria-hidden="true"></span>

                        @if (!empty($photo['title']) && !empty($photo['description']))

                            <div class="swiper-slide-overlay photo-overlay
                                        absolute hidden md:block
                                        top-5 left-5
                                        w-[36%] max-w-[360px]
                                        rounded-2xl
                                        bg-white/82 backdrop-blur-xl
                                        ring-1 ring-secondary-900/5
                                        shadow-[0_18px_44px_-20px_rgba(49,48,47,0.45)]
                                        p-6
                                        opacity-0 translate-y-2
                                        transition-[opacity,translate] duration-500 ease-out">

                                <span class="photo-overlay__title
                                             block mb-2
                                             text-secondary-900 text-lg tracking-[-0.01em] font-semibold leading-snug">
                                    {{ $photo['title'] }}
                                </span>

                                <p class="photo-overlay__desc
                                          text-secondary-900/70 text-sm leading-relaxed font-light">
                                    {!! nl2br($photo['description']) !!}
                                </p>
                            </div>

                        @endif

                    </div>

                @endforeach
            </div>
        </div>

        <div class="photo-controls
                    relative mt-10
                    flex items-center justify-center gap-5 lg:gap-7">

            <button type="button"
                    class="photo-nav__btn swiper-button-prev
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
                    aria-label="Vorige foto">
                <span class="photo-nav__sheen absolute inset-0
                             bg-gradient-to-r from-transparent via-white/25 to-transparent
                             -translate-x-full
                             transition-transform duration-700 ease-out
                             group-hover:translate-x-full"></span>
                <span class="relative inline-flex transition-transform duration-300 ease-out
                             group-hover:-translate-x-0.5">
                    @include('svg.arrow-right', ['rotate' => true])
                </span>
            </button>

            <div class="photo-counter
                        inline-flex items-center gap-2.5
                        text-[12px] font-semibold tracking-[0.18em] uppercase
                        text-secondary-900/70
                        tabular-nums"
                 aria-live="polite">
                <span class="photo-counter__current text-secondary-900">01</span>
                <span class="photo-counter__bar
                             relative inline-block
                             w-12 h-px
                             bg-secondary-900/15
                             overflow-hidden"
                      aria-hidden="true">
                    <span class="photo-counter__bar-fill
                                 absolute left-0 top-0
                                 h-full
                                 bg-primary-500
                                 transition-[width] duration-500 ease-out"
                          style="width: {{ $totalPhotos > 0 ? (int) ((1 / $totalPhotos) * 100) : 0 }}%"></span>
                </span>
                <span class="photo-counter__total text-secondary-900/55">{{ str_pad((string) $totalPhotos, 2, '0', STR_PAD_LEFT) }}</span>
            </div>

            <button type="button"
                    class="photo-nav__btn swiper-button-next
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
                    aria-label="Volgende foto">
                <span class="photo-nav__sheen absolute inset-0
                             bg-gradient-to-r from-transparent via-white/25 to-transparent
                             -translate-x-full
                             transition-transform duration-700 ease-out
                             group-hover:translate-x-full"></span>
                <span class="relative inline-flex transition-transform duration-300 ease-out
                             group-hover:translate-x-0.5">
                    @include('svg.arrow-right')
                </span>
            </button>

        </div>

    </x-container>

</section>
