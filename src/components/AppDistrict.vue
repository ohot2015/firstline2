<template>
    <div class="district">
        <header>
            <p>Для перехода к планировкам выберите желаемый дом на общем плане жилого комплекса</p>
            <div class="wrap">
                <div>доступные объекты</div>
                <div>недоступные объекты</div>
            </div>
        </header>
        <div class="plan"></div>
    </div>
</template>
<script>
export default {
    name: 'AppDistrict',
    data () {
        return {

        }
    }
}
</script>

<style lang="scss" scoped>
    .district {
        header {
            p {
                width: 100%;
                text-align: center;
                font-family: RobotoCondensed-Regular;
                font-size: 18px;
                margin-top: 19px;
            }
            .wrap {
                display: flex;
                justify-content: center;
                font-size: 12px;
                color: #9c9da2;
                margin-top: 21px;
                margin-left: 66px;
                & > div {
                    width: 137px;
                    height: 26px;
                    letter-spacing: -1.5px;
                }
                & > div:first-child {
                    position: relative;
                    &:after {
                        content: ' ';
                        position: absolute;
                        left: -28px;
                        top: -1px;
                        width:21px;
                        height: 21px;
                        background: url(../assets/img/cube_shodow_pur.png) no-repeat center;
                    }
                }
                & > div:last-child {
                    position: relative;
                    &:after {
                        content: ' ';
                        position: absolute;
                        left: -28px;
                        top: -1px;
                        width:21px;
                        height: 21px;
                        background: url(../assets/img/cube_shodow_black.png) no-repeat center;
                    }
                }
            }
        }
        .plan {
            background: url(../assets/img/district_map.jpg) no-repeat center;
            background-size: cover;
            width:100%;
            height: 687px;
            margin-top: 13px;
            @media screen and (min-width: 1920px) {
                height: 820px;
            }
        }
    }
</style>
