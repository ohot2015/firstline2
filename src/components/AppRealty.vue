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
                @eventHouseRealty="clickHouseRealty"
            >
            </house-realty>
        </div>
        <div class="slider">
            <carousel
                :navigationNextLabel="'<span class=next></span>'"
                :navigationPrevLabel="'<span class=prev></span>'"
                :per-page="1"
                :mouse-drag="false"
                :navigationEnabled="true"
                :paginationEnabled="false"
            >
            <slide v-for="(item, index) in selectedSlider" :key="index" >
              <img :src="'http://' + item.img_path" alt="">
            </slide>
          </carousel>
        </div>
        <realty-info-board :infoBoard="infoBoard"></realty-info-board>
    </div>
</template>
<script>

import HouseRealty from './HouseRealty.vue'
import RealtyInfoBoard from './RealtyInfoBoard.vue'
import _ from 'underscore'
import { Carousel, Slide } from 'vue-carousel';
function getInfoBoard(realty) {
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
                    type: 'plan'
                },
                {
                    line1: '2D',
                    line2: 'вид этажа',
                    type: 'main'
                },
                {
                    line1: '3D',
                    line2: 'квартира',
                    type: 'other'
                },
            ],
            sliders:{
                main: [{img_path: ''}],
                plan: [{img_path:''}],
                other: [{img_path:''}]
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
            console.log(this.sliders);
        },
        getRealtysByHouseId: function() {

          this.$http.get(this.endpoint, {params: {realty_id: this.rId}}).then(function(response){
            let house = response.data.house;
            let realty = response.data.realty;
            console.log(response.data);

            this.infoBoard = getInfoBoard(realty);
            // при перовй загрузки страницы
            let selectedSlider = _.find(realty.img,{type:'plan'}) || _.find(realty.img,{type:'main'});
            this.selectedSlider = [selectedSlider];
            // подставляю значения для навигации
            this.sliders.plan = _.filter(realty.img,{type:'plan'})
            this.sliders.main = _.filter(realty.img,{type:'main'})
            this.sliders.other = _.filter(realty.img,{type:'other'})

          },
          function(error){

          })
        },
    },
    created () {
        console.log(this.$route);
        this.getRealtysByHouseId();
    }
}
</script>
<style lang="scss">
    body, html , #app, .content {
        background:  #e7e4ff;
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
        height: 100%;
        padding-top: 25px;
    }
    .type-slider {
        .house-realty {
            margin-bottom: 10px;
        }
    }
    .slider {
        background: white ;
        width: 560px;
        height: 420px;
        margin: 0 20px;
        img {
            width: 100%;
        }
    }

</style>
