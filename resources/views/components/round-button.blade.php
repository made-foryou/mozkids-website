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
            class="flex items-center 
                   bg-secondary-500 cursor-pointer rounded-full shadow-xs
                   size-8
                   transition duration-245 ease-in-out
                   hover:bg-secondary-700 hover:text-white
                   focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500"
        >
            {{ $slot }}
        </button>

    @break
    @default

        <button 
            type="{{ $type }}" 
            class="flex items-center justify-center 
                   bg-primary-500 cursor-pointer rounded-full shadow-xs text-white
                   size-8
                   transition duration-245 ease-in-out
                   hover:bg-primary-700
                   focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
        >
            {{ $slot }}
        </button>

    @break
@endswitch
