<template>
    <section class="img-section">
        <div class="container">
            <div id="img-section-container" class="img-section-container">
                <div class="img-container grid-item">
                    <img :src="homePreview" alt="">
                </div>
                <div class="img-container grid-item phone-container">
                    <img :src="phonePreview" alt="" class="phone-img">
                </div>
                <div class="img-container grid-item">
                    <img :src="productPreview" alt="">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Masonry from 'masonry-layout'
    import homePreview from '~/assets/images/project/project-home.png'
    import phonePreview from '~/assets/images/project/project-phone.png'
    import productPreview from '~/assets/images/project/project-product.png'

    export default {
        data(){
            return{
                homePreview,
                phonePreview,
                productPreview,
                masonryW : '#img-section-container',
            }
        },
        mounted() {
            // var masonryW = this.$el.querySelector('.img-section-container');
            console.log(this.masonryW);
            
            var msnry = new Masonry( this.masonryW, {
                itemSelector: '.img-container'
            });
        }
    }
</script>

<style lang="scss" scoped>
    .img-section{
        background-color: $white;
    }
    .img-section-container{
        transform: translateY(-140px);
        .img-container{
            width: 50%;
        }
        .phone-container{
            text-align: center;
            padding: 100px 0;
        }
    }
    .grid-sizer,
    .grid-item {
        width: 50%;
    }
    
</style>