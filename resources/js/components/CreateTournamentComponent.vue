<template>
    <div>
        <small>Deporte</small>
        <select name="sport_id" id="sport_id" class="form-control" required>
            <option v-for="sport in sports" :key="sport.id" :value="sport.id">{{sport.name}}</option>
        </select>
        <div class="w-100 text-right">
            <a href="#" id="addSport" @click="addSport">Agregar deporte</a>
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

    </div>
</template>


<script>
export default {
    props: {
        s: Array,
        r: Array,
        oldData: Object,
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
                    axios.post('/actividades-deportivas/admin/sports', {
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
                    axios.post('/actividades-deportivas/admin/requirements', {
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
