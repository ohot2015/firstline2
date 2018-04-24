<template>
  <div class='house'>
    <div class="floor-block">
        <house-realty class="realty"
            v-for="(item, index) in floor"
            :color="'white'"
            :line1=" item"
            :line2="'этаж'"
            :key="item.id"
            :data="item"
            @eventHouseRealty="clickFloor"
        ></house-realty>
        <div class="help">
            <img src="src/assets/img/help.png" alt="">
        </div>
    </div>
    <div class="section"
        v-for="item_section in house.section_count"
    >
        <div class="wrap-floor">
            <div class="floor-line"
                v-for="item_floor in floor "
            >
                <house-realty class="realty"
                    v-for="(item, index) in getRealtyInFloor(item_floor, item_section)"
                    :data="item.id"
                    :key="item.id"
                    :id="'realty_'+item.id"
                    :color="getColor(item)"
                    :line1="checkStatus(item) ? item.rooms + 'к':''"
                    :line2="checkStatus(item) ? item.square + ' м²':''"
                    @eventHouseRealty="clickHouseRealty"
                ></house-realty>

            </div>
        </div>
        <div class="floor-desc">
            <div class="first-line">{{item_section}}/{{house.section_count}}</div>
            <div class="second-line">подъезд</div>
        </div>
    </div>
  </div>
</template>
<script>
import HouseRealty from './HouseRealty.vue'
import _ from 'underscore'
                    //:line1="item.rooms + 'к'"

export default {
    name:'house',
    data () {
        return {
            house: [],
            section: 0,
            floor: [],
            realtys: [],
            endpoint: 'src/api/getRealtysByHouseId.php',
        }
    },
    components: {
        HouseRealty
    },
    computed: {
        checkStatus:() => (realty) => {
            return realty.status == 'free' && !realty.reserv;
        }
    },
    methods: {
        // checkStatus(realty) {
        //     return =
        // },
        getRealtysByHouseId() {
          this.$http.get(this.endpoint).then(function(response){
             this.house = response.data.response.house
             this.realtys = response.data.response.realty
             this.section = _.range(1,this.house.section_count)
             this.floor = _.range(this.house.floor_count ,0,-1)
          },
          (err)=>{

          })
        },
        getColor: function(realty) {
            switch(realty.rooms) {
              case 1: return 'orange';
              case 2: return 'blue';
              case 3: return 'red';
              case 4: return 'purpul';
              case 0: return 'white';
            }
        },
        getRealtyInFloor: function(floor=null,section=null) {
            let arr = [];
            for(let realty of this.realtys) {
                if (realty.section == section && realty.floor == floor) {
                    arr.push(realty);
                }
            }
            return arr;
        },
        clickHouseRealty: function(id) {
            this.$router.push({name:'realty',params:{id:id}});
        },
        clickFloor: function(floor) {
            this.$router.push({name:'floor',params:{id:14,floor:floor}});
        }
    },
    created: function() {
        this.beforeShow = '';
        this.getRealtysByHouseId();
    }
}
</script>

<style lang="scss" scoped>

    $sm: 1024px;
    $md: 1366px;
    $lg: 1920px;
    .house {
        background: #e7e4ff;
        font-family: direct-Regular;
        display: flex;
        overflow: auto;
        justify-content: center;
        padding-top: 85px;
        min-height: calc(100% - 85px);
        .section {
            margin-right:5px;
            display: inline-block;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items:stretch;
            justify-content:space-between;
            @media screen and (min-width: $sm) {
                 margin-right:6px;
            }
            @media screen and (min-width: $sm) {
                 margin-right:7px;
            }
            @media screen and (min-width: $lg) {
                 margin-right:8px;
            }
            .floor-line {
                display: flex;
                .realty {
                    margin:5px;
                    @media screen and (min-width: $sm) {
                         margin:6px;
                    }
                    @media screen and (min-width: $sm) {
                         margin:7px;
                    }
                    @media screen and (min-width: $lg) {
                         margin:8px;
                    }
                }
            }
            .floor-desc {
                flex: 0 0 auto;
                height:40px;
                background: #c6c3dc;
                border-radius: 5px;
                margin: 6px;
                @media screen and (min-width: $sm) {
                    height:50px;
                }
                @media screen and (min-width: $md) {
                    height:60px;
                }
                @media screen and (min-width: $lg) {
                    height:70px;
                }
                .first-line {
                    font-size: 18px;
                    text-align: center;
                    line-height: 30px;
                    font-weight: 700;
                    @media screen and (min-width: $sm) {
                        font-size: 23px;
                        line-height: 33px;
                    }
                    @media screen and (min-width: $md) {
                        font-size: 28px;
                        line-height: 44px;
                    }
                    @media screen and (min-width: $lg) {
                        line-height: 50px;
                        font-size: 33px;
                    }
                }
                .second-line{
                    font-size: 9px;
                    text-align: center;
                    line-height: 2px;
                    @media screen and (min-width: $sm) {
                        font-size: 12px;
                        line-height: 11px;
                    }
                    @media screen and (min-width: $md) {
                        font-size: 14px;
                        line-height: 7px;
                    }
                    @media screen and (min-width: $lg) {
                        line-height: 11px;
                        font-size: 17px;
                    }
                }
            }
        }
    }
    .floor-block {
        // position: absolute;
        // left:20px;
        margin-right:10px;
            @media screen and (min-width: $sm) {
                margin-right:12px;
            }
            @media screen and (min-width: $sm) {
                margin-right:14px;
            }
            @media screen and (min-width: $lg) {
                margin-right:16px;
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
            &:first-child {
                margin-top: 5px;
                @media screen and (min-width: $sm) {
                    margin-top: 6px;
                }
                @media screen and (min-width: 992px) {
                    margin-top: 7px;
                }
                @media screen and (min-width: $lg) {
                    margin-top: 8px;
                }
            }
        }
        .help{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60px;
        }
    }

</style>
