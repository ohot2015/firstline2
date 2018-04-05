import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource'

import AppMenu from './components/AppMenu.vue'
import AppStyleKostil from './components/AppStyleKostil.vue'
import AppGallery from './components/AppGallery.vue'
import AppHouse from './components/AppHouse.vue'

import YmapPlugin from 'vue-yandex-maps'
// or for a single instance
import { yandexMap, ymapMarker } from 'vue-yandex-maps'

Vue.use(YmapPlugin)
Vue.use(VueResource);
Vue.component('AppMenu', AppMenu);
Vue.component('AppHouse', AppHouse);
Vue.component('AppStyleKostil', AppStyleKostil);
//Vue.component('AppGallery', AppGallery);

new Vue({
  el: '#menu',
  render: h => h(AppMenu)
})

new Vue({
  el: '#style',
  render: h => h(AppStyleKostil)
})

new Vue ({
    el: "#house",
    render: h => h(AppHouse)
})

// new Vue({
//   el:'#yamaps',
//   components: { yandexMap, ymapMarker },
//    data() {
//   return {
//      placemarks: [
//       {
//         coords: [56.622964, 47.897818],
//         properties: {
//         }, // define properties here
//         options: {
//                 iconLayout: 'default#image',
//                 //iconImageHref: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAvCAYAAABpG3MiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABD5JREFUeNq8mHtoTmEcx9/37J3LXOaWS265zSVMLkNCFEUofwj/MJc/iOQPSfhnIUUoCkmEWTKS3KIWmcnMbLHRmEmbucRcxu575/ur79HTcd5znvO+O371ae09z/Oc7/k9z/P7/Z4nmLSjMuDB+oGFYBYYDvqARNAGNIDv4AMoBvfBdfBed/CQZrtJYD2YBjqAtqAjaKe0iQNd+XsvMANsBtngGCiIVUwS2ACmgyGgs02bFmKOFw8SlOcibBx4BE6AomjELAGpYB4I8rdmekC1oPLcamF6Szw7EYwA6eCc8gGOYsTNS8EWdg5YpsKLGRbRc7jW2oPz4JeTGJmGZWAv6BbwxwaAPVzwmaogVbnsiMVgJ4WEfRIj09MdbOMSiLMTI3O6BvRnB8MnMTJd9dwcqZy2f8SsBlOVDn6aGZdkDa2zipkPUjzEHbFGh2nQ8U48mcDQ8fflK8AwjUHCfFkcB3oNXoFq0IkuH2oRFXQQJOONBaskOIqYwSDZEk0jfbHBv0/AVVAIKkANA52kizFgEZiifIDhIEhCyWQwSMQs4L53E2JOTR7YDW7ZtCtkPsrnbklxGTuoxLYFoni2JXzbWTM7vmQMuuXS/g7YBZ4p3nQyyXezpeHICDnH6pkGvuS65gK/yyTZoCFGUsZog4ks5BLk4vmV2R63cDanzi1myfMeBl0UpxFbykGJRzFloFJzPbY3PETaXyyevJj0qdVsG28oicrNM32Z5LxYH82EK96pETHvGCfcLJnlphebyX46HnxrsAL7odFBMu1cJlIdG8w001tTTL7Brfpb8wXjWdcmurSTqdnK9jp5SoJplmzpLHqmRWPddGV2r2A6+AzqlHJUCvUuYCVYznyls16+gNsheqWQwS9Bo6MEyH1gLbjAj/kIenJNSck6irFL5wNlinLBVzNrn2NxlazhUpOBYBPYqLzU9E7IRkQkYZL1T0vQNcXk0jsipkmjrgnSix0ieC/okBStVsx3/w14dfROgYcCK+jxdzuTM1SGWaip0fc+E2GAye1/2E1wz64GbuQ2z9NM+7FaEUuRejsxYg/AKW7VJp/FnAE5kU58atrPoiC/rIyRv9FNzAtwgFvUr4PcQfDU6Sysbk0ppA754J0wF22WXXKOVMtUgaPgUysLkYujNPDG7ZbA2lE6HAY/W+FsHWD+2w4eRzoAGi5B7SR43gpn65/MY+m69yd2X/QNHOfqj8VyuGgD0YoxLZ2CqqIUUsoxSltDjNh+cITR0st2b2BGzvB6zeVm5qCGhiBz0V4CF6O5c3Ozcrq7SHPRSp1yVgptP8SINx7yDB12yOxNfJ7GSqDZDzFm3XONF4RtIrQJUcgVDwe4qMQE+AJJFZeVtaP+vcLntV4HjvYSUaLpDmb4RuW48YC/V0czaCw3miXc8gX0SAH/fxntgKFAbHaDxxK5gsv0cHdja38EGADm/QGfqq1/cQAAAABJRU5ErkJggg==',
//                 iconImageHref: 'src/assets/img/logo.png',
//                 iconImageSize: [30, 42],
//                 iconImageOffset: [-5, -38]
//         }, // define options here
//         balloonTemplate: '<div>"Your custom template"</div>',
//         callbacks: { click: function() {} }
//       }
//     ]
//   }
// }
// })
// new Vue({
//   el: '#gallery',
//   render: h => h(AppGallery)
// })


//url('')