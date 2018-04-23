<template>
    <div class="wrap">
        <h1>Проектные декларации</h1>
            <div class="declaration">
                <a v-for="item in delcaration" :href='item.src' target="_blank">{{item.name}}</a><br>
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
                    {src:'http://m2metr.com/uploads/document/95972fa3621f49d92020b76af5b56aac.pdf',
                    name:'ПРОЕКТНАЯ ДЕКЛАРАЦИЯ (поз.3/1 проекта планировки мкрн «Ширяйково»)'},
                    {src:'http://m2metr.com/uploads/document/351d0a0981060b45f7f1339140312b3c.pdf',
                    name:'ПРОЕКТНАЯ ДЕКЛАРАЦИЯ (поз.3/1 проекта планировки мкрн «Ширяйково») изменения от 13.02.2018 г.'},
                    {src:'http://m2metr.com/uploads/document/4a6dbf6bb80408274ace926b89524e3e.pdf',
                    name:'ПРОЕКТНАЯ ДЕКЛАРАЦИЯ (поз.3/1 проекта планировки мкрн «Ширяйково») изменения от 22.01.2018 г.'},
                    {src:'http://m2metr.com/uploads/document/d3b290b6b4b96eb29ec1f13c1de76012.pdf',
                    name:'Договор аренды и передачи прав и обязанностей Ширяйково поз.3.1'},
                    {src:'http://m2metr.com/uploads/document/075b59c47f4e5d4dce67d244c10901a1.pdf',
                    name:'Заключение Минстроя от 10.11.2017 года Ширяйково поз.3.1'},
                    {src:'http://m2metr.com/uploads/document/6fdde369f0d44daf6861195cded0a1bf.pdf',
                    name:'Заключение экспертизы от 23.01.2018 Ширяйково поз. 3/1'},
                    {src:'http://m2metr.com/uploads/document/6a54aa402531637de831b30487297f85.pdf',
                    name:'Заключение экспертизы от 10.06.2016 Ширяйково поз. 3/1'},
                    {src:'http://m2metr.com/uploads/document/47fd11e465e5f4b2e8efb0d47700f959.pdf',
                    name:'Постановление о предоставлении разрешения на отклонение Ширяйково поз.2.1'},
                    {src:'http://m2metr.com/uploads/document/0dfdd8be24f674b990c64bbd663c26ef.pdf',
                    name:'Разрешение на строительство от 13.02.2018 Ширяйково поз.3.1'},
                    {src:'http://m2metr.com/uploads/document/59d04c1334f13a8d9b6003b77f0ab944.pdf',
                    name:'Разрешение на строительство от 08.08.2017 Ширяйково поз.3.1'},
                    {src:'http://m2metr.com/uploads/document/d2539d39bee067bf88da7651d939315e.pdf',
                    name:'ДДУ Форма (ООО Метр в квадрате) Ширяйково поз.3.1'},
                    {src:'http://m2metr.com/uploads/document/db3ffc3f9726803461b31afc30e33b72.pdf',
                    name:'Справка о счете эскроу Ширяйково поз.3.1'},

            ]
        }
    },
    components: {
        AppFooter
    }
}
</script>

<style lang="scss" scoped>
    .wrap{
        height: 100%;
        background: #e7e4ff;
        h1 {
            margin:0;
            padding: 20px 0 ;
            width: 100%;
            text-align: center;
        }
        width: 100%;
   .declaration {
            width:1200px;
            margin:0 auto;
        }
        a {
            display: block;
            width:1200px;

        }
        a:hover{
            background: #eee;
        }

    }

    .footer {
        position: fixed;
        bottom: 0;
    }
</style>
