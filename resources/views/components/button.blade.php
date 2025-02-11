@php
/**
 * @var string $color The selected color for the button
 * @var string $type Button type value
 */    
@endphp

@switch ($color)
    @case('secondary')

        <button 
            type="{{ $type }}" 
            class="group
                   flex items-center 
                   bg-secondary cursor-pointer rounded-full shadow-xs
                   space-x-4 py-2 pl-6 pr-7
                   transition duration-245 ease-in-out
                   hover:bg-primary hover:text-white
                   focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary"
        >
            <span class="inline-block 
                         text-primary text-xs lg:text-sm font-sans tracking-wide font-semibold
                         group-hover:text-white">
                {{ $slot }}
            </span>
        </button>

    @break
    @default

        <button 
            type="{{ $type }}" 
            class="group
                flex items-center 
                bg-primary cursor-pointer rounded-full shadow-xs
                space-x-4 py-2 pl-6 pr-7
                transition duration-245 ease-in-out
                hover:bg-primary-darken hover:text-white
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
        >
            <span class="inline-block 
                        text-white text-xs lg:text-sm font-sans tracking-wide font-semibold">
                {{ $slot }}
            </span>
        </button>

    @break
@endswitch
