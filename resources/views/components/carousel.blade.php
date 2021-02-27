<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" :style="carouselStyle">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      @foreach ($filmesSorteados as $key => $filme)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key+1 }}" aria-label="Slide {{ $key+2 }}"></button>
      @endforeach
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img 
          src="https://image.tmdb.org/t/p/w500{{ $lista[$filmePrincipal]['backdrop_path'] ?? '' }}" 
          v-on:click="redirect({{ $lista[$filmePrincipal]['id'] ?? '' }})" 
          class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <h5>{{ $lista[$filmePrincipal]['title'] ?? '' }}</h5>
          <p>{{ mb_strimwidth($lista[$filmePrincipal]['overview'],0,200,'...')  ?? '' }}</p>
        </div>
      </div>
      @foreach ($filmesSorteados as $filme)
        <div class="carousel-item">
          <img 
            src="https://image.tmdb.org/t/p/w500{{ $lista[$filme]['backdrop_path'] ?? '' }}" 
            v-on:click="redirect({{ $lista[$filme]['id'] ?? '' }})"
            class="d-block w-100">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{ $lista[$filme]['title'] ?? '' }}</h5>
            <p>{{ mb_strimwidth($lista[$filme]['overview'],0,200,'...')  ?? '' }}</p>
          </div>
        </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>
  </div>