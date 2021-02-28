@extends('layouts.app')

@section('title', "Favoritos")

@section('content')    
    <div class="d-flex flex-column bd-highlight mb-3" id="containerFilmes" :style="containerStyle">
        <h1 class="p-2 bd-highlight" :style="titleStyle">Favoritos</h1>
        <div class="row d-flex justify-content-center">
            <img :src="'https://image.tmdb.org/t/p/w500'+movie.poster_path" 
                :alt="movie.name"
                v-for="(movie) in page"
                class="img-thumbnail"
                :style="cardStyle"
                v-on:click="redirect(movie.id)"
                data-bs-trigger="hover"
                data-bs-toggle="popover" 
                :title="movie.name" 
                :data-bs-content="movie.overview+
                ' Lançamento: '+movie.release_date">
        </div>
    </div>
    @include('_partials.vueContainer')
@endsection
