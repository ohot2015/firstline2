<template>

</template>
<script>
export default {

}

</script>

<style lang="scss">
  $color-text: #111;
  $f-bold: direct_Bold;
  $f-reg: direct_Regular;
  $f-os-reg: OpenSansRegular;
  $ident:25px;
  $background: #e7e4ff;

.clear {
    content: "";
    display: table;
    clear: both;
}

body,html {
  height: 100%;
}
body {
  margin:0;
  font-family: $f-reg;
  font-weight: none;
  color:$color-text;
}
h1 {
  font-weight: 400;
}
 .page1 {
    background: url('../assets/img/background.png') 0 -15px;
    height: 100%;
    .logo {
      width: 209px;
      margin: 0 auto;
      padding-top: 43px;
      @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
        width: 138px;
        padding-top: 29px;
      }
      img {
         width:209px;
        @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
          width:138px;
        }
      }
    }
    .wave {
      width:100%;
      .wrap-text {
        width:100%;
        height: 94px;
        @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
          height: 38px;
        }
        &>div {
          float:left;
        }
        &:first-child {
            margin-top: 36px;
            @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
              margin-top: 15px;
            }
        }
        &:nth-child(2) {
          height:100px;
          @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {

          }
        }
        &:last-child {
          height:70px;
          @media screen and (max-width: 1366px) {
            height: 38px;
          }
        }
        .text {
          &.text1 {
            font-size: 78px;
            text-align: right;
            width: calc(50% - 41px);

            @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
              font-size: 57px;
              width: calc(50% - 28px)
            }
            span {
              padding-right: 23px;
              @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
                padding-right: 15px;
              }
            }
          }
          &.text2 {
            font-size: 95px;
            @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
              font-size: 67px;
            }
            text-align: left;
            width: calc(50% - 41px);
            margin-top: -3px;
            padding-left:11px;
            span {
              padding-right: 20px;
            }
          }
          &.text3 {
            font-size: 105px;
            text-align: left;
            width: calc(50% - 41px);
            margin-top: -10px;
            padding-left: 16px;
            position: relative;
            @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
              font-size: 74px;
              padding-left: 13px;
            }
            &:after {
              content: '';
              background: url(../assets/img/marker.png) no-repeat;
              width: 43px;
              height: 57px;
              position: absolute;
              left: 351px;
              top: 6px;
              @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
                width: 28px;
                height: 57px;
                left: 254px;
                top: 5px;
                background-size: contain;
              }
            }
            span {
              padding-right: 20px;
            }
          }
          &.text4 {
            margin: 0 auto;
            float: none;
            text-align: center;
            font-size: 24px;
            padding-left: 508px;
            font-weight: 400;
            letter-spacing: 0.2px;
            padding-top: 14px;
            @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
              padding-top: 6px;
              font-size: 16px;
              padding-left: 343px;
            }
          }
        }
        .bg-img {
          &.bg-img1 {
            width: calc(50% + 41px);
            background: url(../assets/img/wave.png) no-repeat;
            background-size: contain;
            height: 83px;
            margin-top: 8px;
            @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
              width: calc(50% + 28px);
              margin-top: 15px;
              height: 51px;
            }
          }
          &.bg-img2 {
            width: calc(50% + -188px);
            background: url(../assets/img/wood.png) no-repeat  right 0;
            background-size: contain;
            height: 100%;
            margin-top: -6px;
            text-align: right;
            @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
              width: calc(50% + -136px);
              height: 171%;
              margin-top: -3px;
            }
          }
          &.bg-img3 {
            width: calc(50% + 17px);
            background: url(../assets/img/wave.png) no-repeat;
            background-size: contain;
            height: 83px;
            margin-top: 30px;
            @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
              width: calc(50% + 10px);
              margin-top: 18px;
              height: 56px;
            }
          }
        }
      }
    }
    .content {
      text-align: left;
      margin: 0 auto;
      width: 870px;
      padding-left: 128px;
      margin-top: 14px;
      font-size: 14px;
      font-family: $f-reg;
      text-indent: $ident;
      @media screen and (max-width: 1024px)  ,screen and (max-width: 1366px) {
        width: 623px;
        padding-left: 128px;
        margin-top: 7px;
      }
    }
  }
  .page2 {
    $background: #e7e4ff;
    background: $background;
    height:calc(100% - 115px);
    width:100%;

    .content {
      width: 100%;
      height: 308px;
      @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
        height: 212px;
      }
    }
    header {
      width: 949px;
      margin: 0 auto;
      padding-top: 76px;
      padding-left: 110px;
      @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
        width: 720px;
        margin: 0 auto;
        padding-top: 36px;
        padding-left: 0px;
      }
    }
    h1 {
      line-height: 41px;
      font-size: 35px;
      margin: 0;
      position: absolute;
      z-index: 222;
      &:after {
        background: url(../assets/img/diamon.png) no-repeat;
        background-size: contain;
        content: '';
        height: 85px;
        position: absolute;
        width:101px;
        left: 181px;
        top: -36px;
        z-index: -1;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
          height: 57px;
          width: 68px;
          left: 122px;
          top: -21px;
        }
      }
      @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
        line-height: 29px;
        font-size: 23px;
      }
    }

    span {
      display:block;
      text-indent: $ident;
    }
    p {
      font-size: 14px;
      letter-spacing: -.5px;
      margin-left: 2px;
      margin-bottom: 0;
      padding-bottom: 0;
      margin-top: 97px;
      text-indent: $ident;
      @media screen and (max-width: 1024px),screen and (max-width: 1366px)  {
        font-size: 12px;
        margin-top: 66px;
        margin-bottom: 0;
        letter-spacing: -.9px;
      }
      &:last-child {
          padding-top:3px;
          margin-top:0;
          @media screen and (max-width: 1024px),screen and (max-width: 1366px) {
            padding-top:0;
            margin-bottom: 0;
            letter-spacing: -1px;
          }
      }
    }
    .wrap-map {
      position: relative;
      .wave {
        position: absolute;
        top: -19px;
        width: 100%;
        height: 104px;
        z-index: 999;
        background: url(../assets/img/wave-long.png) no-repeat;
        background-size:contain ;
      }
      #yamaps {
        position: absolute;
        z-index: 9;
        width:100%;
        height: 717px;
        z-index: 99;
        .ymaps-2-1-60-svg-icon {
          width: 0 !important;
          height: 0 !important;
          cursor: auto;
        }
        .yandex-marker {
          width: 210px;
          height: 70px;
        }
        // #marker1 {
        //   background: url(../assets/img/marker1.png);
        // }
        // #marker2 {
        //   background: url(../assets/img/marker2.png);
        // }
        // #marker3 {
        //   background: url(../assets/img/marker3.png);
        // }
        // #marker4 {
        //   background: url(../assets/img/marker4.png);
        // }
        // #marker5 {
        //   background: url(../assets/img/marker5.png);
        // }
        // #marker6 {
        //   background: url(../assets/img/marker6.png);
        // }
        // #marker7 {
        //   background: url(../assets/img/marker7.png);
        // }
        #marker1024 {
          background: url(../assets/img/logomap1024.png) no-repeat;
          width: 250px;
          height: 160px;
          position: absolute;
          left: -48px;
          top: -84px;
        }
      }
    }
  }
   .page3 {
    $background: #e7e4ff;
    background: $background url(../assets/img/background2.png);
    height: 100%;//height:calc(100% - 115px);
    width:100%;
    overflow: hidden;
    & > div {
      width: 930px;
      @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
        width: 650px;
      }
      margin:0 auto;
      position: relative;
      &:after {
          content:'';
          position:absolute;
      }
      h1 {
        margin:0;
        letter-spacing: .5px;
        font-size: 34px;


      }
      p {
        padding-top: 8px;
        margin: 0px;
        line-height: 17px;
        padding-left: 2px;
        font-size: 14px;
        letter-spacing: -0.5px;
        width:957px;
        text-indent: $ident;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
          font-size: 12px;
          line-height: 13px;
        }
      }
    }
    .block1 {
      padding-top: 103px;
      padding-left: 10px;
      @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
        padding-top: 44px;
        padding-left: 0px;
        letter-spacing: -0.7px;

      }
      h1 {
        font-size: 47px;
        letter-spacing: .5px;
        position: absolute;
        z-index: 999;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
          font-size: 34px;
          letter-spacing: -0.6px;
        }
      }
      p {
        padding-top: 56px;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
          width: 644px;
          padding-top: 39px;
        }
      }
      &:after {
        height: 99px;
        background: url(../assets/img/shield.png) no-repeat;
        background-size: contain;
        width: 82px;
        left: -48px;
        top: 51px;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px) {
          width: 55px;
          left: -43px;
          top: 22px;

        }
      }
    }
    .block2 {
      height: 115px;
      padding-left: 344px;
      width: 510px;
      padding-top: 45px;
      @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
        padding-top: 16px;
        height: 91px;
      }
      h1 {
        font-size: 30px;
        margin-left: 7px;
        margin-top: 6px;
        position: absolute;
        z-index: 1;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
            font-size: 23px;
            margin-left: 3px;
            margin-top: 10px;
            letter-spacing: 0px;
        }
      }
      p{
        position: absolute;
        z-index: 1;
        width: 559px;
        margin-left: 8px;
        margin-top: 36px;
        @media screen and (max-width: 1024px),screen and (max-width: 1366px)   {
          margin-left: 0px;
          margin-top: 30px;
          width: 379px;
          letter-spacing: -0.55px;
        }
      }
      &:after {
        height: 99px;
        background: url(../assets/img/parking.png) no-repeat;
        background-size: contain;
        width: 55px;
        left: 314px;
        top: 17px;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
          height: 75px;
          width:36px;
          top: 9px;
          left: 318px;
        }
      }
      &:before {
        position: absolute;
        content: '';
        left: -533px;
        background: url(../assets/img/wave1.png) no-repeat;
        background-size: contain;
        width: 229%;
        height: 135px;
        top: 81px;
        @media screen and (max-width: 1024px) {
          width: 123%;
          height: 42px;
          left: -137px;
          top: 75px;
        }
        @media screen and (max-width: 1366px) {
          left: -276px;
          width: 160%;
          top: 58px;
        }
      }
    }
    .block3 {
      width: 755px;
      padding-top: 33px;
      @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
        width: 556px;
        padding-top: 0;
      }
      h1 {
          position: absolute;
          z-index: 999;
          margin-left: 21px;
          font-size: 43px;
          margin-top: -8px;
          letter-spacing: 1.1px;
          @media screen and (max-width: 1024px),screen and (max-width: 1366px)   {
            font-size: 30px;
            margin-top: 11px;
            letter-spacing: 0px;
          }
      }
      p {
          margin-left: 20px;
          padding-top: 44px;
          width: 743px;
          @media screen and (max-width: 1024px),screen and (max-width: 1366px)   {
          width: 573px;
            padding-top: 48px;
          }
      }
      &:after {
        width: 80px;
        height: 98px;
        left: 55px;
        top: -45px;
        background: url(../assets/img/children.png) no-repeat;
        background-size: contain;
        z-index: 0;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
          width:53px;
          left: 56px;
          top: -37px;
        }
      }

    }
    .block4 {
      width: 1086px;
      height: 114px;
      padding-top: 46px;
      @media screen and (max-width: 1366px) {
        margin-left: 304px;
        padding-top: 8px;
        width: 434px;
      }
      @media screen and (max-width: 1024px) {
        width: 434px;
        margin-left: 132px;
      }
       &:before {
        position: absolute;
        content: '';
        width: calc(100% - 208px);
        height: 99px;
        right: -451px;
        top: 100px;
        background: url(../assets/img/wave2.png) no-repeat;
        @media screen and (max-width: 1366px) {
          background: url(../assets/img/wave2.png) no-repeat;
          background-size: contain;
          width: 280%;
          height: 129px;
          right: -1241px;
          top: 62px;
        }
      }
      p {
        padding-top: 57px;
        width: 660px;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
          padding-top: 52px;
          width: 453px;
        }
      }
      h1 {
          position: absolute;
          z-index: 999;
          font-size: 47px;
          @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
            font-size: 33px;
            margin-top: 12px;
          }
      }
      &:after {
        width: 105px;
        height: 117px;
        left: -69px;
        top: -18px;
        background: url(../assets/img/footbol.png) no-repeat;
        background-size: contain;
        z-index: 0;
        @media screen and (max-width: 1024px) ,screen and (max-width: 1366px)  {
          width: 70px;
          left: -45px;
          top: -22px;
        }
      }
    }
    .block5 {
      width: 652px;
      padding-top: 45px;
      padding-left: 483px;
      line-height: 41px;
      h1 {
        letter-spacing: .6px;
        position: absolute;
        z-index: 999;
      }
      p {
          padding-top: 88px;
      }
      &:after {
        width: 134px;
        height: 126px;
        right: 31px;
        top: 25px;
        background: url(../assets/img/plan.png) no-repeat;
        z-index: 0;
      }
      &:before {
        position: absolute;
        content: '';
        width: 100%;
        height: 113px;
        left: -393px;
        top: 55px;
        background: url(../assets/img/wave1.png) no-repeat;
      }
    }
  }

</style>
