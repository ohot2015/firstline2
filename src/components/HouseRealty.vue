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
            bigMess: '3k',
            lowMess: 'этаж',
        }
    },
    props: ['options'],
    computed: {
    },
    created () {
        this.color = this.options.color
        this.bigMess = this.options.mesg.line1
    }
}
</script>

<style lang="scss" scoped>
    .house-realty {
        font-size: direct_Regular;
        margin:40px;
        height:40px;
        width:44px;

        border-radius: 5px;
        .first-line {
            font-size: 18px;
            text-align: center;
            line-height: 30px;
            font-weight: 700;
        }
        .second-line{
            font-size: 9px;
            text-align: center;
            line-height: 2px;
        }
        &.orange {
            background: #ffb735;
        }
        &.blue {
            background: #21c9d2;
        }
        &.red {
            background: #ef5350;
        }
        &.purpul {
            background: #c569d6;
        }
    }
</style>
