<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
  <label>
    <span class="screen-reader-text">Busca:</span>
    <input class="search-field" placeholder="Busca" value="" name="s" type="search">
  </label>
  {{-- <input class="search-submit" value="&#xf002;" type="submit"> --}}
  <button type="submit" class="search-submit" type="submit">
    <i class="fas fa-search"></i>
</button>
</form>
