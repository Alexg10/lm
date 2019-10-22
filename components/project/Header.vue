<template>
    <div class="project-header" :style="{ backgroundImage: `url(${image})` }">
        <div class="project-header-content">
            <div class="category">Project</div>
            <div class="project-name">{{name}}</div>
            <div class="project-description">
                <p>{{description}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
            }
        },
        props: [
            'name',
            'description',
            'image'
        ]
    }
</script>

<style lang="scss" scoped>
    .project-header{
        height: 100vh;
        width: 100vw;
        background-size: cover;
        color: white;
        .project-header-content{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
            max-width: 1113px;
            margin: 0 auto;
        }
        .category{
            font-family: 'GTWalsheimProMedium';
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .project-name{
            font-size: 200px;
            font-weight: bold;
        }
        .project-description{
            align-self: flex-end;
            max-width: 370px;
            font-size: 23px;
            font-weight: bold;
        }
        @media only screen and ( max-width : 768px ) {
            .project-header-content{
                padding: 0 20px;
            }
            .project-name{
                font-size: 150px;
            }
        }
        @media only screen and ( max-width : 680px ) {
            .project-name{
                font-size: 65px;
            }
            .project-description{
                align-self: center;
                max-width: 100%;
                font-size: 19px;
            }
        }
    }
</style>