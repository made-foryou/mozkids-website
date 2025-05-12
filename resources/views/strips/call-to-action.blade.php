<section
    class="relative
           w-full
           py-12
           lg:py-18"
>
    <x-container class="max-w-6xl">

        <a 
            href="{{ Cms::url($link) }}"
            class="flex flex-col items-center justify-between gap-5 md:gap-15 md:flex-row
                   relative w-full py-8 px-4 md:py-13 md:px-14
                   bg-primary rounded-lg md:rounded-full
                   group
                   cursor-pointer
                   transition duration-245 ease-in-out
                   hover:shadow-xl
                   focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
        >

            <span 
                class="inline-flex justify-center items-center flex-shrink-0
                       size-7 md:size-14
                       bg-white text-primary rounded-full"
            >
                <x-svg.hart class="size-5 md:size-9" />
            </span>
            <span 
                class="inline-block 
                       lg:max-w-2/4
                       text-center font-sans text-white text-lg tracking-wide
                       md:text-xl lg:text-2xl">
                {!! $content !!}
            </span>
            <span 
                class="inline-flex justify-center items-center flex-shrink-0
                       size-7 md:size-14
                       border-2 border-white text-white bg-primary rounded-full">
                <x-svg.arrow-right class="size-5" />
            </span>

        </a>

    </x-container>

</section>