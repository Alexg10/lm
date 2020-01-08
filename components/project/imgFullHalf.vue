<template>
    <section class="img-full-half-section">
        <div class="img-full-half-section-container" >
            <div class="img-full-half-container" v-for="img_half in img_full_half" v-bind:key>
                <img class="img-full-half-container-img" :src="img_half.bloc_img_full_half_image.url" alt="">
            </div>
        </div>
    </section>
</template>

<script>
    import { Timeline, TimelineMax } from 'gsap'
    import VueScrollmagic from 'vue-scrollmagic'
    
    export default {
        data(){
            return{
                
            }
        },
        props:[
            'img_full_half'
        ],
        mounted() {


            var img1 = document.querySelector(".img-full-half-container:nth-child(1) .img-full-half-container-img");
            var img2 = document.querySelector(".img-full-half-container:nth-child(2) .img-full-half-container-img");
            var img3 = document.querySelector(".img-full-half-container:nth-child(3) .img-full-half-container-img");
            var img4 = document.querySelector(".img-full-half-container:nth-child(4) .img-full-half-container-img");

            var scrollM = this.$scrollmagic;
            var tlA = new TimelineMax({ paused: false});

            tlA.fromTo(img1, 1, {y: -30},{y: 30, overwrite: false},"start")
            .fromTo(img2, 1, {y: -30},{y: 30, overwrite: false}, "start")
            .fromTo(img3, 1, {y: -30},{y: 30, overwrite: false}, "start")
            .fromTo(img4, 1, {y: -30},{y: 30, overwrite: false}, "start");

            const sceneHalfSection = scrollM.scene({
                triggerElement: ".img-full-half-section",
                triggerHook: 0.65,
                offset: -150,
                duration: window.innerHeight*2
            })
            .setTween(tlA)
            scrollM.addScene(sceneHalfSection);
        }
    }
</script>

<style lang="scss" scoped>
    .img-full-half-section{
        .img-full-half-section-container{
            display: flex;
            flex-wrap: wrap;
            .img-full-half-container{
                display: flex;
                justify-content: center;
                width: 50%;
                overflow: hidden;
                img{
                    width: 100%;
                    transform: scale(1.1);
                }
            }
        }
        &.three-multiple {
            .img-full-half-section-container{
                .img-full-half-container{
                    width: 33.3%;
                }
            }
        }
    }


</style>