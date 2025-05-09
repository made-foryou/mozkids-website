<div class="fixed z-20 w-full inset-x-0 bottom-0 mb-8">
    <x-container class="w-full max-w-6xl mx-auto flex items-center justify-center">
        <div 
            class="inline-flex items-center
                   cursor-pointer rounded-full shadow-xs text-primary backdrop-blur-2xl
                   bg-black/40 
                   py-1 pl-1 pr-4
                   group
                   transition duration-245 ease-in-out
                   hover:bg-black/60 hover:shadow-xl
                   focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
        >
            <div 
                class="rounded-full size-12 flex items-center justify-center mr-4
                       bg-white text-primary  
                       transition duration-245 ease-in-out
                       group-hover:text-white group-hover:bg-primary">
                @include('svg.hart', ['size' => 8])
            </div>
            <div class="text-white mr-5">
                <span class="block text-base font-sans tracking-wide font-bold leading-5">Doneer direct</span>
                <span class="block text-xs font-light">{{ $subject }}</span>
            </div>
            <div 
                class="text-white
                       transition duration-245 ease-in-out
                       group-hover:translate-x-2"
            >
                @include('svg.arrow-right', ['size' => 5])
            </div>
        </div>
    </x-container>
</div>