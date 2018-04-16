<template>
    <div id="info-board">
        <div class="wrap-info">
            <div class="wrap" v-for="item in infoBoard">
                <div class="info">{{item.info}}</div>
                <div class="label">{{item.label}}</div>
            </div>
        </div>
        <div class="killer-call">ОСТАВИТЬ ЗАЯВКУ НА БРОНЬ КВАРТИРЫ</div>
    </div>
</template>
<script>
export default {
    name: 'RealtyInfoBoard',
    data () {
        return {
            infoBoardData:{}
        }
    },
    methods: {
    },
    props: ['infoBoard'],
    created(){
    }
}

</script>

<style lang="scss" scoped>
    #info-board {
        width: 250px;
        height: 420px;
        background: white;
        border-radius: 5px;
        position: relative;
        .wrap-info {
            padding-top:8px;
            .wrap {
                padding:{
                    left: 9px;
                    bottom: 7px;
                }
                .info {
                    font-size: 24px;
                    font-family: direct_regular;
                    font-weight: 700;
                    line-height: 27px;
                }
                .label {
                    font-size: 12px;
                }
            }
        }
        .killer-call {
            height: 35px;
            width: 100%;
            background: #a3cdf9;
            font-size: 12px;
            text-align: center;
            line-height: 35px;
            font-family: roboto-regular;
            position: absolute;
            bottom: 10px;
            cursor: pointer;
        }
    }
</style>
