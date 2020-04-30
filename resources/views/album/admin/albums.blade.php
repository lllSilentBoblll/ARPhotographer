@extends('album.layouts.admin')

<!-- admin menu -->
@section('navbar')
    @include('album.admin.navbar')
@endsection
<!-- admin menu -->

<!-- albums list -->
@section('albumsTable')
    {!! $albumsTable !!}
@endsection
<!-- albums list -->
