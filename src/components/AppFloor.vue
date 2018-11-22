<template>
    <div class="wrap-all">
        <!--<div class="test">-->
            <!--{{selectSectionNum}}, {{selectFloorNum}} {{floors.length}}-->
        <!--</div>-->
        <div class="section">
            <house-realty
                    class="realty"
                    v-for="(item, key, index) in range"
                    :color="'white'"
                    :line1="key +1"
                    :line2="'подъезд'"
                    :key="index"
                    :data="item + 1"
                    :class="key + 1 == selectSectionNum ? 'active':''"
                    :parentSelector="'.section'"
                    @eventHouseRealty="changeSection"
            >
            </house-realty>
        </div>
        <div class="floor">
            <div class="floors-count">
                <house-realty
                    class="realty"
                    v-for="(item, key, index) in floors"
                    :color="'white'"
                    :line1="getLine2(item)"
                    :line2="'этаж'"
                    :key="index"
                    :data="item"
                    :class="activeFloor(item)"
                    :parentSelector="'.floors-count'"
                    @eventHouseRealty="changeFloor"
                >
                </house-realty>
            </div>
            <div class="slider">
            <!-- замочег в виде глифа  -->
                <plan-svg
                    :polygon1="polygon1"
                    :path="pathPoly"

                    @eventMouseEnter="mouseEnterPolly"
                ></plan-svg>
            </div>
            <div class="info-plan">
                <ul>
                    <li
                        v-for="item in realtys"
                        :key="item.id"
                        :ref="'realty-'+item.id"
                        :class="'rooms'+item.rooms"
                        @mouseenter="hoverRealty(item,$event)"
                        @mouseleave="hoverRealty(item,$event)"
                    >
                       {{rooms[item.rooms]}} / <span>{{item.square}} м²</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="floor2">
            <div class="block-nav">
                <div class="back-to-plan" @click="backToPlan"><span class="icon_planhouse"></span>Перейти к общему плану дома</div>
                <div class="back-to-floor" @click="backToFloor"><span class="icon_planfloor"></span>Перейти к общему плану района</div>
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
 //:tmp="tmp"
export default {
    name: 'AppFloor',
    data () {
        return {
            svg: {
                points:'',
            },
            houseId:0,
            selectFloorNum:2,
            selectSectionNum:1,
            rooms: {
                1: 'Однокомнатная',
                2: 'Двухкомнатная',
                3: 'Трёхкомнатная',
                4: 'Четырёхкомнатная',
            },
        }
    },
    computed: {

        range() {
            return _.range(this.house.sections_count)
        },
        house() {
            return this.$store.getters.house();
        },
        floors() {
            let floors = this.$store.getters.floors.floors

            let tmp =[]
            Object.keys(floors).forEach((key,id)=> {
                tmp.push(floors[key])
            })

            return tmp.reverse();
        },
        selectFloor() {
            return this.$store.getters.floorSectionByNum(this.selectFloorNum, this.selectSectionNum);
        },
        realtys() {
            return this.$store.getters.getRealtyByFloorByHouseId(this.selectFloorNum, this.selectSectionNum, this.houseId);
        },
        polygon1() {
            let poly = this.$store.getters.floorSectionByNum(this.selectFloorNum, this.selectSectionNum);
            return poly ? poly.polygon : '';
        },
        pathPoly() {
            return this.selectFloor ? this.selectFloor.path:'';
        }
    },
    methods: {
        activeFloor(item) {
            if (item[this.selectSectionNum]) {
                return item[this.selectSectionNum].floor == this.selectFloorNum ? 'active':''
            }
            return "";
        },
        hoverRealty(relaty,e){
            let els = document.querySelectorAll('.info-plan ul li');
            els.forEach((el)=> {
                el.classList.remove('active')
            })
            for(let el in this.selectFloor.polygon) {
                if (this.selectFloor.polygon[el].realty == relaty.id && this.selectFloor.polygon[el].reserv) {
                    this.selectFloor.polygon[el].color = e.type == 'mouseenter' ? 'rgba(0,0,0,.4)' : 'rgba(0,0,0,.0)'
                }
            }
        },
        getLine2(item){
            return item[Object.keys(item)[0]].floor
        },
        backToPlan () {
            this.$router.push({name:'house',params:{id:this.houseId}});
        },
        backToFloor: function() {
            this.$router.push({name:'district',params:{scrollTo:'scrolltodistrict'}});
        },
        changeFloor(floor) {
            this.selectFloorNum  = floor[this.selectSectionNum] ? floor[this.selectSectionNum].floor:''
        },
        changeSection(section) {
            this.selectSectionNum = section
        },
        mouseEnterPolly(id,e) {

            let els = document.querySelectorAll('.info-plan ul li');
            els.forEach((el)=> {
                el.classList.remove('active')
            })
            let target = this.$refs['realty-'+id];
            if (target) {
                target[0].classList.add('active')
                if (e.type == 'mouseleave') {
                    target[0].classList.remove('active')
                }
            }
        },
    },
    components: {
        HouseRealty,
        Carousel,
        Slide,
        planSvg
    },
    created() {
        this.houseId = parseInt(this.$route.params.id);
        this.selectFloorNum = parseInt(this.$route.params.floor);

        if (!(this.house && this.floors && this.selectFloor && this.realtys.length)) {
            this.$store.dispatch('getRealtysByHouseId').then(response => {
                this.$store.dispatch('getFloorsByHouseId')
            }, err => { throw err });
            this.$store.dispatch('getHousesByDistrictId')
        }
    }
}
</script>
<style lang="scss">

    // \e903
    // \e908

    .VueCarousel {
        background: white;
    }

</style>
<style lang="scss" scoped>
    .prev, .next {
        width: 20px;
        height: 20px;
        background: url(../assets/img/strelka_levaya.png);
    }
    .content {
        background:  #e7e4ff;
    }

    $sm: 1024px;
    $md: 1366px;
    $lg: 1920px;
    .wrap-all {
        width: 100%;
        background: #e7e4ff;
        padding-top: 68px;
        height:calc(100vh - 68px);
        @media screen and (max-height: 821px) {
            height:calc(100% - 68px);
        }
    }
    .section {
        width: 960px;
        display: flex;
        justify-content: left;
        margin: 0 auto;
        padding-left: calc((45px ) * 2);
        padding-top: 15px;
        @media screen and (min-width: $sm) {
            width: 960px;
            padding-left: calc((55px + 22px)  * 2);
        }
        @media screen and (min-width: $md) {
            width: 1170px;
            padding-left: calc((66px + 22px)  * 2);

        }
        @media screen and (min-width: $lg) {
            padding-left: calc((77px + 22px)  * 2);
            width: 1170px;
        }
        .realty{
            margin-right: 10px;
            margin-bottom: 20px;
            @media screen and (min-width: $sm) {
                margin-right: 12px;
            }
            @media screen and (min-width: $sm) {
                margin-right: 14px;
            }
            @media screen and (min-width: $lg) {
                margin-right: 16px;
            }
        }
    }
    .floor {
        background: #e7e4ff;
        display: flex;
        justify-content: center;

        margin: 0 auto;
        /*width: 100%;*/

        width: 960px;
        @media screen and (min-width: 1366px) {
            width: 1170px;
        }
    }

    .floor2{
        width: 960px;
        margin:0 auto;

        @media screen and (min-width: 1366px) {
            width: 1170px;
        }

        .block-nav{
            @media screen and (min-width: $sm) {
                margin-left: 73px;
            }
            @media screen and (min-width: $md) {
                margin-left: 84px;
            }
            @media screen and (min-width: $lg) {
                margin-left: 95px;
            }
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
    .VueCarousel {
        height: 100%;
    }
    .slider {
        background: white;
        border-radius: 5px;
        width: calc(100% - 345px);
        min-height: 420px;
        /*height: 420px;*/
        margin: 0 20px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        @media screen and (min-width: 1366px) {
            min-height: 440px;
        }

    }
    .info-plan {
        width: 250px;
        border-radius: 5px;
        background: white;

        ul {
            margin:0;
            padding-left: 0;
            padding:10px 0 10px 0;
            li {
                list-style-type: none;
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
            li[class^="rooms"]:before{
                font-family: 'Firstline' !important;
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
    .back-to-plan{
        cursor: pointer;
    }
    .back-to-floor{
        cursor: pointer;
    }
</style>
