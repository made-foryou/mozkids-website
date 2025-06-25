@props([
    'item'
])

<div class="bg-white rounded-xl py-8 px-7">
    <div class="prose">
        <span
            class="block
                mb-4
                text-xs text-primary-500 font-sans tracking-wide uppercase
                md:text-sm"
        >
            Bank
        </span>
        <h2 class="mb-6 font-bold text-lg">
            Financiële gegevens
        </h2>
        @foreach ($item['accounts'] as $account)
            <p>
                <strong>{{ $account->label }}</strong><br />
                {{ $account->account }}
            </p>
        @endforeach
        <p class="text-xs">
            Giften aan Moz Kids zijn fiscaal aftrekbaar.
        </p>
        <div class="mt-7.5">
            @include('svg.anbi')
        </div>
    </div>
</div>
