<template>
    <div>
        <HeaderProject></HeaderProject>
        <div class="grey-section">
            <Chapter></Chapter>
            <LaptopSection></LaptopSection>
            <TextSection></TextSection>
        </div>
    </div>
</template>

<script>
    import HeaderProject from '~/components/project/Header'
    import LaptopSection from '~/components/project/LaptopSection'
    import Chapter from '~/components/project/Chapter'
    import TextSection from '~/components/project/TextSection'

    export default {
        components:{
            HeaderProject,
            LaptopSection,
            Chapter,
            TextSection
        },
        data(){
            return{
                
            }
        }
    }
</script>

<style lang="scss" scoped>
    .text{
        font-size: 28px;
        padding-bottom: 108px;
        p{
            text-align: center;
            max-width: 640px;
            margin: 0 auto;
            font-weight: bold;
        }
    }
    
</style>