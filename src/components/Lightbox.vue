<template>
  <div :class="{ 'vue-lightbox' : !resetstyles }">
   <div class="container">
       <div class="photo">
            <img :src="imgprev" :alt="caption" @click="clickImage(0)">
       </div>
        <div class="desc"><span v-if="title">{{ title }}</span></div>
   </div>
    <div class="lightbox-overlay" v-if="overlayActive" @click.self="closeOverlay">
      <div class="holder">
        <img :src="images[currentImage].src"/>
        <div class="nav" v-if="nav">
          <a class="close" nohref @click="closeOverlay"><span>&times;</span></a>
          <a class="prev" nohref @click="prevImage"><span>&#8592;</span></a>
          <a class="next" nohref @click="nextImage"><span>&#8594;</span></a>
        </div>
        <p v-if="caption && images[currentImage].caption">{{ images[currentImage].caption }}</p>
      </div>
     </div>
  </div>
</template>

<script>
      //<li v-for="(image, index) in images">

export default {
  props: {
    resetstyles: {
      default: false,
      type: Boolean,
    },
    title: {
      type: String,
    },
    imgprev: {
      type: String,
    },
    images: {
      type: Array,
    },
    loop: {
      default: true,
      type: Boolean,
    },
    nav: {
      default: true,
      type: Boolean,
    },
    caption: {
      deftault: true,
      type: Boolean,
    },
  },
  data() {
    return {
      currentImage: null,
      overlayActive: false,
    };
  },
  mounted() {
    const self = this;
    window.addEventListener('keydown', (e) => {
      self.handleGlobalKeyDown(e);
    });
  },
  methods: {
    clickImage(index) {
      this.currentImage = index;
      this.overlayActive = true;
    },
    nextImage() {
      if (this.currentImage === (this.images.length - 1)) {
        if (this.loop) {
          this.currentImage = 0;
        }
      } else {
        this.currentImage += 1;
      }
    },
    prevImage() {
      if (this.currentImage === 0) {
        if (this.loop) {
          this.currentImage = (this.images.length - 1);
        }
      } else {
        this.currentImage -= 1;
      }
    },
    closeOverlay() {
      this.overlayActive = false;
    },
    handleGlobalKeyDown(e) {
      switch (e.keyCode) {
        case 37: this.prevImage(); break;
        case 39: this.nextImage(); break;
        case 27: this.closeOverlay(); break;
        default: break;
      }
    },
  },
};
</script>

<style scoped lang="scss">


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




.vue-lightbox ul {
	list-style: none;
	margin: 0 auto;
	padding: 0;
	display: block;
	max-width: 780px;
	text-align: center;

	li {
		display: inline-block;
		padding: 5px;
		background: ghostwhite;
		margin: 10px;

        img {
            display: block;
            width: 200px;
        }
	}
}

.lightbox-overlay {
	width: 100%;
	height: 100%;
	position: fixed;
	top: 0;
	left: 0;
	background: rgba(0,0,0,0.9);
	text-align: center;
	padding: 20px;
    box-sizing: border-box;
    z-index: 999999999999;

	.holder {
		max-width: 600px;
		margin: 0 auto;
		position: relative;
        max-height: 100vh;
        margin-top: 100px;

		img {
			width: 100%;
			max-width: 600px;
			cursor: pointer;
			box-sizing: border-box;
			display: block;
            max-height: 100vh;
		}

		p {
			color: #ffffff;
			margin: 0;
			background-color: rgba(0,0,0,0.4);
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			box-sizing: border-box;
			padding: 10px;
		}
		.nav {
			max-width: 600px;
			margin: 0 auto;
			font-size: 14px;

			a {
				color: white;
				opacity: 0.3;
				-webkit-user-select: none;
				cursor: pointer;

				&:hover {
					opacity: 1;
				}
			}

			.next, .prev {
				position: absolute;
				top: 0;
				bottom: 0;
				padding: 10px;
				width: 50%;
				box-sizing: border-box;
				font-size: 40px;

				span {
					top: 50%;
					transform: translateY(50%);
					position: relative;
				}
			}

			.next {
				right: 0;
				text-align: right;
			}

			.prev {
				left: 0;
				text-align: left;
			}
			.close {
				right: 10px;
				top: 0;
				font-size: 30px;
  				opacity: 0.6;
				z-index: 1000000;
				position: absolute;
				text-align: left;
				box-sizing: border-box;

				&:hover {
					opacity: 1;
				}
			}
		}
	}
}
</style>