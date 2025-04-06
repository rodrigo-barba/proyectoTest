<template>
    <div class='container mx-auto'>
        <!-- <h1>Principal</h1> -->
        <router-view></router-view>
    </div>
</template>

<script>
export default {
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




