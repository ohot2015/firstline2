<template>
  <div class='house'>
    <house-realty
        :options="options"
    ></house-realty>
  </div>
</template>
<script>
import HouseRealty from './HouseRealty.vue'
//
export default {
    name:'house',
    data () {
        return {
            options: {
                color: 'red',
                mesg: {
                    line1: '3k',
                    line2: 'этаж',
                }
            }
        }
    },
    components: {
        HouseRealty
    }
}
</script>

<style lang="scss">

</style>
