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
                flex: 1;
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
    }


</style>