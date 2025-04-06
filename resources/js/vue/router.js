//importo el sistema de ruteo y el tipo de navegación (URL con hash)
import { createRouter, createWebHashHistory, createWebHistory } from "vue-router";

//importo los componentes
import List from "./components/ListComponent.vue";
import Save from "./components/SaveComponent.vue";

// declaro el array de rutas (array de objetos)
const routes = [
    {
        name: 'list',
        path: '/',
        component: List
    },
    {
        name: 'save',
        path: '/save/:id?', // parámetro id opcional
        component: Save
    },
]

// creo las rutas
const router = createRouter({
    history: createWebHashHistory(),
    // history: createWebHistory(),
    routes: routes
})

//exporto este modulo (con el nombre que usé en el createRouter)
export default router


