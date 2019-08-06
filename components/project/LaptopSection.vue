<template>
    <div>
        <section class="project-laptop-preview container">
            <img :src="LaptopPreview" alt="">
        </section>
    </div>
</template>

<script>
    import LaptopPreview from '~/assets/images/project/project-laptop.png'
    export default {
        data(){
            return{
                LaptopPreview
            }
        }
    }
</script>

<style lang="scss" scoped>
    .project-laptop-preview{
        img{
            width: 100%;
        }
    }
</style>