<template>
    <div>
        <notices-carousel :slides="slides"></notices-carousel>
        <div class="slider-editor">
            <div v-for="(slide, i) in slides" :key="slide.id" class="card">
                <img :src="slide.img" alt="" class="w-100" height="200">
                <div class="card-body">
                    <form :action="'/admin/slides/'+slide.id" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="text" v-model="slide.caption" class="form-control" placeholder="Pie de imagen" name="caption">
                        <input type="text" v-model="slide.link_text" class="form-control" placeholder="Texto del link" name="link_text">
                        <input type="text" v-model="slide.link_to" class="form-control" placeholder="Dirección del link" name="link_to">
                        <label>Imagen</label>
                        <input type="file" @change="changeImg(i, $event)" class="form-control-file" name="image">
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <input type="submit" value="Guardar" class="btn btn-success w-100">
                            </div>
                            <div class="col-sm-6">
                                <form :action="'/admin/slides/'+slide.id" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="submit" value="Eliminar" class="btn btn-danger w-100">
                                </form>
                            </div>
                        </div>
                        <span class="font-weight-bold text-monospace">No olvides guardar los cambios</span>
                    </form>
                    
                </div>
            </div>
            <div class="card">
                <form action="/admin/slides" method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <button class="btn btn-secondary btn-lg rounded-circle">
                        <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        s: Array
    },

    data(){
        return {
            slides: this.s,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },

    mounted(){
       
    },

    
    methods: {
        changeImg(i, event){
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = (e)=>{
                    console.log(e.target);
                    
                    this.slides[i].img =  e.target.result;
                }

                reader.readAsDataURL(event.target.files[0]);
            }
            
        }
    }

    
}
</script>
