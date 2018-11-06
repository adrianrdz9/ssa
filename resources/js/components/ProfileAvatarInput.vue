<template>
<div>
    <label for="avatar" class="btn btn-secondary">Cambiar imagen de perfil</label>
    <input type="file" name="avatar" id="avatar"  @change="changeImg($event)" class="d-none">
    <img :src="imageUrl" alt="Missing" height="70">

</div>

</template>


<script>
export default {
    props: {
        src: String
    },

    data() {
        return {
            imageUrl: this.src
        }
    },
    methods: {
        changeImg(event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = (e)=>{
                    
                    this.imageUrl =  e.target.result;
                }

                reader.readAsDataURL(event.target.files[0]);
            }
            
        }
    }
}
</script>
