@extends('layouts.app')

@section('title', "Favoritos")

@section('content')
    <div class="container" id="containerFilmes" v-bind:style="containerStyle">
        <h1>Favoritos</h1>
        <div class="container-sm" id="colecao">
            <script>
                let page = JSON.parse(localStorage.getItem('favoritos'));
                for(let key = 0; key < page.length; key++) {
                    let link = document.createElement("a");
                    let img = document.createElement("img");
                    link.setAttribute("href","http://localhost:8000/catalogo/"+page[key].id);
                    link.setAttribute("id","filmeLink");
                    img.setAttribute("style", "height: 280px; width:190px; float:left; margin-left: 5px"); 
                    img.setAttribute('src', "https://image.tmdb.org/t/p/w500"+page[key].poster_path);
                    img.setAttribute("alt",page[key].name);
                    img.setAttribute("class","img-thumbnail");
                    img.setAttribute("data-bs-trigger",'hover');
                    img.setAttribute("data-bs-toggle",'popover'); 
                    img.setAttribute("title",page[key].name);
                    img.setAttribute("data-bs-content",page[key].overview+" "+page[key].release_date);              
                    document.body.appendChild(link);
                    document.querySelector("a#filmeLink").appendChild(img);
                }
            </script>
                
        </div>
    </div>
    @include('components.pagination')
    @include('_partials.vueContainer')
    <script>
        let colecao = new Vue({
            el:'#colecao',
            data: {
                page: [],
                jsonName: 'favoritos',
                ref: {
                    uri:null
                },
                message: '<h1>Hello</h1>',
                cardStyle: {
                    height: 280+'px', 
                    width:190+'px', 
                    float:'left', 
                    marginLeft: 5+'px'
                }
            },
            mounted() {
                if (localStorage.getItem(this.jsonName)) {
                    try {
                        this.page = JSON.parse(localStorage.getItem(this.jsonName));
                    } catch(e) {
                        console.error(e);
                        //localStorage.removeItem(this.jsonName);
                    }
                }
            },
            methods: {
                completar(n) {
                    return 'http://localhost:8000/catalogo/'+this.page[n].id
                },
                pageRender() {
                    return this.page;
                }
            }
        });
    </script>
@endsection
