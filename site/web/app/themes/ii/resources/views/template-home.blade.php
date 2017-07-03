{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    {{-- @include('partials.page-header') --}}
    @include('partials.content-page')
    @include('partials.home-slideshow')
    @include('partials.home-curiosidadeselistas')
    @include('partials.home-mais')
  @endwhile
@endsection
