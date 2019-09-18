<template>
    <section class="text transition">
        <div class="container">
            <p>
                Modernization of the website by using immersive full screen images and a configurator allowing user to create a unique piece of jewelry.
            </p>
        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return{
                
            }
        }
    }
</script>

<style lang="scss" scoped>
    .text{
        font-size: 28px;
        padding-bottom: 108px;
        &.transition{
            padding-bottom: 250px;
        }
        p{
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            font-weight: bold;
        }
        @media only screen and ( max-width : 768px ) {
        }
        @media only screen and ( max-width : 680px ) {
            font-size: 18px;

        }
    }
    
</style>