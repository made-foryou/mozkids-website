@php
    $live = $live ?? false;
@endphp

<section class="three-columns-strip relative
                w-full
                py-8 lg:py-12">

    <x-container class="max-w-6xl w-full grid md:grid-cols-3 gap-8 lg:gap-10 items-stretch">

        <div class="h-full" data-reveal="slide-right" style="--reveal-delay: 0ms">
            <x-column class="h-full" :items="$left_columns" side="left" :live="$live" columns="3" />
        </div>

        <div class="h-full" data-reveal="fade-up" style="--reveal-delay: 130ms">
            <x-column class="h-full" :items="$middle_columns" side="middle" :live="$live" columns="3" />
        </div>

        <div class="h-full" data-reveal="slide-left" style="--reveal-delay: 260ms">
            <x-column class="h-full" :items="$right_columns" side="right" :live="$live" columns="3" />
        </div>

    </x-container>
</section>
