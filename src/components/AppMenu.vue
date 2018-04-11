<template>
  <div class='main-nav'>
    <div class="work-spaces" id="work-spaces">
      <div class="block-menu">
        <div class="buter">
            <img src="src/assets/img/buter.png" alt="" class="ico"><div>меню</div>
        </div>
        <button>
            Выбрать квартиру
        </button>
      </div>
      <div class="logo"><a href=""><img src="src/assets/img/logo-menu.png" alt=""></a></div>
      <div class="contact">
          <img src="src/assets/img/menu-phone.png" alt="" class="logo-phone">
          <div class="phone">
              <div class="digit">{{ phone }}</div>
              <div class="desc">телефон отдела продаж</div>
          </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    name: 'AppMenu',
    data () {
        return {
            phone: this.getPhone()
        }
    },
    methods: {
        getPhone() {
            return '430-800';
        }
    }
}
</script>

<style lang="scss">
    $button-border-color: blue;
    .main-nav {
        position: fixed;
        top:0;
        width:100%;
        height: 67px;
        background: white;
        border-bottom: 1px solid black;
        .work-spaces {
            width: 900px;
            @media screen and (min-width: 1366px) {
                width: 1200px;
            }
            @media screen and (min-width: 1920px) {
                width: 1800px;
            }
            height: 75px;
            margin: 0 auto;
            display:flex;
            justify-content: space-between;
            flex-direction:row;
            align-items: center;
            &>div {
                width:300px;
                height: 35px;
                cursor:pointer;
            }
            .block-menu {
                .buter{
                    float:left;
                    div {
                        font-size: 12px;
                        text-transform:uppercase;
                    }
                }
                button {
                    cursor: pointer;
                    float:left;
                    height: 35px;
                    width: 135px;
                    appearance: none;
                    background: white;
                    border: 1px solid $button-border-color;
                    border-radius: 4px;
                    margin-left:13px;
                    text-transform: uppercase;
                    font-size: 12px;
                    &:active, &:focus {
                        outline: 0;
                    }
                }
            }
            .contact {
                img {
                    display:block;
                    float:left;
                    margin-right: 5px;
                }
                .digit {
                    font-size: 30px;
                    line-height: 20px;
                }
                .desc {
                    font-size: 12px;
                }
            }
        }
    }

</style>
