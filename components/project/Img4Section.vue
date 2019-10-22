<template>
    <section class="img-4-section">
        <div class="container">
            <div class="img-section-container" >
                <div class="img-container grid-item" v-for="four_image in four_images" v-bind:key>
                    <!-- WHY sketch_image -->
                    <img :src="four_image.image.url" :alt="four_image.image.title">
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
            'four_images',
        ]
    }
</script>

<style lang="scss" scoped>
    .img-4-section{
        padding: 90px 0 110px;
        .img-section-container{
            display: flex;
            .img-container{
                flex: 1;
                display: flex;
                justify-content: center;
            }
        }
        @media only screen and ( max-width : 768px ) {
            .img-section-container{
                .img-container{
                    img{
                        width: 80%;
                    }
                }
            }
        }
        @media only screen and ( max-width : 680px ) {
            .img-section-container{
                flex-wrap: wrap;
                .img-container{
                    flex: 50%;
                    margin-bottom: 30px;
                    img{
                        width: 80%;
                    }
                }
            }
        }
    }

</style>