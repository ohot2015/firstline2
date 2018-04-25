<template>
    <div id="info-board">
        <div class="wrap-info">
            <div class="wrap" v-for="item in infoBoard">
                <div v-html="item.info" class="info"></div>
                <div class="label">{{item.label}}</div>
            </div>
        </div>
        <div
            id="show-modal"
            class="killer-call"
            @click="showModal = true"
        >ОСТАВИТЬ ЗАЯВКУ НА БРОНЬ КВАРТИРЫ</div>
          <modal :realtyId="realtyId" v-if="showModal" @close="close">
            <h3 class="description" slot="header">Оставьте свой номер телефона и мы вам перезвоним</h3>
          </modal>
    </div>
</template>
<script>
import modal from './modal.vue'
export default {
    name: 'RealtyInfoBoard',
    data () {
        return {
            infoBoardData:{},
            showModal: false,
            endpoint: 'src/api/sendMail.php'
        }
    },
    methods: {
        close(form) {
            if (!form) {
                return this.showModal = false;
            }
            this.$http.get(this.endpoint, {params: form}).then(function(response){
            },
            function(error){

            })
            return this.showModal = false;
        }
    },
    props: ['infoBoard','realtyId'],
    components: {
        modal
    },
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
                    font-family: direct-Bold;
                    font-weight: 700;
                    line-height: 27px;

                    span{
                        color: #a3cdf9;
                    }
                }
                .label {
                    font-size: 12px;
                    font-family: RobotoCondensed-Regular;
                    font-weight: 400;
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
            font-family: RobotoCondensed-Regular;
            position: absolute;
            bottom: 10px;
            cursor: pointer;
        }
    }

.description{
    margin: 10px 0;
}
</style>
