<template>
    <div>
        <div class="d-block text-center" v-if="loading">
            <i class="fas fa-spinner fa-spin" style="font-size: 7em;"></i>
        </div>

        <div class="row" v-if="!loading">
            <div class="col-6">
                <div class="row">
                    <h2>Usuarios</h2>
                    <div class="col-12" v-for="user of users" :key="user.id">
                        <div class="card" v-if="user.name != null">
                            <div class="card-header">
                                <h3>
                                    {{ user.name }}  {{ user.last_name }}
                                </h3>
                                <span>
                                    {{ user.account_number }}
                                </span><br>
                                <span> {{ user.email }} </span>
                            </div>

                            <div class="card-body">
                                <label for="role"> Rol del usuario </label>
                                <select name="role" id="role" @change="updateRole($event, user.id)">
                                    <option :value="role.id" v-for="role of roles" :key="role.id" :selected="user.role == role.name"> {{ role.name }} </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <a href="/s/cu">Crear usuario</a>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <h2>Roles</h2>
                    <div class="col-12" v-for="role of roles" :key="role.id"> 
                        <div class="card">
                            <div class="card-header">
                                <h3> {{ role.name }} </h3>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning" @click="addRole">
                        Agregar rol
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            users: [],
            roles: [],
            loading: true
        }
    },

    created(){
        axios.get('/s').then(response => {
            this.users = response.data.users;
            this.roles = response.data.roles;

            this.loading = false;
        })
    },

    methods: {
        updateRole($event, userId){
            $($event.target).attr('disabled', true);

            axios.post('/s/u', {
                user_id: userId,
                role_id: $event.target.value
            }).then(response => {
                $($event.target).attr('disabled', false);
            }).catch(err => {
                window.location.reload();
            });

        },
        
        addRole(){
            swal({
                title: 'Agregar rol',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'on'
                },
                showCancelButton: true,
                confirmButtonText: 'Agregar',
                showLoaderOnConfirm: true,
                preConfirm: (data) => {
                    axios.post('/s/c', {
                        name: data
                    }).then(response => {
                        console.log(response);
                        
                        if(response.status !== 200 && response.status !== 201){
                            swal('Error',error.response.data.errors.name[0],'error');
                            throw new Error();
                        }
                        this.roles.push(response.data);
                        return response;
                    }).catch(error =>{       
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
                }).then((result) => {
                    console.log(result);
                if (result.value) {

                    swal({
                        title: `Rol creado`,
                        type: 'success',
                    })
                }
            })
        }
    }
}
</script>
