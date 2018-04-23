<template>
    <div class="longrid">
        <section class='silence'>
            <div class="logo"></div>
            <div class="block-silence">Тишина</div>
            <div class="embankment">Набережная</div>
            <div class="center">Центр</div>
            <div class="abs">И абсолютный комфорт в каждой детали...</div>
        </section>
        <section class="iphone10"></section>
        <section class="mesto">
            <h2>ПРЕСТИЖНОЕ МЕСТОПОЛОЖЕНИЕ</h2>
            <p class="first">
                ЖК «Первая линия» предлагает вам уникальную возможность - наслаждаться тишиной, спокойствием и комфортом, оставаясь в пределах городского центра.
            </p>
            <p>Расположенный на набережной Малой Кокшаги, комплекс обладает рядом эксклюзивных особенностей: необычная архитектура зданий, многофункциональный внутренний двор с развитой инфраструктура и детским садом, закрытая охраняемая территория и, конечно, захватывающие панорамные виды на речную акваторию, лесопарковые массивы и архитектурные объекты столицы.</p>
        </section>
        <section class="wrap-map">
                  <!-- :coords="[56.625628, 47.892787]" -->
            <div id="yamaps">
                <yandex-map
                  :coords="[56.622603, 47.887130]"
                  zoom="16"
                  style="width: 100%; height: 100%;"
                  :placemarks="placemarks"
                  :controls="['zoomControl']"
                  :behaviors="['drag', 'dblClickZoom', 'rightMouseButtonMagnifier', 'multiTouch']"
                >
                </yandex-map>
            <div class="wave"></div>
            </div>
        </section>
        <section class="dvor">
            <h2>БЕЗОПАСНЫЙ ДВОР</h2>
            <p class="first">
                Территория комплекса закрыта от посторонних.
            </p>
            <p>Круглосуточная охрана выступит гарантом безопасности для Вас и Ваших детей и позволит не волноваться за сохранность апартаментов и имущества. Облачная система видеонаблюдения за всеми объектами комплекса, включая детскую площадку предоставляет возможность наблюдения за Вашими детьми во время прогулки с помощью мобильного устройства из любой точки мира.</p>
            <div class="black-wave"></div>
        </section>
        <section class="lego">
            <div class="volna"></div>
        </section>
        <section class="kindergarten">
            <h2>СОБСТВЕННЫЙ ДЕТСКИЙ САД</h2>
            <p class="first">Все родители знают, как сложно найти для ребенка детский сад. Ведь хочется, чтобы он обеспечил достойный уровень ухода и воспитания, и был не очень далеко от дома. У жителей «Первой линии» не будет с этим никаких забот! Здесь будет расположен детский сад! Маленькие жители найдут собственные горки, домики и качели.
            </p>
            <p>Мы создадим все необходимое каждому ребенку. Не сомневайтесь – ваши дети будут по утрам с радостью собираться в детский сад.</p>
            <div class="black-wave">

            </div>
        </section>
        <section class="parking">
            <div class="volna"></div>
        </section>
        <section class="parking-text">
            <h2>ОХРАНЯЕМАЯ ПАРКОВКА</h2>
            <p>Проект включает бесплатную парковочную зону для автомобилей жителей комплекса. Парковка вынесена за границы дворовой территории. Круглосуточная охрана и закрытый въезд на парковку позволит вам не беспокоиться за безопасность вашего автомобиля.</p>
            <div class="black-wave"></div>
        </section>
        <section class="footbol">
            <div class="volna"></div>
        </section>
        <section class="footbol-text">
            <h2>КОМФОРТНЫЙ МНОГОФУНКЦИОНАЛЬНЫЙ ДВОР</h2>
            <p class="first">Особое внимание уделено функциональности двора. Здесь разместится детская площадка, многофункциональная спортивная площадка, места для прогулок и отдыха с множеством лавочек, беседок и декоративных навесов.
            </p>
            <p>Многофункциональная спортивная площадка, позволит играть в активные групповые игры: от бадминтона и волейбола, до мини-футбола, а в зимнее время хоккея.</p>
            <div class="black-wave"></div>
        </section>
        <section class="plan">
            <div class="volna"></div>
        </section>
        <section class="plan-text">
            <h2>ШИРОКИЙ СПЕКТР ПЛАНИРОВОК НА ЛЮБОЙ ВКУС</h2>
            <p class="first">Вы можете купить одно, двух или трехкомнатную квартиру без посредников. Прямая продажа от застройщика обеспечит Вам максимально комфортные условия сделки и её полную безопасность. Кроме того, на ранних этапах строительства у Вас есть возможность заказать индивидуальную планировку Ваших апартаментов.
            </p>
            <p>Все объекты комплекса оснащены поквартирной системой отопления. Высота потолков 2,7м, на последних этажах - 3м. Строительство ведется под чутким контролем профессионалов, уделяющих особое внимание качеству материалов и производимых работ.</p>
            <div class="black-wave"></div>
        </section>
        <div id="scrolltodistrict"></div>
        <app-district></app-district>
        <app-footer></app-footer>
    </div>
</template>
<script>
import { yandexMap, ymapMarker } from 'vue-yandex-maps'
import AppFooter from './AppFooter.vue'
import AppDistrict from './AppDistrict.vue'
export default {
    name: 'AppLongrid',
    data () {
        return {
            placemarks: [{

                //coords: [56.618972, 47.887258],
                coords: [56.622964,  47.897818],
                properties:
                    {}, // define properties here
                    options: {
                        iconLayout: 'default#image',
                        iconImageHref: 'src/assets/img/logo.png',
                        iconImageSize: [30, 42],
                        iconImageOffset: [-5, -38]
                    }, // define options here
                    balloonTemplate: '<div>"Your custom template"</div>',
                    callbacks: { click: function() {} }
            }]
        }
    },
    mounted(){
        if (this.$route.params.scrollTo) {
            this.$scrollTo('#scrolltodistrict', 500, {
     easing: "ease-in-out",})
        }
    },
    updated(){
        if (this.$route.params.scrollTo) {
            this.$scrollTo('#scrolltodistrict', 500, {
     easing: "ease-in-out",})
        }
    },
    created(){
        console.log();
    },
    components: {
        yandexMap,
        ymapMarker,
        AppFooter,
        AppDistrict
    },
}
</script>
<style lang="scss" scoped>
    .content {
        background: white;
    }
    .longrid {
        background: white;
        font-weight: 400;
        font-family: direct_Regular;
    }
    .silence {
        .logo {
            width: 192px;
            height: 153px;
            margin-top: 28px;
            margin-left: auto;
            margin-right: auto;
            background: url('../assets/img/logo_1024.png');
        }
        .block-silence {
            width: 798px;
            font-size: 66px;
            margin: {
                left: auto;
                right: auto
            }
            text-align: left;
            margin-top: 26px;
            position: relative;
            &:before {
                content: ' ';
                background: url('../assets/img/bird_left.png');
                width: 70px;
                height: 36px;
                position: absolute;
                left: -73px;
                top: -47px;
            }
            &:after {
                content: ' ';
                background: url(../assets/img/wave_house_1024.png);
                width: 568px;
                height: 158px;
                position: absolute;
                left: 258px;
                top: -47px;
            }
        }
        .embankment {
            width: 465px;
            font-size: 80px;
            font-weight: 400;
            position: relative;
            margin: {
                left: auto;
                right: auto
            }
            &:before {
                background: url('../assets/img/forest_1024.png');
                content: ' ';
                height: 81px;
                left: -91px;
                position: absolute;
                top: -4px;
                width: 86px;
            }
            &:after {
                background: url(../assets/img/bird_right.png) no-repeat;
                content: ' ';
                height: 23px;
                position: absolute;
                right: -243px;
                top: -107px;
                width: 52px;
            }
        }
        .center {
            font-size: 87px;
            font-weight: 400;
            margin-left: auto;
            margin-right: auto;
            margin-top: -5px;
            position: relative;
            width: 126px;
            &:after {
                background: url(../assets/img/marker_1024.png);
                content: ' ';
                height: 76px;
                position: absolute;
                right: -224px;
                top: 13px;
                width: 61px;
            }
        }
        .abs {
            margin-left: auto;
            margin-right: auto;
            margin-top: 6px;
            position: relative;
            width: 693px;
            font-size: 24px;
            text-indent: 165px;
            font-weight: 400;
        }
    }
    .iphone10 {
        width: 100%;
        height: 359px;
        margin:0 auto;
        margin-top: 41px;
        background: url(../assets/img/iphone_4k.png) no-repeat center;
        background-size: cover;
        @media screen and (min-width: 1920px) {
            height: 422px;
        }
    }
    .mesto ,.dvor ,.kindergarten, .parking-text, .footbol-text, .plan-text{
        h2 {
            width: 323px;
            margin:0 auto;
            margin-top:20px;
            font-family: RobotoCondensed-Bold;
            font-size: 30px;
            text-align: center;
        }
        p {
            display:block;
            margin: 0 auto;
            text-align: center;
            font-family: RobotoCondensed-Regular;
            font-weight: 400;
            font-size: 18px;
            width: 907px;
            margin-top: 24px;
            line-height: 21px;
        }
        p.first {
             width: 960px;
             margin-top: 16px;
             line-height: 20px;
        }
        .black-wave {
            background: url(../assets/img/black_wave_1024.png) no-repeat center;
            width: 100%;
            height: 27px;
            margin-top: 22px;
        }
    }
    .mesto {
      margin-top: -51px;
    }
    .wrap-map {
        height: 759px;
        margin-top: 30px;
        position: relative;
        width:100%;
        #yamaps {
            width: 100%;
            height: 672px;
        }
        .wave {
            background: url(../assets/img/camera_4k.png) no-repeat center;
            background-size: cover;
            bottom: 4px;
            height: 362px;
            position: absolute;
            width: 100%;
            z-index: 1;
            @media screen and (min-width: 1920px) {
                height: 458px;
            }
        }
    }
    .dvor {
        h2 {
            margin-top: -31px;
            width: 245px;
        }
        p {
            margin-top: 21px;
            width: 939px;
        }
        p.first{
            margin-top: 15px;
        }
    }
    .lego {
        .volna {
            background: url(../assets/img/lego_4k.png) no-repeat center;
            background-size: cover;
            width: 100%;
            height: 359px;
            margin-top: 47px;
            position: relative;
            @media screen and (min-width: 1920px) {
                height: 458px;
            }
        }
    }
    .kindergarten {
        margin-top: -39px;
        h2 {
            margin-top: 0px;
            width: 211px;
        }
        p {
            width:938px;
        }
        p.first {
            width:938px;
        }
    }
    .parking {
        .volna {
            background: url(../assets/img/brelok_4k.png) no-repeat center;
            background-size: cover;
            width: 100%;
            height: 327px;
            position: relative;
            margin-top: 44px;
            @media screen and (min-width: 1920px) {
                height: 380px;
            }
        }
    }
    .parking-text {
        margin-top: -40px;
        h2 {
            width: 173px;
        }
        p{
            margin-top: 13px;

        }
    }
    .footbol {
        .volna {
            background: url(../assets/img/footbol_4k.png) no-repeat center;
            background-size: cover;
            width: 100%;
            height: 433px;
            position: relative;
            margin-top: 42px;
            @media screen and (min-width: 1920px) {
                height: 513px;
            }
        }
    }
    .footbol-text {
        margin-top: -50px;
        h2 {
            width: 453px;
        }
        p {
            width: 940px;
        }
    }
    .plan {
        .volna {
            background: url(../assets/img/plan_4k.png) no-repeat center;
            background-size: cover;
            width: 100%;
            height: 316px;
            position: relative;
            margin-top: 23px;
            @media screen and (min-width: 1920px) {
                 height: 374px;
            }
        }
    }
    .plan-text {
        margin-top: -56px;
        h2{
            width: 410px;
        }
        p.first{
            width: 936px;
        }
        p{
            width: 910px;
        }
    }
</style>
