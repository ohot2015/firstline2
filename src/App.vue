<template>
  <div id="app">
    <app-menu></app-menu>
    <div class="content">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import VueRouter from 'vue-router'
import AppMenu from './components/AppMenu.vue'

import AppLongrid from './components/AppLongrid.vue'
import AppHouse from './components/AppHouse.vue'
import AppGallery from './components/AppGallery.vue'
import AppPlan from './components/AppPlan.vue'
import AppRealty from './components/AppRealty.vue'
import AppAbout from './components/AppAbout.vue'

import YmapPlugin from 'vue-yandex-maps'
Vue.use(YmapPlugin)

Vue.use(VueRouter);
Vue.component('AppMenu', AppMenu);

var router = new VueRouter({
    routes: [
        {path: '/', component: AppLongrid},
        {path: '/house', component: AppHouse},
        {path: '/plan', component: AppPlan},
        {path: '/realty', component: AppRealty},
        {path: '/gallery', component: AppGallery},
        {path: '/about', component: AppAbout}
    ]
})


export default {
  name: 'app',
  data () {
      return {
    }
  },
  router: router,
  components: {
  }
}

</script>

<style lang="scss">
  body,html {
//    background: #e7e4ff;
    background: white;
    color:#252525;
    margin:0;
//    width : 100%;
  }
  .content{
    padding-top: 68px;
    width: 100%;
    //height: calc(100% - 68px);
  }
  #app {

  }
</style>
