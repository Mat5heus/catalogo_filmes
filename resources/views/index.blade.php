@extends('layouts.app')

@section('title', "Próximos lançamentos")

@section('content')
    <style>
        html, body {
            overflow-x: hidden;
            overflow-y: scroll;
        }
    </style>
    <div class="d-flex flex-column bd-highlight mb-3 justify-content-center" id="containerFilmes" >
        {{-- <div class="p-3 mb-2 ">.bg-dark</div> --}}
        <div class="p-2 bd-highlight bg-dark text-white" :style="carouselStyle">
            @include('components.carousel')
        </div>
        <h1 class="p-2 bd-highlight" :style="titleStyle">Catálogo</h1>
        <div class="container-sm" :style="containerStyle">
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
