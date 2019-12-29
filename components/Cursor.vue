<template>
    <div>
        <div id="cursor"></div>
    </div>
</template>

<script>
    export default {
        methods: {
            getLinks(){
                // console.log("OOOOOO");
                var linkItems = document.querySelectorAll(".link");
                    // console.log(linkItems);

                linkItems.forEach(item => {
                    // console.log(item)
                    item.addEventListener("mouseenter", addHoverClass);
                    item.addEventListener("mouseleave", removeHoverClass);
                });

                function addHoverClass(e) {
                    document.getElementById('cursor').classList.add("hover");
                }
                function removeHoverClass(e) {
                    document.getElementById('cursor').classList.remove("hover");
                }
            }
        },
        mounted(){
      // document.addEventListener('mousemove', this.moveCursor);
      // this.moveCursor();

        var $ = document.querySelector.bind(document);
        var $on = document.addEventListener.bind(document);

        this.getLinks();

        var xmouse, ymouse;
        $on('mousemove', function (e) {
            xmouse = e.clientX || e.pageX;
            ymouse = e.clientY || e.pageY;
        });

        var ball = $('#cursor');
        var x = void 0,
            y = void 0,
            dx = void 0,
            dy = void 0,
            tx = 0,
            ty = 0,
            key = -1;

        var followMouse = function followMouse() {
            key = requestAnimationFrame(followMouse);

            if(!x || !y) {
                x = xmouse;
                y = ymouse;
            } else {
                dx = (xmouse - x) * 0.125;
                dy = (ymouse - y) * 0.125;
                if(Math.abs(dx) + Math.abs(dy) < 0.1) {
                    x = xmouse;
                    y = ymouse;
                } else {
                    x += dx;
                    y += dy;
                }
            }
            ball.style.left = x + 'px';
            ball.style.top = y + 'px';
        };

        followMouse();
    },
    watch: {
        $route () {
        console.log('route changed', this.$route);
            this.getLinks();

        }
    }
}
</script>

<style lang="scss" scoped>
    #cursor{
        position: fixed;
        left: 50%;
        top: 50%;
        width: 45px;
        height: 45px;
        border: 1px solid #B4B3B1;
        border-radius: 100px;
        transform: translate(-20px, -20px); 
        /* transition-duration: 0.2s;
        transition-timing-function: ease-in-out; */
        /* transition: top 200ms ease-in-out, left 200ms ease-in-out; */
        pointer-events: none;
        transition: width 0.4s ease, height 0.4s ease, border 0.4s ease;
        z-index: 9999;
        &.hover{
            width: 15px;
            height: 15px;
            transform: translate(-8px, -5px);
            transition: width 0.5s ease, height 0.5s ease;
        }
        &.hidden{
            border: 1px solid transparent;
            transition: border 0.4s ease;
        }
    }
</style>