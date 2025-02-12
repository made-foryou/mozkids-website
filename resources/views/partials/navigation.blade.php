<div class="flex flex-row justify-between items-center w-full space-x-10">

    <a 
        href="{{ url('/') }}" 
        class="block
               transition ease-in-out duration-145
               hover:opacity-75
               focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
    >
        @include('svg.logo')
    </a>

    <nav class="hidden lg:block">
        <ul class="flex flex-row justify-between items-center space-x-4 text-sm">

            <li>
                <a 
                    href="#" 
                    class="py-2 px-4 rounded-full
                           text-sm/4 text-black 
                           transition ease-in-out duration-145
                           hover:text-primary
                           focus-visible:outline-primary focus-visible:outline-2 focus-visible:outline-offset-2"
                >
                    Over Moz Kids
                </a>
            </li>
            <li>
                <a 
                    href="#" 
                    class="py-2 px-4 rounded-full
                           text-sm/4 text-black 
                           transition ease-in-out duration-145
                           hover:text-primary
                           focus-visible:outline-primary focus-visible:outline-2 focus-visible:outline-offset-2"
                >
                    Activiteiten
                </a>    
            </li>
            <li>
                <a 
                    href="#" 
                    class="py-2 px-4 rounded-full
                           text-sm/4 text-black 
                           transition ease-in-out duration-145
                           hover:text-primary
                           focus-visible:outline-primary focus-visible:outline-2 focus-visible:outline-offset-2"
                >
                    Nieuws
                </a>
            </li>
            <li>
                <a 
                    href="#" 
                    class="py-2 px-4 rounded-full
                           text-sm/4 text-black 
                           transition ease-in-out duration-145
                           hover:text-primary
                           focus-visible:outline-primary focus-visible:outline-2 focus-visible:outline-offset-2"
                >
                    Contact
                </a>
            </li>

        </ul>
    </nav>

    <x-button :href="'#'">
        Doneer direct
        <x-slot:icon>
            @include('svg.arrow-right')
        </x-slot:icon>
    </x-button>


    <div class="block lg:hidden">
        <button
            type="button"
            class="p-4 text-black"
            data-made-sidebar-opener
        >
            @include('svg.menu-bars')
        </button>
    </div>
</div>