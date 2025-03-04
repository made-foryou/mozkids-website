@php
    use Made\Cms\Facades\Cms;
@endphp

@extends('templates.page', [])

@section('content')

    @if ($record && $record->content)

        {!! Cms::renderContentStrips($record->content) !!}
        
    @endif

@endsection