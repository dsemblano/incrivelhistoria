@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  {{-- @if (!have_posts()) --}}
    <div class="alert">
      {{ __('Desculpe, a página acessada não existe. Por favor faça uma nova busca, use um dos links da página ou clique na imagem abaixo para ir na página principal ', 'sage') }}
      <a href="{{ home_url('/') }}">
        <img id="notfound" src="@asset('images/notfound.jpg')" alt="404 página não encontrada" title="Ir para a Home" />
      </a>
    </div>
  {{-- @endif --}}
@endsection
