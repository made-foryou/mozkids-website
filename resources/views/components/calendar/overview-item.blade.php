<div {{ $attributes->merge(['class' => 'block bg-white rounded-lg overflow-hidden flex flex-col lg:flex-row justify-start items-stretch']) }}>
    
    <div class="lg:w-2/3 order-2 lg:order-1 py-8 px-6 lg:py-13 lg:px-12">

        <span class="block uppercase text-primary-500 font-sans text-sm">
            {{ $item->start_date->translatedFormat('d F Y') }}

        @if (!empty($item->end_date))
        
            tot en met {{ $item->end_date->translatedFormat('d F Y') }}

        @endif

        </span>

        <span class="block mt-2 text-black font-sans tracking-wide text-lg lg:text-xl">
            {{ $item->name }}
        </span>

        <div>
            {!! str($item->description)->sanitizeHtml() !!}
        </div>

    </div>
    <div class="lg:w-1/3 order-1 lg:order-2">
        <figure class="w-full h-full">
            {{ $item->getFirstMedia('image')  }}
        </figure>
    </div>

</div>
