<template>
    <div class="district" >
        <header>
            <p>Для перехода к планировкам выберите желаемый дом на общем плане жилого комплекса</p>
            <div class="wrap">
                <div>доступные объекты</div>
                <div>недоступные объекты</div>
            </div>
        </header>
        <tooltip class="tooltip" :options="tooltip">
            <header v-if="house">{{house.sections_count}} подъезда </header>
            <hr>
            <div class="body" v-if="house">
                <span class="floor">{{house.floor_count}}</span>
                этажей
            </div>
        </tooltip>
        <div class="plan">
            <img class="background" :src="'http://'+districtImg">
            <svg>
                <g>
                    <polygon
                        v-for="item in $store.getters.houses"
                        :points="item.coords"
                        data="item.house_id"
                        fill="rgba(0,0,0,.1)"
                        @mouseenter="tooltipChange"
                        @mouseleave="tooltipChange"
                        @click="toFloor(item.id,$event)"
                        >
                        </polygon>
                </g>
            </svg>
        </div>
    </div>
</template>
<script>
import tooltip from './tooltip'
export default {
    name: 'AppDistrict',
    data () {
        return {
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
        // houses() {
        //     let houses = this.$store.getters.houses;
        //     console.log(houses);
        //     if (houses) {
        //         return houses;
        //     }
        //     else {
        //        return 0
        //     }
        // },
        districtImg(){
            return this.$store.getters.districtImg;
        },
        house(){
            return this.$store.getters.house(14);
        }
    },
    components: {
        tooltip,
    },
    methods:{
        toFloor(id,e) {
            this.$store.dispatch('getRealtysByHouseId', id)
            this.$store.dispatch('getFloorsByHouseId', id);
            this.$router.push({name:'floor',params:{id:id}});
        },
        tooltipChange(e) {
            this.tooltip = {
                width : 107,
                height : 65,
                offsetY : e.offsetY,
                offsetX : e.offsetX,
            }

            console.log(e.target.attributes);
//            setTimeout(()=>{
//            if (!document.querySelector('.tooltip')){
               if (e.type == "mouseenter") {
                   this.tooltip.show = !this.tooltip.show;
               }


//            }
//            },200)
        },
    },
    created () {
        this.$store.dispatch('getHousesByDistrictId')
        this.houses = this.$store.getters.houses;
    }
}
</script>

<style lang="scss" scoped>
    .district {
        position: relative;
        header {
            p {
                width: 100%;
                text-align: center;
                font-family: RobotoCondensed-Regular;
                font-size: 18px;
                margin-top: 19px;
            }
            .wrap {
                display: flex;
                justify-content: center;
                font-size: 12px;
                color: #9c9da2;
                margin-top: 21px;
                margin-left: 66px;
                & > div {
                    width: 137px;
                    height: 26px;
                    letter-spacing: -1.5px;
                }
                & > div:first-child {
                    position: relative;
                    &:after {
                        content: ' ';
                        position: absolute;
                        left: -28px;
                        top: -1px;
                        width:21px;
                        height: 21px;
                        background: url(../assets/img/cube_shodow_pur.png) no-repeat center;
                    }
                }
                & > div:last-child {
                    position: relative;
                    &:after {
                        content: ' ';
                        position: absolute;
                        left: -28px;
                        top: -1px;
                        width:21px;
                        height: 21px;
                        background: url(../assets/img/cube_shodow_black.png) no-repeat center;
                    }
                }
            }
        }
        .plan {
          //  background: url(../assets/img/district_map.jpg) no-repeat center;

            //background-size: cover;
            background-size:contain;
            width:100%;
            height: 687px;
            margin-top: 13px;
            position: relative;
            @media screen and (min-width: 1920px) {
                height: 820px;
            }
            img {
                width: 100%;
                position: absolute;
                z-index: 2
            }
            svg {
                position: absolute;
                left:0;
                top:0;
                width: 100%;
                height: 687px;
                z-index: 3;
                @media screen and (min-width: 1920px) {
                    height: 820px;
                }
            }

        }
    }

    .tooltip{
        padding: 8px 20px 0 20px;

        header{
            width: 100%;
            font-size: 13px;
            text-align: center;
            font-family: RobotoCondensed-Regular;
        }
        .body{
            width: 100%;
            text-align: center;
            font-family: RobotoCondensed-Regular;
            font-size: 13px;
            .floor{
                display: block;
                font-family: direct-Bold;
                font-size: 28px;
            }
        }
        hr{
            padding: 0;
            margin: 0;
            margin-top: 5px;
        }
    }
</style>
