<template>
    <div>
        <section class="project-laptop-preview container">
            <img :src="image" alt="">
        </section>
    </div>
</template>

<script>

    import { Timeline, TimelineMax } from 'gsap'
    import VueScrollmagic from 'vue-scrollmagic'

    export default {
        data(){
            return{
            }
        },
        props: [
            'image'
        ],
        mounted(){
                var scrollM = this.$scrollmagic;
                var tl = new TimelineMax({ paused: false});
                var img = document.getElementsByClassName("project-laptop-preview");
                tl.fromTo(img, 2.5, {y: 100, opacity: 0},{y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});                
                
                const animSectionScene = scrollM.scene({
                    triggerElement: ".project-laptop-preview",
                    triggerHook: 0.65,
                    offset: -250
                })
                .setTween(tl)
                .reverse(false)
                // .addIndicators({ name: 'blocsImgFullCenter' })
                scrollM.addScene(animSectionScene)
        }
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