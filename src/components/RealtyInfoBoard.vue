<template>
    <div id="info-board">
        <div class="wrap-info">
            <div class="wrap" v-for="item in infoBoard">
                <div class="info">{{item.info}}</div>
                <div class="label">{{item.label}}</div>
            </div>
        </div>
        <div
            id="show-modal"
            class="killer-call"
            @click="showModal = true"
        >ОСТАВИТЬ ЗАЯВКУ НА БРОНЬ КВАРТИРЫ</div>
          <modal :realtyId="realtyId" v-if="showModal" @close="close">
            <h3 slot="header">Оставте свой номер телефона мы вам перезвоним</h3>
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
            this.$http.get(this.endpoint, {params: form}).then(function(response){
                //console.log(response.data);
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
        console.log(this.realtyId);
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
                    font-family: direct_Regular;
                    font-weight: 700;
                    line-height: 27px;
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
</style>
