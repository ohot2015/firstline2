import Vue from 'vue'
import App from './App.vue'

import AppMenu from './components/AppMenu.vue'

Vue.component('AppMenu',AppMenu);

new Vue({
  el: '#app',
  render: h => h(App)
})
