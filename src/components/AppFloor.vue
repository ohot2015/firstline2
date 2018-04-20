<template>
    <div class="floor">
        <div class="floors-count">
            <house-realty
                v-for="(item, index) in floors"
                :color="'white'"
                :line1="item.floor"
                :line2="'этаж'"
                :key="index"
                :data="item"
                @eventHouseRealty="clickHouseRealty"
            >
            </house-realty>
        </div>
        <div class="slider">
        <tooltip :options="tooltip">
            <header>{{realtyHover.rooms}} комн. / №  {{realtyHover.num}}</header>
            <hr>
            <div class="body">
                {{realtyHover.square}} м2
            </div>
        </tooltip>
            <carousel
                :per-page="1"
                :mouse-drag="false"
                :navigationEnabled="true"
                :paginationEnabled="false"
                :key="'qwe1232'"
                >
            <slide v-for="(item, index) in selectedSlider" :key="index" >
                <div class="wrap-svg">
                    <svg>
                        <g>
                            <polygon
                                v-for="ploy in item.polygon"
                                :points="ploy.points"
                                fill="rgba(0,0,0,.5)"
                                @mouseenter="tooltipChange(ploy.realty,$event)"
                                @mouseleave="tooltipChange(ploy.realty,$event)"
                                >
                            </polygon>
                        </g>
                    </svg>
                    <img :src="'http://'+item.path" alt="">
                </div>
            </slide>
            </carousel>
          <div class="block-nav">
            <div class="back-to-plan" @click="backToPlan"><span class="icon_planhouse"></span>Перейти к общему плану дома</div>
          </div>
        </div>
        <div class="info-plan">
            <ul>
                <li v-for="item in countRoomsInFloor"></li>
            </ul>
        </div>
    </div>
</template>
<script>

import HouseRealty from './HouseRealty.vue'
import _ from 'underscore'
import { Carousel, Slide } from 'vue-carousel';
import tooltip from './tooltip'

export default {
    name: 'AppFloor',
    data () {
        return {
            svg: {
                points:'',
            },
            houseId:0,
            selectedSlider:'',
            realtyHover:'',
            tooltip: {
                width:'',
                height:'',
                offsetX: "",
                offsetY: "",
                show: false
            },
        }
    },
    computed: {
        house() {
            return this.$store.getters.house(this.houseId);
        },
        floors() {
            return this.$store.getters.floors && this.$store.getters.floors.floors;
            //return [...Array(parseInt(this.house.floor_count)).keys()].map((c)=> c + 1).reverse();
        },
        countRoomsInFloor(){
            //return this.$store.getters.countRoomsInFloor(this.houseId)
        },
    },
    methods: {
        backToPlan () {
            this.$router.push({name:'home'});
        },
        clickHouseRealty(floor){
            this.selectedSlider = [floor]
        },
        setSelectedSlider(){
            let qwe = {};
            for(let el in this.floors) {
                qwe = this.floors[el];break;
            }
            this.selectedSlider = [qwe]
        },
        tooltipChange(rId,e) {
            this.realtyHover = this.$store.getters.realty(rId);
            setTimeout(()=>{
                this.tooltip.width = 107;
                this.tooltip.height = 86;
                this.tooltip.offsetY = e.offsetY;
                this.tooltip.offsetX = e.offsetX;
                this.tooltip.show = !this.tooltip.show;
            },200)
        },
    },
    components: {
        HouseRealty,
        Carousel,
        Slide,
        tooltip

    },
    created() {
        this.houseId = this.$route.params.id;
        this.$store.dispatch('getRealtysByHouseId', this.houseId)
        this.$store.dispatch('getFloorsByHouseId', this.houseId)
        this.setSelectedSlider();
    }
}
</script>
<style lang="scss">
    body, html , #app, .content {
        background:  #e7e4ff;
    }

// \e903
// \e908
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
    .floor {
        background: #e7e4ff;
        display: flex;
        justify-content: center;
       // height: 100%;
        padding-top: 25px;
    }
    .block-nav {
        margin-top: 12px;
        font-family: RobotoCondensed-Regular;
        div span {
            padding-right: 10px;
            line-height: 32px;
        }
    }
    .VueCarousel {
        height: 100%;
    }
    .slider {
        background: #e7e4ff;
        width: 560px;
        min-height: 420px;
        height: 420px;
        margin: 0 20px;
        position: relative;
        .wrap-svg {
            width: 100%;
            position: relative;
            img {
                    //width: 100%;
                    // position: absolute;
                    // z-index: 2
                }
                svg {
                    position: absolute;
                    left:0;
                    top:0;
                    width: 100%;
                    height: 687px;
                    z-index: 3;
                }
        }
    }
</style>
