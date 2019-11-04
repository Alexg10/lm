<template>
    <section class="gradient-bg">
        <div class="gradient-column" v-for="image in gradient_img" v-bind:key :style="{ backgroundImage: `url('${image.gradient_background_image.url}')` }"></div>
        <div class="text">
            <p>{{gradient_text}}</p>
        </div>
    </section>

</template>

<script>
    export default {
        data(){
        },
        props: [
            'gradient_text',
            'gradient_img'
        ]
    }
</script>

<style lang="scss" scoped>
    .gradient-bg{
        display: flex;
        position: relative;
        border: none;
        .gradient-column{
            flex:1;
            min-height: 652px;
            min-width: 16.666666667%;
            width: 16.666666667%;
            border-right: 1.5px solid rgba(227,225,225,0.33);
        }
    }
    .text{
        position: absolute;
        font-size: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        p{
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            font-weight: bold;
            color: $white;
        }
    }
    @media only screen and ( max-width : 680px ) {
        .text{
            width: 70%;
            font-size: 18px;
        }
        .gradient-bg{
            width: 100vw;
            overflow: hidden;
            .gradient-column{
                min-width: 170px;
                width: 170px;
            }
        }
    }
</style>