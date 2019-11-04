<template>
    <section class="bloc-animation">
        <div class="container">
            <div class="bloc-animation-desktop-container">
                <img class="bloc-animation-desktop-img" :src="image_desktop.url">
            </div>
            <div class="bloc-animation-mobile-container">
                <img class="bloc-animation-mobile-img" :src="image_mobile.url">
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
            'image_desktop',
            'image_mobile',
        ]
    }
</script>

<style lang="scss" scoped>
    .bloc-animation{
        background: $white;
        .container{
            width: 100%;
        }
        .bloc-animation-desktop-container{
            text-align: right;
            .bloc-animation-desktop-img{
                width: 100%;
                max-width: 1050px;
            }
        }
        .bloc-animation-mobile-container{
            display: inline-block;
            margin-top: -153px;
        }
    }
    @media ( max-width : 680px ) {

    }
</style>