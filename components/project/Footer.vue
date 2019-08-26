<template>
    <div class="footer-project">
        <div class="foter-project-content">
            <a href="">
                next project
                <div class="project-name">Chopard</div>
                <img :src="arrowDown" alt="">
            </a>
        </div>

    </div>
</template>

<script>

    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'

    export default {
        data(){
            return{
                arrowDown
            }
        }
        
    }
</script>

<style lang="scss" scoped>
    .footer-project{
        text-align: center;
        padding-bottom: 96px;
        a{
            color: $black;
            text-decoration: none;
            font-family: 'GTWalsheimProMedium';
            font-size: 16px;
            .project-name{
                margin-bottom: 20px;
            }

        }
    }
</style>