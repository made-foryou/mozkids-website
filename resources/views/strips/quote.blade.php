@php
    $image = ($live) ? asset("storage/{$image}") : asset('storage/' . array_pop($image));
@endphp

<section class="quote-strip relative
                w-full
                py-14 lg:py-22">

    <x-container class="max-w-6xl">

        <figure class="quote-frame relative
                       w-full
                       aspect-116/65 lg:aspect-541/175
                       rounded-2xl overflow-hidden
                       ring-1 ring-secondary-900/8
                       shadow-[0_30px_70px_-30px_rgba(49,48,47,0.45)]"
                data-reveal="fade-up"
                style="--reveal-delay: 0ms">

            <div class="quote-frame__photo
                        absolute inset-0
                        bg-cover bg-center bg-no-repeat
                        will-change-transform"
                 style="background-image: url('{{ $image }}')"
                 aria-hidden="true"></div>

            <div class="quote-frame__shade
                        absolute inset-0
                        bg-gradient-to-br from-secondary-900/72 via-secondary-900/40 to-secondary-900/20"
                 aria-hidden="true"></div>

            <div class="quote-frame__vignette
                        absolute inset-0
                        bg-[radial-gradient(120%_80%_at_70%_30%,transparent_0%,rgba(49,48,47,0.45)_100%)]"
                 aria-hidden="true"></div>

            <svg class="quote-frame__mark
                        absolute top-6 left-6 lg:top-10 lg:left-12
                        w-16 h-16 lg:w-24 lg:h-24
                        text-white/15"
                 viewBox="0 0 80 64"
                 fill="currentColor"
                 aria-hidden="true">
                <path d="M0 38.5C0 21.5 12.4 5.3 30.6 0l3.6 7.4c-10.7 4.5-17.4 13.2-18.6 23.1C25 30 32 35.8 32 45.6 32 55.4 24.8 64 14.6 64 5.6 64 0 56.4 0 47.4v-8.9zM44.4 38.5C44.4 21.5 56.8 5.3 75 0l3.6 7.4c-10.7 4.5-17.4 13.2-18.6 23.1 9.4 0 16.4 5.8 16.4 15.6 0 9.8-7.2 17.9-17.4 17.9-9 0-14.6-7.6-14.6-16.6v-8.9z"/>
            </svg>

            <figcaption class="quote-frame__body relative z-10
                               flex flex-col justify-end
                               h-full
                               px-7 py-10 lg:px-16 lg:py-14">

                <blockquote class="quote-frame__text
                                   max-w-3xl
                                   font-sans font-medium italic
                                   text-white
                                   text-xl md:text-3xl lg:text-[2.1rem]
                                   leading-[1.25] tracking-[-0.01em]
                                   text-balance
                                   drop-shadow-[0_2px_18px_rgba(0,0,0,0.45)]"
                            data-reveal="fade-up"
                            style="--reveal-delay: 180ms">
                    {!! nl2br($quote) !!}
                </blockquote>

                <div class="quote-frame__attribution
                            inline-flex items-center gap-3
                            mt-6 lg:mt-8"
                     data-reveal="fade-up"
                     style="--reveal-delay: 360ms">

                    <span class="quote-frame__rule
                                 block w-10 h-px
                                 bg-gradient-to-r from-primary-500 to-primary-500/0"
                          aria-hidden="true"></span>

                    <span class="quote-frame__author
                                 text-[11px] md:text-xs
                                 font-semibold uppercase tracking-[0.18em]
                                 text-white/85">
                        {{ $author }}
                    </span>
                </div>
            </figcaption>
        </figure>

    </x-container>
</section>
