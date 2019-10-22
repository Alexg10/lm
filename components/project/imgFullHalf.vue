<template>
    <section class="img-full-half-section">
        <div class="img-section-container" >
            <div class="img-container" v-for="img_half in img_full_half" v-bind:key>
                <img :src="img_half.bloc_img_full_half_image.url" alt="">
            </div>
        </div>
    </section>
</template>

<script>
    import signIt01 from '~/assets/images/project/signit-half.jpg'
    import signIt02 from '~/assets/images/project/signit-half2.jpg'
    import signIt03 from '~/assets/images/project/signit-half2.jpg'
    import signIt04 from '~/assets/images/project/signit-half.jpg'
    export default {
        data(){
            return{
                signIt01,
                signIt02,
                signIt03,
                signIt04
            }
        },
        props:[
            'img_full_half'
        ]
    }
</script>

<style lang="scss" scoped>
    .img-full-half-section{
        .img-section-container{
            display: flex;
            flex-wrap: wrap;
            .img-container{
                display: flex;
                justify-content: center;
                width: 50%;
                img{
                    width: 100%;
                }
            }
        }
        &.three-multiple {
            .img-section-container{
                .img-container{
                    width: 33.3%;
                }
            }
        }
    }


</style>