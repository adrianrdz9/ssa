<template>
    <div class="card">
        <div class="card-header">
            <h3>Nuevo torneo</h3>
        </div>
        <div class="card-body">
            <form action="/torneos/nuevo" method="post" @submit="validateForm">
                <input type="hidden" name="_token" :value="csrf">
                <input type="text" name="name" id="name" class="form-control my-2" placeholder="Nombre del torneo" required>
                <input type="text" name="responsable" id="responsable" class="form-control my-2" placeholder="Responsable del torneo" required>
                <input type="text" name="place" id="place" class="form-control my-2" placeholder="Sede" required>
                <input type="text" name="semester" id="semester" class="form-control my-2" placeholder="Semestre del torneo" required>
                
                
                
                
                <small>Deporte</small>
                <select name="sport_id" id="sport_id" class="form-control" required>
                    <option v-for="sport in sports" :key="sport.id" :value="sport.id">{{sport.name}}</option>
                </select>
                <div class="w-100 text-right">
                    <a href="#" id="addSport" @click="addSport">Agregar deporte</a>
                </div>
                <div class="w-100 px-2">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                            <label for="date" class="mb-0"><small>Fecha del torneo</small></label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                            <label for="technic_meeting" class="mb-0"><small>Fecha de la reunion técnica</small></label>
                            <input type="date" name="technic_meeting" id="technic_meeting" class="form-control" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                            <label for="signup_close" class="mb-0"><small>Cierre de inscripciones</small></label>
                            <input type="date" name="signup_close" id="signup_close" class="form-control" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                            <label for="max_teams"></label>
                            <input type="number" name="max_teams" id="max_teams" min="1" class="form-control" placeholder="Máximo de equipos" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                            <label for="min_per_team"></label>
                            <input type="number" name="min_per_team" id="min_per_team" min="1" class="form-control" placeholder="Mínimo de integrantes" required>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 px-2">
                            <label for="max_per_team"></label>
                            <input type="number" name="max_per_team" id="max_per_team" min="1" class="form-control" placeholder="Máximo de integrantes" required>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-12 text-center mb-2">
                            <span>Requisitos</span>
                        </div>
                        <div class="col" v-for="requirement in requirements" :key="requirement.id">
                            <input type="checkbox" name="requirements[]" id="requirements" :value="requirement.id">
                            <label for="requirements">{{requirement.name}}</label>
                        </div>
                        <div class="col-12 text-right mb-4">
                            <a href="#" id="addRequirement" @click="addRequirement">Agregar requerimiento</a>
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

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="row justify-content-around">
                                <div class="col-sm-12 col-md-6 col-lg-4 checkbox-group form-check">
                                    <input type="checkbox" name="only_representative" id="only_representative"  value="true">
                                    <label for="only_representative" >Solo equipos representativos  </label>
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
        s: Array,
        r: Array,
    },

    data() {
        return{
            sports: this.s,
            requirements: this.r,
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

        addRequirement(){
            swal({
                title: 'Nombre del requerimiento',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'on'
                },
                showCancelButton: true,
                confirmButtonText: 'Agregar',
                showLoaderOnConfirm: true,
                preConfirm: (data) => {
                    axios.post('/admin/requirements', {
                        name: data
                    }).then(response => {
                        console.log(response);
                        
                        if(response.status !== 200 && response.status !== 201){
                            swal('Error',error.response.data.errors.name[0],'error');
                            throw new Error();
                        }
                        this.requirements.push(response.data);
                        return response;
                    }).catch(error =>{       
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                    console.log(result);
                if (result.value) {

                    swal({
                        title: `Requerimiento creado`,
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
