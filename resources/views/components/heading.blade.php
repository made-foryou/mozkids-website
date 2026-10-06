{{--
    Titel met een instelbaar HTML-kopniveau. Het niveau bepaalt alleen de tag;
    de opmaak komt volledig uit de meegegeven classes.

    <x-heading :level="$title_level" class="...">{{ $title }}</x-heading>
--}}
@props([
    'level' => null,
    'fallback' => 'span',
])

@php
    $tag = \App\Enums\HeadingLevel::resolve($level)->tag($fallback);
@endphp

<{{ $tag }}{!! $attributes->isNotEmpty() ? ' ' . $attributes : '' !!}>{{ $slot }}</{{ $tag }}>
