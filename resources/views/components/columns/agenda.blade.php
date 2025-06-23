<div class="bg-white rounded-xl py-4 px-7">
    <span
        class="block
            mb-9 pb-3
            border-b border-secondary-500
            text-xs text-primary-500 font-sans tracking-wide uppercase leading-8.5
            md:text-sm"
    >
        Activiteitenagenda
    </span>
    <div class="divide-y divide-secondary-500 border-b border-secondary-500">
        @foreach ($items as $item)

        <div class="pb-9.5">
            <span class="block text-xs text-dark font-sans leading-5.5 mb-3.5 md:text-sm">
                 {{ $item->start_date->translatedFormat('d F Y') }}

                @if (!empty($item->end_date))

                    tot en met {{ $item->end_date->translatedFormat('d F Y') }}

                @endif
            </span>
            <span class="block text-base md:text-lg text-dark mb-3.5 font-sans tracking-wide">
                {{ $item->name }}
            </span>
            <span class="block text-xs md:text-sm text-dark leading-5.5 font-sans">
                {!! substr(strip_tags($item->description), 0, 100) !!}
            </span>
        </div>

        @endforeach
    </div>
    <a href="/activiteiten" class="flex flex-row justify-between items-center w-full pt-5.5 text-xs text-dark font-semibold leading-5.5 font-sans">
        <span class="inline-block">Bekijk de volledige activiteitenagenda</span>
        <figure class="inline-block">
            @include('svg.arrow-right')
        </figure>
    </a>
</div>
