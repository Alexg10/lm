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
                diameter: 45
            });


            cursor.over('.work-container', {
                borderColor: 'transparent',
            });

            cursor.over('.linkHover', {
                diameter: 25
            });

            function cursorHoverIn(){
                console.log("ooosodf");
                var cursorId = document.querySelector('#cursor');
                cursorId.classList.add('cursorHover');
            };

            function cursorHoverOut(){
                console.log("OOOOOOUT");
                var cursorId = document.querySelector('#cursor');
                cursorId.classList.remove('cursorHover');
            };
            var link = document.querySelector('.linkHover');
            link.addEventListener('mouseenter', cursorHoverIn);
            link.addEventListener('mouseleave', cursorHoverOut);

    }
}
</script>

<style lang="scss" scoped>

</style>