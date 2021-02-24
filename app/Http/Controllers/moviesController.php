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
        $this->apiKey = 'c3135c7dfc71986d9e636528b5e9743f';
        $this->apiRef = 'https://api.themoviedb.org/3';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $lista = $this->requestPage();
        // $genres = $this->requestGenres();
        // foreach($lista as $page) {
        //     foreach($page as $movie) {
        //         $genres_name = array();
        //         foreach($movie['genre_ids'] as $genres_id) {
        //             foreach($genres['genres'] as $id_list) {
        //                 if($id_list['id'] == $genres_id) {
        //                     array_push($genres_name,$id_list['name']);
        //                     break;
        //                 }
        //             } 
        //         }
        //         array_merge($movie['genre_ids'], $genres_name);
        //     }
        // }
        // dd($genres_name);
        return view('index', [
             'lista' => $this->requestPage()
        ]);
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
                array_push($lista, array_slice($response->json()['results'],0,12,true));
            } else {
                array_push($lista, array_slice($response->json()['results'],0,19,true));
            } 
        }
        session(['pages' => $lista]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('show', [ 'filme' => $this->getMovie($id) ]);
    }

    public function getMovie($id) {
        $lista = session('pages');
        if(isset($lista[0])) {
            foreach($lista as $page) {
                foreach($page as $movie) {
                    if($movie['id'] == $id) {
                        $informations = $movie;
                        break;
                    }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
