<template>
    <div class="work-list">
        <div class="project-name">Chopard</div>

        <swiper :options="swiperOption">
            <!-- slides -->
            <swiper-slide v-for="project in projectInfos" v-bind:key >
                <div class="project-container" >
                    <nuxt-link :to="{ name: 'project-id', params: { id: project[1] }}" class="white-container" :style="{ backgroundImage: `url('${project[2]}')` } " ></nuxt-link>
                    <div class="big-background" :style="{ backgroundImage: `url('${project[2]}')` } " ></div>
                </div>
            </swiper-slide>
            
        </swiper>
    </div>
</template>

<script>
    import axios from 'axios'
    const apiUrl = process.env.API_URL || 'http://localhost:8888/lm/lm_wordpress/wp-json/wp/v2/projets'

    import { swiper, swiperSlide } from 'vue-awesome-swiper'
    import 'swiper/dist/css/swiper.css'
    export default {
        data(){
            return{
                apiUrl,
                id: this.$route.params.id,
                swiperOption: {
                    loop: true,
                    speed:1000,
                    slidesPerView: 3,
                    spaceBetween: "50%",
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    keyboard: {
                        enabled: true,
                    },
                }
            }
        },
        components:{
            swiper,
            swiperSlide
        },
        mounted: function(){
            console.log(this);
            axios.get(`${apiUrl}`)
            .then(value => {
                var data = value;
            });
        },
        async asyncData({ params, error }) {
            return axios.get(`${apiUrl}`)
            .then(res => {
                var projects = res.data;
                var project= new Object();
                var projectInfos = [];
                projects.forEach(function(element) {
                    project.name = element.title.rendered;
                    project.slug = element.slug;
                    project.cover = element.acf.header_picture.url;
                    projectInfos.push(Object.values(project));
                });
                return { 
                    projectInfos
                }
            })
            .catch((e) => {
                error({ statusCode: 404})
            });
        }
    }
</script>

<style lang="scss" scoped>
    .work-list,
    .swiper-container{
        width: 100vw;
        height: 100vh;
    }
    .swiper-slide{
        width: 70%;
        height: 100vh;
    }
    .project-container{
        display: block;
        position: relative;
        height: 100%;
        background-size: cover;
    }
    .project-name{
        position: fixed;
        display: inline-block;
        top: 50%;
        left: 50%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 200px;
        color: #F7F6F5;
        mix-blend-mode: soft-light;
        text-decoration: none;
        z-index: 999;
        &:hover{
            cursor: pointer;
            mix-blend-mode: normal;

            color: $main-color;
        }
    }
    .big-background{
        position: absolute;
        background-size: cover; 
        height: 100vh;
        width: 100vw;
        transition: fade 0.2s;
        animation-name: fade;
        animation-duration: 3s;
        animation-delay: 2s;
        animation-fill-mode: forwards;
        animation-timing-function: cubic-bezier(0, 0, 0.65, 0.96);
    }
    .white-container{
        width: 383px;
        height: 500px;
        position: absolute;
        background-size: cover; 
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        clip: rect(0px, 430px, 500px, 0px);
    }

    @keyframes fade {
        0% { opacity: 1; }
        100% { opacity: 0; }
        }

</style>