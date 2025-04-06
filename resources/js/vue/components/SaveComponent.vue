<template>
    <!-- si post es null, undefined o una cadena vacía ("") -->
    <h1 v-if="!post">Crear nuevo Posteo</h1> 
    <h1 v-else>Editar Posteo <span class="font-bold">{{ post.title }}</span></h1>


    <div class="grid grid-cols-2 gap-3">
        <div class="col-span-2">
            <o-field label="Título" :variant="errors.title ? 'danger': 'primary'" :message="errors.title">
                <o-input v-model="form.title"></o-input>
            </o-field>
        </div>

        <o-field label="Descripción" :variant="errors.description ? 'danger': 'primary'" :message="errors.description">
            <o-input v-model="form.description" type="textarea"></o-input>
        </o-field>        

        <o-field label="Contenido" :variant="errors.content ? 'danger': 'primary'" :message="errors.content">
            <o-input v-model="form.content" 
                     type="textarea" 
                     placeholder="Ingrese algún texto..."
                     :maxlength="500"
                     counter></o-input>
        </o-field>        

        <o-field label="Categoría" :variant="errors.category_id ? 'danger': 'primary'" :message="errors.category_id">
            <o-select v-model="form.category_id" placeholder="Selecciona una opción">
                <option value=""></option>
                <!-- es lo mismo escribir v-bind:key="c.id" que :key="c.id" -->
                <option v-for="c in categories" v-bind:key="c.id" :value="c.id">{{ c.title }}</option>
            </o-select>
        </o-field>        

        <o-field label="Slug" :variant="errors.slug ? 'danger': 'primary'" :message="errors.slug">
            <o-input v-model="form.slug"></o-input>
        </o-field>

        <o-field label="Posteado" :variant="errors.posted ? 'danger': 'primary'" :message="errors.posted">
            <o-select v-model="form.posted" placeholder="Selecciona una opción">
                <option value="yes">Sí</option>
                <option value="not">No</option>
            </o-select>
        </o-field>
    </div>

    <div class="my-3">
        <o-button variant="primary" @click="submit">Enviar</o-button>
    </div>

    <!-- muestro solo si tengo un post (estoy en edicion) -->
    <div class="grid grid-cols-2 gap-3" v-if="post"> 
        <o-field :message="fileError" :variant="fileError ? 'danger' : 'secondary'">
            <o-upload v-model="file">
                <o-button tag="upload-tag" icon-left="upload" variant="secondary">Click para elegir imagen</o-button>
                <!-- <o-button tag="upload-tag" variant="secondary">
                    <o-icon icon="upload"></o-icon>
                    <span>Click para elegir imagen</span>
                </o-button> -->
            </o-upload>
        </o-field>

        <!-- el div está para que el botón no se estire al ancho del contenedor -->
        <div>
            <o-button icon-left="upload" class="file-name" variant="secondary" @click="upload">Subir imagen</o-button>
        </div>
    </div>

    <div class="my-3">
        <h3>Drag & Drop</h3>

        <!-- aca no hay un boton para subir, porque el D&D ejecuta al soltar el archivo en el area definida
             cuando eso pasa, se ejecuta el metodo 'watch'  -->
        <o-field :message="fileErrorDaD" :variant="fileErrorDaD ? 'danger' : 'secondary'">
            <o-upload v-model="filesDaD" multiple drag-drop>
                <section>
                    <o-icon icon="upload"></o-icon>
                    <span>Drag & Drop para subir imagenes</span>
                </section>
            </o-upload>
        </o-field>

        <!-- muestro la lista de archivos que se suben
             el key es para poder referenciar el elemento (ej: ane un error) y por buenas prácticas, 
             ya que cada elemento debe tener un id unico -->
        <span v-for="(file, index) in filesDaD" :key="index">
            {{ file.name }}
        </span>
    </div>

</template>

<script>
export default {
    async mounted() {
        //si quiero editar => paso el id del registro
        if (this.$route.params.id) {
             this.registro = await this.$axios.get(this.$root.urls.postGET + this.$route.params.id);
             this.post = this.registro.data;
             this.initPost();
        }
        this.getCategory()
    },

    data() {
        return {
            //guardo los datos del post en una edición
            post: '',
            // contiene los datos de form
            form: {
                title:'',
                slug:'',
                description:'',
                content:'',
                category_id:'',
                posted:''
            }, 
            //contiene el 1er msg de error de cada campo
            errors: {
                title:'',
                slug:'',
                description:'',
                content:'',
                category_id:'',
                posted:''
            },
            file: null, // para manejar el archivo a subir
            filesDaD: [], // para los files del Drag & Drop
            fileError: '', // error en subida imagen
            fileErrorDaD: '', // error en subida imagenes (Drag & Drop)
            categories: []
        }
    },

    methods: {
        initPost() {
            this.form.title = this.post.title;
            this.form.slug = this.post.slug;
            this.form.description = this.post.description;
            this.form.category_id = this.post.category_id;
            this.form.content = this.post.content;
            this.form.posted = this.post.posted;
        },

        getCategory() {
            this.$axios.get(this.$root.urls.categoryAllGET).then((res) => {
                this.categories = res.data;
            })
        },

        upload() {
            //limpio msgs de error 
            this.fileError = '';
            //como la subida de arhivos no es como mandar datos por post, genero un formulario aparte
            const formData = new FormData();
            formData.append('image', this.file);
            //paso el id del post, el formData con el archivo a subir y los headers del request
            this.$axios.post(this.$root.urls.postUPLOAD + this.post.id, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((res)=> {
                console.log(res);
            }).catch((e)=> {
                this.fileError = e.response.data.message
                //console.log(e);
            })
        },

        submit() {
            this.cleanErrorsForm();

            // INSERT o UPDATE
            if (this.post == ''){
                //CREATE

                // llamo al metodo para guardar el post
                this.$axios.post(this.$root.urls.postPOST, this.form)
                .then((res) => {
                    this.$oruga.notification.open({
                        message: 'Posteo creado exitosamente.',
                        position: 'bottom-right',
                        duration: 4000,
                        closable: true,
                        type: 'success',   // muestra icono de exito
                        rootClass: "!bg-lime-800 text-white",  // Cambia el color de fondo y texto
                        iconPack: "mdi",
                        iconSize: "medium" // Verifica si tu versión de Oruga lo soporta
                    })
                })
                .catch(error => {
                    //console.log(error);
                    this.showErrors(error.response.data.errors);
                })

            } else {
                //UPDATE
                // console.log(this.post.id);

                // llamo al metodo para guardar el post
                this.$axios.patch(this.$root.urls.postPATCH + this.post.id, this.form)
                .then((res) => {
                    this.$oruga.notification.open({
                        message: 'Posteo actualizado exitosamente.',
                        position: 'bottom-right',
                        duration: 4000,
                        closable: true,
                        type: 'success',   // muestra icono de exito
                        rootClass: "!bg-lime-800 text-white",  // Cambia el color de fondo y texto
                        iconPack: "mdi",
                        iconSize: "medium" // Verifica si tu versión de Oruga lo soporta
                    })
                })
                .catch(error => {
                    // console.log(error);
                    this.showErrors(error.response.data.errors);
                })
            }
        },

        cleanErrorsForm () {
            this.errors.title = "";
            this.errors.slug = "";
            this.errors.description = "";
            this.errors.category_id = "";
            this.errors.content = "";
            this.errors.posted = "";
        },

        showErrors(e) {
            if (e.title) this.errors.title = e.title[0]
            if (e.slug) this.errors.slug = e.slug[0]
            if (e.description) this.errors.description = e.description[0]
            if (e.category_id) this.errors.category_id = e.category_id[0]
            if (e.content) this.errors.content = e.content[0]
            if (e.posted) this.errors.posted = e.posted[0]
        }
    },

    watch: {
        filesDaD: { // elemento observado
            handler(valor) { // valor contiene el valor de filesDaD (es una array)
                this.fileError = ''; //limpio msgs de error 
                //como la subida de arhivos no es como mandar datos por post, genero un formulario aparte
                const formData = new FormData();

                // obtengo el ultimo elemento del array (ult arch cargado) y 
                // agrego el campo image al form con ese valor
                formData.append('image', valor[valor.length-1]);
                //paso el id del post, el formData con el archivo a subir y los headers del request
                this.$axios.post(this.$root.urls.postUPLOAD + this.post.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((res)=> {
                    console.log(res);
                }).catch((e)=> {
                    this.fileError = e.response.data.message
                    //console.log(e);
                })

            },
            deep: true  //permite que el watch detecte cambios internos en filesDaD, no solo cuando se reemplaza por un nuevo array.
        }
    }
}
</script>