<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class moviesController extends Controller
{   
    protected $apiKey;

    function __construct()
    {
        $this->apiKey = 'c3135c7dfc71986d9e636528b5e9743f';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = 1)
    {   
        dd($this->importPage());
        // return view('index', [
        //     'lista' => $this->importPage()
        // ]);
    }
    

    protected function importPage()
    {   
        $lista = array();
        for($page = 1; $page <= 3; $page++) {
            $response = Http::get('https://api.themoviedb.org/3/movie/upcoming?api_key='.$this->apiKey.'&page='.$page.'&language=pt-BR');
            if($page == 3) {
                array_push($lista, array_slice($response->json()['results'],0,9,true));
            } else {
                array_push($lista, $response->json());
            } 
        }
        return $lista;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
