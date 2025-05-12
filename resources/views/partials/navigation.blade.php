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

            @foreach ($items as $item)

            <li>
                <a
                    href="{{ Cms::url($item->linkable) }}"
                    title="{{ $item->linkable->meta->title }}"
                    class="py-2 px-4 rounded-full
                           text-sm/4 text-black
                           transition ease-in-out duration-145
                           hover:text-primary
                           focus-visible:outline-primary focus-visible:outline-2 focus-visible:outline-offset-2"
                >
                    {{ $item->linkName }}
                </a>
            </li>

            @endforeach

        </ul>
    </nav>

    <div class="hidden lg:block">
        @if (!empty($donationPage))
        <x-button href="{{ Cms::url($donationPage) }}">
            Doneer direct
            <x-slot:icon>
                @include('svg.arrow-right')
            </x-slot:icon>
        </x-button>
        @endif
    </div>


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
