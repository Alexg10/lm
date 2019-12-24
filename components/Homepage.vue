<template>
    <div>
        <div class="container">
            <div class="cross" v-on:click="hideCross">
                <div class="crossLineOne">
                    <div class="crossLineOne_content"></div>
                </div>
                <div class="crossLineTwo">
                    <div class="crossLineTwo_content"></div>
                </div>
            </div>
            <div class="background-container"></div>
            <div class="love-container active link">
                <div class="love" v-on:mouseenter="loveHover" v-on:mouseleave="loveLeave" v-on:click="loveClick">
                    <div class="word-container elle">
                        <div class="word">
                            <div class="start">
                                <div class="letter-container">
                                    <div class="letter ">e</div>
                                    <div class="letter ">l</div>
                                </div>
                            </div>
                            <div class="letter permanent">l</div>
                            <div class="end">
                                <div class="letter-container">
                                    <div class="letter ">e</div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="word-container aime">
                        <div class="word">
                            <div class="start">
                                <div class="letter-container">
                                    <div class="letter">a</div>
                                    <div class="letter">i</div>
                                </div>
                            </div>
                            <div class="letter permanent">m</div>
                            <div class="end">
                                <div class="letter-container">
                                <div class="letter end">e</div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="hold-on" v-on:mousedown="loveHover" v-on:mouseup="loveLeave">
                        Hold me
                    </div>
                </div>
                <div class="love-content">
                    <div class="word-container">
                        <div class="">images are stronger than words</div>
                    </div>
                    <div class="word-container">
                        <div class="love-description">but I’m Louise, 25, french artistic director who would love to work with u.</div>
                    </div>
                    <div class="contact-me">
                        <a href="https://nuxtjs.org">
                            <div class="ico">
                                <img src="~/assets/images/ico/contact-ico.svg" alt="">
                            </div>
                            <p>contact me</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="work-container">
                <nuxt-link to="/project" class="work"  >
                    <div v-on:mouseenter="workHover" v-on:mouseleave="workLeave" v-on:click="workClick">
                        <div class="word-container">
                            <div class="work-word word">work</div>
                        </div>
                        <div class="word-container">
                            <div class="work-word word">work</div>
                        </div>
                        <div class="word-container">
                            <div class="work-word word">work</div>
                        </div>
                    </div>
                </nuxt-link>
                <div class="hold-on" v-on:mousedown="loveHover" v-on:mouseup="loveLeave">
                    Hold me
                </div>
            </div>
            <img class="arrow link" :src="arrowDown" alt="">
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    const apiUrl = process.env.API_URL || 'http://localhost:8888/lm/lm_wordpress/wp-json/acf/v3/options/options'
    import { TimelineMax } from 'gsap'
    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'

    export default {
        data(){
            return{
                apiUrl,
                lm_tl : new TimelineMax({ paused: true}),
                work_tl : new TimelineMax({ paused: true}),
                arrowDown,
                scrollDownWord: new TimelineMax({ 
                    paused: true,
                }),
                scrollUpWord: new TimelineMax({ 
                    paused: true,
                }),
                lm_click: new TimelineMax({ paused: true}),
                work_click: new TimelineMax({ paused: true}),
                work_close: new TimelineMax({ paused: true}),
                lm_hover_down: new TimelineMax({ paused: true}),
                i: 0, 
                gifLenght: 0,
                gifTime: 250,
                lmImg:'',
                projectName:'',
                playing:'',
                workImg:'',
                Urlimage:'',
                work_close: new TimelineMax({ paused: true}),
                lm_close: new TimelineMax({ paused: true}),
                clicked: process.env.clicked,
                lmImg : [
                    '/images/home/lm_1.jpg',
                    '/images/home/lm_2.jpg',
                    '/images/home/lm_3.jpg',
                    '/images/home/lm_4.jpg',
                    '/images/home/lm_5.jpg',
                    '/images/home/lm_6.jpg',
                    '/images/home/lm_7.jpg'
                ],
                workImg : [
                    '/images/home/work_1.jpg',
                    '/images/home/work_2.png',
                    '/images/home/work_3.jpg',
                    '/images/home/work_4.jpg'
                ],
                clicked: process.env.clicked
            }
        },
        methods: {
            hideCross(){
                var cross = document.getElementsByClassName("cross");
                var vm = this;
                console.log('close nok ');
                this.clicked=false;

                if(cross[0].classList.contains("work")){
                    console.log('close ok ');
                    cross[0].classList.remove("active", "work");
                    this.work_close.play(0);
                    console.log('CLose');
                    this.work_close.eventCallback("onComplete", function () {
                        console.log('complete');
                        vm.showLogo();
                    });
                }else if (cross[0].classList.contains("love")){
                    cross[0].classList.remove("active", "love");
                    this.lm_close.play(0);
                    // this.lm_click.reverse();
                    setTimeout(() => {
                        this.lm_tl.pause(0);
                    }, 3000);
                }
                console.log(this.clicked);

            },
            showLogo(){
                var logo = document.getElementsByClassName("logo");
                console.log(logo);
                logo[0].classList.add("visible");
            },
            loveHover(){
                this.clicked = false;

                console.log(this.lmImg);
                this.lm_tl.play();
                console.log(this.clicked)
                console.log(this.playing);
                this.playing = setInterval(() => {
                    this.gif(this.lmImg);
                }, this.gifTime)
            },
            
            loveClick(){
                var vm = this;
                this.clicked = true;
                this.lm_click.play(0);
                document.getElementsByClassName("arrow")[0].classList.remove("visible");
                setTimeout(() => {
                    clearInterval(this.playing);
                },800);
            },
            loveLeave(){

                if(!this.clicked){
                    this.lm_tl.reverse();
                    setTimeout(() =>     {
                    console.log(this.playing);

                        clearInterval(this.playing)
                    },500);
                    console.log('sdfsdfs');
                    
                }
            },
            gif(imageArray){
                this.i;
                this.gifLenght = imageArray.length;
                var Urlimage = 'url('+imageArray[this.i]+')';
                console.log(Urlimage);
                this.$el.querySelector(".background-container").style.backgroundImage = Urlimage;
                this.i++;
                if(this.i >= this.gifLenght){
                    this.i=0;
                }
            },
            workHover(){
                this.work_tl.play(0);
                console.log("ok")
            },
            workClick(){
                console.log('clic');
                var vm = this;
                this.clicked = true;
                this.work_click.play(0);
                setTimeout(() =>     {
                    clearInterval(this.playing);
                },700);
                vm.hideLogo();
                vm.showCross("work");
                // this.clicked = false;
            },
            workLeave(){
                if(!this.clicked){
                    this.work_tl.reverse();
                    setTimeout(() =>     {
                        clearInterval(this.playing)
                    },500);
                }
            },
            workTitleHover(){
                console.log(this);

                // imgUrl = this.getAttribute("data-image");
                // console.log(imgUrl);
            },
            showLogo(){
                var logo = document.getElementsByClassName("logo");
                console.log(logo);
                logo[0].classList.add("visible");
            },
            hideLogo(){
                var logo = document.getElementsByClassName("logo");
                console.log(logo);
                logo[0].classList.remove("visible");
            },
            showCross(section){
                var cross = document.getElementsByClassName("cross");
                cross[0].classList.add(section, "active");
            },

            loveHoverDown(id){
                console.log('loveHoverDdddown');
                var cross = document.getElementsByClassName("background-container");
                        // clearInterval(this.playing);
                this.loveLeave();
                console.log('id');

                console.log(id);

                cross[0].style.opacity = 0;
                cross[0].style.backgroundImage = 'none';
                clearInterval(id);
                // this.playing='';
                // console.log(this.playing);
                // this.gif([0]);
                // this.playing = setInterval(() => {
                //     this.gif(this.workImg);
                // }, this.gifTime)
                // this.workHover();
            },

            detectScroll(){
                var vm = this;
                window.addEventListener('wheel', function(e) {
                    if (e.deltaY < 0) {
                        // console.log('up');
                        vm.scrollUpWord.play();
                        vm.scrollUpWord.eventCallback("onComplete", function () {
                            console.log('complete');
                            vm.scrollDownWord.pause(0);
                            vm.hideLogo();
                        });
                    }
                    if (e.deltaY > 0) {
                        // console.log('down');
                        document.getElementsByClassName("arrow")[0].classList.remove("visible");
                        vm.scrollDownWord.play();

                        vm.scrollDownWord.eventCallback("onComplete", function () {
                            console.log('complete');
                            console.log(vm.playing);

                            vm.loveHoverDown(vm.playing);
                            vm.scrollUpWord.pause(0);
                            vm.showLogo();
                        });
                    }
                });
            }
        },
        mounted(){
            console.log(apiUrl);
            axios.get(`${apiUrl}`)
            .then(value => {
                console.log(value.data.acf)
                var data = value.data.acf;
            });
            var vm =this;

            //! SETTIMEOUT ?
            setTimeout(() => {
                document.getElementsByClassName("arrow")[0].classList.add("visible");
            }, 5000);

            var elleStart = this.$el.querySelector('.elle .start .letter-container');
            var elleEnd = this.$el.querySelector('.elle .end .letter-container');
            var aimeStart = this.$el.querySelector('.aime .start .letter-container');
            var aimeEnd = this.$el.querySelector('.aime .end .letter-container');
            var love = this.$el.querySelector('.love');
            var loveContent = this.$el.querySelector('.love-content');
            var loveContentW = this.$el.querySelector('.love-content .word-container div');
            var loveContentDesc = this.$el.querySelector('.love-content .word-container .love-description');
            var aime = this.$el.querySelector('.aime');
            var elle = this.$el.querySelector('.elle');
            var bgAnim = this.$el.querySelector('.background-container');
            var work = this.$el.querySelector('.work .work-word');
            var workTop = this.$el.querySelector('.work .word-container:nth-child(1)');
            var workMid = this.$el.querySelector('.work .word-container:nth-child(2)');
            var workBottom = this.$el.querySelector('.work .word-container:nth-child(3)');

            this.lm_hover_down

            this.work_close
                .set( ".work", {display: "block", ease: Power4.easeInOut})
                .to( workTop, 1.7, {x:"0", ease: Power4.easeInOut}, "-=0.9")
                .to( workMid, 1.7, {x:"126px", ease: Power4.easeInOut}, "-=1")
                .to( workBottom, 1.7, {x:"-109px", ease: Power4.easeInOut}, "-=1.1");

            this.lm_close
                .to( loveContentW, 1.8, { y:-80, ease: Power4.easeInOut}, "-=0.6")
                .to( loveContentDesc, 1.5, { y:-80, ease: Power4.easeInOut}, "-=1.3")
                .set( elleStart, {xPercent:0})
                .set( elleEnd, {xPercent:0})
                .set( aimeStart, {xPercent:4})
                .set( aimeEnd, {xPercent:4})
                .set( loveContent, {className:"-=active"})
                .set( love, {autoAlpha: 1, display: 'block'})
                .set( bgAnim, {alpha:0, visibility: "visible"}, "+=0.4")
                .to( elle, 1.5, {x:163, ease: Power4.easeInOut},"fire")
                .to( aime, 1.5, {x:-174, ease: Power4.easeInOut},"fire");   

            this.lm_tl.to( elle, 1, {x:92, ease: Power4.easeInOut},"fire")
                .to( aime, 1, {x:-92, ease: Power4.easeInOut},"fire")
                .to( elleStart, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut},"fire")
                .to( elleEnd, 1, {xPercent:-96,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .from( elleEnd, 1, {x:-107, ease: Power4.easeInOut}, "-=0.98")
                .to( aimeStart, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .to( aimeEnd, 1, {xPercent:-96,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .from( aimeEnd, 1, {x:-87, ease: Power4.easeInOut}, "-=0.98")
                .to( bgAnim, 1, {alpha:1, ease: Power4.easeInOut}, "-=0.98");

            this.work_tl
                .to( workTop, 1, {x:80, ease: Power4.easeInOut}, "-=1")
                .to( workMid, 1, {x:-45, ease: Power4.easeInOut}, "-=1")
                .to( workBottom, 1, {x:160, ease: Power4.easeInOut}, "-=1");

            this.work_click
                .to( workTop, 1.7, {x:"70vw", ease: Power4.easeInOut}, "-=1.7")
                .to( workMid, 1.7, {x:"-70vw", ease: Power4.easeInOut}, "-=1.7")
                .to( workBottom, 1.7, {x:"70vw", ease: Power4.easeInOut}, "-=1.7")
                .to( bgAnim, 2, {autoAlpha:0, ease: Power4.easeInOut}, "-=0.5")
                .set( ".work", {display: "none", ease: Power4.easeInOut})

            this.work_close
                .set( ".work", {display: "block", ease: Power4.easeInOut})
                .set( bgAnim, {alpha:0, visibility: "visible"})

            this.scrollDownWord
                .staggerTo( ".active .word", 1.2, {y:-160, ease: Power4.easeInOut}, 0.3)
                .set(".active+div", {className:"+=active"})
                .set(".active", {className:"-=active"})
                .set(".work .word",{y:160})
                .staggerTo( ".work .word", 1.2, {y:0, ease: Power4.easeInOut}, 0.4);

            this.scrollUpWord
                .staggerTo( ".work-container .word", 1.2, {y:-160, ease: Power4.easeInOut}, 0.3)
                .set(".love-container", {className:"+=active"})
                .set(".work-container", {className:"-=active"})
                .set(".love .word",{y:160})
                .staggerTo( ".love .word", 1.2, {y:0, ease: Power4.easeInOut}, 0.4);
                
            this.lm_click
                .to( elle, 2, {x:"-80vw", ease: Power4.easeInOut},"fire")
                .to( aime, 2, {x:"80vw", ease: Power4.easeInOut},"fire")
                .to( bgAnim, 2, {autoAlpha:0, ease: Power4.easeInOut}, "-=0.6")
                .set( love, {autoAlpha: 0, display: 'none'})
                .set( loveContent, {className:"+=active"})
                .from( loveContentW, 1.8, { y:80, ease: Power4.easeInOut}, "-=0.6")
                .from( loveContentDesc, 1.5, { y:80, ease: Power4.easeInOut}, "-=1.3");  
            
            this.lm_click.eventCallback("onComplete", function () {
                console.log("lm_click");
                vm.showCross("love");
            });
                

            this.detectScroll();
        },
        async asyncData({ params, error }) {
            console.log(params);
            console.log(apiUrl);
            return axios.get(`${apiUrl}`)
            .then(res => {
                console.log(res);
                var mail = res.mail;
                var baseline = res.baseline;
                var description = res.description;

                console.log('options');
                console.log(options);
                return { 
                    mail,
                    baseline,
                    description
                }
            })
            .catch((e) => {
                error({ statusCode: 404})
            });
        }
    }
</script>

<style lang="scss" scoped>
    .container{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        font-size: 200px;
        flex-direction:column;
        overflow: hidden;
        max-width: 100%;
        @media ( max-width : 780px ) {
            font-size: 180px;
        }
        @media ( max-width : 680px ) {
            font-size: 130px;
        }
    }
    .arrow{
        position: fixed;
        bottom: 55px;
        opacity: 0;
        transition: 0.5s ease;
        &.visible{
            opacity: 1;
            bottom: 45px;
            transition: 0.8s ease;
            transition-delay: 2s;
        }
    }
    .background-container{
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-size: cover;
        opacity:0;
    }
    .love{
        font-family: 'Didot';
    }
    .elle,
    .aime{
        position: relative;
        display: inline-block;
        .start,
        .end{
            position: relative;
            display: inline-block;
            float: left;
            overflow: hidden;
            .letter-container{
                transform: translateX(100%);
                opacity:0;
            }
        }
        .letter{
            display: inline;
            float: left;
            overflow: hidden;
            &.permanent{
                display: inline;
                width: auto;
            }
        }
    }
    .love,
    .work{
        position: relative;
        color: black;
        transition: color 0.4s ease;
        text-decoration: none;
        &:hover{
            cursor:pointer;
            color: $main-color;
            transition: color 0.5s ease;
        }
    }
    .love-content{
        display: none;
        font-size: 60px;
        text-align: center;
        font-weight: bold;
        &.active{
            display: block;
        }
        .love-description{
            font-size: 20px;
            text-transform: uppercase;
            font-family: 'GTWalsheimProMedium';
            font-weight: bold;
            margin-top: 20px;
            letter-spacing: 0.75px;

            @media ( max-width : 780px ) {
                margin-top: 45px;
                line-height: 40px;
                font-size: 16px;
                max-width: 80%;
                margin: 0 auto;
            }
            @media ( max-width : 680px ) {
                line-height: 26px;
                margin-top: 45px;
                line-height: 40px;
                font-size: 16px;
                max-width: 90%;
            }
        }
        .word-container{
            line-height: 80px;
            @media ( max-width : 780px ) {
                font-size: 50px;
                line-height: 50px;
                letter-spacing: -1.3px;
                max-width: 80%;
                margin: 0 auto;
            }
            @media ( max-width : 680px ) {
                line-height: 48px;
            }
        }
        .contact-me{
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'GTWalsheimProMedium';
            img{
                width: 45px;
                margin-bottom: 20px;
            }
            a{
                font-size: 17px;
                letter-spacing: 0.3px;
                color: black;
                text-decoration: none;
            }
        }
    }
    .aime{
        transform: translate(-174px, 41px);
        @media ( max-width : 680px ) {
            transform: translate(56px, -89px);

        }

    }
    .elle{
        transform: translate(163px, -42px);
        @media ( max-width : 680px ) {
            transform: translate(-7px, 8px);
        }

    }
    .word-container{
        overflow: hidden;
        font-weight: bold;
        line-height: 160px;
    }

    .work{
        .word-container{
            overflow: hidden;
            line-height: 163px;
            font-weight: bold;
            &:nth-child(1){
                transform: translate(0px, 80px);
            }
            &:nth-child(2){
                transform: translateX(126px);
            }
            &:nth-child(3){
                transform: translate(-109px, -75px);
            }
        }
    }
    .work-list{
        display: none;
        text-align:center;
        opacity: 0;
        .work-list-container{
            &.active{
                .work-list-title{
                    font-size: 200px;
                    color:#FF9170;

                }
            }
        }
        .work-list-title{
            font-weight: bold;
            font-size: 80px;
            transition: color 0.5s ease;
            &:hover{
                cursor: pointer;
                color:#FF9170;
                transition: color 0.5s ease;
            }
        }
    }
    .moveUp{
        transform: translateY(-160px);
        transition: 0.4s ease;
    }
    .love-container{
        // height: 50%;
        display: none;
        .love{
            // display: none;
        }
        &.active{
            display: block;
        }
    }
    .work-container{
        // height: 50%;
        display: none;
        &.active{
            display: block;
        }
    }

    .cross{
		position: absolute;
        top: 15px;
        left: 50%;
		width: 40px;
		height: 40px;
		// border: 1px solid black;
		// border-radius: 100px;
        transform: translateX(-50%);
		&:hover{
			cursor: pointer;
		}
		&.active{
			.crossLineOne{
				.crossLineOne_content{
					transform: translate(0%, 0%);
					transition: 0.4s ease;
					transition-delay:0.3s;
				}
			}
			.crossLineTwo{
				.crossLineTwo_content{
					transform: translate(0%, 0%);
					transition: 0.4s ease;
				}
			}
		}
	}
	.crossLineOne{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        transform: translate(-50%,-50%) rotate(-45deg);
        overflow: hidden;
		&_content{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: #3b4046;
			transform: translate(100%, 0%);
			transition: 0.4s ease;
			transition-delay:0.3s;
		}
	}
	.crossLineTwo{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        transform: translate(-50%,-50%) rotate(45deg);
        overflow: hidden;
		&_content{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: #3b4046;
			transform: translate(-100%, 0%);
			transition: 0.4s ease;
		}
	}

    .hold-on{
        display: none;
        @media ( max-width : 780px ) {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 70px;
            margin: 0 auto;
            font-size: 12px;
            border: 1px solid $grey;
            border-radius: 200px;
            color: $grey;
            font-family: 'GTWalsheimProRegular';
            text-transform: uppercase;
            z-index: 999;
        }
    }

</style>