<template>
    <div>
        <div class="container">
            <div class="love-container">
                <div class="background-container"></div>
                <div class="love" v-on:mouseenter="loveHover" v-on:mouseleave="loveLeave" v-on:click="loveClick">
                    <div class="word-container elle">
                        <div class=" word">
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
                <div class="work" v-on:mouseenter="workHover">
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
            </div>
        </div>
    </div>
</template>

<script>
    import { TimelineMax } from 'gsap'

    export default {
        data(){
            return{
                lm_tl : new TimelineMax({ paused: true}),
                wordInDownTl : new TimelineMax({ paused: true}),
                wordOutTl : new TimelineMax({ paused: true}),
                wordActiveOutTl : new TimelineMax({ paused: true}),
                wordActiveOutUpTl : new TimelineMax({ paused: true}),
                wordInUpTl: new TimelineMax({ paused: true}),
                lm_click: new TimelineMax({ paused: true}),
                images : [
                '/images/home/lm_1.jpg',
                '/images/home/lm_2.jpg',
                '/images/home/lm_3.jpg',
                '/images/home/lm_4.jpg',
                '/images/home/lm_5.jpg',
                '/images/home/lm_6.jpg',
                '/images/home/lm_7.jpg'
                ],
                i: 0, 
                gifLenght: 0,
                image:'',
                Urlimage:'',
                clicked: false
            }
        },
        methods: {
            loveHover(){
                this.lm_tl.play();
                this.playing = setInterval(() => {
                    this.gif()
                }, 200)
            },
            loveClick(){
                console.log('clic');
                this.clicked = true;
                this.lm_click.play(0);
                setTimeout(() =>     {
                    clearInterval(this.playing)
                },3000);
            },
            loveLeave(){
                if(!this.clicked){
                    this.lm_tl.reverse();
                    setTimeout(() =>     {
                        clearInterval(this.playing)
                    },500);
                }
            }, 
            gif(){
                this.i;
                var image = this.images[this.i];
                var Urlimage = 'url('+this.images[this.i]+')';
                console.log(Urlimage);
                this.$el.querySelector(".background-container").style.backgroundImage =Urlimage;
                this.i++;
                if(this.i >= this.gifLenght){
                    this.i=0;
                }
            },
            workHover(){
                
                console.log("ok");
            },
            detectScroll(){
                var vm = this;
                window.addEventListener('wheel', function(e) {

                    if (e.deltaY < 0) {
                        console.log('up');
                        // vm.wordInUpTl.restart();
                        // vm.wordOutTl.play();
                        vm.wordActiveOutUpTl.play();
                        setTimeout(function() {
                            vm.$el.querySelector('.work-container').style.display = 'none';
                            vm.$el.querySelector('.love-container').style.display = 'block';
                            vm.wordInUpTl.play();
                        }, 1250);

                    }
                    if (e.deltaY > 0) {
                        console.log('down');
                        vm.wordActiveOutTl.play(0);
                        setTimeout(function() {
                            vm.$el.querySelector('.love-container').style.display = 'none';
                            vm.$el.querySelector('.work-container').style.display = 'block';
                            vm.wordInDownTl.play();
                        }, 1250);


                        // vm.wordInDownTl.play();
                        // vm.wordInDownTl.restart();
                    }
                });
            }


        },
        mounted(){
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
            this.gifLenght = this.images.length;
            var work = this.$el.querySelector('.work .work-word');

            this.lm_tl.to( elle, 1, {x:92, ease: Power4.easeInOut},"fire")
                .to( aime, 1, {x:-92, ease: Power4.easeInOut},"fire")
                .to( elleStart, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut},"fire")
                .to( elleEnd, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .from( elleEnd, 1, {x:-107, ease: Power4.easeInOut}, "-=0.98")
                .to( aimeStart, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .to( aimeEnd, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .from( aimeEnd, 1, {x:-87, ease: Power4.easeInOut}, "-=0.98")
                .to( bgAnim, 1, {alpha:1, ease: Power4.easeInOut}, "-=0.98");

            this.wordInDownTl.set(".word",{y:160})
                .staggerTo( ".word", 1.2, {y:0, ease: Power4.easeInOut}, 0.4);
            this.wordInUpTl.set(".word",{y:-160})
                .staggerTo( ".word", 1.2, {y:0, ease: Power4.easeInOut}, 0.4);
            this.wordOutTl.staggerTo( ".word", 1.2, {y:-160, ease: Power4.easeInOut}, 0.4);

            this.wordActiveOutTl.staggerTo( ".word", 1.2, {y:-160, ease: Power4.easeInOut}, 0.3);
            this.wordActiveOutUpTl.staggerTo( ".word", 1.2, {y:160, ease: Power4.easeInOut}, -0.3);
            this.lm_click.to( elle, 2, {x:"-80vw", ease: Power4.easeInOut},"fire")
                .to( aime, 2, {x:"80vw", ease: Power4.easeInOut},"fire")
                .to( bgAnim, 2.8, {autoAlpha:0, ease: Power4.easeInOut}, "+=0.5")
                .set( love, {autoAlpha: 0, display: 'none'})
                .set( loveContent,{display: 'block'})
                .from( loveContentW, 1.8, { y:80, ease: Power4.easeInOut}, "-=0.7")
                .from( loveContentDesc, 1.5, { y:80, ease: Power4.easeInOut}, "-=0.96");                ;



            this.detectScroll();

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
    .love{
        position: relative;
        color: black;
        transition: color 0.4s ease;
        &:hover{
            cursor:pointer;
            color:#FF9170;
            transition: color 0.5s ease;
        }
    }
    .love-content{
        display: none;
        font-size: 60px;
        text-align: center;
        font-weight: bold;
        .love-description{
            font-size: 20px;
            text-transform: uppercase;
            font-family: 'GTWalsheimProMedium';
            font-weight: bold;
            margin-top: 20px;
        }
        .contact-me{
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'GTWalsheimProMedium';
            a{
                font-size: 14px;
                color: black;
                text-decoration: none;
            }
        }
    }
    .aime{
        transform: translate(-174px, 41px);
    }
    .elle{
        transform: translate(163px, -42px);
    }
    .word-container{
        overflow: hidden;
        font-weight: bold;
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

    .love-container{
        // display: none;
        .love{
            // display: none;
        }
    }
    .work-container{
        display: none;
    }

</style>