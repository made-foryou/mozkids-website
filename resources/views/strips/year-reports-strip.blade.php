@php
    $live = $live ?? false;
@endphp

<section
    class="relative
           w-full"
>
    <x-container class="flex flex-col justify-center items-center w-full pt-12 lg:pt-18 max-w-6xl">

        <div class="text-center mb-6">
            <span
                class="block
                    border-b border-secondary-500
                    text-xs text-primary-500 font-sans tracking-wide uppercase leading-8.5
                    md:text-sm"
            >
                {{ $subtitle }}
            </span>
            <span
                class="text-2xl tracking-wide font-bold"
                data-highlightable
            >
                {{ $title }}
            </span>
        </div>

    </x-container>
</section>
<section class="relative w-full pb-25">
    <x-container class="max-w-6xl py-6 lg:py-8">

    @foreach ($reports as $year => $entries)

        <span class="text-black font-sans block tracking-wide font-semibold text-xl lg:text-2xl">
            {{ $year }}
        </span>
        <div class="mt-7 flex flex-col gap-6 mb-8">

        @foreach ($entries as $entry)

            @php
                $file = $live ? asset("storage/{$entry->file}") : asset('storage/' . array_pop($entry->file));
            @endphp

            <div class="bg-white rounded-lg overflow-hidden flex flex-col lg:flex-row justify-start items-stretch">
                <div class="lg:w-2/3 order-2 lg:order-1 py-8 px-6 lg:py-13 lg:px-12">
                    <span class="block uppercase text-primary-500 font-sans text-sm">
                        {{ $entry->year }}
                    </span>
                    <span class="block mt-2 text-black font-sans tracking-wide text-lg lg:text-xl">
                        {{ $entry->title }}
                    </span>
                    <div class="prose-sm mb-6">
                        {!! str($entry->description)->sanitizeHtml() !!}
                    </div>
                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                        <li class="flex items-center justify-between py-4 pr-5 pl-4 text-sm/6">
                            <div class="flex w-0 flex-1 items-center">
                                <svg class="size-5 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 0 0-4.242 0l-7 7a3 3 0 0 0 4.241 4.243h.001l.497-.5a.75.75 0 0 1 1.064 1.057l-.498.501-.002.002a4.5 4.5 0 0 1-6.364-6.364l7-7a4.5 4.5 0 0 1 6.368 6.36l-3.455 3.553A2.625 2.625 0 1 1 9.52 9.52l3.45-3.451a.75.75 0 1 1 1.061 1.06l-3.45 3.451a1.125 1.125 0 0 0 1.587 1.595l3.454-3.553a3 3 0 0 0 0-4.242Z" clip-rule="evenodd" />
                                </svg>
                                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                    <span class="truncate font-medium">{{ $entry->file }}</span>
                                    <span class="shrink-0 text-gray-400">{{ $entry->fileSize }}</span>
                                </div>
                            </div>
                            <div class="ml-4 shrink-0">
                                <a href="{{ $file }}" target="_blank" class="font-medium text-primary-500 hover:text-primary-400">
                                    Download
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        @endforeach

        </div>

    @endforeach

    </x-container>
</section>
