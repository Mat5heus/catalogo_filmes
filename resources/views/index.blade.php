@extends('layouts.app')

@section('title', "Próximos lançamentos")

@section('content')
    <div class="container" id="containerFilmes" v-bind:style="containerStyle">
        <h1>Próximos Lançamentos</h1>
        @foreach ($lista as $filme)
            <div class="container-sm">
                <a href="{{ route('catalogo.show', $filme['id']) }}">
                    <img style="height: 280px; width:190px; float:left; margin-left: 5px" 
                        src="https://image.tmdb.org/t/p/w500/{{ $filme['poster_path'] }}" 
                        alt="{{ $filme['original_title'] }}" 
                        class="img-thumbnail"
                        data-bs-trigger="hover"
                        data-bs-toggle="popover" 
                        title="{{ $filme['title'] }}" 
                        data-bs-content="{{ mb_strimwidth($filme['overview'],0,500,'...')  }} 
                            Lançamento: {{ implode("/",array_reverse(explode("-",$filme['release_date']))) }}"
                            {{-- Genero: {{ $filme['genre_ids'] }}" --}}
                    >
                </a>
            </div>
        @endforeach
    </div>
    @include('components.pagination')
    @include('_partials.vueContainer')
    
@endsection
