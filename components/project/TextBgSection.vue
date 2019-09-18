<template>
    <div class="text background" :style="{ backgroundImage: `url(${BackgroundImg})` }">
        <p>We created the brand platform and crafted the brand image by redefining the values and positioning as market outsiders.</p>
    </div>
</template>

<script>

    import BackgroundImg from '~/assets/images/project/bg-conviction.png'

    export default {
        data(){
            return{
                BackgroundImg
            }
        }
    }
</script>

<style lang="scss" scoped>
    .text{
        font-size: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        &.background{
            min-height: 652px;
            background-position: 50%;
            background-size: 100%;
        }
        p{
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            font-weight: bold;
            color: $white;
        }
        @media only screen and ( max-width : 768px ) {
        }
        @media only screen and ( max-width : 680px ) {
            font-size: 18px;

        }
    }
</style>