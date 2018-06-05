{{--
  Template Name: Author page Template
--}}

@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  <div class="author-page">
    {!! get_avatar( get_the_author_meta('user_email') , 128 ) !!}
    <a class="author-facebook" href="https://www.facebook.com/eudes.bezerra.37" target="_blank">
      <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDYwLjczNCA2MC43MzMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYwLjczNCA2MC43MzM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNNTcuMzc4LDAuMDAxSDMuMzUyQzEuNTAyLDAuMDAxLDAsMS41LDAsMy4zNTN2NTQuMDI2YzAsMS44NTMsMS41MDIsMy4zNTQsMy4zNTIsMy4zNTRoMjkuMDg2VjM3LjIxNGgtNy45MTR2LTkuMTY3aDcuOTE0ICAgdi02Ljc2YzAtNy44NDMsNC43ODktMTIuMTE2LDExLjc4Ny0xMi4xMTZjMy4zNTUsMCw2LjIzMiwwLjI1MSw3LjA3MSwwLjM2djguMTk4bC00Ljg1NCwwLjAwMmMtMy44MDUsMC00LjUzOSwxLjgwOS00LjUzOSw0LjQ2MiAgIHY1Ljg1MWg5LjA3OGwtMS4xODcsOS4xNjZoLTcuODkydjIzLjUyaDE1LjQ3NWMxLjg1MiwwLDMuMzU1LTEuNTAzLDMuMzU1LTMuMzUxVjMuMzUxQzYwLjczMSwxLjUsNTkuMjMsMC4wMDEsNTcuMzc4LDAuMDAxeiIgZmlsbD0iIzAwNkRGMCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
    </a>
    <p class="author-description">{{ get_the_author_meta('description') }}</p>
    <h2 class="author-posts">Todos os posts de {{ get_the_author_meta('display_name') }} </h2>
  </div>

  @while(have_posts()) @php the_post() @endphp
    @include('partials.content')  
  @endwhile
@endsection
