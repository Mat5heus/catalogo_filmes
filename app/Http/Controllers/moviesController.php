<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class moviesController extends Controller
{   
    protected $apiKey;
    public $apiRef;

    function __construct()
    {
        $this->apiKey = env('API_KEY', false);
        $this->apiRef = 'https://api.themoviedb.org/3';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $lista = $this->arraySort($this->requestPage());

        #Salva os dados para consulta posterior
        session(['pages' => $lista]);

        return view('index', [
             'lista' => $lista
        ]);
    }

    Protected function arraySort($lista) {
        usort($lista, function ($element1, $element2) { 
            $datetime1 = strtotime($element1['release_date']); 
            $datetime2 = strtotime($element2['release_date']); 
            return $datetime1 - $datetime2; 
        });
        return $lista;
    }  

    protected function requestGenres() {
        $response = Http::get("{$this->apiRef}/genre/movie/list?api_key={$this->apiKey}&language=pt-BR");
        return $response->json();
    }

    protected function requestPage()
    {   
        $lista = array();
        for($page = 1; $page <= 3; $page++) {
            $response = Http::get("{$this->apiRef}/movie/upcoming?api_key={$this->apiKey}&page={$page}&language=pt-BR");
            if($page == 3) {
                #retira 10 filmes da ultima página 
                array_push($lista, array_slice($response->json()['results'],0,12,true));
            } else {
                array_push($lista, array_slice($response->json()['results'],0,19,true));
            } 
        }
        #Retira uma dimensão da matriz
        $lista = array_merge($lista[0], $lista[1], $lista[2]);
        return $lista;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('show', [ 
            'filme' =>  $this->getGenero($this->getMovie($id)),
            'favoritos' => 'Add aos Favoritos'
        ]);
    }
    public function getGenero($movie) {
        $genres = $this->requestGenres();
        foreach($movie['genre_ids'] as $key => $ids) {
            foreach($genres['genres'] as $genre) {
                if($ids == $genre['id']) {
                    $movie['genre_ids'][$key] = $genre['name'];
                }
            }
        }
        return $movie;
    }

    public function requestImdbId($id) {
        $response = Http::get("{$this->apiRef}/movie/{$id}/external_ids?api_key={$this->apiKey}");
        $ids = $response->json();
        return $ids['imdb_id'];
    }

    public function requestMovieInformations($imdbId) {
        $response = Http::get("{$this->apiRef}/find/{$imdbId}?api_key={$this->apiKey}&language=pt-BR&external_source=imdb_id");
    }

    public function getMovie($id) {
        $imdbId = $this->requestImdbId($id);
        $lista = session('pages');
        if(isset($lista[0])) {
            foreach($lista as $movie) {
                if($movie['id'] == $id) {
                    $informations = $movie;
                    break;
                }
            }
        } else {
            foreach($lista['results'] as $movie) {
                if($movie['id'] == $id) {
                    $informations = $movie;
                    break;
                }
            }
        }
        return $informations;
    }

    public function search(Request $request) {
        $query = $request->input('search');
        $page = 1;
        $include_adult = false;
        $response = Http::get("{$this->apiRef}/search/movie?api_key={$this->apiKey}&query={$query}&page={$page}&include_adult={$include_adult}&language=pt-BR");
        session(['pages' => $response->json()]);
        return view('search', [
            'result' => $response->json(),
            'query' => $query
        ]);
    }

    public function favoritos() {
        return view('favoritos');
    }

}
