<template>
    <section class="chapter">
        <div class="container">
            {{this.$store.state.list}}
            <div class="project-chapter"><span class="number">{{number}}</span>.</div>
            <div class="project-category">{{name}}</div>
        </div>
    </section>
</template>

<script>
import { mapMutations } from 'vuex'  
import { mapState } from 'vuex'  

    export default {
        data(){
            return{
                chapter:'01'
            }
        },
        props: [
            'number',
            'name'
        ]
        // computed:{
        //     ...mapState({
        //         projects: state => state.project.list,
        //         project: state => state.projects.project
        //     })
        // },
        // mounted() {
            // console.log(this.$store.state.projects);

            // // console.log($state.projects.list);
            // console.log(this.$store.state.project);
            // console.log(this.$store.getters.list);

            


            // console.log(this.$route.fullPath);
            // console.log(this.$route.params.slug);
            // console.log(this.$store);
            // console.log(this.project);
            // console.log($route.params.id);
        // }
    }
</script>

<style lang="scss" scoped>
    .chapter{
        padding-top: 83px;
        padding-bottom: 40px;
        text-align: center; 
    }
    .project-chapter{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        color: $grey;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .project-category{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bold;
    }
</style>