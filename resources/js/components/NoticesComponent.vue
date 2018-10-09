<template>
    <div class="p-4 mb-4">
        <div v-if="notices.length > 0">
            <div class="row">
                <div v-for="notice in notices" :key="notice.id"  class="col-sm-12 col-md-6 mt-2 p-4" >
                    <div class="row pill shadow px-4 pt-2 notice"  :style="{'background-color':notice.color }">
                        <p>
                            {{notice.notice}}
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
        n: Array
    },

    data(){
        return {
            notices: this.n,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }
}
</script>
