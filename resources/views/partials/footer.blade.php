<div class="site-footer relative">

    <div class="relative grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-10 lg:gap-14"
         data-reveal="fade-up"
         style="--reveal-delay: 0ms">

        <section class="footer-col">
            <x-footer-title>Contactgegevens</x-footer-title>

            <div class="footer-block">
                <span class="footer-block__label
                             block mb-1.5
                             text-[10px] font-semibold uppercase tracking-[0.18em]
                             text-secondary-900/55">
                    Adres
                </span>
                <address class="footer-block__address not-italic
                                text-[13px] md:text-sm
                                text-secondary-900/82
                                leading-relaxed">
                    {{ $address->address }}<br />
                    {{ $address->zipcode }}, {{ $address->city }}<br />
                    {{ $address->country }}
                </address>
            </div>

            <div class="footer-block mt-7 flex flex-col items-start gap-3">
                <a href="tel:{{ $contact->phoneNumber }}"
                   class="footer-pill group/pill
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
                    <span>{{ $contact->phone }}</span>
                </a>

                <a href="mailto:{{ $contact->email }}"
                   class="footer-pill group/pill
                          inline-flex items-center gap-2.5
                          pl-4 pr-5 py-2.5 rounded-full
                          bg-primary-500 text-white
                          text-[12px] font-semibold tracking-[0.06em]
                          overflow-hidden relative
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
                    <span class="relative">{{ $contact->email }}</span>
                </a>
            </div>
        </section>

        <section class="footer-col">
            <x-footer-title>Blijf op de hoogte</x-footer-title>

            <a href="{{ $instagram->url }}"
               rel="nofollow"
               target="_blank"
               class="footer-social group/social
                      inline-flex items-center gap-3
                      transition-transform duration-300 ease-out
                      hover:-translate-y-0.5
                      focus-visible:outline-2 focus-visible:outline-offset-4
                      focus-visible:outline-primary-500 focus-visible:rounded-md">
                <span class="footer-social__icon
                             inline-flex items-center justify-center
                             w-11 h-11 rounded-2xl
                             bg-primary-500 text-white
                             shadow-[0_8px_18px_-8px_rgba(228,35,19,0.5)]
                             transition-[transform,box-shadow] duration-300 ease-out
                             group-hover/social:scale-[1.05]
                             group-hover/social:shadow-[0_14px_24px_-10px_rgba(228,35,19,0.6)]">
                    <span class="w-5 h-5 inline-flex
                                 [&_svg]:w-full [&_svg]:h-full [&_svg]:fill-current">
                        @include('svg.instagram')
                    </span>
                </span>
                <span class="footer-social__handle
                             text-[13px] md:text-sm
                             font-medium text-secondary-900
                             transition-colors duration-300
                             group-hover/social:text-primary-500">
                    {{ $instagram->account }}
                </span>
            </a>
        </section>

        <section class="footer-col">
            <x-footer-title>Financiële gegevens</x-footer-title>

            <div class="footer-block space-y-5">
                <div>
                    <span class="block mb-1
                                 text-[10px] font-semibold uppercase tracking-[0.18em]
                                 text-secondary-900/55">
                        {{ $bankAccount->label }}
                    </span>
                    <span class="block
                                 text-[13px] md:text-sm
                                 text-secondary-900 font-medium
                                 tabular-nums tracking-wide">
                        {{ $bankAccount->account }}
                    </span>
                </div>

                <div>
                    <span class="block mb-1
                                 text-[10px] font-semibold uppercase tracking-[0.18em]
                                 text-secondary-900/55">
                        {{ $sinAccount->label }}
                    </span>
                    <span class="block
                                 text-[13px] md:text-sm
                                 text-secondary-900 font-medium
                                 tabular-nums tracking-wide">
                        {{ $sinAccount->account }}
                    </span>
                </div>

                <p class="text-[11px] text-primary-500 font-light italic">
                    Giften aan Moz Kids zijn fiscaal aftrekbaar.
                </p>
            </div>

            <div class="footer-block mt-7">
                <span class="inline-flex items-center justify-center
                             p-3 rounded-2xl
                             bg-secondary-500/60 ring-1 ring-secondary-900/5
                             transition-transform duration-500 ease-out
                             hover:scale-[1.02]">
                    @include('svg.anbi')
                </span>
            </div>
        </section>
    </div>

    <div class="site-footer__bar relative
                mt-14 pt-6
                flex flex-col-reverse gap-4 sm:flex-row sm:items-center sm:justify-between
                text-[11px] font-light text-secondary-900/65">

        <span class="site-footer__bar-divider
                     pointer-events-none absolute top-0 left-0 right-0
                     h-px
                     bg-gradient-to-r from-transparent via-secondary-900/10 to-transparent"
              aria-hidden="true"></span>

        <div class="flex flex-row flex-wrap gap-x-5 gap-y-2">
            @foreach ($items as $item)
                <a href="{{ Cms::url($item->linkable) }}"
                   title="{{ $item->linkable->meta->title }}"
                   rel="{{ implode(' ', $item->rel) }}"
                   class="footer-legal-link group/legal
                          relative inline-block
                          transition-colors duration-300
                          hover:text-primary-500">
                    {{ $item->linkName }}
                    <span class="pointer-events-none absolute left-0 right-0 -bottom-0.5
                                 h-px origin-left scale-x-0
                                 bg-current
                                 transition-transform duration-300 ease-out
                                 group-hover/legal:scale-x-100"
                          aria-hidden="true"></span>
                </a>
            @endforeach
        </div>

        <div class="flex flex-row flex-wrap gap-x-1.5">
            <span>&copy; Moz Kids {{ now()->format('Y') }}</span>
        </div>
    </div>
</div>
