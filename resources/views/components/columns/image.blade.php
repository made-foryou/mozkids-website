@props([
    'image' => '',
    'alt' => '',
])

<figure class="w-full h-full">
    <img src="{{ $image }}" alt="{{ $alt ?? '' }}" class="object-cover object-center rounded-lg w-full h-full" />
</figure>