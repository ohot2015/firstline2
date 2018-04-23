<template>
  <transition name="fade">
    <div class="tooltip" v-if="options.show" :style="setStyle">
      <div class="container">
        <slot></slot>
      </div>
      <div class="arrow"></div>
    </div>
  </transition>
</template>
<script>

export default {
  name: 'tooltip',
  props: ['options'],
  data () { return {

  }},
  methods: {
  },
  computed: {
    setStyle(){
      let w = this.options.width,
        h = this.options.height,
        l = this.options.offsetX,
        t = this.options.offsetY;
      return {
        width: w + 'px',
        height: h + 'px',
        left: l - (w/2 + 28)  + 'px',
        top: t - 30 + 'px',
      }
    }
  },
  updated() {
   // console.log(this.options);
  },
  created() {

  }
}

</script>

<style lang="scss" scoped>
  .tooltip {
    /*margin-left: 30px;*/
    background: white;
    border-radius: 5px;
    box-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    position: absolute;
    padding: 14px 20px;
    z-index: 9999999999;

      .arrow{
          width: 0;
          height: 0;
          border-left: 8px solid transparent;
          border-right: 8px solid transparent;
          border-top: 15px solid white;
          position: absolute;
          left: calc(50% - 7px);
          bottom: -15px;
      }
  }

  .container {
    padding: 0px;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity .2s ease .1s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
  }
</style>
