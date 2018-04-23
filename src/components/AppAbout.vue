<template>
    <div id="homemap">
        <iframe src="https://yandex.ru/map-widget/v1/-/CBQwMDbjoC" width="100%" height="100%" frameborder="0"></iframe>
    </div>
</template>
<script>
export default {
    name: 'AppLongrid',
    data () {
        return {

        }
    }
}
</script>

<style lang="scss" scoped>
    #homemap {
        width: 100%;
        height: calc(100% - 3px);
    }
</style>
