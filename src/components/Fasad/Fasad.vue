<template>
    <div class="wrap-fasad">
        <carousel
                :per-page="1"
                :mouse-drag="true"
                :navigationEnabled="true"
                :paginationEnabled="true"
                :key="'qwe12323'"
                :style="'height:100%;'"
                :autoplay="false"
        >
             <slide v-for="(fasad, key, index) in  $store.getters.fasadFilterRoom" :key="index" >
                 <div class="wrap">
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
                                     @mouseenter="tooltipChange(item.floor,item.pod, item.polygon, index, $event)"
                                     @mouseleave="tooltipChange(item.floor,item.pod, item.polygon, index, $event)"
                                     @click="backToFloor(item.floor, $event)"
                                     :onload="onload = true"
                             >
                             </polygon>
                         </g>
                         <g id="_2619371276224" ref="tooltip" transform="translate(200,20)" v-show="tooltip.show">
                             <path class="fil0" d="M5 0l363 0c3,0 5,2 5,5l0 174c0,3 -2,5 -5,5l-170 0 -5 9 -5 9 -5 -9 -5 -9 -173 0c-3,0 -5,-2 -5,-5l0 -174c0,-3 2,-5 5,-5z"/>
                             <text x="23" y="43"  class="fil1 fnt0">{{tooltip.floor}} этаж, {{tooltip.pod}} подъезд</text>
                             <text x="23" y="78"  class="fil1 fnt1">Свободных квартир: {{tooltip.freeFlat}}</text>
                             <rect v-show="tooltip.flats[1]" class="fil2 str0" x="23" y="106" width="57" height="51" rx="4" ry="3"/>
                             <text v-show="tooltip.flats[1]" x="37" y="134"  class="fil1 fnt2">1к</text>
                             <text v-show="tooltip.flats[1]" x="38" y="151"  class="fil1 fnt3">10 кв.</text>
                             <rect v-show="tooltip.flats[2]"class="fil2 str0" x="91" y="106" width="57" height="51" rx="4" ry="3"/>
                             <text v-show="tooltip.flats[2]"x="105" y="134"  class="fil1 fnt2">2к</text>
                             <text v-show="tooltip.flats[2]"x="107" y="151"  class="fil1 fnt3">1 кв.</text>
                             <rect v-show="tooltip.flats[3]"class="fil2 str0" x="158" y="106" width="57" height="51" rx="4" ry="3"/>
                             <text v-show="tooltip.flats[3]"x="172" y="134"  class="fil1 fnt2">3к</text>
                             <text v-show="tooltip.flats[3]"x="173" y="151"  class="fil1 fnt3">10 кв.</text>
                             <rect v-show="tooltip.flats[4]"class="fil2 str0" x="225" y="106" width="57" height="51" rx="4" ry="3"/>
                             <text v-show="tooltip.flats[4]"x="240" y="134"  class="fil1 fnt2">4к</text>
                             <text v-show="tooltip.flats[4]"x="240" y="151"  class="fil1 fnt3">10 кв.</text>
                             <rect v-show="tooltip.flats[5]"class="fil2 str0" x="293" y="106" width="57" height="51" rx="4" ry="3"/>
                             <text v-show="tooltip.flats[5]"x="299" y="134"  class="fil1 fnt2">5к+</text>
                             <text v-show="tooltip.flats[5]"x="307" y="151"  class="fil1 fnt3">10 кв.</text>
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
            return this.$store.getters.findAll('houseId');
        },
    },
    components: {
        Carousel,
        Slide,

        houseRealty
    },
    methods: {
        backToFloor(floor,e) {
            this.$router.push({name:'floor',params:{id:this.houseId, floor:floor}});
        },
        realtysTooltip(floor,pod) {
            return  this.$store.getters.findBy('realtys', {floor:floor, section:pod, status:'free', reserv:null});
        },
        tooltipChange(floor,pod,points,indexFasad, e) {
            points = points.split(',');
            let pointsY =  _.filter(points,(el,i) => i % 2);
            let pointsX =  _.filter(points,(el,i) => !(i % 2) );

            let maxValX = Math.max(...pointsX);
            let maxValY = Math.min(...pointsY);
            console.log(indexFasad)
            this.$refs.tooltip[indexFasad].setAttribute('transform',`translate(${maxValX - 373 / 2},${maxValY-202})`);
            console.log(points,pointsY, pointsX,maxValX, maxValY,this.$refs.tooltip);

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
            };

            this.tooltip.show = !this.tooltip.show;
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
            },100);
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
    .str0 {stroke:black}
    .fil2 {fill:none}
    .fil1 {fill:black}
    .fil0 {fill:white}
    .fnt3 {font-weight:normal;font-size:13px;font-family:'Roboto Condensed'}
    .fnt1 {font-weight:normal;font-size:21px;font-family:'Roboto Condensed'}
    .fnt2 {font-weight:bold;font-size:25px;font-family:'DirectRg'}
    .fnt0 {font-weight:bold;font-size:27px;font-family:'DirectRg'}

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
