<template>
    <div class="wrap">
        <div id="homemap">
            <iframe src="https://yandex.ru/map-widget/v1/-/CBQwMDbjoC" width="100%" height="100%" frameborder="0"></iframe>
        </div>
        <div class="footer">
            <app-footer></app-footer>
        </div>
    </div>
</template>
<script>
import AppFooter from './AppFooter.vue'
export default {
    name: 'AppLongrid',
    data () {
        return {

        }
    },
    components: {
        AppFooter
    }
}
</script>

<style lang="scss" scoped>
    .wrap{
        height: calc(100% - 68px);
        padding-top: 68px;
    }

    #homemap {
        width: 100%;
        height: calc(100% - 3px);
    }
    .footer{
        position: fixed;
        bottom: 0;
    }
</style>
