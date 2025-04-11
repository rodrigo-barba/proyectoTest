<template>

<div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-md">
            <!-- el prevent sirve para eviar que se ejecute el evento especificado -->
            <form @submit.prevent="submit">
                <o-field label="Usuario" :variant="errors.login ? 'danger' : 'primary'">
                    <o-input v-model="form.email"></o-input>
                </o-field>
                <o-field label="Clave" :variant="errors.login ? 'danger' : 'primary'" :message="errors.login">
                    <o-input v-model="form.password" type="password"></o-input>
                </o-field>

                <o-button variant="secondary" type="submit">Enviar</o-button>
            </form>
        </div>
    </div>

</template>

<script>
export default {
    // created() {
    //     if (this.$root.isLoggedIn) {
    //         this.$router.push({ name: 'list' })
    //     }
    // },

    data() {
        return {
            // disabledBotton:false,
            form: {
                email: '',
                password: '',
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
            // axios.get('/api/user').then(res => {
            //     console.log(res.data);
            // })

            this.cleanErrorsForm();
        //     this.disabledBotton=true
            axios.get('sanctum/csrf-cookie').then(response => {
                axios.post('/user/login', this.form).then(response => {
                    // console.log(response.data);
        //             this.$root.setCookieAuth({
        //                 isLoggedIn: response.data.isLoggedIn,
        //                 token: response.data.token,
        //                 user: response.data.user,
        //             })

        //             setTimeout(() => (window.location.href = '/vue'), 1500)
        //             // this.disabledBotton = false
                    // uso el componente de ORUGA para mostrar la notificacion de OK
                    this.$oruga.notification.open({
                        message: 'Login exitoso',
                        position: 'bottom-right',
                        duration: 1000,
                        closable: true
                   })

                }).catch(error => {
                    // console.log(error);
        //             this.disabledBotton=false
                    // TO DO: acá faltaria preguntar si es error de formato o autenticacion para
                    //        mostrar bien el texto del msg 
                    this.errors.login = error.response.data;
                })
            })

        },
    }
}
</script>