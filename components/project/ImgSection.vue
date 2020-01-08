<template>
    <section class="img-section">
        <div class="container">
            <div id="img-section-container" class="img-section-container" v-for="image in images" v-bind:key>
                <div class="img-container grid-item">
                    <img :src="image.sketch_image.url" :alt="image.sketch_image.title">
                </div>
            </div>
        </div>
        <div class="spacer" style="clear: both;"></div>
    </section>
</template>

<script>
    import Masonry from 'masonry-layout'
    import { Timeline, TimelineMax } from 'gsap'
    import VueScrollmagic from 'vue-scrollmagic'

    export default {
        data(){
            return{
                masonryW : '#img-section-container',
            }
        },
        mounted() {
            setTimeout(() => {
                var msnry = new Masonry( this.masonryW, {
                    itemSelector: '.img-container'
                });
            }, 500);


            var imgContainers = document.getElementsByClassName("img-section-container");
            var scrollM = this.$scrollmagic;
    
            setTimeout(() => {
                Array.prototype.forEach.call(imgContainers,function(el, i) {
                    // // console.log(el);
                    // var imgContain = el.getElementsByClassName("img-container");
                    // var imgContainEl = el.getElementsByClassName("img-container")[0];

                    // // console.log(imgContain);
                    // var tl = new TimelineMax({ paused: false});

                    // let oldHeight = imgContainEl.offsetHeight;
                    // imgContainEl.style.height= 0;
                    // let newHeight = oldHeight ? 0 : "auto";

                    // tl.fromTo(imgContainEl, 3, {height: 0},{height: oldHeight, ease: Power4.easeInOut, overwrite: false});                
                    // const imgSectionScene = scrollM.scene({
                    //     triggerElement: imgContainEl,
                    //     triggerHook: 0.65,
                    //     offset: -100
                    // })
                    // .setTween(tl)
                    // .reverse(false)
                    // .addIndicators({ name: '2 (imgCain00)' })
                    // scrollM.addScene(imgSectionScene)

                    var tl = new TimelineMax({ paused: false});

                    var imgContain = el.getElementsByClassName("img-container");
                    var imgContainEl = el.getElementsByClassName("img-container")[0];

                    tl.fromTo(imgContainEl, 2, {y: 40, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});                
                    const imgSectionScene = scrollM.scene({
                        triggerElement: el,
                        triggerHook: 0.65,
                        offset: -50
                    })
                    .setTween(tl)
                    .reverse(false)
                    // .addIndicators({ name: '2 (imgCain00)' })
                    scrollM.addScene(imgSectionScene)

                });


                var img1 = document.querySelector(".img-section-container:nth-child(1) .img-container img");
                var img2 = document.querySelector(".img-section-container:nth-child(2) .img-container img");
                var img3 = document.querySelector(".img-section-container:nth-child(3) .img-container img");

                var sectionTl= new TimelineMax({ paused: false});
                var scrollB = this.$scrollmagic;

                sectionTl.fromTo(img1, 1, {y: 0},{y: 200, overwrite: false},"start")
                .fromTo(img2, 1, {y: 0},{y: -80, overwrite: false}, "start")
                .fromTo(img3, 1, {y: 0},{y: -150, overwrite: false}, "start");

                const sceneHalfSection = scrollB.scene({
                    triggerElement: ".img-section",
                    triggerHook: 0.65,
                    offset: -150,
                    duration: window.innerHeight*2.5
                })
                .setTween(sectionTl)
                scrollB.addScene(sceneHalfSection);
            }, 800);


        },
        props: [
            'images',
        ]
    }
</script>

<style lang="scss" scoped>
    .img-section{
        background-color: $white;
    }
    .img-section-container{
        display: inline-block;
        transform: translateY(-140px);
        width: 50%;
        float: left;
        &:nth-child(2){
            padding-top: 94px;
            margin-bottom: 180px;
            .img-container{
                max-width: 240px;
                margin: 0 auto;
            }
        }
        .img-container{
            width: 100%;
            // height: 0;
            // overflow: hidden;
        }
        .phone-container{
            text-align: center;
            padding: 100px 0;
        }
    }
    .grid-sizer,
    .grid-item {
        width: 50%;
        img{
            width: 100%;
            &.phone-img{
                width: auto;
            }
        }
    }

    @media ( max-width : 768px ) {
        .project-header-content{
            padding: 0 20px;
        }
        .project-name{
            font-size: 150px;
        }
    }
    @media ( max-width : 680px ) {

        .img-section-container{
            transform: translateY(-140px);
            width: 100%;
            .img-container{
                width: 100%;
            }
            .phone-container{
                text-align: center;
                padding: 100px 0;
            }
        }
        .grid-sizer,
        .grid-item {
            width: 100%;
            img{
                width: 100%;
            }
        }
    }
    
</style>