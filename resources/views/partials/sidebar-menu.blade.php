<x-sidebar>
    <div
        class="flex shrink-0 items-center
               py-6"
    >
        @include('svg.logo')
    </div>
    <nav
        class="flex flex-1 flex-col"
    >
        <ul
            role="list"
            class="flex flex-1 flex-col gap-y-7"
        >

            <li>

                <ul
                    role="list"
                    class="-mx-2 space-y-1"
                >

                    @foreach ($items as $item)

                    <li>
                        <a href="{{ Cms::url($item->linkable) }}" class="group flex gap-x-3 rounded-md p-2 text-sm/6 text-black">
                            <span>{{ $item->linkName }}</span>
                        </a>
                    </li>

                    @endforeach

                </ul>

            </li>

            <li class="mt-auto">
                <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-indigo-200 hover:bg-indigo-700 hover:text-white">
                    <x-button>
                        Doneer direct

                        <x-slot:icon>
                            @include('svg.arrow-right')
                        </x-slot>
                    </x-button>
                </a>
            </li>

        </ul>
    </nav>
</x-sidebar>
