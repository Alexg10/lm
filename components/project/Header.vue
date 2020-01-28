<template>
    <div class="project-header">
        <img class="bg-cover" :src="project.cover" alt="">
        <CloseProject></CloseProject>
        <div class="project-header-content">
            <div class="project-header-content-top">
                <div class="category">
                    <div class="category-type">{{project.type}}</div>
                </div>
                <div class="project-name">
                    <div class="project-name-content">{{project.name}}</div>
                </div>
            </div>
            <div class="project-description">
                <p>{{project.description}}</p>
                <div v-if="project.link" class="link-container" >
                    <a :href="project.link" target="_blank" class="project-link link linkHover link-stagger">View the website</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import CloseProject from '~/components/project/CloseProject'
    import { TimelineMax } from 'gsap'
    import VueScrollmagic from 'vue-scrollmagic'

    export default {
        components:{
            CloseProject
        },
        methods: {
            letterContainer(className){
                var word = document.getElementsByClassName(className)[0];
                var wordContent = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                word.innerHTML = "";

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    newSpan.className = "staggerLetter";
                    if (wordContentSplit[i] == " "){
                        newSpan.style.width = "7px";
                    }
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                }
            }
        },
        mounted(){
            // const splitted = new SplitText('.project-description p', {
            //     type: "lines",
            //     linesClass: "introLine"
            // });

            if(this.link){
                
                this.letterContainer("link-stagger");

                var staggerLink = document.querySelector('.link-stagger');
                var tl = new TimelineMax();

                staggerLink.addEventListener('mouseenter', e => {
                    tl.staggerFromTo(".staggerLetter", 0.5, { y: 0, ease: Power4.easeInOut },{ y: -45, ease: Power4.easeInOut }, 0.03)
                        .staggerFromTo(".staggerLetter", 0.5, { y: 20, ease: Power4.easeOut },{ y: 0, ease: Power4.easeInOut }, 0.025, "-=0.45");
                });
            }


            var anim = new TimelineLite();
            var sectionTl= new TimelineMax({ paused: false});

            var projectName = document.querySelector('.project-name-content');
            var categoryType = document.querySelector('.category-type');
            var description = document.querySelector('.project-description p');
            var link = document.querySelector('.project-link');
            var img = document.querySelector('.bg-cover');
            var scrollB = this.$scrollmagic;

            sectionTl.fromTo(img, 2,{y:0}, {y:200});

            const sceneParallax = scrollB.scene({
                triggerElement: '.bg-cover',
                triggerHook: 0,
                offset: 0,
                duration: 900
            })
            .setTween(sectionTl)
            scrollB.addScene(sceneParallax);

            if( link){
                anim
                    .fromTo(categoryType, 2,{y:50}, {y:0, ease: Power4.easeInOut})
                    .fromTo(projectName, 1.8,{y:230}, {y:0, ease: Power4.easeInOut},"-=1.2" )
                    .fromTo(description, 1.5,{y:30, opacity:0}, {y:0, opacity:1, ease: Power4.easeInOut},"-=1" )
                    .fromTo(link, 1.5,{y:30, opacity:0}, {y:0, opacity:1, ease: Power4.easeInOut},"-=1" );
            }else{
                anim
                    .fromTo(categoryType, 2,{y:50}, {y:0, ease: Power4.easeInOut})
                    .fromTo(projectName, 1.8,{y:230}, {y:0, ease: Power4.easeInOut},"-=1.2" )
                    .fromTo(description, 1.5,{y:30, opacity:0}, {y:0, opacity:1, ease: Power4.easeInOut},"-=1" );
            }
        },
        computed: {
            project(){
                return this.$store.state.projects.current;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .project-header{
        position: relative;
        height: 100vh;
        width: 100vw;
        background-size: cover;
        background-position: 50%;
        color: white;
        overflow: hidden;
        .bg-cover{
            position: absolute;
            left: 0;
            top: 0;
            height: 100vh;
            width: 100%;
            object-fit: cover;
        }
        .project-header-content{
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            max-width: 1113px;
            margin: 0 auto;
            .project-header-content-top{
                position: absolute;
                top: 50%;
                transform: translateY(-60%);
                text-align: center;
            }
        }
        .category{
            font-family: 'GTWalsheimProMedium';
            text-transform: uppercase;
            letter-spacing: 1px;
            overflow: hidden;
        }
        .project-name{
            font-size: 200px;
            font-weight: bold;
            overflow: hidden;
        }
        .project-description{
            position: relative;
            align-self: flex-end;
            max-width: 370px;
            font-size: 23px;
            font-weight: bold;
            transform: translateY(210px);
        }
        .link-container{
            position: relative;
            display: block;
            margin-top: 40px;
            min-height: 22px;
            overflow: hidden;
        }
        .project-link{
            position: absolute;
            display: inline-block;
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-family: 'GTWalsheimProMedium';
        }
        @media only screen and ( max-width : 1280px ) {
            .project-name{
                font-size: 15.667vw;
            }
        }
        @media only screen and ( max-width : 768px ) {
            .project-header-content{
                padding: 0 20px;
            }
            .project-name{
                // font-size: 150px;
            }
        }
        @media only screen and ( max-width : 680px ) {
            .project-header-content{
                .project-header-content-top{
                    top: 30%;
                }
            }
            .project-description{
                align-self: center;
                max-width: 90%;
                font-size: 19px;
                transform: translateY(0);
            }
            .project-name{
                font-size: 65px;
            }

        }
    }
</style>