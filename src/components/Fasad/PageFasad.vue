<template>
    <transition>
        <div class="fasad">
            <fasad></fasad>
        </div>
    </transition>
</template>
<script>

import AppFooter from 'components/AppFooter.vue'
import AppDistrict from 'components/AppDistrict.vue'
import Fasad from './Fasad.vue'
export default {
    name: 'AppFasad',
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
        AppDistrict,
        Fasad
    },
}
</script>

<style lang="scss" scoped>
.fasad {
    margin-top:68px;
}

</style>