<img 
    src="https://image.tmdb.org/t/p/w500{{ $filme['poster_path'] }}"
    alt="{{ $filme['original_title'] }}"
    :style="cardStyle"
    v-on:click="redirect({{ $filme['id'] }})"
    class="img-thumbnail"
    data-bs-trigger="hover"
    data-bs-toggle="popover"
    title="{{ $filme['title'] }}"
    data-bs-content="{{ mb_strimwidth($filme['overview'],0,500,'...')  }}
        Lançamento: {{ implode("-",array_reverse(explode("-",$filme['release_date'] ?? ''))) }}"
/>