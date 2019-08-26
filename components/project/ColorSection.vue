<template>
    <section class="color-section">
        <div class="container">
            <div class="color-section-container">
                <div class="color-container">
                    <div class="color"></div>
                    <div class="color-name">
                        Primary - #ff5e52
                    </div>
                </div>
                <div class="color-container">
                    <div class="color"></div>
                    <div class="color-name">
                        Primary - #ff5e52
                    </div>
                    
                </div>
                <div class="color-container">
                    <div class="color"></div>
                    <div class="color-name">
                        Primary - #ff5e52
                    </div>
                </div>
                <div class="color-container">
                    <div class="color"></div>
                    <div class="color-name">
                        Primary - #ff5e52
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        data(){
            return{

            }
        }
    }
</script>

<style lang="scss" scoped>
    .color-section{
        padding: 90px 0 110px;
        .color-section-container{
            display: flex;
            justify-content: center;
            .color-container{
                padding: 0 62px;
                text-align: center;
            }
        }
        .color{
            width: 80px;
            height: 80px;
            margin: 0 auto;
            margin-bottom: 25px;
            border-radius: 100px;
            background-color: #ff5e52;
        }
        .color-name{
            font-family: 'GTWalsheimProRegular';
        }
        @media only screen and ( max-width : 768px ) {
            .color-section-container{
                flex-wrap: wrap;
                .color-container{
                    padding: 0 22px;
                    margin-bottom: 30px;
                }
            }
        }
        @media only screen and ( max-width : 680px ) {

        }
    }


</style>