@php
    $live = $live ?? false;

    // Detecteer of een van beide kolommen een donatie-formulier bevat. De
    // tegenoverliggende kolom wordt dan sticky zodat de korte inhoud naast
    // het lange formulier in beeld blijft tijdens scrollen.
    $hasDonation = fn (array $columns): bool => collect($columns)
        ->contains(fn ($item) => ($item['type'] ?? null) === 'donation-form');

    $leftHasDonation = $hasDonation($left_columns ?? []);
    $rightHasDonation = $hasDonation($right_columns ?? []);
    $anyDonation = $leftHasDonation || $rightHasDonation;
@endphp

<section class="two-columns-strip relative
                w-full
                py-8 lg:py-12">

    <x-container class="max-w-6xl grid md:grid-cols-2 gap-10 md:gap-12 lg:gap-16
                        {{ $anyDonation ? 'items-start' : 'items-center' }}">

        <div data-reveal="slide-right"
             class="{{ $rightHasDonation ? 'md:sticky md:top-28 self-start' : '' }}"
             style="--reveal-delay: 0ms">
            <x-column :items="$left_columns" side="left" :live="$live" />
        </div>

        <div data-reveal="slide-left"
             class="{{ $leftHasDonation ? 'md:sticky md:top-28 self-start' : '' }}"
             style="--reveal-delay: 140ms">
            <x-column :items="$right_columns" side="right" :live="$live" />
        </div>

    </x-container>
</section>
