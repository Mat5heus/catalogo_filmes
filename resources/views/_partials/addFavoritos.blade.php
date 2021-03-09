<script>
    let addFavoritos = new Vue({
        el: "#AddFavoritos",
        data: {
          addMessage: 'Add aos Favoritos',
          removeMessage: 'Remover dos Favoritos',
          currentMessage: null,
          arrayKey: null,
          page: [],
          dados: {
            id:"{{ $filme['id'] ?? '' }}",
            name: "{{ $filme['title'] ?? '' }}",
            original_title: "{{ $filme['original_title'] ?? '' }}",
            overview: "{{ mb_strimwidth($filme['overview'],0,500,'...')  ?? '' }}",
            backdrop_path: "{{ $filme['backdrop_path'] ?? '' }}",
            poster_path: "{{ $filme['poster_path'] ?? '' }}",
            release_date: "{{ $filme['release_date'] ?? '' }}",
            genre: "{{  implode(', ',$filme['genre_ids']) ?? '' }}",
            adult: "{{ $filme['adult'] ?? '' }}",
            vote_average: "{{ $filme['vote_average'] ?? '' }}",
            vote_count: "{{ $filme['vote_count'] ?? '' }}"
          },
          jsonName: 'favoritos'
        },
        mounted() {
          if (localStorage.getItem(this.jsonName)) {
            try {
              this.page = JSON.parse(localStorage.getItem(this.jsonName));
              this.arrayKey = this.movieExists();
              if(this.arrayKey != null) {
                this.currentMessage = this.removeMessage;
              } else {
                this.currentMessage = this.addMessage;
              }
            } catch(e) {
              console.error(e);
            }
          } else {
            this.currentMessage = this.addMessage;
          }
        },
        methods: {
          exec() {
            if(this.arrayKey != null) {
              this.removeMovie();
              this.arrayKey = null;
              this.currentMessage = this.addMessage;
            } else {
              this.addMovie();
              this.arrayKey = this.movieExists();
              this.currentMessage = this.removeMessage;
            }
          },
          addMovie() {
            this.page.push(this.dados);
            this.saveMovie();
          },
          movieExists() {
            for(let ctd = 0; ctd < this.page.length; ctd++) {
              if (this.page[ctd].id == this.dados.id) {
                return ctd;
              }
            }
            return null;
          },
          removeMovie() {
            this.page.splice(this.arrayKey, 1);
            this.saveMovie();
          },
          saveMovie() {
            const parsed = JSON.stringify(this.page);
            localStorage.setItem(this.jsonName, parsed);
          }
        }
    })
</script>