<template>
    <div class="container mx-auto">
        <nav class='bg-white border-b border-gray' v-if="$root.isLoggedIn">
            <header class='px-4 sm:px-6 lg:px-8'>
                <div class='flex justify-between'>
                    <div class='flex items-center'>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="35"
                             viewBox="0 0 262 227" >
                            <g id="Vue.js_logo_strokes" fill="none" fill-rule="evenodd">
                                <g id="Path-2">
                                <polyline class="outer" stroke="#4B8" stroke-width="46" points="12.19 -24.031 131 181 250.351 -26.016" />
                                </g>
                                <g id="Path-3" transform="translate(52)">
                                <polyline class="inner" stroke="#354" stroke-width="42" points="15.797 -14.056 79 94 142.83 -17.863" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class='max-w-7xl mx-auto py-4 px-4 sm:px-6'>
                        <!-- para decidir si mostrar el link o no, puedo usar una condicion v-if="<concicion>"
                        <router-link :to="{'name': 'login'}" class='navbar_links' v-if="!$root.isLoggedIn"> -->
                        <router-link :to="{'name': 'list'}" class='navbar_links'>List</router-link>
                        
                        <!-- estos son de relleno -->
                        <router-link :to="{'name': ''}" class='navbar_links'>link 2</router-link>
                        <router-link :to="{'name': ''}" class='navbar_links'>link 3</router-link>
                        <router-link :to="{'name': ''}" class='navbar_links'>link 4</router-link>

                        <o-button variant="danger" @click="logout">Logout</o-button>
                    </div>    

                    <div class='flex flex-col items-center py-2'>   
                        <div class='rounded-full w-9 h-9 bg-blue-300 text-center p-1 font-bold'>
                            {{ $root.user.name.substr(0,2).toUpperCase() }}
                        </div>
                        <p>{{ $root.user.name }}</p>
                    </div>
                </div>
            </header>

        </nav>

        <router-view></router-view>

    </div>
</template>

<script>
export default {
    mounted(){
        // lleno los datos de auteticacion en Vue desde la cookie 
        const auth = this.$cookies.get('auth');

        if (auth) {
            this.isLoggedIn = true
            this.user = auth.user
            this.token = auth.token
        }
    },

    data() {
        return {
            // variables de autenticación para Vue (son reactivas). Cualquier cambio que hagas en ellas (como en mounted()) 
            // se reflejará automáticamente en la vista (template) o cualquier otra parte del componente que las use.
            // Si intentara usar this.user sin declararla antes en data(), Vue no la reconocería como 
            // reactiva (no haría seguimiento a sus cambios)
            isLoggedIn: false,
            user: '',
            token: '',

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
    },

    methods: {
        // guardo en la cookie 'auth' la info provista
        setCookieAuth(data) {
            this.$cookies.set('auth', data)
        },

        logout() {
            // destruyo la sesion/token y redirecciono a una pagina
            // no uso el res, porque no me interesa el response del metodo logout

            const config = {
                headers: {
                    Authorization: 'Bearer ' + this.token
                }
            }

            //uso el null porque no paso parámetros, pero (aunque no lo uso) 
            // debo pasar el token como header (3er parametro)
            axios.post('/api/user/logout', null, config)
            .then(()=> {
                this.setCookieAuth("");
                // la recarga total de la pagina no hace falta si uso cookies  
                // window.location.href = '/';
                this.$root.isLoggedIn = false;
                this.$router.push({ name: 'login' })
            })
            .catch(()=> {
                // TODO: ver que hacer al haber un error en el logout
                window.location.href = '/';
            })
        }
    }

}
</script>




