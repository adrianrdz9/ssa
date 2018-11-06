<template>
    <div class="card">
        <div class="card-header">
            <h3>Nuevo torneo</h3>
        </div>
        <div class="card-body">
            <form action="/admin/tournaments" method="post" @submit="validateForm">
                <input type="hidden" name="_token" :value="csrf">
                <input type="text" name="name" id="name" class="form-control my-2" placeholder="Nombre del torneo" required>
                <small>Deporte</small>
                <select name="sport" id="sport" class="form-control" required>
                    <option v-for="sport in sports" :key="sport.id" :value="sport.id">{{sport.name}}</option>
                </select>
                <div class="w-100 text-right">
                    <a href="#" id="addSport" @click="addSport">Agregar deporte</a>
                </div>
                <div class="w-100 px-2">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 px-2">
                            <label for="date" class="mb-0"><small>Fecha</small></label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="col-sm-12 col-md-6 px-2">
                            <label for="max_room"></label>
                            <input type="number" name="max_room" id="max_room" min="1" class="form-control" placeholder="Máximo de inscripciones" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <span>Ramas disponibles</span>
                            <div class="row">
                                <div class="col checkbox-group form-check">
                                    <input type="checkbox" name="branch[]" id="branch-varonil"  value="varonil">
                                    <label for="branch-varonil">Varonil</label>
                                </div>
                                <div class="col checkbox-group">
                                    <input type="checkbox" name="branch[]" id="branch-femenil"  value="femenil">
                                    <label for="branch-femenil">Femenil</label>
                                </div>
                                <div class="col checkbox-group">
                                    <input type="checkbox" name="branch[]" id="branch-mixto"  value="mixto">
                                    <label for="branch-mixto">Mixto</label>
                                </div>

                                <div class="text-red col-12 text-left d-none" id="checkbox-error">
                                    Debes de elegir al menos una opcion
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-75 mx-auto d-block mt-4" >Crear</button>
            </form>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        s: Array
    },

    data() {
        return{
            sports: this.s,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },

    methods:{
        addSport(){
            swal({
                title: 'Nombre del deporte',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'on'
                },
                showCancelButton: true,
                confirmButtonText: 'Agregar',
                showLoaderOnConfirm: true,
                preConfirm: (data) => {
                    axios.post('/admin/sports', {
                        name: data
                    }).then(response => {
                        console.log(response);
                        
                        if(response.status !== 200 && response.status !== 201){
                            swal('Error',error.response.data.errors.name[0],'error');
                            throw new Error();
                        }
                        this.sports.push(response.data);
                        return response;
                    }).catch(error =>{       
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                    console.log(result);
                if (result.value) {

                    swal({
                        title: `Deporte creado`,
                        type: 'success',
                    })
                }
            })
        },

        validateForm: function(e){
            if(document.querySelectorAll('input[type="checkbox"]:checked').length === 0){
                document.querySelector('#checkbox-error').classList.remove('d-none');
                e.preventDefault();
                return false;
            }else{
                return true;
            }
        }
    },

}
</script>
