@extends('master')

@section('title')
@endsection

@section('body')
    @if($city ?? false)
        {{ $city }}
    @else
        No city is selected
    @endif

    {{--{{ dd($forecast) }}--}}
@endsection