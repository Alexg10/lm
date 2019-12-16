<template>
    <div class="cross" v-on:click="hideCross">
        <nuxt-link :to="{ path: '/project',hash: this.currentProjectSlug}" class="back-link">
            <div class="crossLineOne">
                <div class="crossLineOne_content"></div>
            </div>
            <div class="crossLineTwo">
                <div class="crossLineTwo_content"></div>
            </div>
        </nuxt-link>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                currentProjectSlug:''
            }
        },
        methods: {
            showCross(){
                var cross = document.getElementsByClassName("cross");
                cross[0].classList.add("active");
                // this.$store.state.projects.fromProject = true;
            },
            hideCross(){
                var cross = document.getElementsByClassName("cross");
                cross[0].classList.remove("active");
                // this.animBeforeGoBack();
            },
            animBeforeGoBack(){
                var anim = new TimelineLite();
                var projectName = document.querySelector('.project-name-content');
                var categoryType = document.querySelector('.category-type');
                var description = document.querySelector('.project-description p');

                anim
                    .fromTo(categoryType, 2,{y:0}, {y:-50, ease: Power4.easeInOut})
                    .fromTo(projectName, 1.8,{y:0}, {y:-230, ease: Power4.easeInOut},"-=1.2" )
                    .fromTo(description, 1.5,{y:0, opacity:1}, {y:-30, opacity:0, ease: Power4.easeInOut},"-=1" );
            }
        },
        mounted() {
            this.currentProjectSlug = this.$store.state.projects.currentProjectData[0].slug;
            this.currentProjectSlug = "#"+this.currentProjectSlug;
            console.log(this.currentProjectSlug);
            setTimeout(() => {
                this.showCross();
            }, 2000);
        }
    }
</script>

<style lang="scss" scoped>
    .crossLineOne,
    .crossLineTwo{
        width: 25px;
    }
    .crossLineOne_content,
    .crossLineTwo_content{
        background-color: white;
    }
    .back-link{
        display: block;
        height: 100%;
    }

</style>