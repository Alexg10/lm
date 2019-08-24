<template>
    <section class="img-full-center-section">
        <div class="container">
            <div class="img-full-center-section-container">
                <img :src="fullCenter" alt="">
            </div>
        </div>
    </section>
</template>

<script>
    import fullCenter from '~/assets/images/project/fullCenter.png'

    export default {
        data(){
            return{
                fullCenter
            }
        }
    }
</script>
<style lang="scss" scoped>
    .img-full-center-section{
        .img-full-center-section-container{
            display: flex;
            justify-content: center;
        }
    }

</style>