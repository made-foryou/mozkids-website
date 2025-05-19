@php
    $live = $live ?? false;
@endphp

<section
    class="relative
           w-full
           py-12
           bg-secondary-500
           lg:py-18"
>
    <x-container
        class="max-w-6xl flex flex-col md:flex-row gap-10"
    >

        <x-column class="w-2/3" :items="$left_columns" side="left" :live="$live" />
        <x-column class="w-1/3" :items="$right_columns" side="right" :live="$live" />

    </x-container>
</section>
