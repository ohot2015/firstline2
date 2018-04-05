<template>
  <div class='house-realty' :class="color">
    <div class="first-line" >{{ bigMess }}</div>
    <div class="second-line">{{ lowMess }}</div>
  </div>
</template>
<script>
export default {
    name: 'HouseRealty',
    data () {
        return {
            bigMess: '1k',
            lowMess: 'этаж',
        }
    },
    props: ['options'],
    computed: {
        color: function() {
            return this.options.color
        },
        bigMess:function (){
            console.log(12123);
            this.bigMess = this.options.mgsg.line1
        }
    }
}
</script>

<style lang="scss" scoped>
    .house-realty {
        height:40px;
        width:44px;
        border-radius: 5px;
        .first-line {
            font-size: 18px;
            text-align: center;
            line-height: 20px;
        }
        .second-line{
            font-size: 9px;
            text-align: center;
            line-height: 10px;
        }
        &.red {
            background: #ef5350;
        }
        &.blue {
            background: #21c9d2;
        }
    }
</style>
