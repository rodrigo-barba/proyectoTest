<template>
    <div class='container mx-auto'>
        <!-- <h1>Principal</h1> -->
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    // mounted(){
        //autentico con SPA
        // axios.get('sanctum/csrf-cookie').then(res => {
        //     // console.log('sanctum/csrf-cookie');
        //     axios.post('/api/user/login', {
        //         'email' : 'rodrigobarba@yahoo.com.ar',
        //         'password' : '12345678'
        //     }).then(res => {
        //         console.log(res.data);
        //     }).catch(e => {
        //         console.log(e);
        //     })
        // })

        //obtengo los datos del usuario autenticado para testear autenticacion
        // axios.get('/api/user').then(res => {
        //         console.log(res.data);
        // })

    // },

    data() {
        return {
            // genero un objeto llamado urls
            urls: {
                postGET: '/api/post/',
                postPaginateGET: '/api/post/',
                postDELETE: '/api/post/',
                postUPLOAD: 'api/post/upload/',
                postPOST: '/api/post/',
                postPATCH: '/api/post/',
                categoryAllGET: '/api/category/all'
            }
        }
    }
}
</script>




