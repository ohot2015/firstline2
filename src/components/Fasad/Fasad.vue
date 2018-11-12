<template>
    <div class="wrap-fasad">
        <tooltip class="tooltip" :options="tooltip" >
            <header> {{tooltip.floor}} Этаж, {{tooltip.pod}} Подъезд </header>
            <div class="body">
            Свободных помещений: {{tooltip.freeFlat}}
                <div class="wrap-h-realty">
                    <house-realty class="realty"
                                  v-for="(item, index) in tooltip.flats "
                                  :key="index"
                                  :line1="index + 'к'"
                                  :line2="item + ' кв.'"
                    ></house-realty>
                </div>
            </div>
        </tooltip>
        <carousel
                :per-page="1"
                :mouse-drag="true"
                :navigationEnabled="true"
                :paginationEnabled="true"
                :key="'qwe12323'"
                :style="'height:100%;'"
                :autoplay="false"
        >
             <slide v-for="(fasad, index) in  $store.getters.fasadFilterRoom" :key="index" >
                 <div class="wrap">
                     <div class="qwe">{{fasad.imgW }}</div>
                     <svg :style="'background-image: url(http://'+fasad.url+'); background-repeat: no-repeat; width:' +
                     fasad.imgW  + 'px; height:' + fasad.imgH + 'px;'">
                         <g>
                             <polygon
                                     v-for="item in fasad"
                                     :points="item ? item.polygon:''"
                                     data-floor="item.floor"
                                     data-queue="item.queue"
                                     data-pod="item.pod"
                                     :fill="item ? item.fill:''"
                                     @mouseenter="tooltipChange(item.floor,item.pod, $event)"
                                     @mouseleave="tooltipChange(item.floor,item.pod, $event)"
                                     @click="backToFloor(item.floor, $event)"
                                     :onload="onload = true"
                             >
                             </polygon>
                         </g>
                     </svg>
                 </div>
             </slide>
        </carousel>
    </div>
</template>
<script>
import { Carousel, Slide } from 'vue-carousel';
import _ from 'underscore'
import tooltip from 'components/tooltip.vue'
import houseRealty from 'components/HouseRealty.vue'
export default {
    name: 'Fasad',
    data () {
        return {
            tooltip: {
                width:'',
                height:'',
                offsetX: "",
                offsetY: "",
                show: false,
                floor:0,
                pod:0,
                freeFlat: 0,
                flats: {1:0,2:0,3:0,4:0}
            },
            onload: false
        }
    },
    computed: {
        fasads() {
            return this.$store.getters.findAll('fasads').fasads;
        },
        houseId(){
            console.log(this.$store.getters.findAll('houseId'))
            return this.$store.getters.findAll('houseId');
        }
    },
    components: {
        Carousel,
        Slide,
        tooltip,
        houseRealty
    },
    methods: {
        backToFloor(floor,e) {
            this.$router.push({name:'floor',params:{id:this.houseId, floor:floor}});
        },
        tooltipChange(floor,pod,e) {

            let realtys = this.$store.getters.findBy('realtys', {floor:floor, section:pod, status:'free', reserv:null});

            let groupFloor = _.groupBy(realtys, 'rooms');
            let flats = {};
            for (let i in groupFloor ) {
                flats[i] = groupFloor[i].length;
            }
            this.tooltip = {
                ...this.tooltip,
                ...{
                    floor:floor,
                    pod:pod,
                    freeFlat: realtys.length,
                    flats:flats
                }
            }
                setTimeout(()=>{
                    var padding_top = window.getComputedStyle(e.target.parentNode.parentNode.parentElement.parentElement, null)
                            .getPropertyValue('padding-top').replace('px', '') - 95,

                        wrap_width = window.getComputedStyle(e.target.parentNode.parentNode.parentElement.parentElement.parentElement, null)
                            .getPropertyValue('width').replace('px', '')/2 - 220;

                    this.tooltip = {
                        ... this.tooltip,
                        ...{
                            width: 270,
                            height: 150,
                            offsetY: e.layerY + padding_top,

//                            offsetX: e.layerX + wrap_width,
                            offsetX: e.clientX,
                            show: !this.tooltip.show,
                        }
                    }
                },200)

        },

    },
    mounted(){

        document.querySelector('section.VueCarousel').style.overflow = 'hidden';
        // todo костыльt
        let promise = new Promise((resolve, reject) => {
            let id = setInterval(()=>{
                if (this.onload == true) {
                    clearInterval(id)
                    resolve('loadCarusel');
                }
            },10);
        });
        promise.then(loadCarusel => {
            let dot = document.querySelectorAll('.VueCarousel-pagination button');
            let fasads = this.fasads;
            dot.forEach((e,i) => {
                let iter = 0;
                for (let j in fasads){
                    if (i == iter++ ) {
                        e.innerHTML = fasads[j].description
                    }
                }
            });
        })


//      document.querySelector('.VueCarousel-wrapper').style.overflowX = 'inherit';
//      document.querySelector('.VueCarousel-wrapper').style.overflowY = 'inherit';
    },
    created() {
        if (!this.$store.getters.findAll('fasads').fasads) {
            this.$store.dispatch('getFasadByHouseId', this.houseId);
        }
    }
}

</script>

<style lang="scss" >

    .wrap-fasad {
        .tooltip {
            header {
                font-size: 22px;
                font-family: direct-Bold;
                margin-bottom: 10px;
            }
            .body {
                .wrap-h-realty {
                    margin-top: 20px;
                    .realty {
                        margin-right: 10px;
                    }
                }
            }
        }
        .wrap-h-realty {
            display: flex;
            justify-content: flex-start;
            .realty{
                border: 1px solid #252525;
            }
        }
        section.VueCarousel {
            position: relative;
        }
        .VueCarousel-pagination {
            position: absolute;
            top:60px;
            left: calc(50% - 1179px / 2);
            text-align: left !important;
            width: 1170px;
            margin: 0 auto;
            li {
                padding-left: 5px !important;
            }
            li.VueCarousel-dot--active {
                button{
                    border: 1px solid white;
                    color :black;
                    background: rgba(255, 255, 255, 0.6)!important;
                    border-color: black;
                }

            }
            button {
                width: auto !important;
                min-width: 10px;
                padding: 0 10px;
                font-size: 14px;
                font-family: direct-Bold;
                height: 33px !important;
                background: rgba(0, 0, 0, 0.6)!important;
                box-sizing: border-box;
                border: 1px solid transparent;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                color:white;
                &:focus {
                    outline:0;
                }
                &:hover {
                    border: 1px solid white;
                    color :black;
                    background: rgba(255, 255, 255, 0.6)!important;
                    border-color: black;
                }
            }
        }

        .wrap {
            background-size:contain;
            height: calc(100vh - 174px);
            position: relative;
            display: flex;
            justify-content: center;
            svg {
                position: absolute;
                top:0;
                width: 100%;
                z-index: 3;
                polygon{
                    cursor: pointer;
                    box-shadow: 10px 10px 10px rgba(0,0,0,0.5);

                    &:hover{
                        fill: rgba(0,0,0,.5);
                    }
                }
            }
        }
    }
    /*.footer{*/
        /*position: absolute;*/
        /*bottom: 0;*/
    /*}*/
</style>
