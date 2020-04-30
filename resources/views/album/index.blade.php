@extends('album.layouts.site')

@section('header')
    @include('album.header')
@endsection

@section('photosGallery')
    {!! $photosGallery !!}
@endsection

@section('footer')
    @include('album.footer')
@endsection
