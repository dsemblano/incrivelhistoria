@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-single-'.get_post_type())
    @include('partials.kaduads')
    {!! do_shortcode('[crp limit="6" heading="1" cache="1"]') !!}
  @endwhile
@endsection
