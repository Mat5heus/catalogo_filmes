@extends('layouts.app')

@section('title', "busca por ".$query)

@section('content')
    <div class="d-flex flex-column bd-highlight mb-3" id="containerFilmes" v-bind:style="containerStyle">
        <h1 class="p-2 bd-highlight" :style="titleStyle">Buscar</h1>
        <h6 class="p-2 bd-highlight" :style="subtitleStyle">Foram encontrados {{ $result['total_results'] }} resultados na sua busca</h6>
        <div class="row d-flex justify-content-center">
            @foreach ($result['results'] as $filme)
                @include('_partials.imgThumbnail')
            @endforeach
        </div>
        <div class="p-2 bd-highlight">
            @include('components.pagination')
        </div>
    </div>
    @include('_partials.vueContainer')
@endsection