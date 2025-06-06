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
    <x-container class="max-w-6xl">

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

        @foreach ($posts as $post)
            <x-news.overview-item :post="$post"></x-news.overview-item>
        @endforeach

        </div>

        <div class="mt-6 flex items-center justify-between">
            @if ($posts->currentPage() > 1)
                <x-button href="?page={{ $posts->currentPage() - 1 }}">
                    Nieuwere berichten
                </x-button>
            @else
                <div></div>
            @endif

            @if ($posts->currentPage() < $posts->lastPage())
                <x-button href="?page={{ $posts->currentPage() + 1 }}">
                    Oudere berichten
                </x-button>
            @endif
        </div>

    </x-container>
</section>
