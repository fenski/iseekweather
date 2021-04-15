@extends('master')

@section('title')
    @if($city ?? false)
        {{ $city }}
    @else
        No city is selected
    @endif
@endsection

@section('body')
    <div id="root"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/weather.js') }}"></script>
@endsection