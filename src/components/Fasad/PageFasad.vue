<template>
    <div class="wrap-page-fasad">
        <div class="fasad" >
            <div class="container">
                <FilterFasad v-if="!fasad"></FilterFasad>
            </div>
            <fasad v-if="!fasad"></fasad>
            <h1 v-else class="fasad-not-data">Загрузите фасад</h1>
        </div>
        <app-footer></app-footer>
    </div>
</template>
<script>

import AppFooter from 'components/AppFooter.vue'
import Fasad from './Fasad.vue'
import FilterFasad from './FilterFasad.vue'
import _ from 'underscore'
export default {
    name: 'PageFasad',

    computed:{
      fasad() {
          if (!_.isEmpty(this.$store.state.fasads)) {
              if (!_.isEmpty(this.$store.state.fasads.fasads)){
                  return false
              }
          }
          return true;
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
        FilterFasad,
    },
}
</script>

<style lang="scss" scoped>
    .wrap-page-fasad {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

    }
    .fasad-not-data {
        text-align: center;
    }
.fasad {
    margin-top:68px;
    min-height: (calc(100vh - 174px));
    .container {
        position: relative;
        width: 1170px;
        margin: 0 auto;
        height: 0px;
        z-index: 99;
    }
}

</style>