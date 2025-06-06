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
        class="max-w-6xl w-full grid md:grid-cols-3 gap-10 md:gap-0"
    >

        <div class="bg-white rounded-lg py-5 px-6 md:mr-14">
            <span
                class="block
                    mb-9 pb-3
                    border-b border-secondary-500
                    text-xs text-primary-500 font-sans tracking-wide uppercase leading-8.5
                    md:text-sm"
            >
                {{ $subtitle }}
            </span>
            <span
                class="inline-block text-sans text-2xl tracking-wide text-black pb-7"
                data-highlightable
            >
                {!! str($title)->sanitizeHtml() !!}
            </span>
        </div>

        @foreach ($values as $value)

        @if ($loop->index !== 2)
        <div
            class="bg-transparent border-b border-white pb-7
                   md:border-t md:py-12 md:pr-12"
        >
        @else
        <div
            class="bg-transparent border-b border-white pb-7
                   md:py-12 md:pr-12"
        >
        @endif
            <div class="flex items-center justify-start gap-4">
                <figure
                    class="inline-flex justify-center items-center rounded-full size-[60px] bg-white text-primary-500 p-3
                           md:size-[71px]"
                >
                    @include($value['icon']->icon())
                </figure>
                <span class="inline-block text-xl text-black font-sans tracking-wide leading-8.5">
                    {{ $value['title'] }}
                </span>
            </div>
            <div class="mt-7 prose-sm">
                {!! str($value['content'])->sanitizeHtml() !!}
            </div>
        </div>

        @endforeach

    </x-container>
</section>
