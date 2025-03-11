<div class="divide-y divide-white">
    @foreach ($items as $item) 

    @if ($item['type'] === 'text') 
        @if (count($items) > 1 && $loop->first)
            <div
                class="pt-0 pb-10
                    text-sm text-black font-sans
                    md:pb-12.5 @if ($isLeft()) md:mr-18 @else md:ml-18 @endif"
            >
        @elseif (count($items) > 1 && $loop->last)
        <div
            class="pb-0 pt-10
                text-sm text-black font-sans
                md:pt-12.5 @if ($isLeft()) md:mr-18 @else md:ml-18 @endif"
        >
        @else
        <div
            class="py-10
                text-sm text-black font-sans
                md:py-12.5 @if ($isLeft()) md:mr-18 @else md:ml-18 @endif"
        >
        @endif
            <span
                class="block
                    mb-4
                    text-xs text-primary font-sans tracking-wide uppercase
                    md:text-sm"
            >
                {{ $item['subtitle'] }}
            </span>

            <span data-highlightable >
                {!! $item['content'] !!}
            </span>

            @if (!empty($item['buttons']))

            <div
                class="mt-8 flex flex-row gap-4"
            >
                @foreach ($item['buttons'] as $button)
                    
                    <x-button :color="$button['color']" :href="Cms::url($button['website_link'])">
                        {{ $button['label'] }}
                        <x-slot:icon>
                            @include('svg.arrow-right')
                        </x-slot:icon>
                    </x-button>
                    
                @endforeach
            </div>

            @endif
        </div>
    @endif

    @if ($item['type'] === 'image')
        @php
            $image = $live ? asset("storage/{$item['image']}") : asset('storage/' . array_pop($item['image']));
        @endphp        

        <figure class="w-full h-full">
            <img src="{{ $image }}" alt="{{ $alt ?? '' }}" class="object-cover object-center rounded-lg w-full h-full" />
        </figure>
    @endif

    @endforeach
    </div>