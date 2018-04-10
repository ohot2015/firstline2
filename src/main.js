import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource'
import _ from 'underscore'
Vue.use(_);

Vue.use(VueResource);
Vue.component('App', App);

new Vue({
  el: '#app',
  render: h => h(App),
})

