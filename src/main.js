import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource'
import store from './store'

import _ from 'underscore'
Vue.use(_);
Vue.use(VueResource);
Vue.component('App', App);
new Vue({
  el: '#app',
  store,
  render: h => h(App),
})

