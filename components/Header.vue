<template>
    <div class="header">
        <div class="logo">
            <div class="logo-container">
                <span class="letter first-letter">L</span>
                <span class="letter second-letter">M</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { TimelineMax } from 'gsap'

    export default {
        data(){
            return{
                work_close: new TimelineMax({ paused: true}),
                lm_close: new TimelineMax({ paused: true}),
                clicked: process.env.clicked
            }
        },
        methods: {
            // hideCross(){
            //     var cross = document.getElementsByClassName("cross");
            //     var vm = this;
            //     console.log('close nok ');
            //     this.clicked=false;

            //     if(cross[0].classList.contains("work")){
            //         console.log('close ok ');
            //         cross[0].classList.remove("active", "work");
            //         this.work_close.play(0);
            //         this.work_close.eventCallback("onComplete", function () {
            //             console.log('complete');
            //             vm.showLogo();
            //         });
            //     }else if (cross[0].classList.contains("love")){
            //         cross[0].classList.remove("active", "love");
            //         this.lm_close.play(0);
            //     }
            //     console.log(this.clicked);

            // },
            // showLogo(){
            //     var logo = document.getElementsByClassName("logo");
            //     console.log(logo);
            //     logo[0].classList.add("visible");
            // }
        },
        mounted(){
            var workList = document.querySelector('.work-list');
            var workTop = document.querySelector('.work .word-container:nth-child(1)');
            var workBottom = document.querySelector('.work .word-container:nth-child(3)');
            var workMid = document.querySelector('.work .word-container:nth-child(2)');
            var loveContentW = document.querySelector('.love-content .word-container div');
            var loveContentDesc = document.querySelector('.love-content .word-container .love-description');
            var love = document.querySelector('.love');
            var aime = document.querySelector('.aime');
            var aimeStart = document.querySelector('.aime .start .letter-container');
            var aimeEnd = document.querySelector('.aime .end .letter-container');
            var elle = document.querySelector('.elle');
            var elleStart = document.querySelector('.elle .start .letter-container');
            var elleEnd = document.querySelector('.elle .end .letter-container');
            var loveContent = document.querySelector('.love-content');
            var bgAnim = document.querySelector('.background-container');





            // this.work_close
            //     .to( workList, 1, {autoAlpha:0, ease: Power4.easeInOut})
            //     .set( workList, {display: "none", ease: Power4.easeInOut})
            //     .set( ".work", {display: "block", ease: Power4.easeInOut})
            //     .to( workTop, 1.7, {x:"0", ease: Power4.easeInOut}, "-=0.9")
            //     .to( workMid, 1.7, {x:"126px", ease: Power4.easeInOut}, "-=1")
            //     .to( workBottom, 1.7, {x:"-109px", ease: Power4.easeInOut}, "-=1.1");

            // this.lm_close
            //     .to( loveContentW, 1.8, { y:-80, ease: Power4.easeInOut}, "-=0.6")
            //     .to( loveContentDesc, 1.5, { y:-80, ease: Power4.easeInOut}, "-=1.3")
            //     .set( elleStart, {xPercent:0})
            //     .set( elleEnd, {xPercent:0})
            //     .set( aimeStart, {xPercent:4})
            //     .set( aimeEnd, {xPercent:4})
            //     .set( loveContent, {className:"-=active"})
            //     .set( love, {autoAlpha: 1, display: 'block'})
            //     // .set( bgAnim, 2.8, {autoAlpha:0, ease: Power4.easeInOut}, "+=0.4")
            //     .to( elle, 1.5, {x:163, ease: Power4.easeInOut},"fire")
            //     .to( aime, 1.5, {x:-174, ease: Power4.easeInOut},"fire");     

        }
    }
</script>

<style lang="scss" scoped>
    .header{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        .logo{
            text-align: center;
            font-size: 22px;
            padding-top: 20px;
            &:hover{
                cursor: pointer;
            }
            &.visible{
                .logo-container{
                    .first-letter,
                    .second-letter{
                        transform: translateY(0%);
                        transition: 0.3s ease;
                    }
                    .second-letter{
                        transition-delay:0.4s;
                    }
                }
            }
            .logo-container{
                display: inline-block;
                padding-top: 4px;
                overflow: hidden;
                .letter{
                    float: left;
                }
                .first-letter{
                    position: relative;
                    top: -8px;
                    left: 1px;
                    transform: translateY(-120%);
                    transition: 0.3s ease;

                }
                .second-letter{
                    position: relative;
                    top: 8px;
                    left: -1px;
                    transform: translateY(0%);
                    transform: translateY(-120%);
                    transition: 0.3s ease;
                    transition-delay:0.4s;
                }
            }

        }
    }
    

</style>