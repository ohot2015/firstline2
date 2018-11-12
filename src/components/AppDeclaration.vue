<template>
    <div class="wrap">
        <h1>Проектные декларации</h1>
        <div class="declaration">
            <a v-for="item in delcaration" :href='item.src' target="_blank" :data-date='item.date'>{{item.name}}</a><br>
        </div>
        <div class="footer">
            <app-footer></app-footer>
        </div>
    </div>
</template>
<script>
    import AppFooter from './AppFooter.vue'
    export default {
        name: 'AppDiclaration',
        data () {
            return {
                delcaration: [
                    {
                        src: 'http://m2metr.com/uploads/document/db3ffc3f9726803461b31afc30e33b72.pdf',
                        name: 'Справка о счете эскроу Ширяйково поз.3.1', date: '28.03.2018'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/351d0a0981060b45f7f1339140312b3c.pdf',
                        name: 'ПРОЕКТНАЯ ДЕКЛАРАЦИЯ (поз.3/1 проекта планировки мкрн «Ширяйково») изменения от 13.02.2018 г.',
                        date: '13.02.2018'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/0dfdd8be24f674b990c64bbd663c26ef.pdf',
                        name: 'Разрешение на строительство от 13.02.2018 Ширяйково поз.3.1',
                        date: '13.02.2018'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/47fd11e465e5f4b2e8efb0d47700f959.pdf',
                        name: 'Постановление о предоставлении разрешения на отклонение Ширяйково поз.2.1',
                        date: '31.01.2018'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/6fdde369f0d44daf6861195cded0a1bf.pdf',
                        name: 'Заключение экспертизы от 23.01.2018 Ширяйково поз. 3/1',
                        date: '23.01.2018'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/4a6dbf6bb80408274ace926b89524e3e.pdf',
                        name: 'ПРОЕКТНАЯ ДЕКЛАРАЦИЯ (поз.3/1 проекта планировки мкрн «Ширяйково») изменения от 22.01.2018 г.',
                        date: '22.01.2018'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/95972fa3621f49d92020b76af5b56aac.pdf',
                        name: 'ПРОЕКТНАЯ ДЕКЛАРАЦИЯ (поз.3/1 проекта планировки мкрн «Ширяйково»)',
                        date: '10.11.2017'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/075b59c47f4e5d4dce67d244c10901a1.pdf',
                        name: 'Заключение Минстроя от 10.11.2017 года Ширяйково поз.3.1',
                        date: '12.10.2017'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/59d04c1334f13a8d9b6003b77f0ab944.pdf',
                        name: 'Разрешение на строительство от 08.08.2017 Ширяйково поз.3.1',
                        date: '08.08.2017'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/6a54aa402531637de831b30487297f85.pdf',
                        name: 'Заключение экспертизы от 10.06.2016 Ширяйково поз. 3/1',
                        date: '10.06.2016'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/d3b290b6b4b96eb29ec1f13c1de76012.pdf',
                        name: 'Договор аренды и передачи прав и обязанностей Ширяйково поз.3.1',
                        date: '14.09.2015'
                    },
                    {
                        src: 'http://m2metr.com/uploads/document/d2539d39bee067bf88da7651d939315e.pdf',
                        name: 'ДДУ Форма (ООО Метр в квадрате) Ширяйково поз.3.1',
                        date: ''
                    },
                ]
            }
        },
        components: {
            AppFooter
        }
    }
</script>

<style lang="scss" scoped>
    .wrap {
        padding-top: 68px;
        background: #e7e4ff;
        font-family: RobotoCondensed-Regular;
        height: calc(100vh - 68px);
        width: 100%;
        @media screen and (max-height: 821px) {
            height: 800px;
        }
        h1 {
            margin: 0;
            padding: 20px 0;
            width: 100%;
            text-align: center;
        }
        .declaration {
            width: 960px;
            margin: 0 auto;
            @media screen and (min-width: 1366px) {
                width: 1170px;
            }
        }
        a {
            display: block;
            height: 40px;
            line-height: 40px;
            background: white;
            border-radius: 5px;
            width: calc(100% - 40px);
            margin-bottom: 10px;
            padding-left: 40px;
            position: relative;

            &:before {
                position: absolute;
                content: '';
                left: 5px;
                top: 5px;
                width: 22px;
                height: 29px;
                background: url('../assets/img/pdf.png');
            }

            &:after {
                position: absolute;
                content: attr(data-date);
                right: 5px;
                top: 1px;
                width: 79px;
                height: 40px;
            }
        }
        a:hover {
            background: #eee;
        }
    }

    .footer {
        position: fixed;
        bottom: 0;
    }
</style>
