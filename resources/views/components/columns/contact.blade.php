@props([
    'item'
])

<div class="contact-card
            relative h-full flex flex-col
            bg-white/82 backdrop-blur-md
            rounded-2xl
            ring-1 ring-secondary-900/5
            shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
            px-6 py-7 md:px-8 md:py-9
            overflow-hidden"
     data-reveal="fade-up"
     style="--reveal-delay: 0ms">

    <span class="contact-card__glow
                 pointer-events-none absolute -top-24 -right-24
                 w-72 h-72
                 rounded-full
                 bg-primary-500/6 blur-3xl"
          aria-hidden="true"></span>

    <header class="contact-card__header relative mb-6">

        <span class="contact-card__eyebrow
                     inline-flex items-center gap-2
                     mb-3
                     text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                     text-primary-500">
            <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                  aria-hidden="true"></span>
            <span>Contact</span>
            <span class="ml-1 inline-block w-6 h-px
                         bg-gradient-to-r from-primary-500/40 to-transparent"
                  aria-hidden="true"></span>
        </span>

        <h3 class="contact-card__title
                   text-2xl md:text-3xl
                   text-secondary-900 font-semibold
                   tracking-[-0.018em] leading-[1.15] text-balance">
            Contactgegevens
        </h3>
    </header>

    <div class="contact-card__body relative
                flex flex-col gap-6">

        <div class="contact-card__block">
            <span class="contact-card__label
                         block mb-1.5
                         text-[10px] font-semibold uppercase tracking-[0.18em]
                         text-secondary-900/55">
                Postadres
            </span>
            <address class="contact-card__address not-italic
                            text-[13px] md:text-sm
                            text-secondary-900/82 leading-relaxed">
                {{ $item['address']->address }}<br />
                {{ $item['address']->zipcode }}, {{ $item['address']->city }}<br />
                {{ $item['address']->country }}
            </address>
        </div>

        <div class="contact-card__block flex flex-col items-start gap-3">
            <a href="tel:{{ $item['contact']->phoneNumber }}"
               class="contact-pill group/pill
                      inline-flex items-center gap-2.5
                      pl-4 pr-5 py-2.5 rounded-full
                      bg-transparent text-secondary-900
                      ring-1 ring-secondary-900/12
                      text-[12px] font-semibold tracking-[0.06em]
                      transition-[background-color,color,box-shadow,transform,ring-color] duration-300 ease-out
                      hover:-translate-y-0.5
                      hover:bg-primary-500 hover:text-white hover:ring-primary-500
                      hover:shadow-[0_12px_24px_-10px_rgba(228,35,19,0.5)]
                      focus-visible:outline-2 focus-visible:outline-offset-2
                      focus-visible:outline-primary-500">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"
                     class="w-4 h-4 transition-transform duration-300 group-hover/pill:rotate-[8deg]"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <span>{{ $item['contact']->phone ?? $item['contact']->phoneNumber }}</span>
            </a>

            <a href="mailto:{{ $item['contact']->email }}"
               class="contact-pill group/pill
                      relative inline-flex items-center gap-2.5
                      pl-4 pr-5 py-2.5 rounded-full
                      bg-primary-500 text-white
                      text-[12px] font-semibold tracking-[0.06em]
                      overflow-hidden
                      transition-[transform,box-shadow] duration-300 ease-out
                      hover:-translate-y-0.5
                      hover:shadow-[0_14px_28px_-10px_rgba(228,35,19,0.6)]
                      focus-visible:outline-2 focus-visible:outline-offset-2
                      focus-visible:outline-primary-500">
                <span class="absolute inset-0
                             bg-gradient-to-r from-transparent via-white/25 to-transparent
                             -translate-x-full
                             transition-transform duration-700 ease-out
                             group-hover/pill:translate-x-full"
                      aria-hidden="true"></span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"
                     class="relative w-4 h-4"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span class="relative">{{ $item['contact']->email }}</span>
            </a>
        </div>

        @if (!empty($item['social']) && count($item['social']) > 0)
            <div class="contact-card__block
                        pt-6 mt-1
                        border-t border-secondary-900/8">
                <span class="contact-card__label
                             block mb-3
                             text-[10px] font-semibold uppercase tracking-[0.18em]
                             text-secondary-900/55">
                    Volg ons
                </span>

                <ul class="flex flex-col gap-3 list-none">
                    @foreach ($item['social'] as $account)
                        <li>
                            <a href="{{ $account->url }}"
                               rel="nofollow"
                               target="_blank"
                               class="contact-social group/social
                                      inline-flex items-center gap-3
                                      transition-transform duration-300 ease-out
                                      hover:-translate-y-0.5
                                      focus-visible:outline-2 focus-visible:outline-offset-4
                                      focus-visible:outline-primary-500 focus-visible:rounded-md">
                                <span class="contact-social__icon
                                             inline-flex items-center justify-center
                                             w-10 h-10 rounded-xl
                                             bg-primary-500 text-white
                                             shadow-[0_8px_16px_-8px_rgba(228,35,19,0.5)]
                                             transition-[transform,box-shadow] duration-300 ease-out
                                             group-hover/social:scale-[1.05]
                                             group-hover/social:shadow-[0_12px_22px_-10px_rgba(228,35,19,0.6)]">
                                    <span class="w-4 h-4 inline-flex
                                                 [&_svg]:w-full [&_svg]:h-full [&_svg]:fill-current">
                                        @include('svg.' . $account->key)
                                    </span>
                                </span>
                                <span class="contact-social__handle
                                             text-[13px] font-medium text-secondary-900
                                             transition-colors duration-300
                                             group-hover/social:text-primary-500">
                                    {{ $account->account }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
