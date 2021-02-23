@extends('layouts.app')

@section('title', "Próximos lançamentos")

@section('content')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <h1>Próximos Lançamentos</h1>
    @foreach ($lista as $pages)
        @foreach ($pages['results'] as $filme)
            <div class="container-sm">
                <img style="height: 280px; width:190px; float:left; margin-left: 5px" 
                    src="https://image.tmdb.org/t/p/w500/{{ $filme['poster_path'] }}" 
                    alt="{{ $filme['original_title'] }}" 
                    class="img-thumbnail"
                    data-bs-trigger="hover"
                    data-bs-toggle="popover" 
                    title="{{ $filme['title'] }}" 
                    data-bs-content="{{ mb_strimwidth($filme['overview'],0,500,'...')  }} Lançamento: {{ implode("-",array_reverse(explode("-",$filme['release_date']))) }}"
                >
            </div>
        @endforeach
    @endforeach
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        var popover = new bootstrap.Popover(document.querySelector('.example-popover'), {
            trigger: 'hover'
        })
    </script>
    
@endsection
