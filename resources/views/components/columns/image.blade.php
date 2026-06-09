@props([
    'image' => '',
    'alt' => '',
    'columns' => 1,
])

<figure class="column-image
               w-full
               rounded-2xl overflow-hidden
               ring-1 ring-secondary-900/5
               shadow-[0_24px_60px_-30px_rgba(49,48,47,0.35)]
               @if ($columns === 3) h-auto @else h-full @endif">
    <img src="{{ $image }}"
         alt="{{ $alt ?? '' }}"
         class="column-image__img
                object-cover object-center
                @if ($columns === 3) w-full h-[250px] @else w-full h-full @endif
                transition-transform duration-700 ease-out
                hover:scale-[1.03]" />
</figure>
