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
        class="pt-0 @if ($columns === 3) pb-4 @else pb-10 @endif
            text-sm text-black font-sans
            @if ($columns !== 3) @if ($left) md:pb-12.5 md:mr-18 @else md:pb-12.5 md:ml-18 @endif @endif"
    >
@elseif ($count > 1 && $last)
<div
    class="pb-0 @if ($columns === 3) pt-0 @else pt-10 @endif
        text-sm text-black font-sans
         @if ($columns !== 3) @if ($left) md:pt-0 md:mr-18 @else md:pt-12.5 md:ml-18 @endif @endif"
>
@else
<div
    class="@if ($columns === 3) py-4 @else py-10 @endif
        text-sm text-black font-sans
        @if ($columns !== 3) @if ($left) md:py-0 md:mr-18 @else md:py-12.5 md:ml-18 @endif @endif"
>
@endif
    <span
        class="block
            mb-4
            text-xs text-primary-500 font-sans tracking-wide uppercase
            md:text-sm"
    >
        {{ $subtitle }}
    </span>

    <div class="prose" data-highlightable>
        {!! $content !!}
    </div>

    @if (!empty($buttons))

    <div
        class="mt-8 flex flex-row gap-4"
    >
        @foreach ($buttons as $button)

            <x-button :color="$button['color']" :href="Cms::url($button['website_link'])">
                {{ $button['label'] }}
                <x-slot:icon>
                    @include('svg.arrow-right')
                </x-slot:icon>
            </x-button>

        @endforeach
    </div>

    @endif
</div>
