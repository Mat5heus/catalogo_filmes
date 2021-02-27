<script>
    let containerFilmes = new Vue({
        el: '#containerFilmes',
        data: {
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
                textAlign: 'center'
            },
            carouselContainerStyle: {
                display: 'flex',
                height: '500px'
            },
            carouselStyle:{
                marginLeft:'15%',
                width: '70%'
            }
        },
        methods: {
            redirect(id) {
                window.location = "{{ route('show','') }}/"+id;
            }
        }
    })
</script>