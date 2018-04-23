<template>
    <div class="wrap">
        <tooltip :options="tooltip">
            <header>{{rh.rooms}} комн. / №  {{rh.num}}</header>
            <hr>
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
                        :fill="polyfill"
                        class="poly"
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
            rh:{},
        }
    },
    computed: {

    },
    props: ['plan','floor'],
    components: {
        tooltip
    },
    methods: {
        tooltipChange(rId,e) {
            this.rh = this.$store.getters.realty(rId);
            setTimeout(()=>{
                this.tooltip = {
                    width : 107,
                    height : 86,
                    offsetY : e.offsetY - 70,
                    offsetX : e.offsetX,
                    show : !this.tooltip.show,
                }
            },200)
            e.target.style.fill = e.type == 'mouseenter' ? 'rgba(0,0,0,.4)' : 'rgba(0,0,0,.0)'
            this.$emit('eventMouseEnter',rId);
        },
        clickPoly (){
            this.$router.push({name:'realty',params:{id:this.rh.id} });
        }
    }
}
</script>

<style lang="scss" scoped>
.wrap {
    width: 100%;
    height: 100%;
}
 .wrap-svg {
            width: 100%;
            position: relative;
            height: 100%;
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
                    height: 420px;
                    z-index: 3;
                }
        }

</style>
