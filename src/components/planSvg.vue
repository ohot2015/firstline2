<template>
    <div class="wrap">
        <tooltip class="tooltip" :options="tooltip" v-if="rh">
            <header>{{rh.rooms}} комн. <span class="delimiter">/</span> №  {{rh.num}}</header>
            <div class="body">
                {{rh.square}} м2
            </div>
        </tooltip>
        <div class="wrap-svg">
            <svg>
                <g>
                    <polygon
                        v-for="poly in polygon1"
                        :points="poly.points"
                        :fill="poly.color"
                        :key="poly.id"
                        class="poly"
                        :class="poly.reserv || 'reserv'"
                        @mouseenter="tooltipChange(poly.realty,$event)"
                        @mouseleave="tooltipChange(poly.realty,$event)"
                        @click="clickPoly(poly.realty)"
                        >
                    </polygon>
                </g>
            </svg>
            <img :src="'http://'+path" alt="">
        </div>
    </div>
</template>
<script>
import tooltip from './tooltip'
export default {
    name: 'planSvg',
    data () {
        return {
            tooltip: {
                width:'',
                height:'',
                offsetX: "",
                offsetY: "",
                show: false
            },
            polyfill:'rgba(0,0,0,.1)',
            rh:'',
        }
    },
    props: ['polygon1','floor','path'],
    components: {
        tooltip
    },
    methods: {
        tooltipChange(rId,e) {
            this.rh = this.$store.getters.realty(rId);
            if (this.rh.status === 'free' && !this.rh.reserv) {
                setTimeout(()=>{
                    var padding_top = window.getComputedStyle(e.target.parentNode.parentNode.parentElement.parentElement, null).getPropertyValue('padding-top').replace('px', '') - 55,
                        wrap_width = window.getComputedStyle(e.target.parentNode.parentNode.parentElement.parentElement.parentElement, null).getPropertyValue('width').replace('px', '')/2 - 420;


                    this.tooltip = {
                        width : 135,
                        height : 37,
                        offsetY : e.layerY + padding_top,
//                        offsetY: e.clientY - 140,
                        offsetX : e.layerX + wrap_width,
                        show : !this.tooltip.show,
                    }
                },200)


                for(let el in this.polygon1) {
                    if (this.polygon1[el].realty == rId) {
                        this.polygon1[el].color = e.type == 'mouseenter' ? 'rgba(0,0,0,.4)' : 'rgba(0,0,0,.0)'
                    }
                }

            }
            this.$emit('eventMouseEnter',rId,e);
        },
        clickPoly (rId){
            let realty = this.$store.getters.realty(rId);
            if (realty.status === 'free' && !realty.reserv) {
                this.$router.push({name:'realty',params:{id:this.rh.id} });
            }
        }
    },
    created(){
    }
}
</script>

<style lang="scss" scoped>
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
            img {
                    max-width: 800px;
                    max-height: 758px;
                    // position: absolute;
                    // z-index: 2
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
