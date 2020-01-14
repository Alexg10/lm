<template>
    <div>
        <Header></Header>
        <HeaderProject :name="currentProject.title" :type="currentProject.type" :description="currentProject.description" :image="currentProject.HeaderImg" :link="currentProject.link"></HeaderProject>
        <div class="grey-section">
            <div v-for="bloc in currentProject.projectBlocName" v-bind:key>
                <Chapter v-if="bloc.acf_fc_layout == 'bloc_step'" :bg_color=bloc.color :number=bloc.number :name=bloc.step_title></Chapter>
                <LaptopSection v-if="bloc.acf_fc_layout == 'bloc_laptop'" :image=bloc.laptop_picture.url></LaptopSection>
                <TextSection v-if="bloc.acf_fc_layout == 'bloc_txt'" :text=bloc.text></TextSection>
                <ImgSection v-if="bloc.acf_fc_layout == 'bloc_sketch'" :images=bloc.sketch_images></ImgSection>
                <Img4Section v-if="bloc.acf_fc_layout == 'bloc_four_section_content'" :four_images=bloc.bloc_four_section_img></Img4Section>
                <ImgFullCenter v-if="bloc.acf_fc_layout == 'bloc_img_full_center'" :img_full_center=bloc.bloc_img_full_center_img></ImgFullCenter>
                <ImgFullHalf v-if="bloc.acf_fc_layout == 'bloc_img_full_half'" :img_full_half=bloc.bloc_img_full_half_images></ImgFullHalf>
                <ColorSection v-if="bloc.acf_fc_layout == 'bloc_colors'" :colors=bloc.bloc_colors_color></ColorSection>
                <TextBgSection v-if="bloc.acf_fc_layout == 'bloc_bg_gradient'" :gradient_text=bloc.bloc_bg_gradient_txt :gradient_img=bloc.gradient_background></TextBgSection>
                <Img6SquareText v-if="bloc.acf_fc_layout == 'bloc_six_img_txt'" :six_chapter=bloc.chapter :six_chapter_name=bloc.chapter_name :six_images=bloc.bloc_six_images :six_images_txt=bloc.bloc_six_txt ></Img6SquareText>
                <ImgPatchwork v-if="bloc.acf_fc_layout == 'bloc_patchwork'" :patchworkOne=bloc.first_patchwork :patchworkTxt=bloc.patchwork_txt :patchworkTwo=bloc.second_patchwork></ImgPatchwork>
                <BlocAnimation v-if="bloc.acf_fc_layout == 'bloc_animation'" :image_desktop=bloc.image_desktop :image_mobile=bloc.image_mobile></BlocAnimation>
                <BlocAfter v-if="bloc.acf_fc_layout == 'bloc_after_effect'" :after_top_left=bloc.image_top_left :after_top_righ=bloc.image_top_right :after_top_middle=bloc.image_middle :after_full_height=bloc.images_full_height></BlocAfter>
            </div>
            <Footer :link="currentProject.footerLink" :title="currentProject.footerLinkTitle"></Footer>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    const apiUrl = process.env.API_URL || 'http://localhost:8888/lm/lm_wordpress/wp-json/wp/v2/projets'

    import Header from '~/components/Header'
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

    export default {
        components:{
            Header,
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
                id: this.$route.params.id,
                currentProject :this.$store.state.projects.currentProjectData[0]
            }
        },
        mounted: function(){
            if (document.getElementsByClassName("cover-project").length>0) {
                document.querySelector('.cover-project').classList.remove('visible');
            }
            document.body.classList.remove("fixed");
        },
        computed: {
            project(){
                return this.$store.state.projects.list.find(project => project.id === this.id)
            }
        },
        fetch({store, params}){
            // Get project from slug
            var projectName = params.id.charAt(0).toUpperCase() + params.id.slice(1);
            return axios.get(`${apiUrl}?slug=${projectName}`)
            .then(res => {
                store.commit('projects/add', res);
            })
            // Commit project in project st@ore list
            
            // Commit project in project current
        }
    }
</script>