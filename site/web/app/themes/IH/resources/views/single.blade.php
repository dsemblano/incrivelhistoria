@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-single-'.get_post_type())
    {!! do_shortcode('[crp limit="6" heading="1" cache="1"]') !!}
  @endwhile
@endsection