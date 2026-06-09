<section class="text-strip relative
                w-full
                pt-3 pb-8
                lg:pt-4 lg:pb-12
                [&:first-child]:pt-12 lg:[&:first-child]:pt-16">

    <x-container class="max-w-6xl">

        @if (!empty($title))
            <h1 class="text-strip__title
                       block mb-6
                       text-3xl lg:text-4xl
                       text-secondary-900 font-semibold
                       tracking-[-0.018em] leading-[1.15]
                       text-balance"
                data-reveal="fade-up"
                style="--reveal-delay: 0ms">
                {{ $title }}
            </h1>
        @endif

        <div class="prose max-w-none text-strip__prose
                    text-secondary-900/82
                    [&>p:first-child]:mt-0"
             data-reveal="fade-up"
             style="--reveal-delay: {{ !empty($title) ? 120 : 0 }}ms">
            {!! str($content)->sanitizeHtml() !!}
        </div>

    </x-container>
</section>
