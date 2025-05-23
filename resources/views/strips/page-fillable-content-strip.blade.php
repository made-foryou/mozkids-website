
<section class="relative flex flex-grow w-full py-12">
    <x-container class="flex-grow flex flex-col justify-center items-center">
        <div class="py-25 flex justify-center items-center flex-col">
            <span 
                class="block mb-10
                    text-black text-6xl lg:text-8xl font-sans tracking-wide font-semibold"
            >
                {{ $title }}
            </span>

            <span
                class="block
                    text-black text-xl lg:text-2xl font-sans tracking-wide font-semibold"
            >
                {!! $content !!}
            </span>
        </div>
        
    @if (!empty($link) || !empty($label))

        <div class="w-full flex flex-col justify-center items-center border-t border-white pt-12">
            <x-button :color="'white'" :href="url($linkModel->route->route)">
                {{ $label }}
                <x-slot:icon>
                    @include('svg.arrow-right')
                </x-slot:icon>
            </x-button>
        </div>

    @endif

    </x-container>
</section>
