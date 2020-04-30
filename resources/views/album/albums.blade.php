@extends('album.layouts.site')

@section('header')
    @include('album.header')
@endsection

@section('albumsGallery')
    {!! $albumsGallery !!}
@endsection

@section('footer')
    @include('album.footer')
@endsection

