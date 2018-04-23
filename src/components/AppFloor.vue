<template>
    <div class="wrap">
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
            <plan-svg
                :plan="selectedSlider[0]"
                :floor="floor"
                @eventMouseEnter="mouseEnterPolly"
            ></plan-svg>
          <div class="block-nav">
            <div class="back-to-plan" @click="backToPlan"><span class="icon_planhouse"></span>Перейти к общему плану дома</div>
            <div class="back-to-floor" @click="backToFloor"><span class="icon_planfloor"></span>Перейти к общему плану района</div>
          </div>
        </div>
        <div class="info-plan">
            <ul>
                <li v-for="item in realtys ? realtys: realty" :key="item.id" :ref="'realty-'+item.id" :elem="huelem" :class="'rooms'+item.rooms">
                    {{rooms[item.rooms]}} / <span>{{item.square}} м²</span>
                </li>
            </ul>
        </div>
    </div>
    </div>
</template>
<script>

import HouseRealty from './HouseRealty.vue'
import _ from 'underscore'
import { Carousel, Slide } from 'vue-carousel';

import planSvg from './planSvg'
import Vue from 'vue'

export default {
    name: 'AppFloor',
    data () {
        return {
            svg: {
                points:'',
            },
            houseId:0,
            //selectedSlider:'',
            selected: false,
            //realtys:[],
            floor:1,
            rooms: {
                1: 'Однокомнатная',
                2: 'Двухкомнатная',
                3: 'Трёхкомнатная',
                4: 'Четырёхкомнатная',
            },
            huelem:'123',
            realtys:'',
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
        selectedSlider: {
            set: function(val) {
                this.selectedSlider[0] = val;
               // console.log(this.selectedSlider);
            },
            get:function() {
                if (!this.selected) {
                    this.selected = true;
                    return this.selectedSlider;
                }
                this.floors = this.$store.getters.floors.floors
                let qwe = {};
                for(let el in this.floors) {
                    qwe = this.floors[el];break;
                }
                return [qwe];
            }
        },
        realty() {
            let floor = _.first(this.selectedSlider).floor
            console.log(this.$store.getters.getRealtyByFloorByHouseId(floor,this.houseId));
            return this.$store.getters.getRealtyByFloorByHouseId(floor,this.houseId);
        },
    },
    // watch: {
    //     selectedSlider: function (val) {
    //         console.log(12123);
    //       let floor = _.first(this.selectedSlider).floor

    //         this.realtys = this.$store.getters.getRealtyByFloorByHouseId(floor,this.houseId);
    //     },
    // },
    methods: {
        setRealtys(){
            let floor = _.first(this.selectedSlider).floor
            if (floor){
                this.realtys =  this.$store.getters.getRealtyByFloorByHouseId(floor,this.houseId);
            }else {
                this.realtys = false
            }
        },
        backToPlan () {
            this.$router.push({name:'house',params:{id:this.houseId}});
        },
        backToFloor: function() {
            this.$router.push('/');
        },
        clickHouseRealty(floor) {
            this.floor = floor.floor;
            this.selectedSlider = floor;
            this.huelem = floor.floor;
            let floor1 = _.first(this.selectedSlider).floor
            console.log(this.$store.getters.getRealtyByFloorByHouseId(floor1,this.houseId));
            this.realtys = this.$store.getters.getRealtyByFloorByHouseId(floor1,this.houseId);
        },
        mouseEnterPolly(id) {
            let els = document.querySelectorAll('.info-plan ul li');
            els.forEach((el)=> {
                el.classList.remove('active')
            })
            let target = this.$refs['realty-'+id];
            if (target) {
                target[0].classList.add('active')
            }
        }
    },
    components: {
        HouseRealty,
        Carousel,
        Slide,
        planSvg
    },
    created() {
        this.houseId = parseInt(this.$route.params.id);
        this.setRealtys();
    }
}
</script>
<style lang="scss" scoped>
    .content {
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
    .wrap {
        min-height: 100%;
        background: #e7e4ff;
    }
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
        background: white;
        width: 560px;
        min-height: 420px;
        height: 420px;
        margin: 0 20px;
        position: relative;


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
