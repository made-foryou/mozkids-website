@php
    $live = $live ?? false;
@endphp

<section class="large-small-column-strip relative
                w-full
                py-8 lg:py-12">

    <x-container class="max-w-6xl flex flex-col md:flex-row gap-10 md:gap-12 lg:gap-16 items-start">

        <div class="w-full md:w-2/3"
             data-reveal="slide-right"
             style="--reveal-delay: 0ms">
            <x-column :items="$left_columns" side="left" :live="$live" />
        </div>

        <div class="w-full md:w-1/3"
             data-reveal="slide-left"
             style="--reveal-delay: 140ms">
            <x-column :items="$right_columns" side="right" :live="$live" />
        </div>

    </x-container>
</section>
