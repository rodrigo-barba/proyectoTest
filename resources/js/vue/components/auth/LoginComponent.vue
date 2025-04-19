<template>

<!-- container -->
<div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <!-- card -->
        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-md">
            <!-- el prevent sirve para eviar que se ejecute el evento especificado -->
            <form @submit.prevent="submit">
                <o-field label="Usuario" :variant="errors.login ? 'danger' : 'primary'">
                    <o-input v-model="form.email"></o-input>
                </o-field>
                <o-field label="Clave" :variant="errors.login ? 'danger' : 'primary'" :message="errors.login">
                    <o-input v-model="form.password" type="password"></o-input>
                </o-field>

                <o-button class="float-right" :disabled="disabledButton" variant="secondary" type="submit">Enviar</o-button>
            </form>
        </div>
    </div>

</template>

<script>
export default {
    // created(): Es un hook del ciclo de vida de Vue que se ejecuta cuando 
    // el componente ha sido instanciado pero antes de renderizarse.
    // Si el usr ya tiene sesión iniciada, lo redirige directamente al listado.
    // esto deja inaccesible el login hasta que se destruye la sesion (logout)
    created() {  // created está por sobre mounted
        if (this.$root.isLoggedIn) {
            this.$router.push({ name: 'list' })
        }
    },

    data() {
        return {
            disabledButton: false,
            //pongo mi usr SOLO para no estar ingresándolo para pruebas
            form: {
                email: 'rodrigobarba@yahoo.com.ar',
                password: '12345678',
            },
            errors: {
                login: ''
            },
        }
    },
    methods: {

        cleanErrorsForm() {
            this.errors.login = ''
        },

        submit() {
            this.cleanErrorsForm();

            // desabilito el botón para evitar que se vuelva a presionar
            this.disabledButton = true;

            axios.get('sanctum/csrf-cookie').then(response => {
                axios.post('/api/user/login', this.form).then(response => {

                    this.$root.setCookieAuth({
                        isLoggedIn: response.data.isLoggedIn,
                        token: response.data.token,
                        user: response.data.user,
                    })

                    // redirecciono despues de 1,5 seg, para poder mostrar el msg de login ok
                    setTimeout(() => (window.location.href = '/'), 1500);
                    // una vez hecha la redirección, rehabilito el botón
                    this.disabledButton = false;
                    // uso el componente de ORUGA para mostrar la notificacion de OK
                    this.$oruga.notification.open({
                        message: 'Login exitoso',
                        position: 'bottom-right',
                        duration: 1000,
                        closable: true
                   })

                }).catch(error => {
                    // console.log(error);
        //             this.disabledButton=false
                    // TO DO: acá faltaria preguntar si es error de formato o autenticacion para
                    //        mostrar bien el texto del msg 
                    this.errors.login = error.response.data;
                })
            })

        },
    }
}
</script>