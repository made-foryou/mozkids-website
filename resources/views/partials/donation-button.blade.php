<a href="{{ Cms::url($donationPage) }}"
   class="donation-fab group fixed z-30
          bottom-10 lg:bottom-12 left-1/2
          inline-flex items-center gap-4
          pl-1.5 pr-5 py-1.5
          rounded-full
          bg-secondary-900/82 backdrop-blur-xl
          ring-1 ring-white/10
          shadow-[0_20px_50px_-18px_rgba(0,0,0,0.55),0_0_0_0_rgba(228,35,19,0)]
          overflow-hidden
          transition-[opacity,translate,box-shadow,transform] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]
          hover:-translate-y-0.5
          hover:shadow-[0_28px_60px_-22px_rgba(228,35,19,0.55)]
          focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-primary-500"
   aria-label="Doneer direct">

    <span class="donation-fab__sheen
                 pointer-events-none absolute inset-0
                 bg-gradient-to-r from-transparent via-white/12 to-transparent
                 -translate-x-full
                 transition-transform duration-[1100ms] ease-out
                 group-hover:translate-x-full"
          aria-hidden="true"></span>

    <span class="donation-fab__heart relative
                 inline-flex items-center justify-center
                 w-11 h-11 rounded-full
                 bg-white text-primary-500
                 transition-[transform,box-shadow] duration-500 ease-out
                 group-hover:scale-105"
          aria-hidden="true">

        <span class="donation-fab__pulse
                     pointer-events-none absolute inset-0 rounded-full
                     ring-2 ring-primary-500/35"
              aria-hidden="true"></span>

        <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 donate-cta__beat">
            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
        </svg>
    </span>

    <span class="donation-fab__copy relative
                 flex flex-col items-start leading-tight">
        <span class="donation-fab__label
                     text-[11px] font-semibold uppercase tracking-[0.18em]
                     text-white">
            Doneer direct
        </span>
        <span class="donation-fab__subject
                     text-[11px] font-light text-white/70 mt-0.5
                     whitespace-nowrap">
            {{ $subject }}
        </span>
    </span>

    <span class="donation-fab__arrow relative
                 inline-flex items-center justify-center
                 w-8 h-8 rounded-full
                 bg-white/8 ring-1 ring-white/15
                 text-white
                 transition-[transform,background-color,color] duration-300 ease-out
                 group-hover:translate-x-1
                 group-hover:bg-primary-500 group-hover:ring-primary-500
                 group-hover:text-white"
          aria-hidden="true">
        @include('svg.arrow-right', ['size' => 4])
    </span>
</a>
