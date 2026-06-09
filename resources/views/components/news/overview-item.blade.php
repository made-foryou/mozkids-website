@php
    $hasImage = $post->hasMedia('featured_image');
    $imageUrl = $hasImage ? $post->getFirstMediaUrl('featured_image') : null;
@endphp

<a {{ $attributes->merge(['class' => 'news-card group/card
                                      relative h-full flex flex-col
                                      overflow-hidden
                                      bg-white/82 backdrop-blur-md
                                      rounded-2xl
                                      ring-1 ring-secondary-900/5
                                      shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
                                      transition-[transform,box-shadow] duration-500 ease-out
                                      hover:-translate-y-1
                                      hover:shadow-[0_28px_60px_-26px_rgba(49,48,47,0.4)]
                                      focus-visible:outline-2 focus-visible:outline-offset-4
                                      focus-visible:outline-primary-500']) }}
   href="{{ Made\Cms\Facades\Cms::url($post) }}">

    <figure class="news-card__media
                   relative
                   overflow-hidden
                   aspect-[16/10]
                   bg-secondary-500">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}"
                 alt="{{ $post->name }}"
                 class="news-card__img
                        absolute inset-0 w-full h-full
                        object-cover object-center
                        transition-transform duration-700 ease-out
                        group-hover/card:scale-[1.04]" />
        @endif

        <span class="news-card__shade
                     pointer-events-none absolute inset-0
                     bg-gradient-to-t from-secondary-900/30 via-transparent to-transparent
                     opacity-0 transition-opacity duration-500
                     group-hover/card:opacity-100"
              aria-hidden="true"></span>
    </figure>

    <div class="news-card__body
                flex-1 flex flex-col
                px-6 py-6 md:px-7 md:py-7">

        <span class="news-card__date
                     inline-flex items-center gap-2
                     mb-3
                     text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.2em]
                     text-primary-500">
            <span class="inline-block w-1 h-1 rounded-full bg-primary-500"
                  aria-hidden="true"></span>
            <span class="tabular-nums">{{ $post->date->translatedFormat('d F Y') }}</span>
        </span>

        <h3 class="news-card__title
                   mb-3
                   text-lg md:text-xl
                   text-secondary-900 font-semibold
                   tracking-[-0.012em] leading-snug text-balance
                   transition-colors duration-300
                   group-hover/card:text-primary-500">
            {{ $post->name }}
        </h3>

        @if (!empty($post->introduction))
            <p class="news-card__intro
                      mb-5
                      text-[13px] md:text-sm
                      text-secondary-900/70 leading-relaxed
                      line-clamp-3">
                {{ $post->introduction }}
            </p>
        @endif

        <span class="news-card__more group/more
                     mt-auto
                     inline-flex items-center gap-1.5
                     text-[11px] font-semibold uppercase tracking-[0.12em]
                     text-primary-500
                     transition-colors duration-200
                     group-hover/card:text-primary-700">
            <span class="border-b border-primary-500/30
                         transition-colors duration-200
                         group-hover/card:border-primary-500">Lees verder</span>
            <span class="inline-flex
                         transition-transform duration-300 ease-out
                         group-hover/card:translate-x-1"
                  aria-hidden="true">
                @include('svg.arrow-right')
            </span>
        </span>
    </div>
</a>
