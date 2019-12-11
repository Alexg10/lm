<template>
    <section class="img-square">
        <div class="container">
            <div class="img-square-container">
                <div class="project-chapter"><span class="number">{{six_chapter}}</span></div>
                <div class="project-category"><span class="name">{{six_chapter_name}}</span></div>
                <div class="img-square-txt mobile">
                    {{six_images_txt}}
                </div>
                <div class="img-square-section-container">
                    <div class="img-square-section-content" v-for="(image, index) in six_images" v-bind:key>
                        <div v-if="index==4" class="img-square-txt">
                            {{six_images_txt}}
                        </div>
                        <img :src="image.bloc_six_img.url" :alt="image.bloc_six_img.title">
                    </div>
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
            'six_chapter',
            'six_chapter_name',
            'six_images',
            'six_images_txt'
        ],
        mounted(){
            var imgsSquare = document.getElementsByClassName("img-square-section-content");
            var scrollM = this.$scrollmagic;

            var name = document.querySelector(".img-square-container .number");
            var tlChapter = new TimelineMax({ paused: true});
            tlChapter.fromTo(name, 1, {y: 10},{y: 0, ease: Power4.easeInOut, overwrite: false})
            .fromTo(".img-square-container .name", 1, {y: 40},{y: 0, ease: Power4.easeInOut, overwrite: false});
            
            const sceneChapter = scrollM.scene({
                triggerElement: ".img-square-container",
                triggerHook: 0.65,
                offset: 100
            })
            .setTween(tlChapter)
            .reverse(false)
            .addIndicators({ name: '2 (duration: 300)' })
            scrollM.addScene(sceneChapter);
            
            Array.prototype.forEach.call(imgsSquare,function(el, i) {
                var img = el.getElementsByTagName("img");
                var tl = new TimelineMax({ paused: false});
                tl.staggerFromTo(".img-square-section-content img", 1.5, {y: 140, opacity:0},{y: 0, opacity:1, ease: Power4.easeInOut, overwrite: false},0.3);
                const scene2 = scrollM.scene({
                    triggerElement: ".img-square-container",
                    triggerHook: 0.65,
                    offset: -100
                })
                .setTween(tl)
                .reverse(false)
                .addIndicators({ name: '2 (IMG 4' })
                scrollM.addScene(scene2)
            });
        }
    }
</script>

<style lang="scss" scoped>

    .project-chapter{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        color: $grey;
        font-weight: bold;
        margin-bottom: 10px;
        overflow: hidden;
    }
    .project-category{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bold;
        overflow: hidden;
    }
    .img-square{
        position: relative;
        padding-top: 100px;
        padding-bottom: 70px;
        background-color: $light-grey;
        &:after{
            content:'';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100vw;
            height: 32%;
            background-color: $white;
            z-index: 0;
        }
    }
    .img-square-container{
        text-align: center; 
    }
    .img-square-txt{
        font-size: 28px;
        text-align: center;
        max-width: 475px;
        margin: 0 auto;
        font-weight: bold;
        margin: 110px 0 100px;
    }
    .img-square-section-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        .img-square-section-content{
            position: relative;
            width: 33.3%;
            z-index: 10;
            &:nth-child(2){
                margin-top: 94px;
            }
        }
    }
    .img-square-txt.mobile{
        display: none;
    }

    @media ( max-width : 768px ) {
        .img-square-txt.mobile{
            display: block;
            margin: 70px auto;
        }
        .img-square-txt{
            font-size: 22px;
            display: none;
        }
        .img-square-section-container{
            .img-square-section-content{
                width: 50%;
                margin-bottom: 50px;
                &:nth-child(2){
                    margin-top: 0;
                }
            }
        }
    }
    @media ( max-width : 680px ) {
        .img-square-section-container{
            .img-square-section-content{
                width: 100%;
            }
        }
    }
    
</style>