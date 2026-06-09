@php
    $live = $live ?? false;
@endphp

<section class="two-columns-strip relative
                py-14 lg:py-22">

    <x-container class="max-w-6xl grid md:grid-cols-2 gap-10 md:gap-12 lg:gap-16 items-center">

        <div data-reveal="slide-right" style="--reveal-delay: 0ms">
            <x-column :items="$left_columns" side="left" :live="$live" />
        </div>

        <div data-reveal="slide-left" style="--reveal-delay: 140ms">
            <x-column :items="$right_columns" side="right" :live="$live" />
        </div>

    </x-container>
</section>
