<template>
    <transition>
        <tooltip class="tooltip" :options="tooltip" v-if="rh">
            <header>{{rh.rooms}} комн. <span class="delimiter">/</span> №  {{rh.num}}</header>
            <div class="body">
                {{rh.square}} м2
            </div>
        </tooltip>
        <carousel
                :per-page="1"
                :mouse-drag="true"
                :navigationEnabled="false"
                :paginationEnabled="false"
                :key="'qwe12323'"
                :style="'height:100%;'"
                :autoplay="false"
        >
             <slide v-for="(fasad, index) in  $store.getters.fasadFilterRoom(changedRoom)" :key="index" >
                 <div class="wrap">
                     <div class="qwe">{{fasad.imgW }}</div>
                     <svg :style="'background-image: url(http://'+fasad.url+'); background-repeat: no-repeat; width:' +
                     fasad.imgW  + 'px; height:' + fasad.imgH + 'px;'">
                         <g>
                             <polygon
                                     v-for="item in fasad"
                                     :points="item.polygon"
                                     data-floor="item.floor"
                                     data-queue="item.queue"
                                     data-pod="item.pod"
                                     :fill="item.fill"
                                     @mouseenter="tooltipChange(poly.realty,$event)"
                                     @mouseleave="tooltipChange(poly.realty,$event)"
                             >
                             </polygon>
                         </g>
                     </svg>
                 </div>
             </slide>
        </carousel>
    </transition>
</template>
<script>
import { Carousel, Slide } from 'vue-carousel';
import _ from 'underscore'
export default {
    name: 'Fasad',
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
    props:['changedRoom'],
    computed: {
        fasads() {
            return this.$store.getters.findAll('fasads').fasads;
        },
    },
    components: {
        Carousel,
        Slide
    },
    methods: {

    },
    mounted(){
      let wrapCarusel = document.querySelector('.VueCarousel-wrapper');
        wrapCarusel.style.overflow = 'inherit';
        wrapCarusel.style.overflowX = 'hidden';
    },
    created() {
        this.$store.dispatch('getFasadByHouseId', 14);
    }
}

</script>

<style lang="scss" scoped>
    .wrap   {
        background-size:contain;
        height: calc(100vh - 68px);
        position: relative;
        display: flex;
        justify-content: center;
        /*@media screen and (min-width: 1920px) {*/
            /*height: 820px;*/
        /*}*/
        /*img {*/
            /*position: absolute;*/
            /*z-index: 2;*/
        /*}*/
        svg {
            position: absolute;
            top:0;
            width: 100%;
            z-index: 3;
            polygon{
                cursor: pointer;
          //      transform: translate(5px);
                box-shadow: 10px 10px 10px rgba(0,0,0,0.5);

                &:hover{
                    fill: rgba(0,0,0,.5);
                }
            }
        }
    }
</style>
