@props([
    'paddingTop' => true,
    'paddingBottom' => true,
    'posts' => collect([]),
])

<section
    class="relative
           w-full
           @if ($paddingTop && $paddingBottom) 
           py-12 lg:py-18 
           @elseif ($paddingTop)
           pt-12 lg:pt-18
           @elseif ($paddingBottom)
           pb-12 lg:pb-18
           @endif"
>
    <x-container
        class="grid grid-cols-1 gap-5
               max-w-6xl
               sm:grid-cols-2
               lg:grid-cols-3"
    >

        @foreach ($posts as $post)
            <x-news.overview-item :post="$post"></x-news.overview-item>
        @endforeach
        
    </x-container>
</section>
