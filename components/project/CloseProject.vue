<template>
    <div class="cross" v-on:click="hideCross">
        <div class="crossLineOne">
            <div class="crossLineOne_content"></div>
        </div>
        <div class="crossLineTwo">
            <div class="crossLineTwo_content"></div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{

            }
        },
        methods: {
            showCross(){
                var cross = document.getElementsByClassName("cross");
                console.log('shoooow');
                cross[0].classList.add("active");
            },
            hideCross(){
                var cross = document.getElementsByClassName("cross");
                cross[0].classList.remove("active");
            }
        },
        mounted() {
            this.showCross();
        }
    }
</script>

<style lang="scss" scoped>
    .crossLineOne,
    .crossLineTwo{
        width: 25px;
    }
    .crossLineOne_content,
    .crossLineTwo_content{
        background-color: white;
    }

</style>