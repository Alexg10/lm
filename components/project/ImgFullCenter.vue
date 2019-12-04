<template>
    <section class="img-full-center-section">
        <div class="bloc-anim"></div>
        <div class="container">
            <div class="img-full-center-section-container">
                <img :src="img_full_center.url" alt="">
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
            'img_full_center',
        ],
        mounted(){

            var scrollM = this.$scrollmagic;

            var blocsImgFullCenter = document.getElementsByClassName("img-full-center-section");

            Array.prototype.forEach.call(blocsImgFullCenter,function(el, i) {
                var tl = new TimelineMax({ paused: false});

                var bloc = el.getElementsByClassName("bloc-anim");
                tl.fromTo(bloc, 1.5, {xPercent: -50, width:0},{xPercent: -50, width: "100%", ease: Power4.easeInOut, overwrite: false});                
                
                const animSectionScene = scrollM.scene({
                    triggerElement: el,
                    triggerHook: 0.65,
                    offset: 200
                })
                .setTween(tl)
                .reverse(false)
                .addIndicators({ name: 'blocsImgFullCenter' })
                scrollM.addScene(animSectionScene)

            });
        }
    }
</script>
<style lang="scss" scoped>
    .img-full-center-section{
        position: relative;
        .img-full-center-section-container{
            position: relative;
            display: flex;
            justify-content: center;
            z-index: 9;
            img{
                width: 100%;
            }
        }
    }
    .bloc-anim{
        position: absolute;
        top: 0;
        left: 50%;
        height: 100%;
        width: 1px;
        transform: translateX(-50%);
        background-color: white;
    }

</style>