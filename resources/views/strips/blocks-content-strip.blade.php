@php
    $live = $live ?? false;
@endphp

<section
    class="relative
           py-12 w-full
           bg-secondary-500
           lg:py-18"
>
    <x-container
        class="max-w-6xl w-full"
    >
        <div class="text-center mb-15">
            <span
                class="block
                    border-b border-secondary-500
                    text-xs text-primary-500 font-sans tracking-wide uppercase leading-8.5
                    md:text-sm"
            >
                {{ $subtitle }}
            </span>
            <div
                class="text-center prose mx-auto"
                data-highlightable
            >
                {!! str($content)->sanitizeHtml() !!}
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-7">

            @foreach ($items as $item)

            @php
                $image = $live ? asset("storage/{$item['image']}") : asset('storage/' . array_pop($item['image']));
            @endphp

            <div>
                <img src="{{ $image }}" alt="{{ $item['title'] ?? '' }}" class="aspect-35/24 max-h-[240px] w-full object-cover object-center rounded-lg mb-7" />

                @if (isset($item['subtitle']) && strlen($item['subtitle']) > 0)
                <span
                    class="block text-xs text-primary-500 font-sans tracking-wide uppercase leading-8.5
                        md:text-sm"
                >
                    {{ $item['subtitle'] }}
                </span>
                @endif

                <h3 class="text-lg tracking-wide leading-8.5 mb-4">
                    {{ $item['title'] }}
                </h3>
                <div class="prose-sm">
                    {!! str($item['content'])->sanitizeHtml() !!}
                </div>
            </div>

            @endforeach

        </div>

    </x-container>
</section>
