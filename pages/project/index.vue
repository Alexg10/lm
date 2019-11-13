<template>
    <div class="work-list">
        <div class="project-name-container">
            <div class="project-name" @click="triggerClick">Chopard</div>
        </div>        
        <swiper :options="swiperOption" ref="mySwiper"  @transitionStart="changeNameStart"  >
            <!-- slides -->
            <swiper-slide v-for="project in projectInfos" v-bind:key :data-name="project[0]" :data-link="project[1]" >
                <div class="project-container">
                    <nuxt-link :to="{ name: 'project-id', params: { id: project[1] }}" class="slide-link"></nuxt-link>
                    <div class="big-background" v-on:mouseenter="triggerHoverIn" v-on:mouseleave="triggerHoverOut">
                        <img :src="project[2]" alt="">
                    </div>
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
        transition: {
            name: 'layout',
            css:false,
            mode: 'out-in',
            duration: 4000,
            leave(){
                console.log("beforeLeaveAnim");


                let leaveTimeline = new TimelineMax();
                leaveTimeline.to( ".swiper-slide-active", 2, {width:"100vw", height:"100vh", ease: Power4.easeInOut});
            }
        },
        data(){
            const vue = this;
            return{
                apiUrl,
                id: this.$route.params.id,
                changeNameDown: new TimelineMax({ 
                    paused: true,
                }),
                changeNameUp: new TimelineMax({ 
                    paused: true,
                }),
                animLeave: new TimelineMax({ 
                    paused: true,
                }),
                swiperOption: {
                    loop: true,
                    speed:1100,
                    slidesPerView: 3,
                    spaceBetween: "50%",
                    // width: "50%",
                    // virtualTranslate: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    keyboard: {
                        enabled: true,
                    },
                    on: {
                        init: function () {
                            var slides = document.getElementsByClassName('swiper-slide');
                            var slideActive = document.getElementsByClassName('swiper-slide-active')[0].nextSibling;
                            var slideActiveName = slideActive.getAttribute('data-name');
                            for (var i = 0; i < slides.length; i++) {
                                slides[i].style.opacity = "0";
                            }
                            slideActive.style.opacity = 1;
                            document.getElementsByClassName("project-name")[0].innerHTML = slideActiveName;
                            setTimeout(function(){
                                for (var i = 0; i < slides.length; i++) {
                                    slides[i].style.opacity = "1";
                                }
                            }, 4000); 
                        },
                        click: function(e){
                            console.log(this.clickedSlide);
                            var clicked = this.clickedSlide;
                            if(clicked.classList.contains("swiper-slide-duplicate-prev") ){
                                this.slideNext();
                            }else if(clicked.classList.contains("swiper-slide-active")){
                                this.slidePrev();
                            }else{
                                vue.triggerClick();
                            }
                        }
                    }
                }
            }
        },
        components:{
            swiper,
            swiperSlide
        },
        methods: {
            changeNameStart(){
                console.log('Chhhhhange');
                var vm = this;
                this.changeNameDown.play(0);
                this.changeNameDown.eventCallback("onComplete", function () {
                    var slideActive = document.getElementsByClassName('swiper-slide-active')[0].nextSibling;
                    var name = slideActive.getAttribute('data-name');
                    var link = slideActive.getAttribute('data-link');
                    document.getElementsByClassName("project-name")[0].innerHTML = name;
                    document.getElementsByClassName("project-name")[0].href = "/project/"+link;
                    vm.changeNameUp.play(0);
                });
            },
            changeNameEnd(){
                console.log('End');
                this.changeName();
                this.changeNameUp.play(0);
            },
            changeName(){
                var slideActive = document.getElementsByClassName('swiper-slide-active')[0].nextSibling;
                var name = slideActive.getAttribute('data-name');
                document.getElementsByClassName("project-name")[0].innerHTML = name;
            },
            triggerHoverIn(e){
                console.log("triggerHoverIn");
                var link = e.target.offsetParent.parentNode.previousSibling;
                if(link.classList.contains("swiper-slide-active")){
                    document.getElementsByClassName('project-name-container')[0].classList.add("hover");
                }
            },
            triggerHoverOut(e){
                console.log("triggerHoverOut");
                // var link = e.target.offsetParent.parentNode.previousSibling;
                // if(link.classList.contains("swiper-slide-active")){
                //     document.getElementsByClassName('project-name-container')[0].classList.remove("hover");
                // }
            },
            triggerClick(){
                console.log("triggerClick");
                const elem = document.getElementsByClassName('swiper-slide-active')[0].nextElementSibling.getElementsByClassName('slide-link')[0];
                elem.click();
            }
        },
        computed: {
            swiper() {
                return this.$refs.mySwiper.swiper
            }
        },
        mounted(){
            axios.get(`${apiUrl}`)
            .then(value => {
                var data = value;
            });
            this.changeNameDown.to( ".project-name", 0.8, {y:220, ease: Power4.easeInOut});
            this.changeNameUp.to( ".project-name", 1, {y:0, ease: Power4.easeInOut});

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
        position: relative;
        width: 50%;
        height: 100vh;
        opacity: 0;
        z-index: 9;
    }
    .swiper-slide-active,
    .swiper-slide-duplicate-active{
        width: 100%;
        // left: 50%;
        .big-background{
            z-index: 999;
        }
    }
    .swiper-slide.swiper-slide-prev,
    .swiper-slide.swiper-slide-next,
    .swiper-slide-duplicate-prev,
    .swiper-slide-duplicate-next{
        // animation-name: fadeOther;
        // animation-duration: 8s;
        // animation-fill-mode: forwards;
        // animation-timing-function: cubic-bezier(0.39, 0.69, 0.36, 1);
        transition: all 1s cubic-bezier(0.39, 0.69, 0.36, 1);
    }

    .project-container{
        display: block;
        position: relative;
        height: 100%;
        background-size: cover;
    }
    .project-name-container{
        position: fixed;
        display: inline-block;
        top: 50%;
        left: 50%;
        width: auto;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 200px;
        z-index: 999;
        mix-blend-mode: soft-light;
        overflow: hidden;
        &.hover{
            mix-blend-mode: normal;
            .project-name{
                cursor: pointer;
                color: $main-color;
                transition: color 0.5s ease;
            }
        }
        &:hover{
            mix-blend-mode: normal;
        }
        .project-name{
            display: inline-block;
            color: #F7F6F5;
            text-decoration: none;      
            white-space: nowrap;  
            transition: color 0.5s ease;
            &:hover{
                cursor: pointer;
                color: $main-color;
                transition: color 0.5s ease;
            }
        }
    }
    .big-background{
        position: absolute;
        background-size: cover; 
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        display: block;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation-name: fadeActive;
        animation-duration: 4s;
        animation-fill-mode: forwards;
        animation-timing-function: cubic-bezier(0.39, 0.69, 0.36, 1);
        cursor: pointer;
        &:after{
            padding-top: 125%;
            // left: auto;
            // right: 0;
            transition: background-color 0.25s ease-in-out;
            display: block;
            content: '';
            background-color: rgba(0, 0, 0, 0);
        }
        img{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-size: cover;
            z-index: -1;
            width: 100vw;
            height: 100vh;
        }
    }
    .slide-link{
        visibility: hidden;
    }

    // .fromprojects-leave-active{
    //     .swiper-slide-active{
    //         .big-background{
    //             animation-name: fadeActiveToproject;
    //             animation-duration: 4s;
    //             animation-fill-mode: forwards;
    //             animation-timing-function: cubic-bezier(0.39, 0.69, 0.36, 1);
    //         }
    //     }
    // }
    .layout-enter-active, .layout-leave-active {
    transition: opacity .5s
    }
    .layout-enter, .layout-leave-active {
    opacity: 0
    }
    @keyframes fadeActive {
        0% { 
            opacity: 0;
        }
        50% { 
            opacity: 1;
            width: 100vw;
            height: 100vh;
        }
        100% {
            width: 383px;
            height: 500px;
        }
    }

    @keyframes fadeActiveToproject {
        0% { 
            width: 383px;
            height: 500px;
        }
        100% { 
            width: 100vw;
            height: 100vh;
        }
    }

    @keyframes fadeOther {
        0% { 
            opacity: 0;
        }
        50% { 
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

</style>