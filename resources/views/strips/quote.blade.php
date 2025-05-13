<section
    class="relative
           w-full
           py-12
           lg:py-18"
>
    <x-container class="max-w-6xl overflow-hidden rounded-lg">

        @php($image = ($live) ? asset("storage/{$image}") : asset('storage/' . array_pop($image)))

        <div 
            class="relative w-full py-9 px-6
                   md:py-29 md:px-23
                   bg-cover bg-center bg-no-repeat
                   aspect-116/65 lg:aspect-541/175
                   rounded-lg"
            style="background-image: url('{{ $image }}')"
        >

            <div class="relative z-10 mb-6">
                <p 
                    class="font text-white text-lg font-sans tracking-wide text-shadow-lg
                           md:text-3xl"
                >
                    {!! nl2br($quote) !!}
                </p>
            </div>
            <div class="relative z-10">
                <p 
                    class="font-light text-white text-sm font-sans tracking-wide text-shadow-lg
                           md:text-lg"
                >
                    {{ $author }}
                </p>
            </div>

            <div 
                class="absolute z-1 top-0 left-0
                       w-full h-full rounded-lg
                       bg-linear-to-bl from-transparent to-black/45"
            ></div>

        </div>

    </x-container>
</section>