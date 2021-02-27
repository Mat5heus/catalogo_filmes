@extends('layouts.app')

@section('title', "Favoritos")

@section('content')    
    <div class="d-flex flex-column bd-highlight mb-3" id="colecao" :style="containerStyle">
        <h1 class="p-2 bd-highlight">Favoritos</h1>
        <div class="p-2 bd-highlight ">
            <div class="container-sm" v-for="(movie) in page">
                <img :src="'https://image.tmdb.org/t/p/w500'+movie.poster_path" 
                    :alt="movie.name"
                    class="img-thumbnail"
                    :style="cardStyle"
                    v-on:click="redirect(movie)"
                    data-bs-trigger="hover"
                    data-bs-toggle="popover" 
                    :title="movie.name" 
                    :data-bs-content="movie.overview+
                    ' Lançamento: '+movie.release_date"
                >
            </div>
            {{-- Versão do código em javascript
                <script>
                let page = JSON.parse(localStorage.getItem('favoritos'));
                for(let key = 0; key < page.length; key++) {
                    let link = document.createElement("a");
                    let img = document.createElement("img");
                    link.setAttribute("href","http://localhost:8000/catalogo/"+page[key].id);
                    link.setAttribute("id","linkId"+key);
                    img.setAttribute("style", "height: 280px; width:190px; float:left; margin-left: 5px"); 
                    img.setAttribute('src', "https://image.tmdb.org/t/p/w500"+page[key].poster_path);
                    img.setAttribute("alt",page[key].name);
                    img.setAttribute("class","img-thumbnail");
                    img.setAttribute("data-bs-trigger",'hover');
                    img.setAttribute("data-bs-toggle",'popover'); 
                    img.setAttribute("title",page[key].name);
                    img.setAttribute("data-bs-content",page[key].overview+" "+page[key].release_date);              
                    document.body.appendChild(link);
                    document.querySelector("a#linkId"+key).appendChild(img);
                }
            </script> --}}  
        </div>
    </div>
    <script>
        let colecao = new Vue({
            el:'#colecao',
            data: {
                page: [],
                jsonName: 'favoritos',
                cardStyle: {
                    height: '280px', 
                    width:'190px', 
                    float:'left', 
                    marginLeft: '5px'
                },
                containerStyle: {
                    textAlign: 'center',
                    marginLeft: '8%'
                },
            },
            mounted() {
                if (localStorage.getItem(this.jsonName)) {
                    try {
                        this.page = JSON.parse(localStorage.getItem(this.jsonName));
                    } catch(e) {
                        console.error(e);
                    }
                }
            },
            methods: {
                redirect(movie) {
                    window.location = "{{ route('show','') }}/"+movie.id;
                }
            }
        });
    </script>
@endsection
