<template>
    <section class="bloc-animation">
        <div class="container">
            <div class="bloc-animation-desktop-container">
                <img class="bloc-animation-desktop-img" :src="image_desktop.url">
            </div>
            <div class="bloc-animation-mobile-container">
                <img class="bloc-animation-mobile-img" :src="image_mobile.url">
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
            'image_desktop',
            'image_mobile',
        ],
        mounted(){

            var scrollM = this.$scrollmagic;

            var blocsAnim = document.getElementsByClassName("bloc-animation");

            Array.prototype.forEach.call(blocsAnim,function(el, i) {
                var tl = new TimelineMax({ paused: false});

                var animImg = el.getElementsByClassName("bloc-animation-desktop-img");
                tl.fromTo(animImg, 2, {yPercent: 100},{yPercent: 0, ease: Power4.easeInOut, overwrite: false});                
                
                const animSectionScene = scrollM.scene({
                    triggerElement: el,
                    triggerHook: 0.65,
                    offset: 350
                })
                .setTween(tl)
                .reverse(false)
                // .addIndicators({ name: 'AnimeSection' })
                scrollM.addScene(animSectionScene)




            });
        }
    }
</script>

<style lang="scss" scoped>
    .bloc-animation{
        background: $white;
        .container{
            width: 100%;
        }
        .bloc-animation-desktop-container{
            text-align: right;
            overflow: hidden;
            .bloc-animation-desktop-img{
                width: 100%;
                max-width: 1050px;
            }
        }
        .bloc-animation-mobile-container{
            position: relative;
            display: inline-block;
            margin-top: -153px;
        }
        @media ( max-width : 780px ) {
            .bloc-animation-mobile-container{
                margin-top: -83px;
                left: 20px;
            }
        }
        @media ( max-width : 680px ) {
            .bloc-animation-mobile-container{
                width: 50%;
                margin-top: -43px;
                img{
                    width: 100%;
                }
            }

        }
    }

</style>