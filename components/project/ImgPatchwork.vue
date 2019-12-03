<template>
    <section class="img-patchwork">
        <div class="container">
            <div class="img-patchwork-one-container">
                <div class="img-pachwork-img" v-for="(patchworkOneImg, index) in patchworkOne" v-bind:key>
                    <img :src="patchworkOneImg.first_patchwork_images.url" v-bind:class="'img-patwork-one-index'">
                </div>
            </div>
            <div class="patchwork-txt">
                {{patchworkTxt}}
            </div>
            <div class="img-patchwork-two-container">
                <div class="img-pachwork-img" v-for="(patchworkTwoImg, index) in patchworkTwo" v-bind:key>
                    <img :src="patchworkTwoImg.second_patchwork_img.url" v-bind:class="'img-patwork-two-index'">
                </div>
            </div>
        </div>
    </section>
</template>

<script>

    import { Timeline, TimelineMax } from 'gsap'
    import VueScrollmagic from 'vue-scrollmagic'
    


    export default {
        // middleware: 'mobile',
        data(){
            return{
                // $device: this
            }
        },
        props: [
            'patchworkOne',
            'patchworkTwo',
            'patchworkTxt'
        ],
        mounted(){
            // var device = require("@nuxtjs/device");
            // console.log(device.isDesktop)

            // if(device.isDesktop){

                var img1 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(1)");
                var img2 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(2)");
                var img3 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(3)");
                var img4 = document.querySelector(".img-patchwork-one-container .img-pachwork-img:nth-child(4)");

                var img5 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(1)");
                var img6 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(2)");
                var img7 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(3)");
                var img8 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(4)");
                var img9 = document.querySelector(".img-patchwork-two-container .img-pachwork-img:nth-child(5)");

                var scrollM = this.$scrollmagic;

                var tlPatchwork = new TimelineMax({ paused: false});
                var tlPatchwork2 = new TimelineMax({ paused: false});

                var heightDurationFirst = document.querySelector(".img-patchwork-one-container").offsetHeight;
                var heightDurationSec = document.querySelector(".img-patchwork-two-container").offsetHeight;

                console.log(heightDurationFirst);

                tlPatchwork.fromTo(img1, 1, {y: -30},{y: 0, overwrite: false},"start")
                .fromTo(img2, 1, {y: 5},{y: 60, overwrite: false}, "start")
                .fromTo(img3, 1, {y: 50},{y: 0, overwrite: false}, "start")
                .fromTo(img4, 1, {y: -110},{y: 0, overwrite: false}, "start");

                
                const scenePatchwork = scrollM.scene({
                    triggerElement: ".img-patchwork",
                    triggerHook: 0.65,
                    offset: -50,
                    duration: heightDurationFirst+700
                })
                .setTween(tlPatchwork)
                // .addIndicators({ name: '22222 (duration: 300)' })
                scrollM.addScene(scenePatchwork);


                tlPatchwork2.fromTo(img5, 1, {y: -30},{y: 10, overwrite: false},"startTwo")
                .fromTo(img6, 1, {y: 5},{y: -10, overwrite: false}, "startTwo")
                .fromTo(img7, 1, {y: 50},{y: -50, overwrite: false}, "startTwo")
                .fromTo(img8, 1, {y: -50},{y: 0, overwrite: false}, "startTwo")
                .fromTo(img9, 1, {y: -50},{y: 0, overwrite: false}, "startTwo");

                const scenePatchwork2 = scrollM.scene({
                    triggerElement: ".patchwork-txt",
                    triggerHook: 0.65,
                    offset: -50,
                    duration: heightDurationSec+600
                })
                .setTween(tlPatchwork2)
                // .addIndicators({ name: '2 (duration: 300)' })
                scrollM.addScene(scenePatchwork2);
            // }else{
            //     console.log('MOBILE FUCKET');
            // }
            

            





        }
    }
</script>

<style lang="scss" scoped>
    .img-patchwork{
        .container{
            width: 100%;
            max-width: 1134px;
        }
        .img-patchwork-one-container,
        .img-patchwork-two-container{
            position: relative;
            // overflow: hidden;
            display: block;
            height: 670px;
            .img-pachwork-img{
                position: absolute;
                transition: transform 0.05s ease-in-out;
                &:nth-child(1){
                    top: 30px;
                    left: 103px;
                    left: 9%;
                }
                &:nth-child(2){
                    right: 0;
                }
                &:nth-child(3){
                    left: 0;
                    top: 305px;
                }
                &:nth-child(4){
                    top: 220px;
                    left: 502px;
                    left: 44.5%;
                }
            }
        }
        .img-patchwork-two-container{
            height: 950px;
            margin-bottom: 50px;
            .img-pachwork-img{
                &:nth-child(1){
                    top: 0;
                    left: 201px;
                }
                &:nth-child(2){
                    top: 100px;
                    right: 90px;
                }
                &:nth-child(3){
                    left: 0;
                    top: 275px;
                }
                &:nth-child(4){
                    right: 200px;
                    top: 435px;
                }
                &:nth-child(5){
                    left: 320px;
                    bottom: 0;
                }
            }
        }
        .patchwork-txt{
            text-align: center;
            max-width: 765px;
            margin: 110px auto;
            font-size: 28px;
        }
    }
    @media ( max-width : 680px ) {
        .img-patchwork{
            .img-patchwork-one-container,
            .img-patchwork-two-container{
                position: relative;
                overflow: hidden;
                display: block;
                height: auto;
                .img-pachwork-img{
                    &:nth-child(n){
                        position: relative;
                        top:auto;
                        left: auto;
                        right: auto;
                        text-align: center;
                        margin-bottom: 30px;
                    }
                }
            }
            .patchwork-txt{
                max-width: 80%;
            }
        }

    }
</style>