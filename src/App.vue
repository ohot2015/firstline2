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
import AppFloor from './components/AppFloor.vue'
import AppRealty from './components/AppRealty.vue'
import AppAbout from './components/AppAbout.vue'

import YmapPlugin from 'vue-yandex-maps'

Vue.use(YmapPlugin)
Vue.use(VueRouter)
Vue.component('AppMenu', AppMenu);

var router = new VueRouter({
    routes: [
        {path: '/',  name: 'home', component: AppLongrid},
        {path: '/house', component: AppHouse},
        {path: '/floor/:id',name:'floor', component: AppFloor},
        {path: '/realty/:id', name:'realty', component: AppRealty},
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
  router,
}

</script>

<style lang="scss">
  body,html {
//    background: #e7e4ff;
    background: white;
    color:#252525;
    margin:0;
    width : 100%;
    height: 100%
  }
  .content{
    padding-top: 68px;
    width: 100%;
    height: calc(100% - 68px);
  }
  #app {
    width : 100%;
    height: 100%;
  }
  a:link,
  a:visited ,
  a:hover ,
  a:active {
      color: #111;
      text-decoration: none;
  }

</style>
