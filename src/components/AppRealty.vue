<template>
    <div class="realty">
        <div class="type-slider">
            <house-realty
                v-for="item in new Array(3)"
                :color="'white'"
                :line1="'2d'"
                :line2="'квартира'"
                :key="item"
            >
            </house-realty>
        </div>
        <div class="slider">
            <carousel
                :per-page="1"
                :mouse-drag="false"
                :navigationEnabled="true"
                :paginationEnabled="false"
            >
            <slide>
              <img src="../assets/logo.png" alt="">
            </slide>
            <slide>
              <img src="../assets/logo.png" alt="">
            </slide>
          </carousel>
        </div>
        <div class="info-board">
        </div>
    </div>
</template>
<script>
import HouseRealty from './HouseRealty.vue'
import { Carousel, Slide } from 'vue-carousel';
export default {
    name: 'AppRealty',
    data () {
        return {

        }
    },
    components: {
        HouseRealty,
        Carousel,
        Slide
    }
}
</script>

<style lang="scss" scoped>
    .VueCarousel {
        height: 100%;
    }
    .realty {
        background: #e7e4ff;
        display: flex;
        justify-content: center;
        height: 100%;
        padding-top: 25px;
    }
    .type-slider {
        .house-realty {
            margin-bottom: 10px;
        }
    }
    .slider {
        background: white ;
        width: 560px;
        height: 420px;
        margin: 0 20px;
    }
    .info-board {
        width: 250px;
        height: 420px;
        background: white;
    }
</style>
