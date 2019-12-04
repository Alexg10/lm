<template>
    <section class="img-full-half-section">
        <div class="img-full-half-section-container" >
            <div class="img-full-half-container" v-for="img_half in img_full_half" v-bind:key>
                <img :src="img_half.bloc_img_full_half_image.url" alt="">
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
        props:[
            'img_full_half'
        ]
    }
</script>

<style lang="scss" scoped>
    .img-full-half-section{
        .img-full-half-section-container{
            display: flex;
            flex-wrap: wrap;
            .img-full-half-container{
                display: flex;
                justify-content: center;
                width: 50%;
                img{
                    width: 100%;
                }
            }
        }
        &.three-multiple {
            .img-full-half-section-container{
                .img-full-half-container{
                    width: 33.3%;
                }
            }
        }
    }


</style>