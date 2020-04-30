@extends('album.layouts.admin')

<!-- admin menu -->
@section('navbar')
    @include('album.admin.navbar')
@endsection
<!-- admin menu -->

<!-- posts list -->
@section('postsTable')
    {!! $postsTable !!}
@endsection
<!-- posts list -->

