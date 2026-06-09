<div class="info-card group relative
            h-full flex flex-col
            bg-white/82 backdrop-blur-md
            rounded-2xl
            ring-1 ring-secondary-900/5
            shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
            px-7 py-7 lg:px-8 lg:py-8
            transition-[transform,box-shadow] duration-500 ease-out
            hover:-translate-y-1
            hover:shadow-[0_28px_60px_-26px_rgba(49,48,47,0.4)]">

    <span class="info-card__eyebrow
                 inline-flex items-center gap-2
                 mb-7
                 text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                 text-primary-500">
        <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
              aria-hidden="true"></span>
        <span>Laatste nieuws</span>
        <span class="ml-1 inline-block w-6 h-px
                     bg-gradient-to-r from-primary-500/40 to-transparent"
              aria-hidden="true"></span>
    </span>

    <ul class="info-card__list flex-1 flex flex-col gap-2">

        @foreach ($items as $item)
            <li class="info-card__item group/item
                       -mx-3 px-3 py-3 rounded-xl
                       transition-colors duration-300 ease-out
                       hover:bg-primary-500/4">
                <span class="info-card__date
                             inline-flex items-center gap-2
                             mb-2
                             text-[11px] font-medium uppercase tracking-[0.14em]
                             text-secondary-900/55">
                    <span class="inline-block w-1.5 h-1.5 rounded-[2px]
                                 bg-primary-500
                                 transition-transform duration-300 ease-out
                                 group-hover/item:scale-125"
                          aria-hidden="true"></span>
                    <span>{{ $item->date->translatedFormat('d F Y') }}</span>
                </span>
                <span class="info-card__title
                             block mb-2
                             text-base md:text-lg
                             text-secondary-900 font-semibold tracking-[-0.01em] leading-snug">
                    {{ $item->name ?? '' }}
                </span>
                <span class="info-card__excerpt
                             block mb-3
                             text-[13px] md:text-sm
                             text-secondary-900/65 leading-relaxed">
                    {{ $item->introduction ?? '' }}
                </span>
                <a href="{{ Made\Cms\Facades\Cms::url($item) }}"
                   class="info-card__read-more group/inline
                          inline-flex items-center gap-1.5
                          text-[12px] font-semibold
                          text-primary-500
                          transition-colors duration-200
                          hover:text-primary-700">
                    <span class="border-b border-primary-500/30
                                 transition-colors duration-200
                                 group-hover/inline:border-primary-500">Lees verder</span>
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ Made\Cms\Facades\Cms::url($newsPage) }}"
       class="info-card__link group/link
              mt-7 inline-flex items-center justify-between gap-3
              text-[12px] font-semibold uppercase tracking-[0.12em]
              text-secondary-900
              transition-colors duration-300 ease-out
              hover:text-primary-500">
        <span>Lees alle berichten</span>
        <span class="inline-flex items-center
                     transition-transform duration-300 ease-out
                     group-hover/link:translate-x-1"
              aria-hidden="true">
            @include('svg.arrow-right')
        </span>
    </a>
</div>
