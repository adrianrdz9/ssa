<template>
    <div class="p-4 mb-4">
        <div class="row">
            <div v-for="event in events" :key="event.id"  class="col-sm-12 col-md-6 mt-2 p-4" >
                <div class="row pill shadow">
                    <div class="date col col-sm-3">
                        <b>{{event.fdate.format('DD')}}</b>
                        <span>
                            {{event.fdate.format('MMM')}} <br>
                            {{event.fdate.format('YYYY')}}
                        </span><br>
                        <a href="#" class="text-indigo" data-toggle="modal" :data-target="'#editEvent-'+event.id">Editar</a>
                    </div>
                    <p class="col-sm-8 position-relative p-2">
                        {{event.event}}
                        <a :href="event.link_to" class="position-absolute" style="bottom: 0; right: 0;">{{event.link_text}}</a>
                    </p>
                </div>

                <div class="modal fade" :id="'editEvent-'+event.id" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form :action="'/actividades-deportivas/admin/events/'+event.id" method="post">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancel">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="PUT">
                                        <label for="date">Fecha</label>
                                        <input type="date" name="date" v-model="event.date" v-on:change="formatDates" class="form-control">
                                        <input type="text" name="event" v-model="event.event" class="form-control mt-2" placeholder="Evento">
                                        <input type="text" name="link_text" v-model="event.link_text" class="form-control mt-2" placeholder="Texto del link">
                                        <input type="text" name="link_to" v-model="event.link_to" class="form-control mt-2" placeholder="Dirección del link">
                                </div>
                                <div class="modal-footer">
                                    <form :action="'/actividades-deportivas/admin/events/'+event.id" method="post">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Eliminar" class="btn btn-danger">
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel">Cerrar</button>
                                    <input type="submit" class="btn btn-primary" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEvent">Agregar evento</button>
        <div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Agregar evento</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/actividades-deportivas/admin/events" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="_token" :value="csrf">
                            <label for="date">Fecha</label>
                            <input type="date" name="date" id="date" class="form-control mt-2">
                            <input type="text" name="event" class="form-control mt-2" placeholder="Nombre del evento">
                            <input type="text" name="link_text" class="form-control mt-2" placeholder="Texto del link">
                            <input type="text" name="link_to" class="form-control mt-2" placeholder="Dirección del link">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <input type="submit" value="Guardar" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        e: Array
    },

    data(){
        return {
            events: this.e,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },

    beforeMount(){
        this.formatDates();
    },

    methods: {
        cancel(){
            window.location.reload();
        },

        formatDates(){
            for (let i = 0; i < this.events.length; i++) {
                this.events[i].fdate = moment(this.events[i].date);
            }
        }
    }
}
</script>
