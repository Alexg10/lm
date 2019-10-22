<template>
    <div>
        <HeaderProject :name="projectName" :description="projectDescription" :image="projectHeaderImg"></HeaderProject>
        <div class="grey-section">
            <div v-for="bloc in projectBlocName" v-bind:key>
                <!-- {{bloc}} -->
                <Chapter v-if="bloc[0] == 'bloc_step'" :number=bloc[1] :name=bloc[2]></Chapter>
                <LaptopSection v-if="bloc[0] == 'bloc_laptop'" :image=bloc[1].url></LaptopSection>
                <TextSection v-if="bloc[0] == 'bloc_txt'" :text=bloc[1]></TextSection>
                <ImgSection v-if="bloc[0] == 'bloc_sketch'" :images=bloc[1]></ImgSection>
                <Img4Section v-if="bloc[0] == 'bloc_four_section_content'" :four_images=bloc[1]></Img4Section>
                <ImgFullCenter v-if="bloc[0] == 'bloc_img_full_center'" :img_full_center=bloc[1]></ImgFullCenter>
                <ImgFullHalf v-if="bloc[0] == 'bloc_img_full_half'" :img_full_half=bloc[1]></ImgFullHalf>
                <ColorSection></ColorSection>
                <TextBgSection></TextBgSection>
            </div>
            <Footer></Footer>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    const apiUrl = process.env.API_URL || 'http://localhost:8888/lm/lm_wordpress/wp-json/wp/v2/projets'

    import HeaderProject from '~/components/project/Header'
    import LaptopSection from '~/components/project/LaptopSection'
    import Chapter from '~/components/project/Chapter'
    import TextSection from '~/components/project/TextSection'
    import ImgSection from '~/components/project/ImgSection'
    import Img4Section from '~/components/project/Img4Section'
    import ImgFullCenter from '~/components/project/ImgFullCenter'
    import ImgFullHalf from '~/components/project/ImgFullHalf'
    import ColorSection from '~/components/project/ColorSection'
    import TextBgSection from '~/components/project/TextBgSection'
    import Footer from '~/components/project/Footer'

import { mapMutations } from 'vuex'  
import { mapState } from 'vuex' 

    export default {
        components:{
            HeaderProject,
            LaptopSection,
            Chapter,
            TextSection,
            ImgSection,
            Img4Section,
            ImgFullCenter,
            ImgFullHalf,
            ColorSection,
            TextBgSection,
            Footer
        },
        data(){
            return{
                apiUrl,
                id: this.$route.params.id
            }
        },
        mounted: function(){
            console.log(this.id);
            console.log(this.$store.state.projects.list.find(project => project.id === this.id));
            axios.get(`${apiUrl}`)
            .then(value => {
                var data = value.data[0];
                console.log('data')
                console.log(data)
            });
        },
        computed: {
            project(){
                return this.$store.state.projects.list.find(project => project.id === this.id)
            }
        },
        async asyncData({ params, error }) {
            var projectName = params.id.charAt(0).toUpperCase() + params.id.slice(1);
            // console.log('cityName');
            // console.log(projectName);
            return axios.get(`${apiUrl}?slug=${projectName}`)
            .then(res => {
                var projectAcf = res.data[0].acf;
                var projectName = projectAcf.project_title;
                var projectDescription = projectAcf.project_description;
                var projectHeaderImg = projectAcf.header_picture.sizes.header_picture;
                var projectBlocs = projectAcf.blocs;
                var projectBlocName = [];
                var projectBlocNameInfos= [];
                var objectBloc = {};
                var blocName;

                projectBlocs.forEach(function(element) {
                    console.log(element.acf_fc_layout);
                    projectBlocName.push(Object.values(element));
                    console.log(projectBlocName);
                });
                return { 
                    projectAcf,
                    projectName,
                    projectDescription,
                    projectHeaderImg,
                    projectBlocName
                }
            })   
            .catch((e) => {
                error({ statusCode: 404})
            });
        }
    }
</script>

<style lang="scss" scoped>
    
</style>