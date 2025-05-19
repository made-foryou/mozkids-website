@props([
    'item'
])

<div class="bg-white rounded-xl py-8 px-7">
    <div>
        <span
            class="block
                mb-4
                text-xs text-primary-500 font-sans tracking-wide uppercase
                md:text-sm"
        >
            Contact
        </span>
        <h2 class="mb-6">
            Contactgegevens
        </h2>
        <p>
            <strong>Post adres</strong><br />
            {{ $item['address']->address }}<br />
            {{ $item['address']->zipcode }}, {{ $item['address']->city }}<br />
            {{ $item['address']->country }}
        </p>
        <p>
            <strong>Telefoonnummer</strong><br />
            <a href="tel:{{ $item['contact']->phoneNumber }}">{{ $item['contact']->phone ?? $item['contact']->phoneNumber }}</a>
        </p>
        <p>
            <strong>E-mailadres</strong><br />
            <a href="mailto:{{ $item['contact']->email }}">{{ $item['contact']->email }}</a>
        </p>
        <h2 class="mt-12 mb-6">
            Volg ons
        </h2>
        <strong class="block mb-4">Social media</strong>
        <div class="flex flex-col justify-start gap-4 space-y-3.5">
        @foreach ($item['social'] as $account)
            <a class="block flex items-center space-x-2" href="{{ $account->url }}" rel="nofollow" target="_blank">
                <x-round-button>
                    @include('svg.' . $account->key)
                </x-round-button>
                <span class="inline-block text-xs lg:text-sm font-sans font-light">
                    {{ $account->account }}
                </span>
            </a>
        @endforeach
        </div>
    </div>
</div>
