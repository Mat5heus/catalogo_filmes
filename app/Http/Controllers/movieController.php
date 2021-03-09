<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class movieController extends Controller
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
        $page = $this->pularPaginaPar($page);
        $lista = $this->requestUpcommingPages($page);
        $sorteio = $this->sortearFilmeCarrosel(5, $lista);

        return view('index', [
             'lista' => $this->sortByDate($lista),
             'filmePrincipal' => array_pop($sorteio),
             'filmesSorteados' => $sorteio,
             'home' => 'active',
             'currentPageNumber' => $page,
             'currentPageName' => 'index',
             'total_pages' => $lista[0]['total_pages']
        ]);
    }

    public function sortearFilmeCarrosel($quant, $lista) {
        //sorteio
        $sorteio = array();
        for($ctd = 1; $ctd <= 5; $ctd++) {
            array_push($sorteio,rand(0,count($lista)-1));
        }
        return $sorteio;
    }

    public function pularPaginaPar($page) {
        //Se for par soma mais 1
        if ($page % 2 == 0) {
            return $page++;
        }
        return $page;
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
        $currentPage = $page;
        for($page; $page <= $currentPage+2; $page++) {
            $response = Http::get("{$this->apiRef}/movie/upcoming?api_key={$this->apiKey}&page={$page}&language=pt-BR");
            if($page == $currentPage+2) {
                //retira 10 filmes da ultima página 
                array_push($lista, array_slice($response->json()['results'],0,12,true));
            } else {
                array_push($lista, array_slice($response->json()['results'],0,19,true));
            } 
        }
        //Retira uma dimensão da matriz
        $lista = array_merge($lista[0], $lista[1], $lista[2]);
        $lista[0]["total_pages"] = $response->json()["total_pages"];
        $lista[0]["total_results"] = $response->json()["total_results"];

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
            'filme' =>  $this->getGenreName($this->getMovie($id)),
            'show' => ''
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
        if(isset($ids['imdb_id'])) {
            return $ids['imdb_id'];
        } else {
            abort(404);
        }
    }

    protected function requestMovieInformations($imdbId) {
        $response = Http::get("{$this->apiRef}/find/{$imdbId}?api_key={$this->apiKey}&language=pt-BR&external_source=imdb_id");
        return $response->json();
    }

    protected function getMovie($id) {
        $imdbId = $this->requestImdbId($id);
        $movie = $this->requestMovieInformations($imdbId);

        if(isset($movie['movie_results'][0])) {
            return $movie['movie_results'][0];
        } else {
            abort(404);
        }
    }

    public function search(Request $request,$page = 1) {

        $query = $request->input('query');
        $include_adult = false;
        $response = Http::get("{$this->apiRef}/search/movie?api_key={$this->apiKey}&query={$query}&page={$page}&include_adult={$include_adult}&language=pt-BR");
    
        return view('search', [
            'result' => $response->json(),
            'query' => $query,
            'currentPageNumber' => $page,
            'total_pages' => $response->json()['total_pages'],
            'currentPageName' => 'search'
        ]);
    }

    public function favorites() {
        return view('favoritos', [
            'favoritos' => 'active'
        ]);
    }
}
