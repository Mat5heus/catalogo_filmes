@extends('layouts.app')

@section('title', $filme['title'])

@section('content')
    <style>
        body {
            background-image: url("https://image.tmdb.org/t/p/original/{{ $filme['backdrop_path'] }}");
            background-color: #1d1c1c;
            background-size: cover;
            background-repeat: no-repeat;
        } 
    </style>
  
    <div id="filter" v-bind:style="filterStyle">
        <div class="container-lg" id="texto" v-bind:style="textStyle">
            <h1>{{ $filme['title'] }}</h1>
            <p>{{ $filme['overview'] }}</p>
            <p><b>Lançamento: </b>{{ implode("/",array_reverse(explode("-",$filme['release_date']))) }}</p>
        </div>
    </div>
    <div id="marcaDaAgua" v-bind:style="marcaStyle">
        <h3>Catálogo Filmes</h3>
    </div>
    <script>
        let texto = new Vue({
            el: '#texto',
            data: {
                textStyle: {
                    marginLeft: '5%',
                    paddingTop: (window.innerHeight / 2)+"px"
                }
            }
        })
        let filtro = new Vue({
            el: '#filter',
            data:{
                filterStyle: {
                    backgroundColor: 'rgb(0, 0, 0, 0.5)',
                    width: '100%',
                    height: (window.innerHeight - 56.1)+"px",
                    color: 'white'
                }
            }
        })
        let marcaAgua = new Vue({
            el: '#marcaDaAgua',
            data: {
                marcaStyle: {
                    position: 'absolute',
                    opacity: '0.4',
                    color: 'rgb(220,220,220)',
                    bottom: 0,
                    right: 2+'px'
                }
            }
        })
    </script>
@endsection