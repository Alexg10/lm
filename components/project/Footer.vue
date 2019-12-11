<template>
    <div class="footer-project">
        <div class="foter-project-content">
            <nuxt-link prefetch class="link-to" :to="{ name: 'project-id', params: { id: this.linkSlug }}" >
                <div class="next-project up-letters">next project</div> 
                <div class="next-project-name up-letters">{{title}}</div>
                <img class="arrow" :src="arrowDown" alt="">
            </nuxt-link>
            <div class="next-cover" :style="{ backgroundImage: `url(${bgNext})` }" :data-id="this.nextId"></div>
        </div>
    </div>
</template>

<script>

    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'
    import axios from 'axios'
    const apiUrl = process.env.API_URL || 'http://localhost:8888/lm/lm_wordpress/wp-json/wp/v2/projets'
    import VueScrollmagic from 'vue-scrollmagic'

    export default {
        data(){
            return{
                apiUrl,
                bgNext:'',
                nextId:'',
                arrowDown,
                linkSlug: this.link.match(/([^\/]*)\/*$/)[1]
            }
        },
        props: [
            'link',
            'title'
        ], 
        methods:{
            letterContainer(className){
                var word = document.getElementsByClassName(className)[0];
                var wordContent = word.textContent.trim();
                var wordContentSplit = wordContent.split("");
                word.innerHTML = "";

                for(var i=0; i< wordContentSplit.length; i++){
                    var newSpan = document.createElement('span');
                    newSpan.style.display = "inline-block";
                    newSpan.innerHTML = wordContentSplit[i];
                    word.appendChild(newSpan);
                }
            },
            goToNextProject(){
                var link = document.querySelector('.link-to');
                var vm = this;
                window.onscroll = function(ev) {
                    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                        console.log('BOOOOTTOM');
                        link.click();
                    }
                };
            },
        },
        mounted: function(){
            var nextProject = this.$store.state.projects.currentProjectData[0].footerLink.match(/([^\/]*)\/*$/)[1];
            axios.get(`${apiUrl}?slug=${nextProject}`)
            .then(res => {
                this.bgNext = res.data[0].acf.header_picture.url;
                this.nextId = res.data[0].id ;
            });
            this.letterContainer("next-project");
            this.letterContainer("next-project-name");

            var scrollM = this.$scrollmagic;
            var nextCover = document.getElementsByClassName("next-cover");
            var footer = document.getElementsByClassName("footer-project");
            var upLetter = document.getElementsByClassName("up-letters");

            var tlCover = new TimelineMax({ paused: false});
            tlCover.fromTo(nextCover, 1, {y: 100, opacity:0, width:"80%"},{y: 0, opacity:1, width:"100%", ease: Power4.easeInOut, overwrite: false});
            const animFooter = scrollM.scene({
                triggerElement: ".footer-project",
                triggerHook: 0.65,
                duration: 850,
                offset: -50
            })
            .setTween(tlCover)
            scrollM.addScene(animFooter);

            Array.prototype.forEach.call(upLetter,function(el, i) {
                var elements = el.childNodes;
                var upLetterTl = new TimelineMax({ paused: false});
                var element;
                for(var i=0; i<el.childNodes.length; i++ ){
                    var yValue= Math.floor(Math.random() * 50) + 1;
                    upLetterTl.fromTo(el.childNodes[i], 2, {y: 0},{y: -yValue, opacity: 0, ease: Power4.easeInOut, overwrite: false}, "start");                
                }
                const animLetterScene = scrollM.scene({
                    triggerElement: ".footer-project",
                    triggerHook: 0.65,
                    duration: 550,
                    offset: 0
                })
                .setTween(upLetterTl)
                scrollM.addScene(animLetterScene)
            });
            
            this.goToNextProject();
        }
    }
</script>

<style lang="scss" scoped>
    .footer-project{
        text-align: center;
        a{
            color: $black;
            text-decoration: none;
            font-family: 'GTWalsheimProMedium';
            font-size: 16px;
            .next-project-name{
                margin-bottom: 20px;
            }
        }
        .arrow{
            margin-bottom: 100px;
        }
    }
    span{
        display: inline-block;
    }
    .next-cover{
        height: 100vh;
        width: 80%;
        margin: 0 auto;
        background-size: cover;
        background-position: 50%;
        z-index: 9999;
    }
</style>