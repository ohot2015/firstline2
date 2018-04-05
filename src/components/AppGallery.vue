<template>
  <div class='gallery' id="gallery">
    <div class="page6 galery">
        <div class="header">
            <h1>Галерея</h1>
        </div>
        <div class="container-gallery">
            <a href="" class="fancy" data-fancybox="_group">
               <div class="container">
                   <div class="photo">
                    <img src="" alt="">
                   </div>
                    <div class="desc"><span>месяц год </span></div>
               </div>
            </a>
        </div>
    </div>
  </div>
</template>
<script>
export default {
    name: 'gallery',
    data () {
        return {
            endpoint: 'api/index.php',
            gallery: [],
        }
    },
    methods: {
        getGallery: function() {
          this.$http.get(this.endpoint).then(function(response){
            console.log(response.data);
            this.gallery = response.data
          },
          function(error){

          })
        }
    },
    created: function() {

      this.getGallery();
    }
}

</script>

<style lang="scss">
  $background: #e7e4ff;
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
      .container {
        float:left;
        width: 231px;
        height:140px;
        box-sizing: border-box;
        margin:10px;
        position: relative;
        //background: url(img/house.jpeg) center;
        background-size: contain;
        transition: all .2s ease-in 0s;
        &.stream {
          img {
            height: 100%;
            width: 100%;
            margin: 0 auto;
          }
        }
        &:hover {
          filter: drop-shadow(4px 4px 15px #888);
          .desc{
            opacity: 0;
          }
          .photo {
            opacity: 1  ;
          }
        }
        .photo {
          background-color:  steelblue;
          opacity: .5;
          width: 100%;
          height: 100%;
          position: relative;
          img {
            width: 100%;
            height: 100%;
          }
        }
        .desc {
          width: 100%;
          height: 40px;
          position: absolute;
          bottom: 0px;
          left: 0px;
          background: white;
          opacity: .5;
          font-size: 24px;
          text-align: center;
          line-height: 40px;
          transition: all .2s ease-in 0s;
          text-transform: capitalize;
          color: black;
        }
      }
    }
  }
</style>
