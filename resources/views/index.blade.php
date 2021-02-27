@extends('layouts.app')

@section('title', "Próximos lançamentos")

@section('content')
    <style>
        html, body {
            width: 100.5%;
            overflow-x: hidden;
            overflow-y: scroll;
        }
    </style>
    <div class="d-flex flex-column bd-highlight mb-3" id="containerFilmes" >
        <div class="p-2 bd-highlight bg-dark text-white" :style="carouselContainerStyle">
            @include('components.carousel')
        </div>
        <h1 class="p-2 bd-highlight" :style="titleStyle">Catálogo</h1>
        <div class="row d-flex justify-content-center" :style="containerStyle">
            @foreach ($lista as $filme)
                @include('_partials.imgThumbnail')
            @endforeach
        </div>
        <div class="p-2 bd-highlight">
            @include('components.pagination')
        </div>
    </div>
    @include('_partials.vueContainer')
@endsection
