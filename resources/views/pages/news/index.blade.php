@extends('templates.page', [
    'meta' => $model->meta,
    'donation_button' => $donation_button,
])

@php
    use Made\Cms\Facades\Cms;
@endphp

@section('content')

    @include('strips.hero-strip', ['content' => 'Nieuwsberichten', 'buttons' => [], 'heading' => true, 'heading_number' => '1'])

    @include('partials.news.overview', ['paddingTop' => false, 'posts' => $posts])

    @if ($model && $model->content)

        {!! Cms::renderContentStrips($model->content) !!}
        
    @endif

@endsection
