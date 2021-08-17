<template>
    <div class="row">
        <div class="col-md-4">
            <!-- Botones para filtrar por ocupacion -->
            <div class="btn-group">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="dropDownTextOccupation" v-html="this.dropDownTextOccupation"></span>
                </button>
                <div class="dropdown-menu">
                    <button v-for="occupation in occupations" :key="occupation.id"  
                    @click="filterSelected(occupation.id, occupation.name)" class="dropdown-item">{{ occupation.name }}</button>
                    <button @click="filterSelected('')" class="dropdown-item"><b>Mostrar todos</b></button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Botones para ordenar por apellido -->
            <div class="btn-group">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="dropDownTextLastName" v-html="this.dropDownTextLastName"></span>
                </button>
                <div class="dropdown-menu">
                    <button @click="sortingbyLastName('asc')" class="dropdown-item">Ascendente</button>
                    <button @click="sortingbyLastName('desc')" class="dropdown-item">Descendente</button>
                    <button @click="sortingbyLastName('')" class="dropdown-item"><b>Cancelar</b></button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Botones para ordenar por edad -->
            <div class="btn-group">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="dropDownTextAge" v-html="this.dropDownTextAge"></span>
                </button>
                <div class="dropdown-menu">
                    <button @click="sortingbyAge('asc')" class="dropdown-item">Ascendente</button>
                    <button @click="sortingbyAge('desc')" class="dropdown-item">Descendente</button>
                    <button @click="sortingbyAge('')" class="dropdown-item"><b>Cancelar</b></button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        occupations: []
    },

    data() {
        return{
            dropDownTextOccupation: 'Filtrar por <b>Ocupación</b>',
            dropDownTextLastName: 'Ordenar por <b>Apellido</b>',
            dropDownTextAge: 'Ordenar por <b>Edad</b>',
        }
    },

    methods:{

        //metodo para el filtro por ocupacion
        filterSelected(selectedID, selectedName){
            //Modificamos la apariencia del boton para dejar saber al usuario que la lista está siendo filtrada
            let dropDownTextOccupation = document.getElementById("dropDownTextOccupation");
            if(selectedID){
                dropDownTextOccupation.innerHTML = selectedName;
            }else{
                dropDownTextOccupation.innerHTML = this.dropDownTextOccupation;
            }
            //Pasamos al componente padre si queremos filtrar por ocupación
            this.$emit('filterBy', selectedID);
        },

        //metodo para ordenar por apellido
        sortingbyLastName(direction){
            //Modificamos la apariencia del boton para dejar saber al usuario que la lista está siendo ordenada
            let dropDownTextLastName = document.getElementById("dropDownTextLastName");
            if(direction){
                dropDownTextLastName.innerHTML = '<b>Apellido</b> ' + direction;
            }else{
                dropDownTextLastName.innerHTML = this.dropDownTextLastName;
            }
            //Pasamos al componente padre si queremos ordenar por apellido y el tipo de orden
            this.$emit('sortLastNameAction', direction);
        },

        //metodo para ordenar por edad
        sortingbyAge(direction){
            //Modificamos la apariencia del boton para dejar saber al usuario que la lista está siendo ordenada
            let dropDownTextAge = document.getElementById("dropDownTextAge");
            if(direction){
                dropDownTextAge.innerHTML = '<b>Edad</b> ' + direction;
            }else{
                dropDownTextAge.innerHTML = this.dropDownTextAge;
            }
            //Pasamos al componente padre si queremos ordenar por apellido y el tipo de orden
            this.$emit('sortAgeAction', direction);
        }

    }
    
}
</script>