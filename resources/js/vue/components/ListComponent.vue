<template>

<div class='container mx-auto'>  
    <div class="mt-6 mb-2 px-6 py-4 bg-white shadow-md rounded-md border-solid border">

        <h1>Lista de Posteos</h1>

        <o-modal v-model:active="confirmDeleteAction">
            <div class="p-4">
                <p>Estás seguro de eliminar el registro?</p>
            </div>
            <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
                <o-button variant="danger" rounded @click="deletePost">Eliminar</o-button>
                <o-button variant="default" rounded @click="confirmDeleteAction=false">Cancelar</o-button>
            </div>
        </o-modal>

        <!-- cambio el link de crear nuevo post po un botón, para poder meterle un icono -->
        <!-- <router-link :to="{ name:'save'}">Crear nuevo post</router-link> -->
        <!-- a este boton no le pongo small porque se ve muy chico -->
        <o-button variant="secondary" iconLeft='plus' rounded @click="$router.push({name:'save'})">Crear</o-button>

        <div class="mb-5"></div>

        <!-- la tabla obtiene los datos del array posts.data 
                loading es para poner una animación cuando está cargando -->
        <o-table :data="posts.data" :loading="isLoading">
            <!-- para mostrar el dato ID, creo un slot (variable que se usa solo aqui) -->
            <o-table-column field="id" label="ID" v-slot="p">
                {{ p.row.id }}
            </o-table-column>
            <o-table-column field="title" label="Título" v-slot="p">
                {{ p.row.title }}
            </o-table-column>
            <o-table-column field="posted" label="Posteado" v-slot="p">
                {{ p.row.posted }}
            </o-table-column>
            <o-table-column field="category_title" label="Categoría" v-slot="p">
                {{ p.row.category.title }}
            </o-table-column>
            <o-table-column field="action" label="Acciones" v-slot="p" class="flex space-x-2">
                <!-- <router-link class="mr-3" :to="{ name:'save', params: {'id': p.row.id } }">Editar</router-link> -->
                <o-button class="!mr-1" variant="secondary" size='small' iconLeft='pencil' rounded @click="$router.push({name:'save', params: {'id': p.row.id }})">Editar</o-button>
                <o-button variant="danger" size='small' iconLeft='delete' rounded @click="deleteRow=p; confirmDeleteAction=true;">Eliminar</o-button>
            </o-table-column>
        </o-table>

        <div class="mb-5"></div>

        <o-pagination
            v-if="posts.data && posts.data.length > 0"
            @change="updatePage"
            :total="posts.total"
            v-model:current="currentPage"
            :rangeBefore="rangeBefore || 0"
            :rangeAfter="rangeAfter || 0"
            :order="order"
            :size="size"
            :rounded="isRounded"
            :simple="isSimple"
            :perPage="posts.per_page"
            :iconPrev="prevIcon"
            :iconNext="nextIcon"
            :iconSize="iconSize"  />

    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [], //data de los posts
                isLoading: true, //indica si la data se está cargando desde la DB, etc.
                currentPage: 1, //página actual (inicia en 1)
                rangeBefore: 2, //iconos antes del de pag actual
                rangeAfter: 2,  //iconos despues del de pag actual
                isRounded: true, //iconos redondeados
                size: 'small', //tamaño de los links
                isSimple: false, //mostraría solo el rango de registros mostrado y los links prev y next
                order: 'centered', //left / centered / right
                prevIcon: 'chevron-left', // arrow-left chevron-left Ícono para "anterior"
                nextIcon: 'chevron-right', // arrow-right chevron-right Ícono para "siguiente"
                iconSize: 'small', //tmaño de los iconos

                //config del modal
                confirmDeleteAction: false, //mostrar modal
                deleteRow: '' // id del rega eliminar
            }
        },

        mounted() {
            this.listPage();
        },

        methods: {
            updatePage() {
                // console.log(this.currentPage);
                // FIX: delay de 100 ms para que actualice el currentPage
                //      este es un problema de Oruga
                setTimeout(() => {this.listPage();}, 100);
            },

            //puedo usar este metodo con un botón
            listPage() {
                //console.log(this.$axios);
                this.isLoading = true; //cargando data

                // armo el header para pasar el token 
                const config = {
                    headers: {
                        Authorization: `Bearer ${this.$root.token}` //interpolo el token en el string
                    }
                }

                // hago la peticion asincrona para obtener la data via mi API
                // hago un GET (seria similar para POST, PUT, PATCH o DELETE)
                // tambien le paso el token en 'config'
                // agarro el response de res y lo uso en una función flecha
                axios.get(this.$root.urls.postPaginateGET + '?page=' + this.currentPage, config).then((res) => {
                    //acordarse que el response tiene 2 grupos de info, los datos están en el elemento llamado 'data'
                    //como el index pagina, para acceder a los datos "puros" tendría que usar: res.data.data
                    this.posts = res.data;
                    //console.log(this.posts.per_page);
                    this.isLoading = false; //ya cargó la data
                })
            }, 

            //DELETE
            deletePost() {
                // cierro el modal de confirmación
                this.confirmDeleteAction = false;

                // armo el header para pasar el token 
                const config = {
                    headers: {
                        Authorization: `Bearer ${this.$root.token}` //interpolo el token en el string
                    }
                }

                // elimino de la db
                this.$axios.delete(this.$root.urls.postDELETE + this.deleteRow.row.id, config);
                // eliminar 1 elemento en la posición row.index
                this.posts.data.splice(this.deleteRow.index, 1);

                this.$oruga.notification.open({
                    message: 'Posteo eliminado exitosamente.',
                    position: 'bottom-right',
                    duration: 4000,
                    closable: true,
                    type: 'info',   // muestra icono de info
                    rootClass: "!bg-blue-700 text-white",  // Cambia el color de fondo y texto
                    iconPack: "mdi",
                    iconSize: "medium" // Verifica si tu versión de Oruga lo soporta
                })
            }

        }
    }
</script>
