<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
  <defs>
    <symbol id="icon-search-1" viewBox="0 0 30 32">
      <title>search-1</title>
      <path d="M10.72 19.328l0.8 0.8q-0.896 0.896-2.72 2.752t-2.336 2.368l-0.864-0.864q0.512-0.48 2.368-2.336t2.752-2.72zM18.56 1.696q4.352 0 7.488 3.104t3.104 7.488-3.104 7.488-7.488 3.072q-2.048 0-3.936-0.768l-8.16 8.224-5.888-5.92 8.192-8.16q-0.832-2.016-0.832-3.936 0-4.384 3.136-7.488t7.488-3.104zM18.56 19.328q2.912 0 4.96-2.048t2.048-4.992-2.048-4.96-4.96-2.048-4.992 2.048-2.048 4.96 2.048 4.992 4.992 2.048z"></path>
    </symbol>
  </defs>
</svg>

<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
  <label>
    <span class="screen-reader-text">Busca:</span>
    <input class="search-field" placeholder="Busca" value="" name="s" type="search">
  </label>
  {{-- <input class="search-submit" value="&#xf002;" type="submit"> --}}
  <button type="submit" class="search-submit" type="submit">
    <svg class="icon icon-search-1"><use xlink:href="#icon-search-1"></use></svg>
</button>
</form>
