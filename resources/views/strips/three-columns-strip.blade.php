@php
    $live = $live ?? false;
@endphp

<section
    class="relative
           py-12 w-full
           bg-secondary-500
           lg:py-18"
>
    <x-container
        class="max-w-6xl w-full grid md:grid-cols-3 gap-10"
    >

        <x-column :items="$left_columns" side="left" :live="$live" />
        <x-column :items="$middle_columns" side="middle" :live="$live" />
        <x-column :items="$right_columns" side="right" :live="$live" />

    </x-container>
</section>