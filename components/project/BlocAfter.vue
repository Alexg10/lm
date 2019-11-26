<template>
    <section class="bloc-after">
        <div class="container">
            <div class="after-bg">
                <svg width="945px" height="668px" viewBox="0 0 945 668" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="A---Homepage" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-family="Helvetica" font-size="300" font-weight="normal">
                        <g id="C.1.0---Project-Page" transform="translate(-233.000000, -6526.000000)" fill="#C9F7F5">
                            <text id="After-effects" transform="translate(682.500000, 6817.000000) rotate(-10.000000) translate(-682.500000, -6817.000000) ">
                                <tspan x="365.727539" y="6928">After </tspan>
                                <tspan x="240.629883" y="7288">effects</tspan>
                            </text>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="bloc-after-top-left-container">
                <img class="bloc-after-top-left-img" :src="after_top_righ.url">
            </div>
            <div class="bloc-after-top-right-container">
                <img class="bloc-after-top-right-img" :src="after_top_left.url">
            </div>
            <div class="bloc-after-top-middle-container">
                <img class="bloc-after-top-middle-img" :src="after_top_middle.url">
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

            var imgContain = document.getElementsByClassName("bloc-after-full-height-container")[0];

            tl.staggerFromTo(".bloc-after-full-height-container", 2, {y: 40, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false}, 0.35);                
            const imgSectionScene = scrollM.scene({
                triggerElement: imgContain,
                triggerHook: 0.65,
                offset: -50
            })
            .setTween(tl)
            .reverse(false)
            // .addIndicators({ name: 'bloc-after-full-height-container' })
            scrollM.addScene(imgSectionScene)

        }
    }
</script>

<style lang="scss" scoped>
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
        }
        .bloc-after-top-right-container{
            padding-top: 144px;
            position: relative;
            left: 130px;
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