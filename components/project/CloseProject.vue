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
                // if (document.getElementsByClassName("cover-project").length>0) {
                //     document.querySelector('.cover-project').classList.add('visible');
                // }
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