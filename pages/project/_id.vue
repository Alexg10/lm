<template>
    <div>
        <HeaderProject :name="projectName" :description="projectDescription" :image="projectHeaderImg"></HeaderProject>
        <div class="grey-section">
            <div v-for="bloc in projectBlocName" v-bind:key>
                <!-- {{bloc}} -->
                <Chapter v-if="bloc[0] == 'bloc_step'" :bg_color=bloc[1] :number=bloc[2] :name=bloc[3]></Chapter>
                <LaptopSection v-if="bloc[0] == 'bloc_laptop'" :image=bloc[1].url></LaptopSection>
                <TextSection v-if="bloc[0] == 'bloc_txt'" :text=bloc[1]></TextSection>
                <ImgSection v-if="bloc[0] == 'bloc_sketch'" :images=bloc[1]></ImgSection>
                <Img4Section v-if="bloc[0] == 'bloc_four_section_content'" :four_images=bloc[1]></Img4Section>
                <ImgFullCenter v-if="bloc[0] == 'bloc_img_full_center'" :img_full_center=bloc[1]></ImgFullCenter>
                <ImgFullHalf v-if="bloc[0] == 'bloc_img_full_half'" :img_full_half=bloc[1]></ImgFullHalf>
                <ColorSection v-if="bloc[0] == 'bloc_colors'" :colors=bloc[1]></ColorSection>
                <TextBgSection v-if="bloc[0] == 'bloc_bg_gradient'" :gradient_text=bloc[1] :gradient_img=bloc[2]></TextBgSection>
                <Img6SquareText v-if="bloc[0] == 'bloc_six_img_txt'" :six_chapter=bloc[1] :six_chapter_name=bloc[2] :six_images=bloc[3] :six_images_txt=bloc[4] ></Img6SquareText>
                <ImgPatchwork v-if="bloc[0] == 'bloc_patchwork'" :patchworkOne=bloc[1] :patchworkTxt=bloc[2] :patchworkTwo=bloc[3]></ImgPatchwork>
                <BlocAnimation v-if="bloc[0] == 'bloc_animation'" :image_desktop=bloc[1] :image_mobile=bloc[2]></BlocAnimation>
                <BlocAfter v-if="bloc[0] == 'bloc_after_effect'" :after_top_left=bloc[1] :after_top_righ=bloc[2] :after_top_middle=bloc[3] :after_full_height=bloc[4]></BlocAfter>
            </div>
            <Footer v-if="footer" :link="footerLink" :title="footerTitle"></Footer>
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
    import Img6SquareText from '~/components/project/Img6SquareText'
    import ImgPatchwork from '~/components/project/ImgPatchwork'
    import BlocAnimation from '~/components/project/BlocAnimation'
    import BlocAfter from '~/components/project/BlocAfter'
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
            Img6SquareText,
            ImgPatchwork,
            BlocAnimation,
            BlocAfter,
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
                var footer = projectAcf.footer_link;
                var footerLink = projectAcf.footer_link.url;
                var footerTitle = projectAcf.footer_link.title;


                console.log(projectAcf);

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
                    projectBlocName,
                    footerLink,
                    footerTitle,
                    footer
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