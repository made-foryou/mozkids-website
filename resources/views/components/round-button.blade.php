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
                   bg-secondary cursor-pointer rounded-full shadow-xs
                   size-8
                   transition duration-245 ease-in-out
                   hover:bg-secondary-dark hover:text-white
                   focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary"
        >
            {{ $slot }}
        </button>

    @break
    @default

        <button 
            type="{{ $type }}" 
            class="flex items-center justify-center 
                   bg-primary cursor-pointer rounded-full shadow-xs text-white
                   size-8
                   transition duration-245 ease-in-out
                   hover:bg-primary-dark
                   focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
        >
            {{ $slot }}
        </button>

    @break
@endswitch
