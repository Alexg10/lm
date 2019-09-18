<template>
    <div class="header">
        <div class="logo">
            <div class="logo-container">
                <span class="letter first-letter">L</span>
                <span class="letter second-letter">M</span>
            </div>
        </div>
        <div class="cross" v-on:click="hideCross">
            <div class="crossLineOne">
                <div class="crossLineOne_content"></div>
            </div>
            <div class="crossLineTwo">
                <div class="crossLineTwo_content"></div>
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
                lm_close: new TimelineMax({ paused: true})

            }
        },
        methods: {
            hideCross(){
                var cross = document.getElementsByClassName("cross");
                var vm = this;
                console.log('close nok ');

                if(cross[0].classList.contains("work")){
                    console.log('close ok ');
                    cross[0].classList.remove("active", "work");
                    this.work_close.play(0);
                    this.work_close.eventCallback("onComplete", function () {
                        console.log('complete');
                        vm.showLogo();
                    });
                }else if (cross[0].classList.contains("love")){
                    cross[0].classList.remove("active", "love");
                    this.lm_close.play(0);
                }
            },
            showLogo(){
                var logo = document.getElementsByClassName("logo");
                console.log(logo);
                logo[0].classList.add("visible");
            }
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
            var elle = document.querySelector('.elle');
            var loveContent = document.querySelector('.love-content');




            this.work_close
                .to( workList, 1, {autoAlpha:0, ease: Power4.easeInOut})
                .set( workList, {display: "none", ease: Power4.easeInOut})
                .set( ".work", {display: "block", ease: Power4.easeInOut})
                .to( workTop, 1.7, {x:"0", ease: Power4.easeInOut}, "-=0.9")
                .to( workMid, 1.7, {x:"126px", ease: Power4.easeInOut}, "-=1")
                .to( workBottom, 1.7, {x:"-109px", ease: Power4.easeInOut}, "-=1.1");

            this.lm_close
                .to( loveContentW, 1.8, { y:-80, ease: Power4.easeInOut}, "-=0.6")
                .to( loveContentDesc, 1.5, { y:-80, ease: Power4.easeInOut}, "-=1.3")
                .set( loveContent, {className:"-=active"})
                .set( love, {autoAlpha: 1, display: 'block'})
                .to( elle, 2, {x:"163px", ease: Power4.easeInOut},"fire")
                .to( aime, 2, {x:"-174px", ease: Power4.easeInOut},"fire")
;     

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

</style>