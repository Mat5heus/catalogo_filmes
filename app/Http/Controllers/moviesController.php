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
    public function index($page = 1)
    {   
        if ($page % 2 == 0) {
            $page++;
        }
        $lista = $this->sortByDate($this->requestUpcommingPages($page));

        $sorteio = array();
        for($ctd = 1; $ctd <= 5; $ctd++) {
            array_push($sorteio,rand(0,count($lista)-1));
        }

        return view('index', [
             'lista' => $lista,
             'filmePrincipal' => array_pop($sorteio),
             'filmesSorteados' => $sorteio,
             'home' => 'active',
             'page' => $page
        ]);
    }

    Protected function sortByDate($lista) {
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

    protected function requestUpcommingPages($page)
    {   
        $lista = array();
        $paginaAtual = $page;
        for($page; $page <= $paginaAtual+2; $page++) {
            $response = Http::get("{$this->apiRef}/movie/upcoming?api_key={$this->apiKey}&page={$page}&language=pt-BR");
            if($page == $paginaAtual+2) {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('show', [ 
            'filme' =>  $this->getGenreName($this->getMovie($id))
        ]);
    }

    protected function getGenreName($movie) {
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

    protected function requestImdbId($id) {
        $response = Http::get("{$this->apiRef}/movie/{$id}/external_ids?api_key={$this->apiKey}");
        $ids = $response->json();
        return $ids['imdb_id'];
    }

    protected function requestMovieInformations($imdbId) {
        $response = Http::get("{$this->apiRef}/find/{$imdbId}?api_key={$this->apiKey}&language=pt-BR&external_source=imdb_id");
        return $response->json();
    }

    protected function getMovie($id) {
        $imdbId = $this->requestImdbId($id);
        $movie = $this->requestMovieInformations($imdbId);

        return $movie['movie_results'][0];
    }

    public function search(Request $request) {

        $query = $request->input('search');
        $page = 1;
        $include_adult = false;
        $response = Http::get("{$this->apiRef}/search/movie?api_key={$this->apiKey}&query={$query}&page={$page}&include_adult={$include_adult}&language=pt-BR");
    
        return view('search', [
            'result' => $response->json(),
            'query' => $query
        ]);
    }

    public function favorites() {
        return view('favoritos', [
            'favoritos' => 'active'
        ]);
    }

}
