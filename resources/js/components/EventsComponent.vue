<template>
    <div class="p-4 mb-4">
        <div v-if="events.length > 0">
            <div class="row">
                <div v-for="event in events" :key="event.id"  class="col-sm-12 col-md-6 mt-2 p-4" >
                    <div class="row pill shadow">
                        <div class="date col col-sm-3">
                            <b>{{event.date.format('DD')}}</b>
                            <span>
                                {{event.date.format('MMM')}} <br>
                                {{event.date.format('YYYY')}}
                            </span>
                        </div>
                        <p class="col-sm-8">
                            {{event.event}}
                        </p>
                    </div>
                </div>       
            </div>
        </div>
        <div v-else>
            <h2>No hay eventos</h2>
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
        for (let i = 0; i < this.events.length; i++) {
            this.events[i].date = moment(this.events[i].date);
        }
    }
}
</script>
