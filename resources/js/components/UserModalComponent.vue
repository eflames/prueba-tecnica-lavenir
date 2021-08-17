<template>
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

</template>
<script>
export default {
    props:
        ['occupations', 'user', 'modalStatus'],
    data() {
            return{
               modalOpen: this.modalStatus,
            }
        },

        methods:{

            listOccupations(){
                axios.get('/api/occupations').then(res => {
                    this.occupations = res.data;
                });
            },

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