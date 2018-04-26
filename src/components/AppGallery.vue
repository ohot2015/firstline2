<template>
  <div class='gallery' id="gallery">
    <div class="page6">
        <div class="header">
            <h1>Галерея</h1>
        </div>
        <div class="gallery">
            <div class="container-gallery">
                <lightbox
                    :key="'streamGallery'"
                    :loop="false"
                    :images="stream"
                    :title="'Сейчас'"
                    :imgprev="stream[0].src"
                    v-if="false"
                    >
                    <div class="container">
                       <div class="photo">
                            <img :src="imgprev" :alt="caption" @click="clickImage(0)">
                       </div>
                        <div class="desc"><span v-if="title">{{ title }}</span></div>
                   </div>
                </lightbox>
                <lightbox
                    v-for="(month, index) in img"
                    :key="month.title + index"
                    :loop="false"
                    :images="month.images"
                    :title="month.title"
                    :imgprev="month.imgPrev"
                    >
                    <div class="container">
                       <div class="photo">
                            <img :src="month.imgPrev">
                       </div>
                        <div class="desc"><span v-if="month.title">{{ month.title }}</span></div>
                   </div>
                </lightbox>
            </div>
        </div>
    </div>
    <div class="footer">
    <app-footer></app-footer>
    </div>
  </div>
</template>

<script>
import AppFooter from './AppFooter.vue'
import _ from 'underscore'
import lightbox from './Lightbox.vue';
//@click="clickImage(0)"
export default {
    name: 'gallery',
    data () {
        return {
            endpoint: 'src/api/index.php',
            gallery: [],
            img: [{
                    month: [
                        {
                            title: 'январь',
                            imgPrev: 'https://unsplash.it/500',
                            images: [
                                {
                                    src: 'https://unsplash.it/500',
                                },
                                {
                                    src: 'https://unsplash.it/400',
                                }
                            ]
                        }
                    ]
                }
            ],
            stream: [{
                src:''
            }]
        }
    },
    methods: {
        getGallery: function() {
            this.$http.get(this.endpoint).then(function(response){
                this.img = [];
                _.each(response.data.images[2018], (el,monthName) => {
                    let month = {
                        title: monthName,
                        imgPrev: el.main? el.main: el[0],
                        images: []
                    }
                    _.each(el,(path) => {
                        let obj = {
                            src: path
                        }
                        month.images.push(obj);
                    })
                    this.img.push(month)
                })
                this.stream = [];
                _.each(response.data.stream,(path) => {
                        let obj = {
                            src: path
                        }
                        this.stream.push(obj);
                })
            },
            function(error){
            })
        }
    },
    components: {
      AppFooter,
      lightbox
    },
    created: function() {
      this.getGallery();
    }
}

</script>

<style lang="scss" scoped>
  $background: #e7e4ff;
  #gallery {
        min-height: calc(100% - 68px);
        padding-top: 68px;
        background: $background;
  }
   .container-gallery {
        width: 1024px;
        height: 560px;

        box-sizing: border-box;
        padding-left:10px;
        margin:0 auto;
        .box {
          width: 100%;
          float:left;
        }
    }
    .footer {
        position: fixed;
        bottom: 0;
    }
 .page6 {
    background: $background;
    width: 100%;
    height: 100%;

    h1 {
      margin: 0;
      height: 50px;
      line-height: 60px;
    }
    h2 {
      margin: {
        top: 10px;
        bottom: 10px;
      }
      text-align: center;
    }
    .header {
      height: 50px;
      width: 200px;
      margin: 0 auto;
      text-align: center;
    }

  }
</style>
