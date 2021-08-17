<template>
    <div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <h1>Lista de usuarios</h1>
                <p>Administrar los usuarios registrados en el sistema</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12">
                        <searchbar-component 
                            @searchAction="filterBySearchBar">
                        </searchbar-component>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-md-right text-center">
                        <filters-component :occupations="occupations" 
                            @filterBy="filterByOccupation"
                            @sortLastNameAction="sortLastName"
                            @sortAgeAction="sortAge"
                        ></filters-component>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabla de usuarios -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No. Documento</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Ocupación</th>
                                <th scope="col">Edad</th>
                                <th scope="col" class="text-center" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <th scope="row">{{ user.id }}</th>
                                <th>{{ user.document_id }}</th>
                                <td>{{ user.first_name }}</td>
                                <td>{{ user.last_name }}</td>
                                <td>{{ user.occupation.name }}</td>
                                <td>{{ user.age }}</td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-dark" @click="openModal(user)">
                                        Editar
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button @click="deleteUser(index, user.id)" class="btn btn-xs btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- 
                        Modal de edición de usuario. 
                        Nota del dev: No soy muy fan de tenerlo aqui mismo pero es lo que hay xD 
                    -->
                    <div :class="{showModal : modalOpen}" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                                    <button type="button" class="close"  @click="closeModal()">
                                        <span aria-hidden="true" class="text-white">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="first_name">No. Documento</label>
                                        <input type="text" v-model="user.document_id" name="document_id" 
                                        class="form-control" placeholder="No. Documento">
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">Nombre</label>
                                        <input type="text" v-model="user.first_name" name="first_name" 
                                        class="form-control" placeholder="Nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">Apellido</label>
                                        <input type="text" v-model="user.last_name" name="last_name" 
                                        class="form-control" placeholder="Apellido">
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">Ocupación</label>
                                        <select name="occupation_id" class="form-control" v-model="user.occupation_id">
                                            <option value="" disabled>Seleccione...</option>
                                            <option v-for="occupation in occupations" 
                                            :key="occupation.id" :value="occupation.id">{{ occupation.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">Edad</label>
                                        <input type="text" v-model="user.age" name="age" class="form-control" placeholder="Edad">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn btn-outline-secondary" @click="closeModal()">
                                        Cancelar
                                    </button>
                                    <button type="button" class="btn btn-dark" v-on:click="updateUser()">
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin del modal de edición -->
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            this.listUsers();
            this.listOccupations();
        },

        data() {
            return{
                users: [], //lista de usuarios a mostrar
                user:{
                    document_id:'',
                    first_name:'',
                    last_name:'',
                    occupation_id:'',
                    age:'',
                }, //usuario a editar
                occupations: [], //lista de ocupaciones disponibles
                keywordsSelected: '', //variable helper para filtrar por la barra de búsqueda
                occupationSelected: '', //variable helper para filtrar por el dropdown de ocupaciones
                sortyByLastNameSelected: '', //variable helper para ordenar por apellido
                sortyByAgeSelected: '', //variable helper para ordenar por edad
                modalOpen: false, //variable switch para el modal
                id:0, //id global para poder mandar a backend el usuario a editar
            }
        },

        methods:{

            //metodo para obtener de la DB los usuarios a listar
            listUsers(){
                axios.get('/api/users', {
                    params:{
                        keywords: this.keywordsSelected,
                        occupation_id: this.occupationSelected,
                        sortLastName: this.sortyByLastNameSelected,
                        sortAge: this.sortyByAgeSelected,
                        }
                    }).then(res => {
                        this.users = res.data;
                });
                
            },

            //metodo para actualizar el usuario editado, se le pasa el objeto user y una ID global
            //Datos que se llena al momento de abrir el modal con el metodo openModal
            updateUser(){
                axios.put('/api/users/' + this.id, this.user).then(() => {
                        this.closeModal();
                        this.listUsers(); 
                    }).catch(error => {
                    console.log(error);
                });
            },

            //metodo para eliminar el usuario mediante el evento click del boton y se usa sweetalert2 para
            //un toque mas elegante xD
            deleteUser(index, id){
                this.$swal({
                    title: '¿Está segur@?',
                    html: `Si borra al usuario no podrá recuperarlo luego.`,
                    type: 'warning',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, estoy segur@',
                    cancelButtonText: 'No, cambié de opinión',
                    confirmButtonColor: '#e3342f',
                    showCloseButton: true,
                    showLoaderOnConfirm: true,
                }).then(result => {
                    if(result.value){
                        axios.delete('/api/users/' + id).then(() => {
                            this.$swal('Eliminado', 'El usuario fue elimnado correctamente', 'success');
                            this.users.splice(index, 1);
                            // this.listUsers();
                        });
                    }
                });
                
            },

            //metodo con el que se obtienen las ocupaciones diposnibles en DB
            listOccupations(){
                axios.get('/api/occupations').then(res => {
                    this.occupations = res.data;
                });
            },

            //Metodo para setear la variable que nos ayudará a filtrar por No. Doc 
            filterBySearchBar(keywordsFilter){
                this.keywordsSelected = keywordsFilter;
                this.listUsers();
            },

            //Metodo para setear la variable que nos ayudará a filtrar por ocupación 
            filterByOccupation(occupationFilter){
                this.occupationSelected = occupationFilter;
                this.listUsers();
            },

            //Metodo para setear la variable que nos ayudara a ordenar por apellido
            sortLastName(direction){
                console.log('parent ln ' + direction)
                this.sortyByLastNameSelected = direction;
                this.listUsers();
            },

            //Metodo para setear la variable que nos ayudara a ordenar por edad
            sortAge(direction){
                this.sortyByAgeSelected = direction;
                this.listUsers();
            },

            //metodo que sirve para setear la variable que abre el modal y se llenan los datos del usuario
            //mediante data binding
            openModal(data){
                this.modalOpen = true;
                this.id = data.id;
                this.user.document_id = data.document_id;
                this.user.first_name = data.first_name;
                this.user.last_name = data.last_name;
                this.user.occupation_id = data.occupation_id;
                this.user.age = data.age;
            },

            //metodo que solo sirve para setear la variable y poder cerrar el modal
            closeModal(){
                this.modalOpen = false;
            },
        }
        
    }
</script>
<style>
    /* clase ccs que le da visibilidad al modal de edición */
    .showModal{
        display: list-item;
        opacity: 1;
        background-color: rgba(0, 26, 48, 0.699);
    }
</style>