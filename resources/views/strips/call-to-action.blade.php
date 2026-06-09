@php
    $live = $live ?? false;
@endphp

<section class="cta-strip relative
                w-full
                py-8 lg:py-12">

    <x-container class="max-w-6xl">

        <a href="{{ Cms::url($link) }}"
           class="cta-banner group relative
                  flex flex-col md:flex-row
                  items-center justify-between
                  gap-6 md:gap-10
                  w-full
                  px-6 py-7 md:px-12 md:py-9
                  rounded-3xl md:rounded-full
                  bg-primary-500 text-white
                  overflow-hidden
                  shadow-[0_24px_50px_-24px_rgba(228,35,19,0.55)]
                  transition-[transform,box-shadow] duration-500 ease-out
                  hover:-translate-y-1
                  hover:shadow-[0_36px_70px_-26px_rgba(228,35,19,0.7)]
                  focus-visible:outline-2 focus-visible:outline-offset-4
                  focus-visible:outline-primary-500"
           data-reveal="fade-up"
           style="--reveal-delay: 0ms">

            <span class="cta-banner__orb
                         pointer-events-none absolute -top-24 -right-24
                         w-72 h-72
                         rounded-full
                         bg-white/12 blur-3xl"
                  aria-hidden="true"></span>

            <span class="cta-banner__orb
                         pointer-events-none absolute -bottom-28 -left-20
                         w-72 h-72
                         rounded-full
                         bg-white/8 blur-3xl"
                  aria-hidden="true"></span>

            <span class="cta-banner__sheen
                         pointer-events-none absolute inset-0
                         bg-gradient-to-r from-transparent via-white/22 to-transparent
                         -translate-x-full
                         transition-transform duration-[1100ms] ease-out
                         group-hover:translate-x-full"
                  aria-hidden="true"></span>

            <span class="cta-banner__heart relative
                         inline-flex items-center justify-center
                         w-12 h-12 md:w-14 md:h-14
                         rounded-full
                         bg-white text-primary-500
                         shadow-[0_8px_20px_-8px_rgba(0,0,0,0.25)]
                         transition-transform duration-500 ease-out
                         group-hover:scale-[1.08]"
                  aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="currentColor"
                     class="w-6 h-6 md:w-7 md:h-7 donate-cta__beat">
                    <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                </svg>
            </span>

            <span class="cta-banner__content relative
                         flex-1
                         text-center
                         text-lg md:text-xl lg:text-[1.4rem]
                         font-semibold tracking-[-0.01em]
                         leading-snug
                         text-balance
                         text-white
                         drop-shadow-[0_2px_12px_rgba(0,0,0,0.18)]">
                {!! $content !!}
            </span>

            <span class="cta-banner__arrow relative
                         inline-flex items-center justify-center
                         w-12 h-12 md:w-14 md:h-14
                         rounded-full
                         ring-1 ring-white/40
                         bg-white/10 backdrop-blur-sm
                         text-white
                         transition-[transform,background-color,box-shadow] duration-500 ease-out
                         group-hover:translate-x-1
                         group-hover:bg-white
                         group-hover:text-primary-500
                         group-hover:ring-white
                         group-hover:shadow-[0_10px_24px_-10px_rgba(0,0,0,0.35)]"
                  aria-hidden="true">
                <x-svg.arrow-right class="w-5 h-5 md:w-6 md:h-6" />
            </span>

        </a>

    </x-container>

</section>
