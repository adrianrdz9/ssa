<template>
    <div class="p-4 mb-4">
        <div class="row">
            <div v-for="notice in notices" :key="notice.id"  class="col-sm-12 col-md-6 mt-2 p-4" >
                <div class="row pill shadow px-4 pt-2 notice" :style="{'background-color':notice.color }" >
                    <p class="w-100">
                        {{notice.notice}}
                        <br>
                        <span>Mostrar hasta: {{notice.fmax_date.format('D [de] MMMM [de] YYYY')}}</span>
                    </p>
                    <br>
                    <a href="#" class="text-indigo" data-toggle="modal" :data-target="'#editNotice-'+notice.id">Editar</a>
                </div>

                <div class="modal fade" :id="'editNotice-'+notice.id" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form :action="'/admin/notices/'+notice.id" method="post">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancel">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="date" name="max_date" v-model="notice.max_date" v-on:change="formatDates" class="form-control">
                                        <input type="text" name="notice" v-model="notice.notice" class="form-control mt-2" placeholder="Avisos">
                                        <input type="color" name="color" v-model="notice.color" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <form :action="'/admin/notices/'+notice.id" method="post">
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addNotice">Agregar aviso</button>
        <div class="modal fade" id="addNotice" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Agregar aviso</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/notices" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="date" name="max_date" id="date" class="form-control">
                            <input type="text" name="notice" id="text" class="form-control">
                            <input type="color" name="color" class="form-control" value="#f1dd73">

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
        n: Array
    },

    data(){
        return {
            notices: this.n,
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
            for (let i = 0; i < this.notices.length; i++) {
                this.notices[i].fmax_date = moment(this.notices[i].max_date);
            }
        }
    }
}
</script>
