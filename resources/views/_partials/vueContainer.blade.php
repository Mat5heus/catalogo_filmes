<script>
    let containerFilmes = new Vue({
        el: '#containerFilmes',
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
                paddingLeft: '5%',
                paddingRight: '5%'                
            },
            titleStyle: {
                textAlign: 'center',
                marginTop: '50px'
            },
            subtitleStyle: {
                textAlign: 'center'
            },
            carouselContainerStyle: {
                display: 'flex',
                height: '500px',
                marginTop: '49px'
            },
            carouselStyle:{
                marginLeft:'15%',
                width: '70%'
            }
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
            redirect(id) {
                window.location = "{{ route('show','') }}/"+id;
            }
        }
    })
</script>