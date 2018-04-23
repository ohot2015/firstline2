<template>
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
                :navigationEnabled="true"
                :paginationEnabled="false"
                :key="'qwe12323'"
            >
            <slide v-for="(item, index) in selectedSlider" :key="index" >
              <img :src="'http://' + item.img_path" alt="">
            </slide>
          </carousel>
          <div class="block-nav">
            <div class="back-to-plan" @click="backToPlan"><span class="icon_planhouse"></span>Перейти к общему плану дома</div>
            <div class="back-to-floor" @click="backToFloor"><span class="icon_planfloor"></span>Перейти к общему плану этажа</div>
          </div>
        </div>
        <realty-info-board :realtyId="rId" :infoBoard="infoBoard"></realty-info-board>
    </div>
</template>
<script>

import HouseRealty from './HouseRealty.vue'
import RealtyInfoBoard from './RealtyInfoBoard.vue'
import _ from 'underscore'
import { Carousel, Slide } from 'vue-carousel';
function getInfoBoard(realty,house) {
    return [
        {
            info: `${realty.rooms} комн. / №${realty.num}`,
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
            info: `${realty.floor} - ${house.floor_count} этаж `,
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
            endpoint: 'src/api/realty.php'
        }
    },
    components: {
        HouseRealty,
        Carousel,
        Slide,
        RealtyInfoBoard
    },
    methods: {
        clickHouseRealty(typeSlider){
            this.selectedSlider = this.sliders[typeSlider];
        },
        getRealtysByHouseId: function() {

          this.$http.get(this.endpoint, {params: {realty_id: this.rId}}).then(function(response){
            let house = response.data.house;
            let realty = response.data.realty;
        //   console.log(response.data);

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
          function(error){

          })
        },
        backToPlan: function() {
            this.$router.push({name:'home'});
        },
        backToFloor: function() {
            this.$router.push({name:'floor',params:{id:14}});
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
    }
    .prev, .next {
        width: 20px;
        height: 20px;
        background: url(../assets/img/strelka_levaya.png);
    }
</style>
<style lang="scss" scoped>
    .VueCarousel {
        height: 100%;
    }
    .realty {
        background: #e7e4ff;
        display: flex;
        justify-content: center;
       // height: 100%;
        padding-top: 25px;
        min-height: 100%;
    }
    .type-slider {
        .house-realty {
            margin-bottom: 10px;
        }
    }
    .slider {

        background: #e7e4ff;
        width: 560px;
        min-height: 420px;
        height: 100%;
        margin: 0 20px;
        img {
            width: 100%;
        }
    }
    .block-nav {
        margin-top: 12px;
        font-family: RobotoCondensed-Regular;
        div span {
            padding-right: 10px;
            line-height: 32px;
        }
    }

</style>
