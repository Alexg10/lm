<template>
    <section class="gradient-bg">
        <div class="gradient-column" v-for="image in gradient_img" v-bind:key :style="{ backgroundImage: `url('${image.gradient_background_image.url}')` }"></div>
        <div class="text">
            <p>{{gradient_text}}</p>
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
            'gradient_text',
            'gradient_img'
        ],
        mounted() {
            var column1 = document.querySelector(".gradient-bg .gradient-column:nth-child(1)");
            var column2 = document.querySelector(".gradient-bg .gradient-column:nth-child(2)");
            var column3 = document.querySelector(".gradient-bg .gradient-column:nth-child(3)");
            var column4 = document.querySelector(".gradient-bg .gradient-column:nth-child(4)");
            var column5 = document.querySelector(".gradient-bg .gradient-column:nth-child(5)");
            var column6 = document.querySelector(".gradient-bg .gradient-column:nth-child(6)");


            var scrollM = this.$scrollmagic;
            var gradientHeightDuration = document.querySelector(".gradient-bg").offsetHeight;

            var tlGradient = new TimelineMax({ paused: false});


            tlGradient.fromTo(column1, 1, {y: -42},{y: 42, overwrite: false},"start")
            .fromTo(column2, 1, {y: -8},{y: 8, overwrite: false}, "start")
            .fromTo(column3, 1, {y: -28},{y: 28, overwrite: false}, "start")
            .fromTo(column4, 1, {y: -72},{y: 72, overwrite: false}, "start")
            .fromTo(column5, 1, {y: -38},{y: 38, overwrite: false}, "start")
            .fromTo(column6, 1, {y: 15},{y: -15, overwrite: false}, "start");


            
            const sceneGradient = scrollM.scene({
                triggerElement: ".gradient-bg",
                triggerHook: 0.65,
                offset: -180,
                duration: gradientHeightDuration+700
            })
            .setTween(tlGradient)
            .addIndicators({ name: 'Gradient' })
            scrollM.addScene(sceneGradient);


        },
    }
</script>

<style lang="scss" scoped>
    .gradient-bg{
        display: flex;
        position: relative;
        border: none;
        margin-bottom: 40px;
        margin-top: 20px;
        z-index: 99;
        .gradient-column{
            flex:1;
            min-height: 652px;
            min-width: 16.666666667%;
            width: 16.666666667%;
            border-right: 1.5px solid rgba(227,225,225,0.33);
        }
    }
    .text{
        position: absolute;
        font-size: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        p{
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            font-weight: bold;
            color: $white;
        }
    }
    @media only screen and ( max-width : 680px ) {
        .text{
            width: 70%;
            font-size: 18px;
        }
        .gradient-bg{
            width: 100vw;
            overflow: hidden;
            .gradient-column{
                min-width: 170px;
                width: 170px;
            }
        }
    }
</style>