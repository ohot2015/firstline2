<template>
    <div class="floor">
        <div class="floors-count">
            <house-realty
                class="realty"
                v-for="(item, key, index) in floors"
                :color="'white'"
                :line1="item.floor"
                :line2="'этаж'"
                :key="index"
                :data="item"
                :class="index == 0 ? 'active':''"
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
            <div class="back-to-floor" @click="backToFloor"><span class="icon_planfloor"></span>Перейти к общему плану этажа</div>
          </div>
        </div>
        <div class="info-plan">
            <ul>
                <li v-for="item in realtys" :class="'rooms'+item.rooms">
                    {{rooms[item.rooms]}} / <span>{{item.square}} м²</span>
                </li>
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
            //selectedSlider:'',
            realtyHover:'',
            tooltip: {
                width:'',
                height:'',
                offsetX: "",
                offsetY: "",
                show: false
            },
            //realtys:[],
            rooms: {
                1: 'Однокомнатная',
                2: 'Двухкомнатная',
                3: 'Трёхкомнатная',
                4: 'Четырёхкомнатная',
            }
        }
    },
    computed: {

        house() {
            return this.$store.getters.house(this.houseId);
        },
        floors: {
            set: function(val) {

            },
            get: function() {
                return  this.$store.getters.floors.floors;
                //return [...Array(parseInt(this.house.floor_count)).keys()].map((c)=> c + 1).reverse();
            }
        },
        countRoomsInFloor(){
            //return this.$store.getters.countRoomsInFloor(this.houseId)
        },
        selectedSlider: {
            set: function(val) {
            },
            get:function() {
                this.floors = this.$store.getters.floors.floors
                let qwe = {};
                for(let el in this.floors) {
                    qwe = this.floors[el];break;
                }
                return [qwe];
            }
        },
        realtys() {
            let floor = _.first(this.selectedSlider).floor
            return this.$store.getters.getRealtyByFloorByHouseId(floor,this.houseId);
        },
    },
    methods: {

        backToPlan () {
            this.$router.push({name:'house',params:{id:this.houseId} });
        },
        backToFloor: function() {
            this.$router.push({name:'floor'});
        },
        clickHouseRealty(floor){
            this.selectedSlider = [floor]
        },
        tooltipChange(rId,e) {
            this.realtyHover = this.$store.getters.realty(rId);
            setTimeout(()=>{
                this.tooltip = {
                    width : 107,
                    height : 86,
                    offsetY : e.offsetY - 70,
                    offsetX : e.offsetX,
                    show : !this.tooltip.show,
                }
            },200)
        },
        // getRealtys() {
        //     let floor = _.first(this.selectedSlider).floor
        //     this.realtys = this.$store.getters.getRealtyByFloorByHouseId(floor,this.houseId);
        // },
    },
    components: {
        HouseRealty,
        Carousel,
        Slide,
        tooltip
    },
    created() {
        this.houseId = this.$route.params.id;
       // this.setSelectedSlider();
        //this.getRealtys();
    }
}
</script>
<style lang="scss">
    body, html , #app, .content {
        background:  #e7e4ff;
    }

    // \e903
    // \e908

    .VueCarousel {
        background: white;
    }
    .prev, .next {
        width: 20px;
        height: 20px;
        background: url(../assets/img/strelka_levaya.png);
    }
</style>
<style lang="scss" scoped>
    $sm: 1024px;
    $md: 1366px;
    $lg: 1920px;
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
    .info-plan {
        width: 250px;
        background: white;

        ul {
            margin:0;
            padding-left: 0;
            padding:10px 0 10px 0;
            li {
                list-style-type: none;
                font-family: 'Firstline' !important;
                speak: none;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height: 1;
                /* Better Font Rendering =========== */
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;

                height: 35px;
                line-height: 35px;
                font-family: RobotoCondensed-Regular;
                color: #252525;
                font-weight: 400;
                padding-left:10px;
                span {
                    font-weight: 700;
                }
                &.active {
                    background: #a3cdf9;
                }
                &:hover {
                    background: #a3cdf9;
                }
            }
            li.rooms1:before {
                content: "\e90d",
            }
            li.rooms2:before {
                content: '\e90f',
            }
            li.rooms3:before {
                content: '\e90e',
            }
            li.rooms4:before {
                content: '\e90c',
            }
        }
    }
    .realty {
            margin-bottom: 10px;
            @media screen and (min-width: $sm) {
                margin-bottom: 12px;
            }
            @media screen and (min-width: $sm) {
                margin-bottom: 14px;
            }
            @media screen and (min-width: $lg) {
                margin-bottom: 16px;
            }
            &:last-child{
                margin:0;
            }
        }
</style>
