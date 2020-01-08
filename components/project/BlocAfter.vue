<template>
    <section class="bloc-after">
        <div class="container">
            <div class="after-bg">
                <img src="~/assets/images/block/ae_anim.svg" alt="">
            </div>
            
            <div class="bloc-after-top-left-container">
                <div id="animation"></div>
                <!-- <img class="bloc-after-top-left-img" :src="after_top_righ.url"> -->
            </div>
            <div class="bloc-after-top-right-container">
                <div id="anim-result"></div>
                <!-- <img class="bloc-after-top-right-img" :src="after_top_left.url"> -->
                <div class="anim-container">
                    <div id="animation-hand" class="hand-anim"></div>
                    <div id="animation-smart" class="hand-anim"></div>
                    <div id="animation-accessibility" class="hand-anim"></div>
                    <div id="animation-creativ" class="hand-anim"></div>
                </div>
            </div>
            <div class="bloc-after-top-middle-container">
                <div id="anim-htu"></div>
                <!-- <img class="bloc-after-top-middle-img" :src="after_top_middle.url"> -->
            </div>
            <div class="bloc-after-full-height-container" v-for="image in after_full_height" v-bind:key>
                <img class="bloc-after-top-middle-img" :src="image.image_full_height.url">
            </div>
        </div>
    </section>
</template>

<script>

    import { Timeline, TimelineMax } from 'gsap'
    import VueScrollmagic from 'vue-scrollmagic'
    import lottie from 'lottie-web'



    export default {
        data(){
            return{
            }
        },
        props: [
            'after_top_left',
            'after_top_righ',
            'after_top_middle',
            'after_full_height',
        ],
        mounted(){
            var scrollM = this.$scrollmagic;


            var tl = new TimelineMax({ paused: false});
            var tlPara = new TimelineMax({ paused: false});

            var imgContain = document.getElementsByClassName("bloc-after-full-height-container")[0];
            var imgH1 = document.querySelector(".bloc-after-full-height-container");
            var imgH2 = document.querySelector(".bloc-after-full-height-container:last-of-type");


            tlPara.fromTo(imgH1, 1, {y: 0},{y: 200, overwrite: false}, "start")
            .fromTo(imgH2, 1, {y: 0},{y: -50, overwrite: false}, "start");                


            tl.staggerFromTo(".bloc-after-full-height-container", 2, {y: 40, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false}, 0.35);                
            const imgSectionScene = scrollM.scene({
                triggerElement: imgContain,
                triggerHook: 0.55,
                offset: -50
            })
            .setTween(tl)
            .reverse(false)
            // .addIndicators({ name: 'bloc-after-full-height-container' })
            scrollM.addScene(imgSectionScene)

            const animFullHeightScenePara = scrollM.scene({
                triggerElement: ".bloc-after-full-height-container:last-of-type",
                triggerHook: 0.75,
                offset: 100,
                duration: window.innerHeight*2
            })
            .setTween(tlPara)
            // .addIndicators({ name: 'bloc-after-full-height-container' })
            scrollM.addScene(animFullHeightScenePara);

            lottie.loadAnimation({
                container: document.getElementById('animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim_intro.json"
            });

            lottie.loadAnimation({
                container: document.getElementById('animation-hand'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-hand-human.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-accessibility'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-hand-accessible.json"
            });

            lottie.loadAnimation({
                container: document.getElementById('animation-smart'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-hand-smart.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-creativ'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-hand-creativ.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('anim-htu'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-htu.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('anim-result'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-result.json"
            });

        }
    }
</script>

<style lang="scss" scoped>
    .container{
        position: relative;
    }
    .bloc-after{
        position: relative;
        // margin-top: -130px;
        padding-top: 118px;
        padding-bottom: 125px;
        overflow: hidden;
        .after-bg{
            position: absolute;
            top: 300px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 0;
            width: 100%;
            img{
                width: 100%;
            }
        }
        .bloc-after-top-left-container,
        .bloc-after-top-right-container,
        .bloc-after-top-middle-container,
        .bloc-after-full-height-container{
            position: relative;;
            display: inline-block;
            z-index: 10;
        }
        .bloc-after-top-middle-container{
            display: block;
            text-align: center;
            margin-top: 136px;
            margin-bottom: 125px;
        }

        .bloc-after-top-left-container{
            position: relative;
            right: 115px;
            float: right;
            max-width: 311px;
        }
        .bloc-after-top-right-container{
            padding-top: 144px;
            position: relative;
            left: 130px;
            max-width: 400px;
            .anim-container{
                display: flex;
                .hand-anim{
                    flex: 1;
                }
            }
        }
        #anim-htu{
            max-width: 580px;
            margin: 0 auto;
        }
        .bloc-after-full-height-container{
            width: 50%;
            float: left;
        }
        @media ( max-width : 780px ) {
            .bloc-after-full-height-container{
                img{
                    width: 100%;
                }
            }

        }
        @media ( max-width : 680px ) {
            .bloc-after-full-height-container{
                width: 100%;
            }
        }

    }


</style>