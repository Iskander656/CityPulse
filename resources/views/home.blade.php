@extends('layouts.app')

@section('title', 'Homepage')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home/homepage.css') }}">
@endpush

@section('content')
    {{-- NAVBAR --}}
    @include('layouts.navbar')

    {{-- HERO --}}
    @include('layouts.hero')
    {{-- ABOUT --}}
    @include('layouts.about')


    {{-- SERVICES --}}
    @include('layouts.services')

    {{-- HOW IT WORKS --}}
    @include('layouts.howitworks')


    {{-- CTA --}}
    @include('layouts.cta')


    {{-- FOOTER --}}
    @include('layouts.footer')
@endsection
