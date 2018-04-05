<template>
  <div class='house'>
    <house-realty
        :options="options"
    ></house-realty>
  </div>
</template>
<script>
import HouseRealty from './HouseRealty.vue'

export default {
    name:'house',
    data () {
        return {
            options: {
                color: 'blue',
                mesg: {
                    line1: '3k',
                    line2: 'этаж',
                }
            },
            realtys: [],
            endpoint: 'src/api/getRealtysByHouseId.php'
        }
    },
    components: {
        HouseRealty
    },
    methods: {
        getRealtysByHouseId: function() {
          this.$http.get(this.endpoint).then(function(response){
            console.log(response.data);
            this.realtys = response.data

          },
          function(error){

          })
        }
    },
    created: function() {
      this.getRealtysByHouseId();
    }
}
</script>

<style lang="scss">

</style>
