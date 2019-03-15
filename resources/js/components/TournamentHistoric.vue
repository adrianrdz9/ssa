<template>
    <div id="content">


        <div class="list-group" v-if="showList">
            <a href="" v-for="tournament in tournaments" :key="tournament.id" 
                :data-id="tournament.id" class="list-group-item list-group-item-action btn"
                @click.stop="onClick($event)" >
                {{tournament.name}}
            </a>
        </div>
        <div class="d-block text-center" v-if="loading">
            <i class="fas fa-spinner fa-spin" style="font-size: 7em;"></i>
        </div>

        <div v-if="showData" class="position-relative">
            {{this.data.sport.tournaments[0].name}}
            <!-- 
                !Nombre del torneo
                !Fecha
                !Pasado o proximo
                -Datos de participantes
                    !Grafica de edades
                    -Grafica de carreras
                -Datos del torneo
                    !Nombre
                    !Ramas
                    !Fecha
                    !Equipos inscritos
                    !Maximo de equipos
                    !Deporte
                Datos del deporte
                    Torneos de ese deporte
                    Numero de equipos en diferentes torneos
            -->

            <div >
                <a href="#" id="backArrow" @click="back"> Regresar </a>
            </div>

            <h1 class="text-center mt-2">
                {{data.name}}
                ({{data.sport.name}})
            </h1>
            <h2 class="text-center">
                Lugar: {{data.place}}
                -
                <span :style="{'color': isPast() ? 'red' : 'green'  }">
                    {{data.date}} 
                    {{ isPast() ? "(pasado)" : "" }}
                </span>
            </h2>

            <div>
                <h4 class="text-center">
                    Datos del torneo
                </h4>

                <div>
                   

                    <p><b>Nombre: </b> {{this.data.name}} </p>
                    <p>
                        <b>Ramas: </b>
                        <ul>
                            <li v-for="branch of this.data.branches" :key="branch.id">{{branch.branch}}</li>
                        </ul>
                    </p>
                    
                    <p><b>Semestre: </b> {{this.data.semester}} </p>
                    
                    <p><b>Fecha del torneo: </b> {{this.data.date}} </p>
                    <p><b>Fecha del cierre de inscripciones: </b> {{this.data.signup_close}} </p>
                    <p><b>Fecha de reunión técnica: </b> {{this.data.technic_meeting}} </p>

                    <p><b>Responsable: </b> {{this.data.responsable}} </p>

                    <p><b>Equipos inscritos: </b> {{this.data.teams.length}} </p>

                    <p><b>Máximo de equipos: </b>{{ this.data.max_teams }}</p>

                    <p><b>Deporte: </b> {{this.data.sport.name}} </p>

                    <p><b>Sede: </b> {{this.data.place}} </p>
                </div>

                <span class="text-center d-block">Inscripciones con respecto a otros torneos de {{data.sport.name}}</span>
                <GChart
                    type="PieChart"
                    :data="sportGraphData()"
                />
            </div>

            <div>
                <h4 class="text-center">
                    Datos de los participantes
                </h4>

                <span class="text-center d-block">
                    Edades:

                    <GChart 
                        type="PieChart"
                        :data="ageGraphData()"
                    />
                </span>

                <span class="text-center d-block">
                    Carreras
                    <GChart
                        type="PieChart"
                        :data="careerGraphData()"
                    />
                </span>

            </div>
            

        </div>
    </div>
</template>


<script>
import { GChart } from 'vue-google-charts'
export default {
    components: {
        GChart
    },

    props: {
        tournaments: Array
    },

    mounted(){
       
    },

    methods: {
        onClick(event){
            event.preventDefault();
            this.showList= false;
            this.loading = true;
            const id = $(event.target).data('id');
            axios.get('/actividades-deportivas/historico/'+id)
                .then(response => {
                    if(response.statusText === "OK"){
                        this.data = response.data;
                        this.loading = false;
                        this.showData = true;
                    }
                })
        },

        back(event){
            event.preventDefault();
            this.showData = false;
            this.showList = true;
        },

        isPast(){
            return moment(this.data.date) < moment();
        },
        
        ageGraphData(){
            let ageCounts = {};
            for (let team of this.data.teams){
                for(let user of team[0].accepted_users){
                    user = user.user;

                    let age = moment().diff(user.birthdate, 'years')
                    if(ageCounts[age])
                        ageCounts[age]++;
                    else
                        ageCounts[age] = 1;
                }
            }                 

            let data = [
                ['Edad', 'Participantes'],
            ]

            for (const key in ageCounts) {
                if (ageCounts.hasOwnProperty(key)) {
                    const age = ageCounts[key];
                    data.push([key, age]);
                }
            }
            return data;

            
        },

        careerGraphData(){
            let careers = {};

            for (let team of this.data.teams){
                for(let user of team[0].accepted_users){
                    user = user.user;

                    let career = user.career;
                    if(careers[career])
                        careers[career]++;
                    else
                        careers[career] = 1;
                }
            }     
                 

            let data = [
                ['Carrera', 'Participantes'],
            ]

            for (const key in careers) {
                if (careers.hasOwnProperty(key)) {
                    const career = careers[key];
                    data.push([key, career]);
                }
            }
            return data;

            
        },

        sportGraphData(){
            
            let data = [
                ['Torneo', 'Inscripciones'],
            ]

            for(let tournament of this.data.sport.tournaments){

                data.push([tournament.name, tournament.teams])
            }
            return data;
        }
    },

    data () {
        return {
            data: null,
            showList: true,
            loading: false,
            showData: false,
            ageGraphOptions: {
                title: "Edad de los participantes"
            },
            careerGraphOptions: {
                title: "Carrera de los participantes"
            }
        }
    }
}
</script>

<style scoped lang="scss">


    #backArrow {
        left: 2.5em;
        position: relative;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    #backArrow::before{
        content: '';
        position: absolute;
        width: 15px;
        height: 15px;
        border-style: solid;
        border-width: calc(35px/2) 30px calc(35px/2) 0;
        border-color: transparent #6c757d transparent transparent;
        top: -1px;
        left: -2.5em;
        transition: border-color 0.15s ease-in-out;
    }   

    #backArrow:hover::before{
        border-right-color: #5a6268;
        
    }

    #content{
        min-height: 50vh;
        max-height: 50vh;
        overflow-y: scroll;
    }
</style>
