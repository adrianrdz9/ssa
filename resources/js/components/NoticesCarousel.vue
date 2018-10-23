<template>
    <div v-if="slides.length > 0">
        <div id="noticesCarousel" class="carousel slide position-relative" data-ride="carousel" style="margin-top: -1.5rem;">
            
            <ol class="carousel-indicators">
                <li v-for="(slide, i) in slides" :key="slide.id" data-target="#noticesCarousel" :data-slide-to="i" :class="{'active': i==0, 'pt-1':true}"></li>
            </ol>
            <div class="carousel-inner">
                <div v-for="(slide, i) in slides" :key="slide.id" :class="{'carousel-item': true, 'active': i==0}" :caption.sync="slide.caption">
                    <img class="d-block w-100 " :src="slide.img" alt="" height="400">
                    <div class="carousel-caption d-none d-block w-100 position-absolute" style="left:0">
                        <div :class="{'p-2 rounded w-100': true, 'd-none': !slide.caption}" style="background-color: rgba(0,0,0,0.4)">
                            <p class="mb-0">{{slide.caption}}</p>
                            <a :href="slide.link_to" class="d-block text-right mt-0 w-75">{{slide.link_text}}</a>
                        </div>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev" href="#noticesCarousel" role="button" data-slide="prev">
                <div class="bg-black pt-3 pb-2 px-3 rounded-circle">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </div>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#noticesCarousel" role="button" data-slide="next">
                <div class="bg-black pt-3 pb-2 px-3 rounded-circle">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </div>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
</template>

<script>
export default {
    props: {
        slides: Array
    }
}
</script>
