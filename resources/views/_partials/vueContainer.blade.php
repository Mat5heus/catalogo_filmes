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
            // containerStyle: {
            //     textAlign: 'center',
            //     marginLeft: '8%'
            // },
            titleStyle: {
                textAlign: 'center'
            },
            carouselStyle: {
                display: 'flex',
                marginLeft: '0px'
            }
        },
        methods: {
            redirect(id) {
                window.location = "{{ route('show','') }}/"+id;
            }
        }
    })
</script>