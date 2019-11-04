<template>
    <section class="img-square">
        <div class="container">
            <div class="img-square-container">
                <div class="project-chapter"><span class="number">{{six_chapter}}</span></div>
                <div class="project-category">{{six_chapter_name}}</div>
                <div class="img-square-txt mobile">
                    {{six_images_txt}}
                </div>
                <div class="img-section-container">
                    <div class="img-section-content" v-for="(image, index) in six_images" v-bind:key>
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
        ]
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
    }
    .project-category{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bold;
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
    .img-section-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        .img-section-content{
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
        .img-section-container{
            .img-section-content{
                width: 50%;
                margin-bottom: 50px;
                &:nth-child(2){
                    margin-top: 0;
                }
            }
        }
    }
    @media ( max-width : 680px ) {
        .img-section-container{
            .img-section-content{
                width: 100%;
            }
        }
    }
    
</style>