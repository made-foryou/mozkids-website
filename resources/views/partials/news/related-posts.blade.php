@props([
    'posts' => collect([]),
])

<section
    class="relative
           w-full"
>
    <x-container class="max-w-6xl py-12 lg:py-18 border-t border-secondary-100">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold">Gerelateerde nieuwsberichten</h2>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            @foreach ($posts as $post)
                <x-news.overview-item :post="$post"></x-news.overview-item>
            @endforeach

        </div>

        <div class="mt-10 text-center">
            <x-button href="{{ Cms::url($newsPage) }}">
                Terug naar het nieuwsoverzicht
            </x-button>
        </div>

    </x-container>
</section>
