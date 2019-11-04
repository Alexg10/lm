<template>
    <div class="footer-project">
        <div class="foter-project-content">
            <n-link :to="this.link_next" >
                next project
                <div class="project-name">{{title}}</div>
                <img :src="arrowDown" alt="">
            </n-link>
        </div>
    </div>
</template>

<script>

    import arrowDown from '~/assets/images/ico/arrow-down-ico.svg'

    export default {
        data(){
            return{
                arrowDown,
                link_next:''
            }
        },
        props: [
            'link',
            'title'
        ], 
        mounted: function(){
            this.link_next = this.link.match(/([^\/]*)\/*$/)[1];
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