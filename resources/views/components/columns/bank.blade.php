@props([
    'item'
])

<div class="bank-card
            relative h-full flex flex-col
            bg-white/82 backdrop-blur-md
            rounded-2xl
            ring-1 ring-secondary-900/5
            shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
            px-6 py-7 md:px-8 md:py-9
            overflow-hidden"
     data-reveal="fade-up"
     style="--reveal-delay: 0ms">

    <span class="bank-card__glow
                 pointer-events-none absolute -top-24 -right-24
                 w-72 h-72
                 rounded-full
                 bg-primary-500/6 blur-3xl"
          aria-hidden="true"></span>

    <header class="bank-card__header relative mb-6">

        <span class="bank-card__eyebrow
                     inline-flex items-center gap-2
                     mb-3
                     text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                     text-primary-500">
            <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                  aria-hidden="true"></span>
            <span>Doneer</span>
            <span class="ml-1 inline-block w-6 h-px
                         bg-gradient-to-r from-primary-500/40 to-transparent"
                  aria-hidden="true"></span>
        </span>

        <h3 class="bank-card__title
                   text-2xl md:text-3xl
                   text-secondary-900 font-semibold
                   tracking-[-0.018em] leading-[1.15] text-balance">
            Financiële gegevens
        </h3>
    </header>

    <div class="bank-card__body relative
                flex flex-col gap-5">

        @foreach ($item['accounts'] as $account)
            <div class="bank-card__account">
                <span class="bank-card__label
                             block mb-1
                             text-[10px] font-semibold uppercase tracking-[0.18em]
                             text-secondary-900/55">
                    {{ $account->label }}
                </span>
                <span class="bank-card__number
                             block
                             text-[13px] md:text-sm
                             text-secondary-900 font-medium
                             tabular-nums tracking-wide">
                    {{ $account->account }}
                </span>
            </div>
        @endforeach

        <p class="bank-card__disclaimer
                  text-[11px] text-primary-500 font-light italic
                  leading-snug">
            Giften aan Moz Kids zijn fiscaal aftrekbaar.
        </p>

        <div class="bank-card__anbi mt-2">
            <span class="inline-flex items-center justify-center
                         p-3 rounded-2xl
                         bg-secondary-500/60 ring-1 ring-secondary-900/5
                         transition-transform duration-500 ease-out
                         hover:scale-[1.02]">
                @include('svg.anbi')
            </span>
        </div>
    </div>
</div>
