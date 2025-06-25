@props([
    'image' => '',
    'alt' => '',
    'columns' => 1,
])

<figure class="w-full @if ($columns === 3) h-auto @else h-full @endif">
    <img src="{{ $image }}" alt="{{ $alt ?? '' }}" class="object-cover object-center rounded-lg @if ($columns === 3) w-full h-[250px] @else w-full h-full @endif" />
</figure>
