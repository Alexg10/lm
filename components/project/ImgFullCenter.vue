<template>
    <section class="img-full-center-section">
        <div class="container">
            <div class="img-full-center-section-container">
                <img :src="img_full_center.url" alt="">
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
            'img_full_center',
        ]
    }
</script>
<style lang="scss" scoped>
    .img-full-center-section{
        .img-full-center-section-container{
            display: flex;
            justify-content: center;
            img{
                width: 100%;
            }
        }
    }

</style>