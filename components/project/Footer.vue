<template>
    <div class="footer-project">
        <div class="foter-project-content">
            <nuxt-link prefetch class="link-to linkHover" :to="{ name: 'project-id', params: { id: this.linkSlug }}" >
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
                bottom: false,
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
                    if (!vm.bottom) {
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                        console.log("bottom");
                        console.log(vm.bottom);


                            console.log('BOOOOTTOM');
                            vm.bottom = true;
                            console.log('CLIIIICK');

                            link.click();
                        }
                    }
                };
            },
        },
        mounted: function(){
                        console.log("bottom");
                        console.log(this.bottom);


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
                    duration: 500,
                    offset: -180
                })
                .setTween(upLetterTl)
                // .addIndicators({ name: 'upLetter' })
                scrollM.addScene(animLetterScene)

            });

            var executed = false;



            function scrollTo(element, duration) {
                var e = document.documentElement;
                if(e.scrollTop===0){
                    var t = e.scrollTop;
                    ++e.scrollTop;
                    e = t+1===e.scrollTop--?e:document.body;
                }
                scrollToC(e, e.scrollTop, element, duration);
            }

            function scrollToC(element, from, to, duration) {
                if (duration < 0) return;
                if(typeof from === "object")from=from.offsetTop;
                if(typeof to === "object")to=to.offsetTop;
                scrollToX(element, from, to, 0, 1/duration, 20, easeOutCuaic);
            }

            function scrollToX(element, x1, x2, t, v, step, operacion) {
                if (t < 0 || t > 1 || v <= 0) return;
                element.scrollTop = x1 - (x1-x2)*operacion(t);
                t += v * step;
                setTimeout(function() {
                    scrollToX(element, x1, x2, t, v, step, operacion);
                }, step);
            }

            function easeOutCuaic(t){
                    t--;
                    return -(t*t*t*t-1);
            }
            var vm = this;


            window.addEventListener("scroll", function() {
                var elementTarget = document.querySelector('.link-to');
                if (!executed) {
                    console.log('executed1 !!');
                    console.log(executed);

                    if (window.scrollY >= (elementTarget.offsetTop + elementTarget.offsetHeight - 300)) {
                        executed = true;
                        console.log('executed2 !!!!!!!!');
                        console.log(executed);
                        // document.querySelector('body').stopScroll();
                        document.querySelector('body').classList.add('fixed');
                        scrollTo(document.querySelector('.next-cover').offsetTop + 10, 2000);
                        vm.goToNextProject();
                    };
                }
            });

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