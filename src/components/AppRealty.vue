<template>
    <div class="wrap-all">
        <div class="realty">
            <div class="type-slider" >
                <house-realty
                    v-for="(item, index) in nav"
                    :color="'white'"
                    :line1="item.line1"
                    :line2="item.line2"
                    :key="index"
                    :data="item.type"
                    :class="index == 0 ? 'active':''"
                    :parentSelector="'.type-slider'"
                    @eventHouseRealty="clickHouseRealty"
                >
                </house-realty>
            </div>
            <div class="slider">
                <div class="slide"  >
                    <lightbox
                    :loop="false"
                    :tmp="realty.id"
                    :images="[{src:imgPath}]"
                    >
                        <div class="wrap">
                            <img  :src="imgPath" :key="imgPath" alt="">
                        </div>
                    </lightbox>
                </div>
              <div class="block-nav">
                <div class="back-to-plan" @click="backToPlan"><span class="icon_planhouse"></span>Перейти к общему плану дома</div>
                <div class="back-to-floor" @click="backToFloor"><span class="icon_planfloor"></span>Перейти к общему плану этажа</div>
              </div>
            </div>
            <realty-info-board :realtyId="rId" :infoBoard="infoBoard"></realty-info-board>
        </div>
    </div>
</template>
<script>

import HouseRealty from './HouseRealty.vue'
import RealtyInfoBoard from './RealtyInfoBoard.vue'
import lightbox from './Lightbox.vue'
import _ from 'underscore'


function getInfoBoard(realty,house) {
    return [
        {
            info: `${realty.rooms} комн. <span class="delimeter">/</span> №${realty.num}`,
            label: 'количество комнат и номер квартиры',
        },
        {
            info: `${realty.square} м²`,
            label: 'общая площадь',
        },
        {
            info: `${realty.living_square} м²`,
            label: 'жилая площадь',
        },
        {
            info: `${house.ceiling_height} м `,
            label: 'высота потолков',
        },
        {
            info: `${realty.floor} этаж (из ${house.floor_count})`,
            label: 'расположение квартир данной планировки',
        },
        {
            info: `${realty.section}`,
            label: 'номер подъезда',
        },
    ];
}

export default {
    name: 'AppRealty',
    data () {
        return {
            rId: this.$route.params.id,            
            nav:[
                {
                    line1: '2D',
                    line2: 'квартира',
                    type: '1'
                },
                {
                    line1: '2D',
                    line2: 'вид этажа',
                    type: '2'
                },
                {
                    line1: '3D',
                    line2: 'квартира',
                    type: '3'
                },
            ],
            // sliders:{
            //     1: [{img_path: ''}],
            //     2: [{img_path:''}],
            //     3: [{img_path:''}]
            // },
            selected:1,
            
        }
    },
    components: {
        HouseRealty,
        RealtyInfoBoard,
        lightbox,
    },
    computed: {
        imgPath(){
            if (this.selectedSlider[0]) {
                return 'http://' + this.selectedSlider[0].img_path;
            }
            else {
                return 'https://www.lrcmyanmar.org/wp-content/uploads/2018/11/noimage.png';
            }

        },
        endpoint() {
            return this.$store.getters.findAll('absPath')+'/src/api/realty';
        },
        realty() {
            return this.$store.getters.realty(this.rId);
        },
        house(){
            return this.$store.getters.house();
        },
        infoBoard() {
            if (this.realty){
                return getInfoBoard(this.realty,this.house);
            }
            return {};
        },
        sliders(){
            if (this.realty) {
                return {
                    1: _.filter(this.realty.img,{type:1}),
                    2: _.filter(this.realty.img,{type:2}),
                    3: _.filter(this.realty.img,{type:3})
                }  
            }
            return {};
        },
        selectedSlider() {
            return this.sliders[this.selected]
        }
    },
    methods: {
        clickHouseRealty(typeSlider = 1){
           this.selected = typeSlider;
        },
        backToPlan() {
            this.$router.push({name:'house',params:{id:this.$store.getters.findAll('houseId')}});
        },
        backToFloor() {
            this.$router.push({name:'floor',params:{id:this.$store.getters.findAll('houseId'),floor:this.realty.floor}});
        }
    },
    created () {
        if (!(this.house && this.realty)){
            this.$store.dispatch('getRealtysByHouseId');
            this.$store.dispatch('getHousesByDistrictId');
        }
        this.clickHouseRealty();
    },

}
</script>
<style lang="scss">

    .delimeter{
        color: #a3cdf9;
    }

</style>
<style lang="scss" scoped>

    .wrap-all{
        width: 100%;
        background: #e7e4ff;
        height: 100vh;
        @media screen and (max-height: 589px) {
            height: 100%;
        }
    }
    .realty {
        margin: 0 auto;
        display: flex;
        justify-content: center;
       // height: 100%;
        padding-top: 93px;
        min-height: calc(100% - 93px);
        width: 960px;
        @media screen and (min-width: 1366px) {
            width: 1170px;
        }
    }
    .type-slider {
        .house-realty {
            margin-bottom: 10px;
        }
    }
    .slider {
        background: #e7e4ff;
        /*width: 560px;*/
        width: calc(100% - 369px);
        min-height: 420px;
        height: 100%;
        margin: 0 20px;

        .slide {
            background: white;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            .wrap{
                background-size: cover;
                height: 420px;
                overflow: hidden;
                text-align: center;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                img {
                    cursor: pointer;
                    height: calc(100% - 20px);
                    width: auto;
                    max-width: 100%;
                    padding:10px;
                }
            }
        }

        /*img {*/
            /*width: 100%;*/
        /*}*/
    }
    .block-nav {
        margin-top: 12px;
        font-family: RobotoCondensed-Regular;
        div span {
            padding-right: 10px;
            line-height: 32px;
        }
    }

    .back-to-plan{
        cursor: pointer;
    }
    .back-to-floor{
        cursor: pointer;
    }

</style>
