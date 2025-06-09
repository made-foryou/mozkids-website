<div class="flex flex-col items-stretch space-y-15
            sm:flex-row sm:items-start sm:space-x-5.5">
    <div class="sm:w-1/3">
        <x-footer-title>
            Contactgegevens
        </x-footer-title>
        <span class="inline-block w-full text-primary-500 text-xs lg:text-sm font-sans font-bold">
            Adres
        </span>
        <span class="inline-block w-full text-black text-xs/4 lg:text-sm/5.5 font-sans">
            {{ $address->address }}<br />
            {{ $address->zipcode }}, {{ $address->city }}<br />
            {{ $address->country }}
        </span>
        <div class="mt-7.5 space-y-2.5">
            <x-button :color="'secondary'" :href="'tel:' . $contact->phoneNumber">
                {{ $contact->phone }}
            </x-button>
            <x-button :href="'mailto:'.$contact->email">
                {{ $contact->email }}
            </x-button>
        </div>
    </div>

    <div class="sm:w-1/3">
        <x-footer-title>
            Blijf op de hoogte
        </x-footer-title>
        <div class="flex flex-col justify-start space-y-3.5">
            <a class="block flex items-center space-x-2" href="{{ $instagram->url }}" rel="nofollow" target="_blank">
                <x-round-button>
                    @include('svg.instagram')
                </x-round-button>
                <span class="inline-block text-xs lg:text-sm font-sans font-light">
                    {{ $instagram->account }}
                </span>
            </a>
        </div>
    </div>

    <div class="sm:w-1/3">
        <x-footer-title>
            Financiële gegevens
        </x-footer-title>
        <div class="space-y-4">
            <div>
                <span class="inline-block w-full text--500 text-xs lg:text-sm font-sans font-bold">
                    {{ $bankAccount->label }}
                </span>
                <span class="inline-block w-full text-black text-xs/4 lg:text-sm/5.5 font-sans">
                    {{ $bankAccount->account }}
                </span>
            </div>
            <div>
                <span class="inline-block w-full text-primary-500 text-xs lg:text-sm font-sans font-bold">
                    {{ $sinAccount->label }}
                </span>
                <span class="inline-block w-full text-black text-xs/4 lg:text-sm/5.5 font-sans">
                    {{ $sinAccount->account }}
                </span>
            </div>
            <div>
                <span class="inline-block w-full text-primary-500 text-[0.6rem] lg:text-xs font-sans font-light">
                    Giften aan Moz Kids zijn fiscaal aftrekbaar.
                </span>
            </div>
        </div>
        <div class="mt-7.5">
            @include('svg.anbi')
        </div>
    </div>
</div>
<div class="flex flex-row justify-between items-center
            text-black text-[0.6rem] font-sans font-light
            sm:pt-6.5 sm:border-t sm:border-secondary-500 sm:mt-10">
    <div class="space-x-4">
        @foreach ($items as $item)

            <a
                href="{{ Cms::url($item->linkable) }}"
                title="{{ $item->linkable->meta->title }}"
                rel="{{ implode(' ', $item->rel) }}"
                class="underline-offset-4 hover:underline"
            >
                {{ $item->linkName }}
            </a>

        @endforeach
    </div>
    <div>
        <a href="https://fourdesign.nl" rel="nofollow" target="_blank">
            Design Fourdesign
        </a>
        <a href="https://made-foryou.nl" rel="nofollow" target="_blank" class="hidden sm:inline-block">
            & ontwikkeling Made
        </a>
        &copy; Mozkids {{ now()->format('Y')}}
    </div>
</div>
