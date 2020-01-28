<template>
    <div class="cover-project" :style="{ backgroundImage: `url(${cover.cover})` }">
        <div class="project-header-content">
            <div class="project-header-content-top">
                <div class="name">{{cover.title}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Cover mounted', this.$store.state.projects.current.id);
        },
        computed: {
            cover(){
                return this.$store.state.projects.cover;
            }
        },
    }

</script>

<style lang="scss" scoped>
    .cover-project{
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100%;
        background-size: cover;
        background-position: 50%;
        opacity:0;
        visibility: hidden;
        z-index: 9999;
        &.visible{
            opacity: 1;
            visibility: initial;
        }
    }

    .project-header-content{
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        max-width: 1113px;
        margin: 0 auto;
        .project-header-content-top{
            position: absolute;
            top: 50%;
            transform: translateY(-60%);
            text-align: center;
        }
    }
    .category{
        font-family: 'GTWalsheimProMedium';
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .name{
        font-size: 200px;
        font-weight: bold;
        color:white;
    }
    .project-description{
        align-self: flex-end;
        max-width: 370px;
        font-size: 23px;
        font-weight: bold;
        transform: translateY(210px);
    }

</style>