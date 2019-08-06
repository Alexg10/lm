<template>
    <section class="chapter">
        <div class="container">
            <div class="project-chapter"><span class="number">{{chapter}}</span>.</div>
            <div class="project-category">Website e-commerce</div>
        </div>
    </section>
</template>

<script>

    export default {
        data(){
            return{
                chapter:'01'
            }
        }

    }
</script>

<style lang="scss" scoped>
    .chapter{
        padding-top: 83px;
        padding-bottom: 40px;
        text-align: center; 
    }
    .project-chapter{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        color: $grey;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .project-category{
        font-family: 'GTWalsheimProBold';
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bold;
    }
</style>