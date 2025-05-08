@props([
    'count' => 1,
    'first' => true,
    'last' => false,
    'left' => true,

    'subtitle' => '',
    'content' => '',
    'buttons' => [],
])

@if ($count > 1 && $first)
    <div
        class="pt-0 pb-10
            text-sm text-black font-sans
            md:pb-12.5 @if ($left) md:mr-18 @else md:ml-18 @endif"
    >
@elseif ($count > 1 && $last)
<div
    class="pb-0 pt-10
        text-sm text-black font-sans
        md:pt-12.5 @if ($left) md:mr-18 @else md:ml-18 @endif"
>
@else
<div
    class="py-10
        text-sm text-black font-sans
        md:py-12.5 @if ($left) md:mr-18 @else md:ml-18 @endif"
>
@endif
    <span
        class="block
            mb-4
            text-xs text-primary font-sans tracking-wide uppercase
            md:text-sm"
    >
        {{ $subtitle }}
    </span>

    <span data-highlightable >
        {!! $content !!}
    </span>

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