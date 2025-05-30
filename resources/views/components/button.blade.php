@php
/**
 * @var string $color The selected color for the button
 * @var string $type Button type value
 */    
@endphp

@switch ($color)
    @case('secondary')

        @if ($href !== null)

            <a
                href="{{ $href }}"
                title="{{ $title }}"
                rel="{{ $rel }}"
                class="group
                    inline-flex items-center 
                    bg-secondary-500 cursor-pointer rounded-full shadow-xs text-primary-500
                    space-x-4 py-2 pl-6 pr-7 lg:py-3
                    transition duration-245 ease-in-out
                    hover:bg-primary-500 hover:text-white
                    focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500"
            >
                <span class="inline-block 
                            text-primary-500 text-xs lg:text-sm font-sans tracking-wide font-semibold
                            group-hover:text-white">
                    {{ $slot }}
                </span>
                {{ $icon ?? '' }}
            </a>

        @else

            <button 
                type="{{ $type }}" 
                class="group
                    flex items-center 
                    bg-secondary-500 cursor-pointer rounded-full shadow-xs text-primary-500
                    space-x-4 py-2 pl-6 pr-7 lg:py-3
                    transition duration-245 ease-in-out
                    hover:bg-primary-500 hover:text-white
                    focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500"
            >
                <span class="inline-block 
                            text-primary-500 text-xs lg:text-sm font-sans tracking-wide font-semibold
                            group-hover:text-white">
                    {{ $slot }}
                </span>
                {{ $icon ?? '' }}
            </button>

        @endif

    @break
    @case('white')
        @if ($href !== null)

        <a
            href="{{ $href }}"
            title="{{ $title }}"
            rel="{{ $rel }}"
            class="group
                inline-flex items-center 
                bg-white cursor-pointer rounded-full shadow-xs text-primary-500
                space-x-4 py-2 pl-6 pr-7 lg:py-3
                transition duration-245 ease-in-out
                hover:bg-primary-500 hover:text-white
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500"
        >
            <span class="inline-block 
                        text-primary-500 text-xs lg:text-sm font-sans tracking-wide font-semibold
                        group-hover:text-white">
                {{ $slot }}
            </span>
            {{ $icon ?? '' }}
        </a>

    @else

        <button 
            type="{{ $type }}" 
            class="group
                flex items-center 
                bg-white cursor-pointer rounded-full shadow-xs text-primary
                space-x-4 py-2 pl-6 pr-7 lg:py-3
                transition duration-245 ease-in-out
                hover:bg-primary hover:text-white
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500"
        >
            <span class="inline-block 
                        text-primary text-xs lg:text-sm font-sans tracking-wide font-semibold
                        group-hover:text-white">
                {{ $slot }}
            </span>
            {{ $icon ?? '' }}
        </button>

    @endif
    @break
    @default
    
        @if ($href !== null)

            <a 
                href="{{ $href }}"
                title="{{ $title }}"
                rel="{{ $rel }}"
                class="group
                    inline-flex items-center 
                    bg-primary-500 cursor-pointer rounded-full shadow-xs text-white
                    space-x-4 py-2 pl-6 pr-7 lg:py-3
                    transition duration-245 ease-in-out
                    hover:bg-primary-700
                    focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
            >
                <span class="inline-block 
                            text-white text-xs lg:text-sm font-sans tracking-wide font-semibold">
                    {{ $slot }}
                </span>
                {{ $icon ?? '' }}
            </a>

        @else

            <button 
                type="{{ $type }}" 
                class="group
                    flex items-center 
                    bg-primary-500 cursor-pointer rounded-full shadow-xs text-white
                    space-x-4 py-2 pl-6 pr-7 lg:py-3
                    transition duration-245 ease-in-out
                    hover:bg-primary-700
                    focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
            >
                <span class="inline-block 
                            text-white text-xs lg:text-sm font-sans tracking-wide font-semibold">
                    {{ $slot }}
                </span>
                {{ $icon ?? '' }}
            </button>

        @endif

    @break
@endswitch
