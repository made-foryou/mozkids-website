@props([
    'count' => 1,
    'first' => true,
    'last' => false,
    'left' => true,

    'subtitle' => '',
    'content' => '',
    'buttons' => [],

    'columns' => 1,
])

@if ($count > 1 && $first)
    <div
        class="column-text pt-0 @if ($columns === 3) pb-4 @else pb-10 @endif
            text-sm text-secondary-900 font-sans
            @if ($columns !== 3) md:pb-12.5 md:mr-18 @endif"
    >
@elseif ($count > 1 && $last)
<div
    class="column-text pb-0 @if ($columns === 3) pt-0 @else pt-0 @endif
        text-sm text-secondary-900 font-sans
         @if ($columns !== 3) md:pt-0 md:mr-18 @endif"
>
@else
<div
    class="column-text @if ($columns === 3) py-4 @else pb-10 @endif
        text-sm text-secondary-900 font-sans
        @if ($columns !== 3) md:py-0 md:mr-18 @endif"
>
@endif

    @if (!empty($subtitle))
        <span
            class="column-text__eyebrow
                   inline-flex items-center gap-2
                   mb-5
                   text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                   text-primary-500"
        >
            <span class="column-text__eyebrow-dot
                         inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                  aria-hidden="true"></span>
            <span>{{ $subtitle }}</span>
            <span class="column-text__eyebrow-line
                         inline-block w-6 h-px
                         bg-gradient-to-r from-primary-500/40 to-transparent"
                  aria-hidden="true"></span>
        </span>
    @endif

    <div class="prose column-text__prose" data-highlightable>
        {!! $content !!}
    </div>

    @if (!empty($buttons))
        <div class="mt-8 flex flex-row flex-wrap gap-3">
            @foreach ($buttons as $button)
                <x-cta :color="$button['color']" :href="Cms::url($button['website_link'])">
                    {{ $button['label'] }}
                </x-cta>
            @endforeach
        </div>
    @endif
</div>
