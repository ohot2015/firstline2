<template>
    <div class="preloader">

    </div>
</template>
<script>

export default {
    created(){
        this.$store.dispatch('getRealtysByHouseId').then(response => {
            this.$store.dispatch('getFloorsByHouseId').then(response => {
                this.$router.push({name:'home'});
            }, err => { throw err });
        }, err => { throw err });
        this.$store.dispatch('getHousesByDistrictId')
        this.$store.dispatch('getFasadByHouseId', this.$store.getters.findAll('houseId'));

        this.$store.dispatch('getGallery');
    }
}

</script>

<style lang="scss" scoped>
    .preloader {
        position: absolute;
        z-index: 999;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: rgba(0,0,0,.8);
    }
</style>
