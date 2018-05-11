<template>
<div class="killerCall">
  <a href="#" id="popup__toggle" @click.stop="showModal=true"><div class="circlephone" style="transform-origin: center;"></div><div class="circle-fill" style="transform-origin: center;"></div><div class="img-circle" style="transform-origin: center;"><div class="img-circleblock" style="transform-origin: center;"></div></div></a>
  <modal v-if="showModal" @close="close">
    <h3 class="description" slot="header">Оставьте свой номер телефона и мы вам перезвоним</h3>
  </modal>
</div>
</template>
<script>
import modal from './modal.vue'
export default {
    name: 'killerCall',
    data () {
        return {
          showModal:false ,
          endpoint: this.$store.getters.findAll('absPath')+'/src/api/sendMail'
        }
    },
    methods: {
      close(form){
        if (!form) {
          return this.showModal = false;
        }
        this.$http.get(this.endpoint, {params: form}).then(function(response){},
            (err)=>{throw err})
        return this.showModal = false;
      }
    },
    components:{
      modal
    }
}

</script>
<style lang="scss" scoped>

  #popup__toggle {
  bottom:25px;
  right:10px;
  position:fixed;
  z-index:999;
}
.img-circle {
  background-color:#00aeef;
  box-sizing:content-box;
  -webkit-box-sizing:content-box;
}
.circlephone {
  box-sizing:content-box;
  -webkit-box-sizing:content-box;
  border: 2px solid #00aeef;
  width:150px;
  height:150px;
  bottom:-25px;
  right:10px;
  position:absolute;
  -webkit-border-radius:100%;
  -moz-border-radius: 100%;
  border-radius: 100%;
  opacity: 1;
  -webkit-animation: circle-anim 2.4s infinite ease-in-out !important;
  -moz-animation: circle-anim 2.4s infinite ease-in-out !important;
  -ms-animation: circle-anim 2.4s infinite ease-in-out !important;
  -o-animation: circle-anim 2.4s infinite ease-in-out !important;
  animation: circle-anim 2.4s infinite ease-in-out !important;
  -webkit-transition: all .5s;
  -moz-transition: all .5s;
  -o-transition: all .5s;
  transition: all 0.5s;
}
.circle-fill{
  box-sizing:content-box;
  -webkit-box-sizing:content-box;
  background-color:#00aeef;
  width:100px;
  height:100px;
  bottom:0px;
  right:35px;
  position:absolute;
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%;
  border-radius: 100%;
  border: 2px solid transparent;
  -webkit-animation: circle-fill-anim 2.3s infinite ease-in-out;
  -moz-animation: circle-fill-anim 2.3s infinite ease-in-out;
  -ms-animation: circle-fill-anim 2.3s infinite ease-in-out;
  -o-animation: circle-fill-anim 2.3s infinite ease-in-out;
  animation: circle-fill-anim 2.3s infinite ease-in-out;
  -webkit-transition: all .5s;
  -moz-transition: all .5s;
  -o-transition: all .5s;
  transition: all 0.5s;
}
.img-circle{box-sizing:content-box;-webkit-box-sizing:content-box;width:72px;height:72px;bottom: 14px;right: 49px;position:absolute;-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;border: 2px solid transparent;opacity: .7;}
.img-circleblock{box-sizing:content-box;-webkit-box-sizing:content-box;width:72px;height:72px;background-image:url(../assets/img/killer_call.png);background-position: center center;background-repeat:no-repeat;animation-name: tossing;-webkit-animation-name: tossing;animation-duration: 1.5s;-webkit-animation-duration: 1.5s;animation-iteration-count: infinite;-webkit-animation-iteration-count: infinite;}
.img-circle:hover{opacity: 1;}
@keyframes pulse {0% {transform: scale(0.9);opacity: 1;}
  50% {transform: scale(1); opacity: 1; }
  100% {transform: scale(0.9);opacity: 1;}}
 @-webkit-keyframes pulse {0% {-webkit-transform: scale(0.95);opacity: 1;}
  50% {-webkit-transform: scale(1);opacity: 1;}
  100% {-webkit-transform: scale(0.95);opacity: 1;}}
@keyframes tossing {
  0% {transform: rotate(-8deg);}
  50% {transform: rotate(8deg);}
  100% {transform: rotate(-8deg);}}
@-webkit-keyframes tossing {
  0% {-webkit-transform: rotate(-8deg);}
  50% {-webkit-transform: rotate(8deg);}
  100% {-webkit-transform: rotate(-8deg);}}
@-moz-keyframes circle-anim {
  0% {-moz-transform: rotate(0deg) scale(0.5) skew(1deg);opacity: .1;-moz-opacity: .1;-webkit-opacity: .1;-o-opacity: .1;}
  30% {-moz-transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .5;-moz-opacity: .5;-webkit-opacity: .5;-o-opacity: .5;}
  100% {-moz-transform: rotate(0deg) scale(1) skew(1deg);opacity: .6;-moz-opacity: .6;-webkit-opacity: .6;-o-opacity: .1;}}
@-webkit-keyframes circle-anim {
  0% {-webkit-transform: rotate(0deg) scale(0.5) skew(1deg);-webkit-opacity: .1;}
  30% {-webkit-transform: rotate(0deg) scale(0.7) skew(1deg);-webkit-opacity: .5;}
  100% {-webkit-transform: rotate(0deg) scale(1) skew(1deg);-webkit-opacity: .1;}}
@-o-keyframes circle-anim {
  0% {-o-transform: rotate(0deg) kscale(0.5) skew(1deg);-o-opacity: .1;}
  30% {-o-transform: rotate(0deg) scale(0.7) skew(1deg);-o-opacity: .5;}
  100% {-o-transform: rotate(0deg) scale(1) skew(1deg);-o-opacity: .1;}}
@keyframes circle-anim {
  0% {transform: rotate(0deg) scale(0.5) skew(1deg);opacity: .1;}
  30% {transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .5;}
  100% {transform: rotate(0deg) scale(1) skew(1deg);
opacity: .1;}}
@-moz-keyframes circle-fill-anim {
  0% {-moz-transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;}
  50% {-moz-transform: rotate(0deg) -moz-scale(1) skew(1deg);opacity: .2;}
  100% {-moz-transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;}}
@-webkit-keyframes circle-fill-anim {
  0% {-webkit-transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;  }
  50% {-webkit-transform: rotate(0deg) scale(1) skew(1deg);opacity: .2;  }
  100% {-webkit-transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;}}
@-o-keyframes circle-fill-anim {
  0% {-o-transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;}
  50% {-o-transform: rotate(0deg) scale(1) skew(1deg);opacity: .2;}
  100% {-o-transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;}}
@keyframes circle-fill-anim {
  0% {transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;}
  50% {transform: rotate(0deg) scale(1) skew(1deg);opacity: .2;}
  100% {transform: rotate(0deg) scale(0.7) skew(1deg);opacity: .2;}}



// .killer-call-pop-up {
//   width: 357px;
//   height: 323px;
//   position: fixed;
//   left:calc(50% - 323px / 2);
//   top: 300px;
//   z-index: 999999;
//   background: white;
//   .header{
//     height: 50px;
//     width: 100%;
//     border-bottom: 1px solid $border-color;
//     .tab {
//       font-family: $f-sem;
//       border-bottom: 3px solid $main-red;
//       line-height: 38px;
//       color: $main-red;
//       text-align: center;
//       width:145px;
//       text-transform: uppercase;
//       margin-left: 27px;
//       padding-top: 8px;

//     }
//   }
//   .body {
//     padding-left: 27px;
//     padding-right: 27px;
//     label {
//       margin-top: 20px;
//       text-align: left;
//       font-size: 12px;
//       display:block;
//     }
//     input{
//       display:block;
//       width: 300px;
//       box-sizing: border-box;
//       height: 30px;
//     }
//     button {
//       text-align: center;
//       text-transform: uppercase;
//       color:white;
//       background: $main-red;
//       border:0;
//       outline:0;
//       width:300px;
//       height: 40px;
//       margin-top: 20px;
//       margin-left: -2px;
//       font-family: $f-sem;
//       &:hover {
//         background: $second-red;
//       }
//     }
//     .checkbox-custom-label {
//       margin-top:10px;
//     }
//     a.time {
//       font-size: 12px;
//       margin-top: 10px;
//       display: inline-block;
//     }
//   }
// }
// .killer-call-pop-up2  {
//   float: left;
//   background: #eee;
//   width: 459px;
//   height: 216px;
//   position: fixed;
//   left:calc(50% - 216px /2);
//   top:300px;
//   z-index: 99999;
//   .phone {
//     position: absolute;
//     top: -31px;
//     left: calc(50% - 32px);
//     background: url(img/killer_call.png) no-repeat center , #da2512;
//     border: 3px solid white;
//     width: 66px;
//     height: 66px;
//     border-radius: 75px;
//     transform: rotate(-29deg);
//   }
//   h2 {
//     margin-top: 61px;
//     font-size: 22px;
//     font-family: $f-sem;
//   }
//   p{
//     margin-top: 12px;
//   }
//   button {
//     width: 76px;
//     height: 40px;
//     background: $main-red;
//     border:0;
//     outline:0;
//     color:white;
//     font-size: 16px;
//     margin-top:21px;
//     font-family: $f-sem;
//     text-transform: uppercase
//   }
// }
// .overley {
//   background: black;
//   opacity: .5;
//   filter: blur(3px);
//   width: 100%;
//   height: 100%;
//   position: fixed;
//   top: 0;
//   left: 0;
//   z-index: 99999;
// }
</style>