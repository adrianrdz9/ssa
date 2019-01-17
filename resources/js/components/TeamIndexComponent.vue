<template>
    <div>
        <h2 class="d-block text-center" v-if="teams.length <= 0">Aún no hay equipos</h2>
        <div class="container">
            <div class="row">
                <div class="col" v-for="team in teams" :key="team.id">
                    <div class="card">
                        <div 
                            :class="{
                                'card-header': true, 
                                'bg-primary': team.accepted_users.length < tournament.min_per_team,
                                'bg-danger': team.accepted_users.length >= tournament.max_per_team,
                                'bg-success': team.accepted_users.length < tournament.max_per_team && team.accepted_users.length >= tournament.min_per_team
                            }"
                        >
                            <h3>{{team.name}}</h3>
                            <h5>
                                <i v-if="team.accepted_users.length < tournament.min_per_team">A este equipo le faltan {{tournament.min_per_team - team.accepted_users.length}} integrantes para poder entrar al torneo</i>
                                <i v-if="team.accepted_users.length >= tournament.max_per_team">Este equipo ya está lleno</i>
                                <i v-if="team.accepted_users.length < tournament.max_per_team && team.accepted_users.length >= tournament.min_per_team">Este equipo solo puede recibir {{tournament.max_per_team - team.accepted_users.length}} integrantes mas</i>
                            </h5>
                        </div>

                        <div class="card-body">
                            <p>
                                <b>Capitan: </b> {{team.captain.name}} {{team.captain.last_name}}
                            </p>
                            <p>
                                <b>Integrantes del equipo</b>
                                <ul>
                                    <li v-for="user in team.accepted_users" :key="user.user.id">{{user.user.name}} {{user.user.last_name}}</li>
                                </ul>
                            </p>
                            
                            <div v-if="team.status" class="text-right">
                                <button disabled="disabled" :class="{
                                    'btn': true,
                                    'btn-success': team.status == 'accepted',
                                    'btn-warning': team.status == 'pending',
                                    'btn-danger': team.status == 'denied'
                                }">
                                    {{team.status == 'accepted' ? "Ya eres parte del equipo" : teams.status == 'pending' ? "Rechazado" : "Solicitud pendiente"}}
                                </button>
                            </div>
                            <div v-else>
                                <button class="btn btn-info d-block ml-auto" v-if="team.accepted_users.length < tournament.max_per_team" @click="signToTeam(team)">
                                    Unirme a este equipo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row justify-content-around mt-4" v-if="tournament.max_teams > teams.length">
            <div class="col-sm-12 col-md-6">
                <button class="btn btn-info w-100" @click="newTeam">Crear nuevo equipo</button>
            </div>
        </div>
        <h2 class="d-block text-center" v-else>Ya no se pueden inscribir mas equipos</h2>
    </div>
</template>

<script>
export default {
    props: {
        t: Array,
        tr: Object,
        branch: Object,
    },

    data(){
        return {
            teams: this.t,
            tournament: this.tr
        }
    },

    methods: {
        newTeam(){
            swal({
                title: 'Crear un equipo',
                text: "El capitan del equipo debe de crear el equipo, pues el creador será el responsable y unico capaz de aceptar a los integrantes del equipo, además deberá de completar el registro del equipo (más información sobre este paso despues de crear el equipo)",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    swal({
                        title: 'Nombre del equipo',
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'on'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Crear',
                        showLoaderOnConfirm: true,
                        preConfirm: (data) => {
                            axios.post('/actividades-deportivas/teams', {
                                tournament_id: this.branch.id,
                                name: data
                            }).then(response => {
                                console.log(response);
                                
                                if(response.status !== 200 && response.status !== 201){
                                    throw new Error(reponse);
                                }
                                return response;
                            }).catch(error =>{                                 
                                if(error.response.status == 400)
                                    swal('Error', error.response.data.error, 'error');
                                else if(error.response.status == 422)
                                    swal('Error', error.response.data.errors.name[0], 'error');
                            })
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    }).then((result) => {
                        if (result.value) {
                            swal('Equipo creado', 'Recuerda el equipo debe de tener entre '+this.tournament.min_per_team+' y '+this.tournament.max_per_team+' integrantes.', 'success').then(()=>window.location.reload());
                        }
                    })
                }
            })
        },

        signToTeam(team){
            swal({
                title: 'Unirse al equipo <i>'+team.name+'</i>',
                text: "El capitan del equipo debera aceptarte antes de que puedas unirte a este equipo, asi que si no lo has hecho asegurate de que el capitan te aceptara. <br> El capitan del equipo podra ver tus datos de contacto (número de telefono y correo electrónico) por si quiere verificar tu identidad",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    axios.post('/actividades-deportivas/teams/'+team.id).then(response => {
                        console.log(response);
                                
                        if(response.status !== 200 && response.status !== 201){
                            throw new Error(reponse);
                        }
                        //this.teams.push(response.data[0]);
                        return response;
                    }).catch(error => {
                        if(error.response.status == 400)
                            swal('Error', error.response.data.error, 'error');
                        else if(error.response.status == 422)
                            swal('Error', error.response.data.errors.name[0], 'error');
                    })
                }
            })
        }
    }
}
</script>