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
                        v-for="poly in plan.polygon"
                        :points="poly.points"
                        :fill="poly.color"
                        class="poly"
                        :class="poly.reserv || 'reserv'"
                        @mouseenter="tooltipChange(poly.realty,$event)"
                        @mouseleave="tooltipChange(poly.realty,$event)"
                        @click="clickPoly"
                        >
                    </polygon>
                </g>
            </svg>
            <img :src="'http://'+plan.path" alt="">
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
    props: ['plan','floor'],
    components: {
        tooltip
    },
    methods: {
        tooltipChange(rId,e) {
            this.rh = this.$store.getters.realty(rId);
            if (this.rh.status == 'free' && !this.rh.reserv) {
                setTimeout(()=>{

                    this.tooltip = {
                        width : 130,
                        height : 37,
                        offsetY : e.layerY + 140,
                        offsetX : e.layerX + 190,
                        show : !this.tooltip.show,
                    }
                },0)

                for(let el in this.plan.polygon) {
                    if (this.plan.polygon[el].realty == rId) {
                        this.plan.polygon[el].color = e.type == 'mouseenter' ? 'rgba(0,0,0,.4)' : 'rgba(0,0,0,.0)'
                    }
                }

            }
            this.$emit('eventMouseEnter',rId);
        },
        clickPoly (){
            this.$router.push({name:'realty',params:{id:this.rh.id} });
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
    padding-top: 200px;
}
 .wrap-svg {
            /*width: 100%;*/
            position: relative;
            /*height: 100%;*/
             width: 450px;
             height: 450px;
             margin: auto;
            img {
                    //width: 100%;
                    // position: absolute;
                    // z-index: 2
                }
                svg {
                    position: absolute;
                    left:0;
                    top:0;
                    width: 450px;
                    height: 420px;
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
