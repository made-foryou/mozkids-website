@extends('templates.page', [
    'meta' => $model->meta,
    'donation_button' => $donation_button,
])

@php
    use Made\Cms\Facades\Cms;
@endphp

@section('content')

    @if ($model && $model->content)

        {!! Cms::renderContentStrips($model->content) !!}
        
    @endif

@endsection
