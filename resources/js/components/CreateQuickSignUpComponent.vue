<template>
    <div class="container mt-4">
        <h3>Agregar participante</h3>
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" v-model="name">
        <input type="text" name="account_number" id="account_number" class="form-control mt-2" placeholder="Número de cuenta" v-model="account_number">
    
        <button type="button" class="btn btn-primary mx-auto" @click="submitForm">Crear</button>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Usuarios rapidos</h4>
            </div>

            <div class="card-body">
                <div class="row p-1">
                   <div class="card p-2 col-sm-12 col-md-3" v-for="user of users" :key="user.id">
                       <h5>
                           {{user.name}}
                       </h5>
                       <span>
                           {{user.account_number}}
                       </span>
                   </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        u: Array,
        id: Number
    },

    data(){
        return {
            name: '',
            account_number: '',
            users: this.u
        }
    },

    methods: {
        validateForm(){
            if(!this.name || !this.account_number){
                alert('Todos los campos son obligatorios');
                return false;
            }

            return true;
        },

        submitForm(){
            if(this.validateForm()){
                axios.post(`/actividades-deportivas/torneos/rapido/${this.id}`, {
                    name: this.name,
                    account_number: this.account_number,
                    tournament_id: this.id
                }).then((response) => {
                    this.name = ""
                    this.account_number = ""
                    console.log(response.response)
                })
            }

        }
    }
}
</script>

