@extends('album.layouts.admin')

<!-- admin menu -->
@section('navbar')
    @include('album.admin.navbar')
@endsection
<!-- admin menu -->

<!-- create/edit form -->
@section('albumCreateOrEditContent')
    {!! $createOrEditContent !!}
@endsection
<!-- create/edit form -->

