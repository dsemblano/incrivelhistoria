<p class="byline author vcard">
  {{ __('Publicado por ', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">
    {{ get_the_author() }}
  </a>
  <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
  @if (get_the_date()!=get_the_modified_date())
  {{", atualizado em"}}
    <time class="updated" datetime="{{ get_the_modified_time('c', true) }}">{{ get_the_modified_date() }}</time>
  @endif

</p>
