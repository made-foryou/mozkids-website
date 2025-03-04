@php
    use Made\Cms\Facades\Cms;
@endphp

@extends('templates.page', [])

@section('content')

    @if ($content)

        {!! Cms::renderContentStrips($content) !!}
        
    @endif

@endsection