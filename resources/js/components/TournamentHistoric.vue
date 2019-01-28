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
            <!-- 
                Nombre del torneo
                Fecha
                Pasado o proximo
                Datos de participantes
                    Grafica de edades
                    Grafica de carreras
                Datos del torneo
                    Nombre
                    Ramas
                    Fecha
                    Equipos inscritos
                    Maximo de equipos
                    Deporte
                Datos del deporte
                    Torneos de ese deporte
                    Numero de equipos en diferentes torneos
            -->
            

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
            this.data.teams.foreach(users => {
                users.foreach(user => {
                    let age = moment(user.birthdate).fromNow(true);
                    if(ageCounts[age])
                        ageCounts[age]++;
                    else
                        ageCounts[age] = 1;
                })
            });                        

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
            this.data.teams.forEach(users => {
                users.foreach(user => {
                    let career = user.career;
                    if(careers[career])
                        careers[career]++;
                    else
                        careers[career] = 1;
                })
            });                        

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
            for (const tName in this.data.sport.tournaments.counts) {
                if(tName !== '_total')
                    data.push([tName, this.data.sport.tournaments.counts[tName]]);
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
        margin-left: 2em;
        position: relative;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    #backArrow::before{
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: calc(35px/2) 30px calc(35px/2) 0;
        border-color: transparent #6c757d transparent transparent;
        top: -1px;
        right: 2em;
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
