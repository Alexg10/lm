<template>
    <div>
        <HeaderProject></HeaderProject>
        <div class="grey-section">
            <Chapter></Chapter>
            <LaptopSection></LaptopSection>
            <TextSection></TextSection>
            <ImgSection></ImgSection>
            <Img4Section></Img4Section>

        </div>
    </div>
</template>

<script>
    import HeaderProject from '~/components/project/Header'
    import LaptopSection from '~/components/project/LaptopSection'
    import Chapter from '~/components/project/Chapter'
    import TextSection from '~/components/project/TextSection'
    import ImgSection from '~/components/project/ImgSection'
    import Img4Section from '~/components/project/Img4Section'


    

    export default {
        components:{
            HeaderProject,
            LaptopSection,
            Chapter,
            TextSection,
            ImgSection,
            Img4Section
        },
        data(){
            return{
                
            }
        }
    }
</script>

<style lang="scss" scoped>
    
</style>