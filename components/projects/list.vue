<template>
    <div class="work-list" v-on:mousemove="parralaxEffect">

        <!-- $device.mobile -->
            <div class="project-name-container link">
                <span>
                    <div class="project-name" @click="triggerClick" v-on:mouseenter="triggerHoverInProjectName" v-on:mouseleave="triggerHoverOutProjectName"  data-id="id">Chopard</div>
                </span>
                <span>
                    <div class="project-type">Brand UI - Interface</div>
                </span>
            </div>
            <swiper :options="swiperOption" ref="mySwiper" @transitionStart="changeNameStart">
                <!-- slides -->
                <swiper-slide v-for="project in $store.state.projects.list" v-bind:key :data-id="project.id" :data-name="project.name" :data-type="project.type" :data-link="project.slug" :data-hash="project.slug">
                    <div class="project-container link">
                        <nuxt-link :to="{ name: 'project-id', params: { id: project.slug }}" class="slide-link"></nuxt-link>
                        <div class="big-background" v-on:mouseenter="triggerHoverIn" v-on:mouseleave="triggerHoverOut" >
                            <div class="project-container-img" :style="{ backgroundImage: `url(${project.cover})` }"></div>
                            <div class="layer"></div>
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
                    mousewheel: true,
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
                            
                            setTimeout(function(){

                                var slideActive = document.getElementsByClassName('swiper-slide-active')[0];
                                var slideActiveName = slideActive.getAttribute('data-name');
                                var slideActiveType = slideActive.getAttribute('data-type');
                                var slideActiveId = slideActive.getAttribute('data-id');
                                
                                


                                document.getElementsByClassName("project-name")[0].innerHTML = slideActiveName;
                                document.getElementsByClassName("project-type")[0].innerHTML = slideActiveType;
                                document.getElementsByClassName("project-name")[0].setAttribute("data-id",slideActiveId);
                            }, 1000);



                            setTimeout(function(){
                                document.getElementsByClassName('swiper-wrapper')[0].classList.add('parallax-ready');
                                document.getElementsByClassName('swiper-slide-active')[0].classList.add('parallax');

                            }, 6000);
                        },
                        slideChange: function(){
                            
                            var slideActiveLayer = document.getElementsByClassName("swiper-slide-active")[0];
                            slideActiveLayer = slideActiveLayer.getElementsByClassName("layer")[0]
                            slideActiveLayer.classList.remove("visible");
                            // document.querySelector('.project-type').classList.add('transition');
                        },
                        transitionStart: function(e){
                            function addMarginL(e) {
                                document.getElementsByClassName('swiper-slide-prev')[0].children[0].style.marginLeft = "50px";
                            }
                            function addMarginR(e) {
                                document.getElementsByClassName('swiper-slide-next')[0].children[0].style.marginRight = "50px";;

                            }
                            function removeMargin(e) {
                                document.querySelector('.swiper-slide-next .project-container').style.marginRight = "0px";
                                document.querySelector('.swiper-slide-prev .project-container').style.marginLeft = "0px";
                            }

                            var nextSlide = document.querySelector('.swiper-slide-next .project-container');
                            var prevSlide = document.querySelector('.swiper-slide-prev .project-container');
                            var activeSlide = document.querySelector('.swiper-slide-active .project-container');

                            nextSlide.addEventListener('mouseenter', addMarginR);
                            prevSlide.addEventListener('mouseenter', addMarginL);
                            nextSlide.addEventListener('mouseleave', removeMargin);
                            prevSlide.addEventListener('mouseleave', removeMargin);
                            activeSlide.addEventListener('mouseenter', removeMargin);

                        },
                        click: function(e){
                            
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
                
                var vm = this;
                this.changeNameDown.play(0);
                this.changeNameDown.eventCallback("onComplete", function () {
                    

                    var slideActive = document.getElementsByClassName('swiper-slide-active')[0];
                    var name = slideActive.getAttribute('data-name');
                    var type = slideActive.getAttribute('data-type');
                    var link = slideActive.getAttribute('data-link');
                    var id = slideActive.getAttribute('data-id');
                    document.getElementsByClassName("project-name")[0].setAttribute("data-id", id);

                    document.getElementsByClassName("project-name")[0].innerHTML = name;
                    document.getElementsByClassName("project-type")[0].innerHTML = type;
                    document.getElementsByClassName("project-name")[0].href = "/project/"+link;
                    vm.changeNameUp.play(0);

                });
            },
            changeNameEnd(){
                
                this.changeName();
                this.changeNameUp.play(0);
                document.querySelectorAll('.layer')[0].classList.remove('visible');

            },
            changeName(){
                var slideActive = document.getElementsByClassName('swiper-slide-active')[0];
                var name = slideActive.getAttribute('data-name');
                var type = slideActive.getAttribute('data-type');
                var id = slideActive.getAttribute('data-id');
                document.getElementsByClassName("project-name")[0].innerHTML = name;
                document.getElementsByClassName("project-type")[0].innerHTML = type;
                document.getElementsByClassName("project-name")[0].setAttribute("data-id", id);
            },
            triggerHoverIn(e){
                
                //! Probleme avec duplicated slide A VOIR 
                //TODO Ne rentre pas ds la function si duplicated slide
                var target = e.target;
                
                var slideActiveLayer = target.getElementsByClassName("layer")[0];
                var link = e.target.closest(".swiper-slide");
                
                if(link.classList.contains("swiper-slide-active")){
                    slideActiveLayer.classList.add("visible");
                    document.querySelector('.project-name-container').classList.add("hover");
                }
            },
            triggerHoverOut(e){
                
                var target = e.target;
                var slideActiveLayer = target.getElementsByClassName("layer")[0];
                var link = e.target.closest(".swiper-slide");
                if(link.classList.contains("swiper-slide-active")){
                    slideActiveLayer.classList.remove("visible");
                    document.querySelector('.project-name-container').classList.remove("hover");
                }
            },
            triggerHoverInProjectName(){
                var slideActiveLayer = document.getElementsByClassName("swiper-slide-active")[0];
                slideActiveLayer = slideActiveLayer.getElementsByClassName("layer")[0]
                slideActiveLayer.classList.add("visible");
            },
            triggerHoverOutProjectName(){
                var slideActiveLayer = document.getElementsByClassName("swiper-slide-active")[0];
                slideActiveLayer = slideActiveLayer.getElementsByClassName("layer")[0]
                slideActiveLayer.classList.remove("visible");
            },
            triggerClick(){
                
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
                var tabLetterLength=[];

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    newSpan.style.minWidth = "40px";
                    newSpan.setAttribute("class", "letter-"+i);
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                    tabLetterLength.push(i)
                }

                //SHUFFLE LETTER
                var currentIndex = tabLetterLength.length, 
                    temporaryValue, 
                    randomIndex;
                while (0 !== currentIndex) {
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex -= 1;
                    temporaryValue = tabLetterLength[currentIndex];
                    tabLetterLength[currentIndex] = tabLetterLength[randomIndex];
                    tabLetterLength[randomIndex] = temporaryValue;
                }

                document.getElementsByClassName("project-name-container")[0].classList.add('visible');
                document.getElementsByClassName("project-name")[0].classList.add('visible');
                //Anim LETTERS
                var letterTrans = new TimelineMax({});
                setTimeout(() => {
                    tabLetterLength.forEach(function(element){
                        var elemToAnim = document.querySelector('.project-name .letter-'+element+'');
                        letterTrans.fromTo(elemToAnim , 0.8, {scaleX:1, scaleY:1, opacity:1},{scaleX:3, scaleY:3, opacity:0, ease: Power4.easeInOut, overwrite: false},"-=0.55");    
                        //! IF PASS TO WHITE
                        // letterTrans.fromTo(elemToAnim , 0.75, {scaleX:1, scaleY:1, opacity:1},{color: "white", ease: Power4.easeInOut, overwrite: false},"-=0.55");    
                    });
                }, 300);

                var tl = new TimelineMax({ paused: false});
                tl.add('start');
                tl.to( ".swiper-slide-prev", 1, {x:-240, ease: Power4.easeInOut}, 'start')
                .to( ".swiper-slide-next", 1, {x:240, ease: Power4.easeInOut}, 'start')
                .to( ".project-type", 1, {y:80, ease: Power4.easeInOut}, "start")
                .to( ".layer.visible", 1, {opcity:0, ease: Power4.easeInOut}, "start+=1")
                .to( paralaxElement, 1, {scale:1, ease: Power4.easeInOut}, 'start+=1')
                .to( ".swiper-slide-active .big-background", 2, {width:"100vw", height:"100vh", ease: Power4.easeInOut}, 'start+=1');
                const elem = document.getElementsByClassName('swiper-slide-active')[0].getElementsByClassName('slide-link')[0];

                setTimeout(() => {
                    document.querySelector('.cover-project').classList.add('visible');
                    elem.click();
                }, 2800);

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
                tl
                .from( slideActive, 3, {width:"100vw", height:"100vh", ease: Power4.easeInOut},'animIntroStart')
                .to( ".project-container-img", 3, {scale: 1.2, ease: Power4.easeInOut},'animIntroStart')
                .from( ".project-name", 2, {y:220, ease: Power4.easeInOut}, 'animIntroStart+=1.5')
                .from( ".swiper-slide-prev", 2.5, {x:-240, ease: Power4.easeInOut}, 'animIntroStart+=2.5')
                .from( ".swiper-slide-next", 2.5, {x:240, ease: Power4.easeInOut}, 'animIntroStart+=2.5');

                tl.eventCallback("onComplete", function () {
                    
                    // vm.showLogo();   
                });
            },
            showLogo(){
                var logo = document.getElementsByClassName("logo");
                
                logo[0].classList.add("visible");
            },
            hideLogo(){
                var logo = document.getElementsByClassName("logo");
                
                logo[0].classList.remove("visible");
            },

        },
        computed: {
            swiper() {
                return this.$refs.mySwiper.swiper
            }
        },
        beforeCreate(){
            

            
            // if(window.innerWidth <= 790) {
            //     this.isMobile = true;
            
            
            // } else {
            //     this.isMobile = false;
            

            // }
            
        },
        mounted(){
            if (document.getElementsByClassName("cover-project").length>0) {
                document.querySelector('.cover-project').classList.remove('visible');
            }
            this.animIntro();
            this.changeNameDown
                .to( ".project-name", 0.8, {y:220, ease: Power4.easeInOut}, "start")
                .to( ".project-type", 1.2, {className:"+=transition"},"start");
            this.changeNameUp
                .to( ".project-name", 1.2, {y:0, ease: Power4.easeInOut},"start")
                .to( ".project-type", 1.2, {className:"-=transition"},"start+=0.5");
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
        margin-right: 0px;
        transition: all 0.6s ease-in-out;
        &.next-hover{
            margin-right: 50px;
            transition: all 0.6s ease-in-out;
        }
    }
    .project-name-container{
        position: fixed;
        display: flex;
        flex-direction: column;
        top: 50%;
        left: 50%;
        width: auto;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 200px;
        z-index: 999;
        // mix-blend-mode: soft-light;
        overflow: hidden;
        span{
            display: inline-block;
            overflow: hidden;
        }
        &.visible{
            overflow: visible;
        }
        &.hover{
            mix-blend-mode: normal;
            .project-name{
                cursor: pointer;
                color: $main-color;
                opacity: 1;
                transition: color 0.5s ease, opacity 0.5s ease;
            }
            .project-type{
                transform: translateY(0px);
                transition: 0.6s ease-in-out;
        }
        }
        &:hover{
            mix-blend-mode: normal;
            .project-type{
                transform: translateY(0px);
                transition: 0.6s ease-in-out;
        }
        }
        .project-name{
            display: inline-block;
            color: #F7F6F5;
            color: $main-color;
            text-decoration: none;      
            white-space: nowrap;  
            opacity: 0.3;
            transition: color 0.5s ease, opacity 0.5s ease;
            span{
                display: inline-block;
                min-width: 50px;
            }
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
        .project-type{
            color: white;
            font-size: 16px;
            font-family: 'GTWalsheimProBold';
            text-transform: uppercase;
            letter-spacing: 1px;
            transform: translateY(50px);
            transition: 0.5s ease-in-out;
            pointer-events: none;
            &.transition{
                transform: translateY(60px)!important;
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

    .layer{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: $main-color;
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    .parallax-ready{
        .layer{
            &.visible{
                opacity: 0.4;
                transition: opacity 0.5s ease;
            }
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