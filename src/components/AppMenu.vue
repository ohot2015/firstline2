<template id="nav12">
  <div class='main-nav'>

    <div class="work-spaces" id="work-spaces">
      <div class="block-menu">
        <div class="buter" @click="click">
            <template id="drop-down" >
                <div class="dropdown" v-show="active"

                >
                    <ul @mouseleave="active = !active">
                        <li class="home"><router-link :to="{ name: 'home'}">Главная страница</router-link></li>
                        <li class="gallery"><router-link :to="{name:'gallery'}">Галерея</router-link></li>
                        <li class="declaration"><router-link :to="{name:'declaration'}">Проектные декларации</router-link></li>
                        <li class="about"><router-link :to="{name:'about'}">Контакты</router-link></li>
                    </ul>
                </div>
            </template>
            <img src="../assets/img/buter_1024.png" alt="" class="ico"><!-- <div>меню</div> -->
        </div>
        <button @click="chanageRealty">
            Выбрать квартиру
        </button>
      </div>
      <div class="logo"><a href=""><img src="../assets/img/logo-menu.png" alt=""></a></div>
      <div class="contact">
        <div class="wrap">
          <img src="../assets/img/phone_1024.png" alt="" class="logo-phone">
          <div class="phone">
              <div class="digit">{{ phone }}</div>
              <div class="desc">телефон отдела продаж</div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
var dropDown = {
    tempalte: '#drop-down'
}
export default {
    name: 'AppMenu',
    data () {
        return {
            phone: this.getPhone(),
            active: false
        }
    },
    methods: {
        getPhone() {
            return '430-800';
        },
        click() {
            this.active = this.active ? false : true;
        },
        chanageRealty() {
            this.$router.push({name:'house',params:{id:14}});
        }

    },
    components: {
        dropDown
    }
}
</script>

<style lang="scss" scoped>
    $button-border-color: blue;
    .dropdown {
        position: absolute;
        width: 233px;
        height: 167px;
        margin-top: 51px;
        left: -12px;
        border: 1px solid black;
        background: white;
        ul {
            margin:0;
            padding:0;
            li {
                list-style-type: none;
                line-height: 41px;
                //text-indent: 52px;
                position: relative;
                a {
                    line-height: 41px;
                    height: 41px;
                    display: inline-block;
                    text-indent: 53px;
                    font-family: RobotoCondensed-Regular;
                    width: 100%;
                    &:after {
                        position: absolute;
                        content: ' ';
                        width: 21px;
                        height: 21px;
                        left: 16px;
                        top: 11px;
                    }
                }
                &:before{
                    position: absolute;
                    content: '';
                    width: 203px;
                    height: 1px;
                    background-color: #959595;
                    left: 15px;

                }
                &:first-child:before{
                    display: none;
                }
                &.home a:after {
                    background: url(../assets/img/menu_home.png) no-repeat center;
                }
                &.gallery a:after {
                    background: url(../assets/img/menu_gallery.png) no-repeat center;
                }
                &.declaration a:after {
                    background: url(../assets/img/menu_declaration.png) no-repeat center;
                }
                &.about a:after {
                    background: url(../assets/img/menu_contact.png) no-repeat center;
                }
            }
        }
    }
    .main-nav {
        position: fixed;
        top:0;
        width:100%;
        height: 67px;
        background: white;
        border-bottom: 1px solid black;
        z-index: 999;
        background: rgba(255,255,255,.9);
        .work-spaces {
            width: 960px;
            @media screen and (min-width: 1366px) {
                width: 1170px;
            }
            /*@media screen and (min-width: 1920px) {*/
                /*width: 1170px;*/
            /*}*/
            height: 66px;
            margin: 0 auto;
            display:flex;
            justify-content: space-between;
            align-items: center;
            &>div {
                width:300px;
                height: 35px;
                cursor:pointer;
            }
            .block-menu {
                .buter {
                    float:left;
                    position: relative;

                    //div {
                    //     font-size: 12px;
                    //     text-transform:uppercase;
                    // }
                }
                button {
                    appearance: none;
                    background: linear-gradient(to left, #48cad8,#00aeef);
                    border-radius: 4px;
                    border: 0;
                    cursor: pointer;
                    float:left;
                    font-family: "RobotoCondensed-Regular";
                    font-size: 12px;
                    height: 37px;
                    margin-left:40px;
                    text-transform: uppercase;
                    width: 150px;
                    color:white;

                            //                    -webkit-transition: all 4s ease-in-out 1s;
                    &:hover {
                        background: linear-gradient(to left, #00aeef,#48cad8);
                    }
                    &:active, &:focus {
                        outline: 0;
                    }
                }
            }
            .logo {
                display:none;
            }
            .contact {
                cursor:default;
                .wrap {
                    float: right;
                    width: 153px;
                }
                img {
                    display:block;
                    float:left;
                    margin-right: 5px;
                }
                .digit {
                    font-size: 30px;
                    line-height: 20px;
                    font-family: direct-Bold;
                }
                .desc {
                    font-family: "RobotoCondensed-Regular";
                    font-size: 12px;
                    padding-top: 5px;
                }
            }
        }
    }

</style>
