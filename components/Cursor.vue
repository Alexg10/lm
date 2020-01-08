<template>
    <div>
        <!-- <div id="cursor"></div> -->
    </div>
</template>

<script>

    import curDot from 'cursor-dot'

    export default {
        mounted(){
            const cursor = curDot({
                borderColor: '#B4B3B1',
                easing: 6,
                diameter: 45,
            });

            cursor.over('.link', {
                diameter: 15,

            })
            cursor.over('.work-container', {
                borderColor: 'transparent',
            })
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