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
                    :imgprev="streamPrev"
                    >
                    <div class="container">
                       <div class="photo">
                            <img :src="streamPrev"  @click="clickImage(0)">
                       </div>
                        <div class="desc"><span>Видеонаблюдение</span></div>
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

export default {
    name: 'gallery',
    data () {
        return {
        }
    },
    methods: {
    },
    computed: {
        img() {
            return this.$store.getters.findAll('gallery');
        },
        stream() {
            return this.$store.getters.findAll('stream');
        },
        streamPrev(){
            let prev = _.first(this.$store.getters.findAll('stream'));
            return prev ? prev.src : '' ;
        }

    },
    components: {
      AppFooter,
      lightbox
    },
    created() {
        if (!this.img.length && !this.stream.length) {
            this.$store.dispatch('getGallery');
        }
    }
}

</script>

<style lang="scss" scoped>
  $background: #e7e4ff;
  #gallery {
        //min-height: calc(100% - 68px);
        padding-top: 68px;
        background: $background;
        height: calc(100vh - 68px);
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
