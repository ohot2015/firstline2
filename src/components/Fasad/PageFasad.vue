<template>
    <transition>
        <div class="fasad">
            <div class="container">
                <FilterFasad @eventRoomClick="RoomClick"></FilterFasad>
            </div>
            <fasad :changedRoom="changedRoom"></fasad>
        </div>
    </transition>
</template>
<script>

import AppFooter from 'components/AppFooter.vue'
import Fasad from './Fasad.vue'
import FilterFasad from './FilterFasad.vue'

export default {
    name: 'PageFasad',
    data () {
        return {
            changedRoom: [1,2,3,4]
        }
    },
    methods: {
        RoomClick(num) {
            this.changedRoom = num;
        }
    },
    mounted(){
        if (this.$route.params.scrollTo) {
            this.$scrollTo('#scrolltodistrict', 500, {easing: "ease-in-out",})
        }
    },
    updated(){
        if (this.$route.params.scrollTo) {
            this.$scrollTo('#scrolltodistrict', 500, {easing: "ease-in-out",})
        }
    },
    created(){

    },
    components: {
        AppFooter,
        Fasad,
        FilterFasad
    },
}
</script>

<style lang="scss" scoped>
.fasad {
    margin-top:68px;
    .container {
        position: relative;
        width: 1170px;
        margin: 0 auto;
        height: 0px;
        z-index: 99;
    }
}

</style>