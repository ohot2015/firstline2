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
                    @eventHouseRealty="clickHouseRealty"
                >
                </house-realty>
            </div>
            <div class="slider">
                <carousel
                    :per-page="1"
                    :mouse-drag="false"
                    :navigationEnabled="false"
                    :paginationEnabled="false"
                    :key="'qwe12323'"
                >
                <slide v-for="(item, index) in selectedSlider" :key="index" >
                    <lightbox
                    :loop="false"
                    :images="[{src:'http://' + item.img_path}]"
                    >
                        <div class="wrap">
                            <img :src="'http://' + item.img_path" alt="">
                        </div>
                    </lightbox>
                </slide>
              </carousel>
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
import { Carousel, Slide } from 'vue-carousel';

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
            infoBoard: {
            },
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
            sliders:{
                1: [{img_path: ''}],
                2: [{img_path:''}],
                3: [{img_path:''}]
            },
            selectedSlider:[],
            
        }
    },
    components: {
        HouseRealty,
        Carousel,
        Slide,
        RealtyInfoBoard,
        lightbox,
    },
    computed: {
        endpoint(){
            return this.$store.getters.findAll('absPath')+'/src/api/realty';
        } 
    },
    methods: {
        clickHouseRealty(typeSlider){
            this.selectedSlider = this.sliders[typeSlider];
        },
        getRealtysByHouseId: function() {

          this.$http.get(this.endpoint, {params: {realty_id: this.rId}}).then(function(response){
            let house = response.data.house;
            let realty = response.data.realty;
            this.infoBoard = getInfoBoard(realty,house);
            // при перовй загрузки страницы
            let selectedSlider = _.find(realty.img,{type:1}) || _.find(realty.img,{type:2});
            if (selectedSlider) {
                this.selectedSlider = [selectedSlider];
            }
            // подставляю значения для навигации
            this.sliders[1] = _.filter(realty.img,{type:1})
            this.sliders[2] = _.filter(realty.img,{type:2})
            this.sliders[3] = _.filter(realty.img,{type:3})
          },
          (err)=>{ throw err })
        },
        backToPlan: function() {
            this.$router.push({name:'house',params:{id:14}});
        },
        backToFloor: function() {
            this.$router.push({name:'floor',params:{id:14,floor:1}});
        }
    },
    created () {
        this.getRealtysByHouseId();
    }
}
</script>
<style lang="scss">
    .VueCarousel-wrapper {
        background: white;
        border-radius: 5px;
    }
    .VueCarousel-inner{
        transform: inherit !important;
        // .prev, .next {
        //     width: 20px;
        //     height: 20px;
        //     background: url(../assets/img/strelka_levaya.png);
        // }
    }
    .delimeter{
        color: #a3cdf9;
    }

</style>
<style lang="scss" scoped>
    .VueCarousel {
        height: 100%;
    }

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

        .VueCarousel-slide{
            .wrap{
                background-size: cover;
                height: 420px;
                overflow: hidden;
                text-align: center;
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
