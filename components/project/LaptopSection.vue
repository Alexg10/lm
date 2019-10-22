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
    }
</style>