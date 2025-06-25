<section
    class="relative
           w-full"
>
    <x-container class="flex flex-col justify-center items-center w-full border-b border-secondary-100 py-12 lg:py-18 max-w-6xl">

        <span
            class="block
                   font-sans tracking-wide text-black font-semibold text-2xl lg:text-4xl text-center"
            data-highlightable
        >
            {{ $title }}
        </span>

    </x-container>
</section>
<section class="relative w-full pb-25">
    <x-container class="max-w-6xl py-6 lg:py-8 space-y-8">

    @foreach ($items as $year => $entries)

        <div>

        <span class="text-black font-sans block tracking-wide font-semibold text-xl lg:text-2xl">
            {{ $year }}
        </span>
        <div class="mt-7 flex flex-col gap-6">

        @foreach ($entries as $entry)
        
            <x-calendar.overview-item :item="$entry" />

        @endforeach

        </div>

        </div>

    @endforeach

    </x-container>
</section>
