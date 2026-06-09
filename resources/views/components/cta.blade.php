@props([
    'href' => null,
    'color' => 'primary',
    'type' => 'button',
    'title' => null,
    'rel' => null,
])

@php
    $base = 'cta-button group relative inline-flex items-center gap-2.5
             pl-5 pr-5 py-3 rounded-full
             text-[12px] font-semibold tracking-[0.08em] uppercase
             overflow-hidden
             transition-[transform,box-shadow,background-color,color] duration-300 ease-out
             hover:-translate-y-0.5
             focus-visible:outline-2 focus-visible:outline-offset-2
             focus-visible:outline-primary-500';

    $variants = [
        'primary' => 'bg-primary-500 text-white
                      hover:shadow-[0_12px_28px_-8px_rgba(228,35,19,0.55)]',
        'secondary' => 'bg-transparent text-primary-500 ring-1 ring-primary-500/40
                        hover:bg-primary-500 hover:text-white hover:ring-primary-500
                        hover:shadow-[0_12px_28px_-8px_rgba(228,35,19,0.55)]',
        'white' => 'bg-white text-primary-500 ring-1 ring-secondary-900/5
                    hover:bg-primary-500 hover:text-white
                    hover:shadow-[0_12px_28px_-8px_rgba(228,35,19,0.55)]',
    ];
    $variantClass = $variants[$color] ?? $variants['primary'];
    $classes = $base . ' ' . $variantClass;
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        @if ($title) title="{{ $title }}" @endif
        @if ($rel) rel="{{ $rel }}" @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        <span class="cta-button__sheen absolute inset-0
                     bg-gradient-to-r from-transparent via-white/25 to-transparent
                     -translate-x-full
                     transition-transform duration-700 ease-out
                     group-hover:translate-x-full"></span>

        <span class="relative">{{ $slot }}</span>

        <span class="cta-button__arrow relative inline-flex translate-x-0
                     transition-transform duration-300 ease-out
                     group-hover:translate-x-1"
              aria-hidden="true">
            @include('svg.arrow-right')
        </span>
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}
    >
        <span class="cta-button__sheen absolute inset-0
                     bg-gradient-to-r from-transparent via-white/25 to-transparent
                     -translate-x-full
                     transition-transform duration-700 ease-out
                     group-hover:translate-x-full"></span>

        <span class="relative">{{ $slot }}</span>

        <span class="cta-button__arrow relative inline-flex translate-x-0
                     transition-transform duration-300 ease-out
                     group-hover:translate-x-1"
              aria-hidden="true">
            @include('svg.arrow-right')
        </span>
    </button>
@endif
