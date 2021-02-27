<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('index') }}">Catálogo Filmes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ $home ?? '' }}" aria-current="page" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $favoritos ?? ''}}" href="{{ route('favorites') }}">Favoritos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gêneros
            </a>
            <ul class="dropdown-menu disabled" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Ação</a></li>
              <li><a class="dropdown-item" href="#">Aventura</a></li>
              <li><a class="dropdown-item" href="#">Terror</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">(Still not working)</a></li>
            </ul> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="AddFavoritos" v-on:click="exec" v-html="favoritosMessage" tabindex="-1"></a>
          </li>
        </ul>
        <form class="d-flex" method="GET" action="{{ route('search',1) }}">
          <input class="form-control me-2" value="{{ $query ?? ''}}" name="query" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  