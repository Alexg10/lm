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

    export default {
        data(){
            return{
            }
        },
        props: [
            'patchworkOne',
            'patchworkTwo',
            'patchworkTxt'
        ]
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
            overflow: hidden;
            display: block;
            height: 670px;
            .img-pachwork-img{
                position: absolute;
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