<template>
    <div class="wrap">
        <!--<tooltip class="tooltip" :options="tooltip" v-if="rh">-->
            <!--<header>{{rh.rooms}} комн. <span class="delimiter">/</span> №  {{rh.num}}</header>-->
            <!--<div class="body">-->
                <!--{{rh.square}} м2-->
            <!--</div>-->
        <!--</tooltip>-->
        <div class="wrap-svg">
            <svg>
                <g>
                    <polygon
                        v-for="(poly, index) in polygon1"
                        :points="poly.points"
                        :fill="poly.color"
                        :key="poly.id"
                        class="poly"
                        :class="poly.reserv || 'reserv'"
                        @mouseenter="tooltipChange(poly,index,$event)"
                        @mouseleave="tooltipChange(poly,index,$event)"
                        @click="clickPoly(poly.realty)"
                        >
                    </polygon>
                </g>
                <g id="_2543785384816" ref="tooltip" v-show="tooltip.show">
                    <path class="fil0" d="M19 0l136 0c2,0 4,2 4,4l0 46c0,2 -2,4 -4,4l-61 0 -3 6 -3 6 -3 -6 -3 -6 -62 0c-2,0 -4,-2 -4,-4l0 -46c0,-2 2,-4 4,-4z"/>
                    <g transform="matrix(1 0 0 1 -62.7963 -5.69506)">
                        <text x="88" y="33"  class="fil1 fnt0">{{tooltip.roomsCount}} комн. / № {{tooltip.realtyNum}}</text>
                    </g>
                    <g transform="matrix(1 0 0 1 -23.3701 10.6037)">
                        <text x="88" y="33"  class="fil1 fnt1">{{tooltip.realtySq}} м2</text>
                    </g>
                </g>
            </svg>
            <img :src="'http://'+path" alt="">
        </div>
    </div>
</template>
<script>
//    @mouseenter="tooltipChange(poly.realty,$event)"
//    @mouseleave="tooltipChange(poly.realty,$event)"
import tooltip from './tooltip'
import _ from 'underscore'
export default {
    name: 'planSvg',
    data () {
        return {
            tooltip: {
                roomsCount:0,
                realtyNum:0,
                realtySq:0,
                show: false
            },
            polyfill:'rgba(0,0,0,.1)',
            realty:'',
        }
    },
    props: ['polygon1','floor','path'],
    components: {
        tooltip
    },
    methods: {
        tooltipChange(poly,index, e) {
            this.realty = this.$store.getters.realty(poly.realty);
            if (this.realty.status !== 'free') {
                return false;
            }

            let points = poly.points;

            points = points.split(',');
            let pointsY =  _.filter(points,(el,i) => i % 2);
            let pointsX =  _.filter(points,(el,i) => !(i % 2) );

            let maxValX = Math.max(...pointsX);
            let maxValY = Math.min(...pointsY);


            this.$refs.tooltip.setAttribute('transform',`translate(${maxValX - 155 / 2},${maxValY-75})`);

            this.tooltip = {
                ...this.tooltip,
                ...{
                    roomsCount:this.realty.rooms,
                    realtyNum:this.realty.num,
                    realtySq:this.realty.square,
                    show:!this.tooltip.show
                }
            }
            for(let el in this.polygon1) {
                if (this.polygon1[el].realty == this.realty.id) {
                    this.polygon1[el].color = e.type == 'mouseenter' ? 'rgba(0,0,0,.4)' : 'rgba(0,0,0,.0)'
                }
            }
            this.$emit('eventMouseEnter',poly,e);
        },
        clickPoly (rId){
            let realty = this.$store.getters.realty(rId);
            if (realty.status === 'free' && !realty.reserv) {
                this.$router.push({name:'realty',params:{id:this.realty.id} });
            }
        }
    },
    created(){
    }
}
</script>

<style lang="scss" scoped>
    .fil0 {fill:#FEFEFE}
    .fil1 {fill:black}
    .fnt1 {font-weight:normal;font-size:13px;font-family:RobotoCondensed-Regular}
    .fnt0 {font-weight:bold;font-size:17px;font-family:direct-Regular}
.wrap {
    width: 100%;
    height: 100%;
    //padding-top: 200px;
    @media screen and (max-width: 1366px) {
        padding-top: 90px;
    }
}
     .wrap-svg {
            /*width: 100%;*/
            position: relative;
            /*height: 100%;*/
            max-width: 800px;
            height: 450px;
            margin: auto;
            padding-top:5px;

            @media screen and (min-width: 1024px) {
                transform: scale(0.7) translate(-117px, -217px);
            }
             @media screen and (min-width: 1440px) {
                 transform: scale(0.8) translate(-95px, -47px);
             }
            @media screen and (min-width: 1366px) {
                //transform: scale(0.7) translate(-117px, -217px);
            }
            @media screen and (min-width: 1920px) {
                transform: scale(1) translate(0, 0);
            }

            img {
                max-width: 800px;
                max-height: 660px;
            }
            svg {
                position: absolute;
                left:0;
                top:5px;
                width: 800px;
                height:660px;
                z-index: 3;
                .poly.reserv {
                    background: black;
                }
            }
        }

    .tooltip{
        header{
            font-family: RobotoCondensed-Bold;
            font-size: 20px;

            span{
                color: #a3cdf9;
            }
        }

        .body{
            width: 100%;
            text-align: center;
            font-family: RobotoCondensed-Regular;
            font-size: 16px;
        }
    }
</style>
