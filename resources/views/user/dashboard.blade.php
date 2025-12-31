@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

@include('inclode.home_picture')
@auth
    @include('inclode.mycourse')
@endauth

@include('inclode.track_famous_courses')

@endsection
