<template>
  <div class='house-realty' :class="color" v-on:click="setEvent" >
    <div class="first-line" >{{ line1 }}</div>
    <div class="second-line" >{{ line2 }}</div>
  </div>
</template>
<script>
export default {
    name: 'HouseRealty',
    data () {
        return {
            //line1:''
            // bigMess: '3k',
            // lowMess: 'этаж',
        }
    },
    props: ['color','line1','line2','data'],
    computed: {

    },
    methods: {
        setEvent: function(e){
            this.$emit('eventHouseRealty',this.data);
            let els = document.querySelectorAll('.house-realty');
            els.forEach((el)=> {
                el.classList.remove('active')
            })
            e.target.parentElement.classList.add('active')
        },
        toggle(num) {
           //console.log($el);
        }
    },
    created () {
        this.line1 = this.line1;
        this.line2 = this.line2;
       //console.log(this.realty);
        //this.bigMess = this.line1
    }
}
</script>

<style lang="scss" scoped>
$sm: 1024px;
$md: 1366px;
$lg: 1920px;
    .house-realty {
        font-family: direct-Regular;
        height:40px;
        width:44px;
        cursor:pointer;
        @media screen and (min-width: $sm) {
            height:50px;
            width:55px;
        }
        @media screen and (min-width: $md) {
            height:60px;
            width:66px;
        }
        @media screen and (min-width: $lg) {
            height:70px;
            width:77px;
        }
        border-radius: 5px;
        .first-line {
            font-size: 18px;
            text-align: center;
            line-height: 30px;
            font-family: direct-Regular;
            font-weight: 700;
            @media screen and (min-width: $sm) {
                font-size: 23px;
                line-height: 33px;
            }
            @media screen and (min-width: $md) {
                font-size: 28px;
                line-height: 44px;
            }
            @media screen and (min-width: $lg) {
                line-height: 50px;
                font-size: 33px;
            }
        }
        .second-line{
            font-family: direct-Regular;
            font-size: 9px;
            text-align: center;
            line-height: 2px;
            @media screen and (min-width: $sm) {
                font-size: 12px;
                line-height: 11px;
            }
            @media screen and (min-width: $md) {
                font-size: 14px;
                line-height: 7px;
            }
            @media screen and (min-width: $lg) {
                line-height: 11px;
                font-size: 16px;
            }
        }
        &.orange {
            background: #ffb735;
            &:hover {
                background: #eaa11c;
            }
        }
        &.blue {
            background: #21c9d2;
            &:hover {
                background: #0cb8c3;
            }
        }
        &.red {
            background: #ef5350;
            &:hover {
                background: #d83a36;
            }
        }
        &.purpul {
            background: #c569d6;
            &:hover {
                background: #ae4fbf;
            }
        }
        &.white {
            background: white;
            &:hover {
                background: #a3cdf9;
            }
        }
        &.active {
            background: #a3cdf9;
        }
    }
</style>
