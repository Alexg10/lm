<template>
    <div>
        <section class="project-laptop-preview container">
            <img :src="image" alt="">
        </section>
    </div>
</template>

<script>
    export default {
        data(){
            return{
            }
        },
        props: [
            'image'
        ]
    }
</script>

<style lang="scss" scoped>
    .project-laptop-preview{
        img{
            width: 100%;
        }
        @media ( max-width : 780px ) {
            padding: 0 20px;
            text-align: center;
            img{
                width: 100%;
            }
        }
        @media ( max-width : 680px ) {

        }
    }
</style>