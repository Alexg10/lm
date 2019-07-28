<template>
    <div>
        <div class="container">
            <div class="background-container" :style="{ 'background-image': 'url(' + Urlimage + ')' }"></div>
            <div class="love" v-on:mouseenter="loveHover" v-on:mouseleave="loveLeave">
                <div class="elle">
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
                <div class="aime">
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
    </div>
</template>

<script>
    import { TimelineMax } from 'gsap'

    export default {
        data(){
            return{
                tl : new TimelineMax({ paused: true}),
                images : [
                'https://picsum.photos/id/586/1500/800',
                'https://picsum.photos/id/516/1500/800',
                'https://picsum.photos/id/519/1500/800',
                'https://picsum.photos/id/522/1500/800',
                'https://picsum.photos/id/509/1500/800'
                ],
                i: 0, 
                gifLenght: 0,
                image:'',
                Urlimage:''
            }
        },
        methods: {
            loveHover(){
                this.tl.play();
                setInterval(() => {
                    this.gif()
                }, 200);
            },
            loveLeave(){
                this.tl.reverse();
                // setTimeout(() => {
                //     clearInterval(this.gif());
                // },500)
            }, 
            gif(){
                this.i;
                console.log(this.i);
                var image = this.images[this.i];
                var Urlimage = 'url('+this.images[this.i]+')';
                console.log(image);
                // $(".background-container").css('background-image','url('+this.images[this.i]+')'); 
                this.i++;
                if(this.i >= this.gifLenght){
                    this.i=0;
                }
            }
        },
        computed: {
            // gif: function(){
            //     console.log(this.i);
            //     var bgImg = this.images[this.i];
            //     if(this.i >= this.gifLenght){
            //         this.i=0;
            //     }
            //     return{
            //         "background": 'url('+bgImg+')'
            //     }
            // }
        },
        mounted(){
            var elleStart = this.$el.querySelector('.elle .start .letter-container');
            var elleEnd = this.$el.querySelector('.elle .end .letter-container');
            var aimeStart = this.$el.querySelector('.aime .start .letter-container');
            var aimeEnd = this.$el.querySelector('.aime .end .letter-container');
            var aime = this.$el.querySelector('.aime');
            var elle = this.$el.querySelector('.elle');
            var bgAnim = this.$el.querySelector('.background-container');
            this.gifLenght = this.images.length;

            this.tl.to( elle, 1, {x:87, ease: Power4.easeInOut},"fire")
                .to( aime, 1, {x:-87, ease: Power4.easeInOut},"fire")
                .to( elleStart, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut},"fire")
                .to( elleEnd, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .from( elleEnd, 1, {x:-107, ease: Power4.easeInOut}, "-=0.98")
                .to( aimeStart, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .to( aimeEnd, 1, {xPercent:-100,alpha:1, ease: Power4.easeInOut}, "-=0.98")
                .from( aimeEnd, 1, {x:-87, ease: Power4.easeInOut}, "-=0.98")
                .to( bgAnim, 1, {alpha:1, ease: Power4.easeInOut}, "-=0.98");
        }    
    }
</script>

<style lang="scss" scoped>
    .container{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        font-family: 'Prata', serif;
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
    .aime{
        transform: translate(-167px, 41px);
    }
    .elle{
        transform: translate(155px, -42px);
    }

</style>