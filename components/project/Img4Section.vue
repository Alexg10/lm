<template>
    <section class="img-4-section">
        <div class="container">
            <div class="img-section-container">
                <div class="img-container grid-item">
                    <img :src="signIt01" alt="">
                </div>
                <div class="img-container grid-item phone-container">
                    <img :src="signIt02" alt="" class="phone-img">
                </div>
                <div class="img-container grid-item">
                    <img :src="signIt03" alt="">
                </div>
                <div class="img-container grid-item">
                    <img :src="signIt04" alt="">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import signIt01 from '~/assets/images/project/signit01.svg'
    import signIt02 from '~/assets/images/project/signit02.svg'
    import signIt03 from '~/assets/images/project/signit03.svg'
    import signIt04 from '~/assets/images/project/signit04.svg'
    export default {
        data(){
            return{
                signIt01,
                signIt02,
                signIt03,
                signIt04
            }
        }
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
    }

</style>