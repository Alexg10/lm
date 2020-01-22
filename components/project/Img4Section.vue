<template>
    <section class="img-4-section">
        <div class="container">
            <div class="img-4-section-container" >
                <div class="img-4-container grid-item" v-for="four_image in four_images" v-bind:key>
                    <!-- WHY sketch_image -->
                    <img class="img-4" :src="four_image.image.url" :alt="four_image.image.title">
                </div>
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
        props: [
            'four_images',
        ],
        mounted(){
            var imgs = document.getElementsByClassName("img-4-container");
            var scrollM = this.$scrollmagic;
            
            Array.prototype.forEach.call(imgs,function(el, i) {
                var img = el.getElementsByClassName("img-4");
                var tl = new TimelineMax({ paused: false});
                tl.staggerFromTo(".img-4", 1.5, {y: 140, opacity:0},{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false},0.35);
                const scene2 = scrollM.scene({
                    triggerElement: el,
                    triggerHook: 0.65,
                    offset: -100
                })
                .setTween(tl)
                .reverse(false)
                // .addIndicators({ name: '2 (IMG 4' })
                scrollM.addScene(scene2)
            });
        }
    }
</script>

<style lang="scss" scoped>
    .img-4-section{
        padding: 90px 0 110px;
        .img-4-section-container{
            display: flex;
            .img-4-container{
                flex: 1;
                display: flex;
                justify-content: center;
                overflow: hidden;
            }
        }
        @media only screen and ( max-width : 768px ) {
            .img-4-section-container{
                display: block;
                overflow: hidden;
                .img-4-container{
                    width: 50%;
                    float: left;
                }
            }
        }
        @media only screen and ( max-width : 680px ) {
            .img-4-section-container{
                flex-wrap: wrap;
                .img-4-container{
                    flex: 50%;
                    margin-bottom: 30px;
                    min-height: 130px;
                    img{
                        width: 65%;
                    }
                }
            }
        }
    }

</style>