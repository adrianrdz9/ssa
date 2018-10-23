<template>
<div class="container">
    <h1 class="d-block text-center">Completar inscripción</h1>
    <div class="row">
        <div style="height: 200px; width: 300px;" class="col-auto" v-if="!decoded">
            <qrcode-reader @decode="onDecode" style="" :paused="paused" class="bg-secondary" >
                Escanear codigo QR (permitir acceso a la camara) <br>
            </qrcode-reader>

        </div>
        <div v-if="decoded">
            <qrcode  :value="validFolio" :options="{size: 200}" ></qrcode>
            <br>
            <a href="#" @click="decoded = false; paused = false">Abrir camara</a>
        </div>
        <div class="col">
            <form action="" @submit="onSubmit" ref="form">
                <div class="row">
                    <div class="col-9">
                        <input type="text" name="folio" class="form-control" v-model="folio">  
                    </div>
                    <div class="col-3">
                        <input type="submit" value="Buscar" class="btn btn-info w-100">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card" v-if="dataAvailable">

        <div class="card-header text-center" >
            <h2>
                
                {{tournament.name}}
                - rama 
                {{tournament.branch}}
            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 p-2 text-center">
                    <h5>Datos del torneo: </h5>
                    <p>
                        <b>Nombre: </b>
                        {{tournament.name}}
                    </p>

                    <p v-if="tournament.deleted_at !== null">
                        <b class="text-danger">Este torneo fue eliminado</b>
                    </p>

                    <p>
                        <b>Deporte: </b>
                            {{tournament.sport.name}}
                        </p>
                    <p>
                        <b>Máximo disponibles: </b>
                            {{tournament.max_room}}
                        </p>
                    <p>
                        <b>Lugares disponibles: </b>
                        {{tournament.roomLeft}}
                    </p>

                    <p>
                        <b>Fecha: </b>
                        <date-format :date="tournament.date" :format="'dddd D [de] MMMM [de] YYYY'"></date-format>
                    </p>
                </div>

                <div class="col-sm-12 col-md-6 p-2 text-center">
                    <h5 >Datos del alumno:</h5>
                    
                    <p>
                        <b>Nombre: </b>
                        {{user.name+' '+user.last_name}}
                    </p>

                    <p v-if="user.deleted_at !== null">
                        <b class="text-danger">Este cuenta fue eliminada</b>
                    </p>

                    <p>
                        <b>Correo electróncico</b>
                        {{user.email}}
                    </p>
                    <p>
                        <b>Altura: </b>
                        {{user.height}}
                        cm
                    </p>
                    <p>
                        <b>Peso: </b>
                        {{user.weight}}
                        kg
                    </p>

                    <p>
                        <b>Edad: </b>
                        {{user.age}}
                        años
                    </p>

                    <p>
                        <b>Carrera: </b>
                        {{user.career}}
                        {{user.semester}}
                    </p>

                    <p>
                        <b>Servicio médico: </b>
                        {{user.medical_service}}
                    </p>
                    <p>
                        <b>Tipo sanguineo: </b>
                        {{user.blood_type}}
                    </p>
                    <p>
                        <b>Número de carnet: </b>
                        {{user.medical_card_no}}

                    </p>

                    <p>
                        <b>Número telefonico: </b>
                        {{user.phone_number}}
                    </p>
                
                </div>
            </div>
        </div>
        <div class="card-footer">
            <span>
                Estado: 
                <b class="text-danger">pendiente</b>
            </span>
            <button class="btn btn-success float-right">
                Completar inscripción
            </button>
        </div>
    </div>
            
</div>
</template>

<script>
export default {
    data(){
        return {
            paused: false,
            video: {
                facingMode: { ideal: 'environment' }, // use rear camera if available
            },
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            folio: "",
            validFolio: "",
            dataAvailable: false,
            user: {},
            tournament: {},
            decoded: false
        }
    },

    methods: {
        onDecode(decodedString){
            this.folio = decodedString;
            this.onSubmit();
        },

        onSubmit(event){
            if(event)
                event.preventDefault();
            axios.get('/torneos/completar/'+this.folio).then((response)=>{
                console.log(response.data);
                if(response.data){
                    this.paused = true
                    this.tournament = response.data.tournament;
                    this.user = response.data.user;
                    this.dataAvailable = true;
                    this.decoded = true;
                    this.validFolio = this.folio;
                }
            }).catch((err) => {
                console.log(err.response);
            })
        }
    }
}
</script>

