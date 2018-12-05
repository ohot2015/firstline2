<template>
  <div id="app">
    <app-menu></app-menu>
    <transition name="fade" mode="out-in">
      <div class="wrap">
      <router-view></router-view>
      </div>
    </transition>
    <killer-call></killer-call>
  </div>
</template>

<script>
import Vue from 'vue'
import VueRouter from 'vue-router'

import AppMenu from './components/AppMenu.vue'

//import AppLongrid from './components/AppLongrid.vue'
import PageFasad from './components/Fasad/PageFasad.vue'
import Preloader from './components/common/Preloader.vue'
import AppHouse from './components/AppHouse.vue'
import AppGallery from './components/AppGallery.vue'
import AppFloor from './components/AppFloor.vue'
import AppRealty from './components/AppRealty.vue'
import AppAbout from './components/AppAbout.vue'
import AppDeclaration from './components/AppDeclaration.vue'
import killerCall from './components/killerCall.vue'

import YmapPlugin from 'vue-yandex-maps'
import VueScrollTo from 'vue-scrollto'
import VTooltip from 'v-tooltip'

Vue.use(VTooltip)
Vue.use(YmapPlugin)
Vue.use(VueRouter)
Vue.component('AppMenu', AppMenu);
Vue.component('killerCall', killerCall);


// You can also pass in the default options
Vue.use(VueScrollTo, {
     container: "body",
     duration: 500,
     easing: "ease",
     offset: 0,
     cancelable: true,
     onStart: false,
     onDone: false,
     onCancel: false,
     x: false,
     y: true
 })

var router = new VueRouter({
    hashbang: false,
    history: true,
    mode: 'history',
    routes: [
       // {path: '/',  name: 'home', component: AppLongrid},
        {path: '/',  name: 'preloader', component: Preloader},
        {path: '/facade',  name: 'home', component: PageFasad},
        {path: '/scrollTo/:scrollTo',  name: 'district', component: PageFasad},
        {path: '/house/:id', name:'house', component: AppHouse},
        {path: '/floor/:id/:floor',name:'floor', component: AppFloor},
        {path: '/realty/:id', name:'realty', component: AppRealty},
      //  {path: '/gallery', name:'gallery', component: AppGallery},
      //  {path: '/declaration', name:'declaration', component: AppDeclaration},
        {path: '/about', name:"about", component: AppAbout}
    ]
})

export default {
    name: 'app',
    data () {
        return {
            preloader:true
      }
    },
    mounted(){
        //this.preloader = this.$store.getters.preloader.state;
    },
    updated(){

      if (this.$router.currentRoute.name == 'home'){
      }
    },
    router,
}

</script>

<style lang="scss" >
  body, html {
    background: white;
    color:#252525;
    margin:0;
    width : 100%;

  }

  .content {
    padding-top: 68px;
    background: white;
    width: 960px;
    @media screen and (min-width: 1366px) {
      width: 1170px;
    }
  }
  #app {
    width : 100%;
//    height: 100vh
  }
  a:link,
  a:visited ,
  a:hover ,
  a:active {
      color: #111;
      text-decoration: none;
  }
  .fade{

  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity .3s ease;
  }
  .fade-enter, .fade-leave-to
  /* .component-fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
  }

</style>
