<template>
    <div class="footer-project">
        <div class="foter-project-content">
            <div class="link-to linkHover">
                <div class="next-project up-letters">next project</div> 
                <div class="next-project-name up-letters">{{project.title}}</div>
                <img class="arrow" :src="arrowDown" alt="">
            </div>
            <div class="next-cover" :style="{ backgroundImage: `url(${project.cover})` }"></div>
        </div>
    </div>
</template>

<script>
    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'
    import VueScrollmagic from 'vue-scrollmagic'

    export default {
        data(){
            return{
                bottom: false,
                arrowDown
            }
        },
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
                var vm = this;
                window.onscroll = function(ev) {
                    if (!vm.bottom) {
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                            vm.bottom = true;
                            // Listen cover change, then scroll to top and finaly change route
                            async function changeRoute(){
                                const cover = await vm.$store.commit('projects/setCover', vm.project.slug);
                                document.querySelector('.cover-project').classList.add('visible');
                                vm.$router.push({
                                    path: '/project/'+ vm.project.slug
                                });
                                return true;
                            }
                            changeRoute();
                            // document.querySelector('.cover-project').classList.remove('visible');
                            // vm.$router.push({
                            //     path: '/project/'+ vm.project.slug
                            // });
                            // document.querySelector('body').classList.remove('fixed');

                        }
                    }
                };
            },
        },
        computed: {
            project(){
                const slug = this.$store.state.projects.current.footerLink.match(/([^\/]*)\/*$/)[1];
                return this.$store.state.projects.list.find(project => project.slug == slug);
            }
        },
        mounted: function(){
            this.$store.commit('projects/emptyCover');
            this.letterContainer("next-project");
            this.letterContainer("next-project-name");

            var scrollM = this.$scrollmagic;
            var nextCover = document.getElementsByClassName("next-cover");
            var footer = document.getElementsByClassName("footer-project");
            var upLetter = document.getElementsByClassName("up-letters");

            var tlCover = new TimelineMax({ paused: false});
            tlCover.fromTo(nextCover, 10, {y: 100, opacity:0, width:"80%"},{y: 0, opacity:1, width:"100%", ease: Power4.easeInOut, overwrite: false});
            const animFooter = scrollM.scene({
                triggerElement: ".footer-project",
                triggerHook: 0.75,
                duration: 1050,
                offset: -100
            })
            .setTween(tlCover)
            scrollM.addScene(animFooter);



            Array.prototype.forEach.call(upLetter,function(el, i) {
                var elements = el.childNodes;
                var upLetterTl = new TimelineMax({ paused: false});
                var element;
                for(var i=0; i<el.childNodes.length; i++ ){
                    var yValue= Math.floor(Math.random() * 50) + 1;
                    upLetterTl.fromTo(el.childNodes[i], 2, {y: 0},{y: -yValue, opacity: 0, ease: Power4.easeIn, overwrite: false}, "start");                
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
                    // console.log('executed1 !!');
                    // console.log(executed);
                    if (window.scrollY >= (elementTarget.offsetTop + elementTarget.offsetHeight - 300)) {
                        executed = true;
                        console.log('executed2 !!!!!!!!');
                        console.log(executed);
                        // document.querySelector('body').stopScroll();
                        // document.querySelector('body').classList.add('fixed');
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