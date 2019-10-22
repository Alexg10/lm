<template>
    <section class="text transition">
        <div class="container">
            <p>
                {{text}}
            </p>
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
            'text'
        ]
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