<template>
    <span class="text-capitalize">
        {{fdate}}
    </span>
</template>


<script>
export default {
    props: {
        date: String,
        format: String
    },

    data(){
        return {
            fdate: null
        }
    },

    created(){
        this.fdate = moment(this.date).format(this.format)
    }
}
</script>
