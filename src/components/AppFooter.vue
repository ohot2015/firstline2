<template>
  <div class='footer'>
    <div class="work-spaces">
        <div class="logo"></div>
        <div class="social">
            <a href="https://vk.com/firstline12" class="vk" target="_blank"></a>
            <a href="https://fb.me/firstline12" class="fb" target="_blank"></a>
            <a href="https://ok.ru/group/54056149319852" class="ok" target="_blank"></a>
            <a href="https://www.instagram.com/firstline12/" class="in" target="_blank"></a>
            <!-- <div class="vk"></div>
            <div class="fb"></div>
            <div class="in"></div> -->
        </div>
        <nav>
            <ul>
                <li class="home"><router-link :to="{ name: 'home'}">Главная страница</router-link></li>
                <li class="gallery"><router-link :to="{name:'gallery'}">Галерея</router-link></li>
                <li class="declaration"><router-link :to="{name:'declaration'}">Проектные декларации</router-link></li>
                <li class="about"><router-link :to="{name:'about'}">Контакты</router-link></li>
            </ul>
        </nav>
    </div>
  </div>
</template>
<script>
export default {
    name: 'AppFooter',
    data () {
        return {
            phone: this.getPhone()
        }
    },
    methods: {
        getPhone() {
            return '';
        }
    }
}
</script>

<style lang="scss">
    .footer {
        width: 100%;
        background: white;
        height: 90px;
        .work-spaces {
            display: flex;
            height: 100%;
            justify-content: space-between;
            margin: 0 auto;
            width: 960px;
            .logo {
                height: 100%;
                width: 220px;
                margin-left: 20px;
                background: url(../assets/img/logo-menu.png) no-repeat center;
                background-size: contain;
            }
            .social {
                // display: flex;
                // justify-content: space-between;
                // align-items: center;

                width: 138px;
                margin-left: 23px;
                & > a {
                    float: left;
                    display: block;
                    width: 34px;
                    margin-top:23px;
                    height: 40px;
                }
                .vk {
                    background: url(../assets/img/vk.png) no-repeat center;
                    background-size: contain;
                }
                .fb {
                    background: url(../assets/img/fb.png) no-repeat center;
                    background-size: contain;
                }
                .in {
                    background: url(../assets/img/in.png) no-repeat center;
                    background-size: contain;
                }
            }
            nav ul {
                display: flex;
                font-family: RobotoCondensed-Regular;
                font-size: 15px;
                justify-content: space-between;
                width: 456px;
                align-items: center;
                margin-left: 30px;
                height: 100%;
                margin-top: 0;
                li {
                    list-style-type: none;
                }
            }
        }
    }

</style>
