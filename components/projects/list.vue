<template>
    <div class="work-list" v-on:mousemove="parralaxEffect">

        <!-- $device.mobile -->
            <div class="project-name-container">
                <div class="project-name" @click="triggerClick" data-id="id">Chopard</div>
            </div>
            <swiper :options="swiperOption" ref="mySwiper" @transitionStart="changeNameStart">
                <!-- slides -->
                <swiper-slide v-for="project in $store.state.projects.list" v-bind:key :data-id="project.id" :data-name="project.name" :data-link="project.slug" :data-hash="project.slug">
                    <div class="project-container">
                        <nuxt-link :to="{ name: 'project-id', params: { id: project.slug }}" class="slide-link"></nuxt-link>
                        <div class="big-background" v-on:mouseenter="triggerHoverIn" v-on:mouseleave="triggerHoverOut" >
                            <!-- <img :src="project[2]" alt=""> -->
                            <div class="project-container-img" :style="{ backgroundImage: `url(${project.cover})` }"></div>
                        </div>
                    </div>
                </swiper-slide>
            </swiper>
        </div>
</template>

<script>
    import { swiper, swiperSlide } from 'vue-awesome-swiper'
    import 'swiper/dist/css/swiper.css'
    
    export default {
        data(){
            const vue = this;
            return{
                fromProjectData:'',
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
                    centeredSlides: true,
                    spaceBetween: "45%",
                    hashNavigation: {
                        watchState: true,
                    },
                    // virtualTranslate: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    keyboard: {
                        enabled: true,
                    },
                    breakpoints: {
                        780: {
                            slidesPerView: 2,
                            // width: 768/2,
                            // loop: false,
                            // slidesOffsetBefore: 768/2,
                            centeredSlides: true,
                            spaceBetween: "150%",
                        },
                        680: {
                            slidesPerView: 2,
                            // width: 768/2,
                            // loop: false,
                            // slidesOffsetBefore: 768/2,
                            centeredSlides: true,
                            spaceBetween: "150%",
                        }
                    },
                    on: {
                        slugP: this.fromProjectData,

                        init: function () {

                            var slides = document.getElementsByClassName('swiper-slide');
                            console.log("init slide");
                            setTimeout(function(){

                            var slideActive = document.getElementsByClassName('swiper-slide-active')[0];
                            var slideActiveName = slideActive.getAttribute('data-name');
                            var slideActiveId = slideActive.getAttribute('data-id');
                            console.log(slideActiveId);
                            console.log(slideActiveName);


                            document.getElementsByClassName("project-name")[0].innerHTML = slideActiveName;
                            document.getElementsByClassName("project-name")[0].setAttribute("data-id",slideActiveId);
                            }, 3000);



                            setTimeout(function(){
                                document.getElementsByClassName('swiper-wrapper')[0].classList.add('parallax-ready');
                                document.getElementsByClassName('swiper-slide-active')[0].classList.add('parallax');

                            }, 6000);
                        },
                        click: function(e){
                            console.log(this.clickedSlide);
                            var clicked = this.clickedSlide;
                            if(clicked.classList.contains("swiper-slide-next") ){
                                this.slideNext();
                            }else if(clicked.classList.contains("swiper-slide-prev")){
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
                    console.log(vm.isMobile);

                    var slideActive = document.getElementsByClassName('swiper-slide-active')[0];
                    var name = slideActive.getAttribute('data-name');
                    var link = slideActive.getAttribute('data-link');
                    var id = slideActive.getAttribute('data-id');
                    document.getElementsByClassName("project-name")[0].setAttribute("data-id", id);

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
                var slideActive = document.getElementsByClassName('swiper-slide-active')[0];
                var name = slideActive.getAttribute('data-name');
                var id = slideActive.getAttribute('data-id');
                document.getElementsByClassName("project-name")[0].innerHTML = name;
                document.getElementsByClassName("project-name")[0].setAttribute("data-id", id);
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
                var id = document.getElementsByClassName('project-name')[0].getAttribute("data-id");
                this.$store.commit('projects/setProject', id);

                var background = document.getElementsByClassName('swiper-slide-active')[0].getElementsByClassName("project-container-img")[0];
                var translate = 'translate(0px, 0px) scale(1)';
                let slideActive = document.querySelector('.swiper-slide-active');
                let paralaxElement = document.querySelector('.project-container-img');

                background.classList.add('anim');
                slideActive.classList.remove('parallax');
                background.style.transform = translate;


                var word = document.getElementsByClassName("project-name")[0];
                var container = document.getElementsByClassName("project-name");

                //ADD SPAN TO LETTERS
                var wordContent = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                word.innerHTML = "";

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                }

                document.getElementsByClassName("project-name-container")[0].classList.add('visible');
                document.getElementsByClassName("project-name")[0].classList.add('visible');
                //Anim LETTERS
                var letterTrans = new TimelineMax({delay:1.3});
                letterTrans.staggerFromTo(".project-name span", 0.75, {scaleX:1, scaleY:1, opacity:1},{scaleX:3, scaleY:3, opacity:0, ease: Power4.easeInOut, overwrite: false}, 0.1);    



                var tl = new TimelineMax({ paused: false});
                tl.add('start');
                tl.to( ".swiper-slide-prev", 1, {x:-240, ease: Power4.easeInOut}, 'start')
                .to( ".swiper-slide-next", 1, {x:240, ease: Power4.easeInOut}, 'start')
                .to( paralaxElement, 1, {scale:1, ease: Power4.easeInOut}, 'start+=1')
                .to( ".swiper-slide-active .big-background", 2, {width:"100vw", height:"100vh", ease: Power4.easeInOut}, 'start+=1');
                const elem = document.getElementsByClassName('swiper-slide-active')[0].getElementsByClassName('slide-link')[0];






                setTimeout(() => {
                    document.querySelector('.cover-project').classList.add('visible');
                    elem.click();
                }, 3000);

            },
            parralaxEffect(e){
                var slideActive = document.getElementsByClassName('swiper-slide-active')[0];
                var slideWrapper = document.getElementsByClassName('swiper-wrapper')[0];

                if (slideActive.classList.contains("parallax")){
                    if (slideWrapper.classList.contains('parallax-ready')){
                        var background = document.getElementsByClassName('swiper-slide-active parallax')[0].children[0].getElementsByClassName("project-container-img")[0];
                        var backgroudH = parseInt(background.offsetHeight)/2;
                        var backgroudW = parseInt(background.offsetWidth)/2;
                        var posX = -backgroudW - e.clientX;
                        var posY= -backgroudH - e.clientY;
                        var moveX = (posX * -1/30)-25;
                        var moveY = (posY * -1/30);
                        var translate = 'translate(' + moveX + 'px, ' + moveY + 'px) scale(1.2)';
                        
                        background.style.transform = translate;
                    }
                }else {
                    slideActive.classList.add('parallax');
                    console.log('no para')
                }

            },
            beforeLeave(){
                var background = document.getElementsByClassName('swiper-slide-active')[0].getElementsByClassName("project-container-img")[0];
                var translate = 'translate(0px, 0px) scale(1.2)';
                let shadesEl = document.querySelector('.swiper-slide-active');
                var vm = this;

                shadesEl.classList.remove('parallax');
                background.style.transform = translate;
                
                var tl = new TimelineMax({ });
                tl.add('start');
                tl.to( ".swiper-slide-active", 1, {x:-200, ease: Power4.easeInOut}, 'start')
                .to( ".swiper-slide-duplicate-prev", 1, {x:200, ease: Power4.easeInOut}, 'start')
                .to( ".swiper-slide-next .big-background", 2, {width:"100vw", height:"100vh", ease: Power4.easeInOut}, 'start+=2');

                tl.eventCallback("onComplete", function () {
                    vm.hideLogo();   
                });
            },
            animIntro(){
                var slideActive = document.getElementsByClassName('swiper-slide-active')[0].children[0].getElementsByClassName("big-background");
                var tl = new TimelineMax({ 
                    delay:0.5
                });
                var vm = this;
                tl.add('start');
                tl.from( slideActive, 2.5, {alpha:0, ease: Power4.easeInOut},'animIntroStart')
                .from( slideActive, 3, {width:"100vw", height:"100vh", ease: Power4.easeInOut},'animIntroStart+=1.5')
                .to( ".project-container-img", 3, {scale: 1.2, ease: Power4.easeInOut},'animIntroStart+=1.5')
                .from( ".project-name", 2, {y:220, ease: Power4.easeInOut}, 'animIntroStart+=3')
                .from( ".swiper-slide-prev", 2.5, {x:-240, ease: Power4.easeInOut}, 'animIntroStart+=4')
                .from( ".swiper-slide-next", 2.5, {x:240, ease: Power4.easeInOut}, 'animIntroStart+=4');

                tl.eventCallback("onComplete", function () {
                    console.log('complete lm');
                    vm.showLogo();   
                });
            },
            showLogo(){
                var logo = document.getElementsByClassName("logo");
                // console.log(logo);
                logo[0].classList.add("visible");
            },
            hideLogo(){
                var logo = document.getElementsByClassName("logo");
                // console.log(logo);
                logo[0].classList.remove("visible");
            },

        },
        computed: {
            swiper() {
                return this.$refs.mySwiper.swiper
            }
        },
        beforeCreate(){
            console.log("beforeCreate");

            // console.log(window.innerWidth);
            // if(window.innerWidth <= 790) {
            //     this.isMobile = true;
            //     console.log("is mobile tru");
            //     console.log(this.isMobile);
            // } else {
            //     this.isMobile = false;
            //     console.log("is mobile false");

            // }
            console.log("fromProject OOOOOON beforeCreate");
        },
        mounted(){
            if (document.getElementsByClassName("cover-project").length>0) {
                document.querySelector('.cover-project').classList.remove('visible');
            }
            this.animIntro();
            this.changeNameDown.to( ".project-name", 0.8, {y:220, ease: Power4.easeInOut});
            this.changeNameUp.to( ".project-name", 1, {y:0, ease: Power4.easeInOut});
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
        // opacity: 0;
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
        // mix-blend-mode: soft-light;
        overflow: hidden;
        &.visible{
            overflow: visible;
        }
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
            color: $main-color;
            text-decoration: none;      
            white-space: nowrap;  
            opacity: 0.3;
            transition: color 0.5s ease, opacity 0.5s ease;
            &.visible{
                opacity: 1;
            }
            &:hover{
                cursor: pointer;
                color: $main-color;
                opacity: 1;
                transition: color 0.5s ease, opacity 0.5s ease;
            }
        }
    }
    .project-container-img{
        background-size: cover; 
        background-position: 50%;
        width: 100vw;
        overflow: hidden;
        display: block;
        transform: scale(1);
        // position: relative;
        // left: -15%;
        &.anim{
            transition: transform 0.5s ease;
        }
    }
    .big-background{
        display:flex;
        position: absolute;
        background-size: cover; 
        background-position: 50%;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        // display: block;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        // animation-name: fadeActive;
        // animation-duration: 4s;
        // animation-fill-mode: forwards;
        // animation-timing-function: cubic-bezier(0.39, 0.69, 0.36, 1);
        width: 383px;
        height: 500px;
        cursor: pointer;
        &:after{
            padding-top: 125%;
            transition: background-color 0.25s ease-in-out;
            display: block;
            content: '';
            background-color: rgba(0, 0, 0, 0);
        }
        img{
            position: absolute;
            // width: 100%;
            height: 100%;
            width: 100%;
            object-fit: cover;
            // left: -50%;
            z-index: -1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1.15);
            // animation-name: fadeActiveImg;
            // animation-delay:2s;
            // animation-duration: 2s;
            // animation-fill-mode: forwards;
            // animation-timing-function: cubic-bezier(0.39, 0.69, 0.36, 1);
        }
    }
    .slide-link{
        visibility: hidden;
    }

    // .fade-leave-active{
    //     opacity:0;
    //     transition: 10s all ease;
    //     .swiper-slide-next{
    //         .big-background{
    //             animation-name: fadeActiveToproject;
    //             animation-duration: 4s;
    //             animation-fill-mode: forwards;
    //             animation-timing-function: cubic-bezier(0.39, 0.69, 0.36, 1);
    //         }
    //     }
    // }
    // .layout-enter-active, .layout-leave-active {
    // transition: opacity .5s
    // }
    // .layout-enter, .layout-leave-active {
    // opacity: 0
    // }
    // @keyframes fadeActive {
    //     0% { 
    //         opacity: 0;
    //     }
    //     50% { 
    //         opacity: 1;
    //         width: 100vw;
    //         height: 100vh;
    //     }
    //     100% {
    //         width: 383px;
    //         height: 500px;
    //     }
    // }

    // @keyframes fadeActiveImg {
    //     0% { 
    //         width: 100vw;
    //         height: 100vh;
    //     }
    //     100% {
    //         width: 50vw;
    //         height: 50vh;
    //     }
    // }




    // @keyframes fadeActiveToproject {
    //     0% { 
    //         width: 383px;
    //         height: 500px;
    //     }
    //     100% { 
    //         width: 100vw;
    //         height: 100vh;
    //     }
    // }

    @media only screen and ( max-width : 1280px ) {
        .project-name-container{
            display: flex;
            .project-name{
                font-size: 15.667vw;
            }
        }
    }

    @media only screen and ( max-width : 768px ) {
        .swiper-slide{
            // overflow: hidden;
            // width: 50%!important;
            z-index: 9;
            // left: -93%;

            &.swiper-slide-next{
                // overflow: initial;
            }
        }
    }

    @media only screen and ( max-width : 680px ) {
        .swiper-slide{
            .big-background{
                width: 220px;
                height: 286px;
            }
        }
    }



</style>