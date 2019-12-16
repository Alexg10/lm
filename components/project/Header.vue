<template>
    <div class="project-header" :style="{ backgroundImage: `url(${image})` }">
        <CloseProject></CloseProject>
        <div class="project-header-content">
            <div class="project-header-content-top">
                <div class="category">
                    <div class="category-type">Project</div>
                </div>
                <div class="project-name">
                    <div class="project-name-content">{{name}}</div>
                </div>
            </div>
            <div class="project-description">
                <p>{{description}}</p>
            </div>
        </div>
    </div>
</template>

<script>

    import CloseProject from '~/components/project/CloseProject'
    import { TimelineMax } from 'gsap'

    export default {
        components:{
            CloseProject
        },
        data(){
            return{
            }
        },
        props: [
            'name',
            'description',
            'image'
        ],
        mounted(){
            // const splitted = new SplitText('.project-description p', {
            //     type: "lines",
            //     linesClass: "introLine"
            // });

            var anim = new TimelineLite();
            var projectName = document.querySelector('.project-name-content');
            var categoryType = document.querySelector('.category-type');
            var description = document.querySelector('.project-description p');

            anim
                .fromTo(categoryType, 2,{y:50}, {y:0, ease: Power4.easeInOut})
                .fromTo(projectName, 1.8,{y:230}, {y:0, ease: Power4.easeInOut},"-=1.2" )
                .fromTo(description, 1.5,{y:30, opacity:0}, {y:0, opacity:1, ease: Power4.easeInOut},"-=1" );

        }
    }
</script>

<style lang="scss" scoped>
    .project-header{
        height: 100vh;
        width: 100vw;
        background-size: cover;
        background-position: 50%;
        color: white;
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
            align-self: flex-end;
            max-width: 370px;
            font-size: 23px;
            font-weight: bold;
            transform: translateY(210px);
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