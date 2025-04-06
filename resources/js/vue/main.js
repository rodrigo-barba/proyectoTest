
import { createApp } from "vue";  // creo la app en vue 3

import Oruga from "@oruga-ui/oruga-next"  // importo la biblioteca UI

import "../../css/vue.css" // importo las hojas de estilos de Vue
import "@oruga-ui/theme-oruga/dist/oruga.css" // importo las hojas de estilos
import "@mdi/font/css/materialdesignicons.min.css" //importo los iconos de Material Design

import axios from "axios"; // importo axios para hacer los fetch

import App from "./App.vue" // importo el componente de arranque (App.vue)

import router from "./router"; //importo el módulo de ruteo

//creo una constante que recibe la aplicación creada desde 'App' (rootcomponent)
const app = createApp(App);

app.use(Oruga).use(router); //uso el plugin de oruga y el ruteo de vue

//genero la propiedad $axios para usar Axios para llamar a la API
app.config.globalProperties.$axios = axios;
// disponibilizo axios para javascript
window.axios = axios;

//monto en el HTML la app que creé (#app corresponde 
// al id del div dentro del body en la vista vue.blade.php)
app.mount("#app")

