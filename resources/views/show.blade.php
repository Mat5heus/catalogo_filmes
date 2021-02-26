@extends('layouts.app')

@section('title', $filme['title'])

@section('content')
    <style>
        body {
            background-image: url("https://image.tmdb.org/t/p/original{{ $filme['backdrop_path'] }}");
            background-color: #1d1c1c;
            background-size: cover;
            background-repeat: no-repeat;
        } 
        #overview{
            overflow-x: auto;
        }
        :root{
            --border-radius: 20px;
        }
        /* width */
        ::-webkit-scrollbar {
            width: 9px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: rgb(226, 223, 223, 0.1); 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(161, 206, 248, 0.6); 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(73, 167, 243); 
            border-radius: var(--border-radius);
        }
    </style>
  
    <div id="filter" v-bind:style="filterStyle">
        <div class="container-lg" id="texto" v-bind:style="textStyle">
            <h1>{{ $filme['title'] }}</h1>
            <p v-bind:style="sinopse" id="overview">{{ $filme['overview'] }}</p>
            <p>
                <span v-bind:style="additional">
                    <b>Lançamento: </b>{{ implode("/",array_reverse(explode("-",$filme['release_date']))) }}
                </span>
                <span v-bind:style="additional">
                    <b>Gênero(s): </b>{{ implode(', ',$filme['genre_ids']) }}
                </span>
                <span v-bind:style="additional">
                    <b>Nota: </b>{{ $filme['vote_average'] }} ({{ $filme['vote_count'] }})
                </span>
                <span v-bind:style="additional">
                    <b>Nome Original: </b>{{ $filme['original_title'] }}
                </span>
                <span v-bind:style="additional">
                    {{ $filme['adult'] ? "<b>Classificação:</b> +18": "" }}
                </span>
            </p>
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
                },
                sinopse: {
                    maxHeight:  (window.innerHeight / 5)+"px"
                },
                additional: {
                    paddingRight: 20+'px'
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
    @include('_partials.addFavoritos')
@endsection