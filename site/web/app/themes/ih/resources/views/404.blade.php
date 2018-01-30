@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Desculpe, mas a página não existe.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  {!! get_the_posts_navigation() !!}
@endsection
