@extends('album.layouts.site')

@section('header')
    @include('album.header')
@endsection

@section('albumContent')
    {!! $albumContent !!}
@endsection

@section('footer')
    @include('album.footer')
@endsection
