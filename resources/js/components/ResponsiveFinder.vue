<template>
    <div>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" v-model="name" placeholder="Nombre del alumno" @change="findUser">
            </div>
            <div class="col">
                <select v-model="tournament" class="form-control" @change="findUser">
                    <option :value="t.id" v-for="t in tournaments" :key="t.id">{{t.name}}</option>
                </select>
            </div>
        </div>
        <div class="row mt-4" v-if="loading" style="font-size: 3em;">
            <div class="col text-center">
                <i class="fas fa-spinner fa-spin fa-lg"></i>
            </div>
        </div>
        <div class="row mt-4" v-if="!loading">
            <div class="col" v-for="result in results" :key="result.id">
                
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{result[0].user.name}}
                            {{result[0].user.last_name}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <span><b>Torneo: </b>{{result[0].team.branch.tournament.name}}</span><br>
                        <span><b>Rama: </b>{{result[0].team.branch.branch}}</span><br>
                        <span><b>Equipo: </b>{{result[0].team.name}}</span><br>
                        <a target="_blank" :href="'/actividades-deportivas/responsiva/'+result[0].id">Descargar responsiva <i class="fas fa-external-link-alt"></i></a> <br>
                        <a target="_blank" :href="'/actividades-deportivas/carnet-imss/'+result[0].user.id">Descargar carnet <i class="fas fa-external-link-alt"></i></a><br>
                        <a target="_blank" :href="'/actividades-deportivas/credencial/'+result[0].user.id">Descargar credencial <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        tournaments: Array
    },
    data(){
        return {
            name: "",
            tournament: this.tournaments[0].id,
            loading: false,
            results: null
        }
    },
    methods: {
        findUser(){
            if(this.name == null || this.name == "") return;
            this.loading = true;
            axios.post('/actividades-deportivas/admin/getResponsive', {
                name: this.name,
                tournament_id: this.tournament
            }).then((data) => {
                data = data.data
                console.log(data);
                this.results = data;
                this.loading = false;
            }).catch(()=>{
                this.loading = false;
                this.results = null;
            });
        }
    }
}
</script>