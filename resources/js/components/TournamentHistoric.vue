<template>
    <div id="content">
        <div class="list-group" v-if="showList">
            <a href="" v-for="tournament in tournaments" :key="tournament.id" 
                :data-id="tournament.id" class="list-group-item list-group-item-action btn"
                @click.stop="onClick($event)" >
                {{tournament.name}} - {{tournament.branch}}
            </a>
        </div>
        <div class="d-block text-center" v-if="loading">
            <i class="fas fa-spinner fa-spin" style="font-size: 7em;"></i>
        </div>

        <div v-if="showData" class="position-relative">
            <div class="position-fixed" style="top:10px; z-index:100">
                <a href="#" class="btn btn-secondary" style="font-size: 1.5em;" id="backArrow" @click.stop="back($event)"> <i class="fas fa-arrow-left"></i> </a>
            </div>
            <h3 class="d-block text-center">
                {{this.data.name}} - Rama {{this.data.branch}}
            </h3>
            <h4 class="d-block text-center">
                Fecha: <date-format :date="this.data.date" format="dddd D [de] MMMM [de] YYYY "></date-format>
                <span class="badge badge-danger" v-if="isPast()" >Terminó</span>
                <span class="badge badge-success" v-else >Próximo</span>                
            </h4>
 
            <h4 class="d-block text-center">
                Datos de los participantes              
            </h4>
            <GChart
                type="PieChart"
                :data="ageGraphData()"
                :options="ageGraphOptions"
            />
            <GChart
                type="PieChart"
                :data="careerGraphData()"
                :options="careerGraphOptions"
            />

            <h4 class="d-block text-center">
                Datos del torneo              
            </h4>

            <p>
                <b>Nombre del torneo: </b>{{ this.data.name }} <br>
                <b>Rama: </b>{{ this.data.branch }} <br>
                <b>Fecha: </b><date-format :date="this.data.date" format="dddd D [de] MMMM [de] YYYY "></date-format> <br>
                <b>Número de participantes: </b>{{ this.data.users.length }} <br>
                <b>Maximo de inscripciones: </b>{{this.data.max_room}} <br>
                <b>Deporte: </b>{{ this.data.sport.name }} <br>
            </p>

            <h4 class="d-block text-center">
                Datos del deporte ({{this.data.sport.name}})              
            </h4>

            <p>
                <b>Torneos de {{this.data.sport.name}}:</b>{{Object.keys(this.data.sport.tournaments).length -1 }} <br>
                <b>Total de inscripciones: </b>{{this.data.sport.tournaments.counts._total}}
                <GChart
                    type="PieChart"
                    :data="sportGraphData()"
                    :options="{title: 'Inscripciones en los torneos de '+this.data.sport.name}"
                />
            </p>

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
            this.data.users.forEach(user => {
                let age = moment(user.birthdate).fromNow(true);
                if(ageCounts[age])
                    ageCounts[age]++;
                else
                    ageCounts[age] = 1;
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
            this.data.users.forEach(user => {
                let career = user.career;
                if(careers[career])
                    careers[career]++;
                else
                    careers[career] = 1;
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
