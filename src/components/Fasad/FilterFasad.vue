<template>
    <div class="filter-fasad">
        <div class="desc">кол-во комнат</div>
        <div class="wrap-button">
            <button @click="buttonClick(1, $event)" >1</button>
            <button @click="buttonClick(2, $event)" >2</button>
            <button @click="buttonClick(3, $event)" >3</button>
            <button @click="buttonClick(4, $event)" >4+</button>
        </div>
    </div>
</template>
<script>

export default {
    name:'FilterFasad',
    data () {
        return {
        }
    },
    methods: {
        buttonClick(num, e) {
            let selectedButton = this.$store.getters.findAll('selectedButton');
            let index = selectedButton[num];

            if (index && index !== undefined) {
                selectedButton[num] = false;
                e.target.classList.remove("active");
            }
            else {
                selectedButton[num] = true;
                e.target.classList.add("active");
            }
            return true ;
        }
    }
}

</script>

<style lang="scss" scoped>
    .filter-fasad {
        position: absolute;
        left: 0;
        top: 20px;
        .desc {
            //text-transform: uppercase;
        }
        .wrap-button {
            margin-top: 5px;
            button {
                font: inherit;
                color: #252525;
                border: 1px solid #252525;
                width: 30px;
                height: 30px;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                background-color: rgba(231, 228, 255,0.5);
                &.active {

                    border-color: #e7e4ff;
                }
                &:active {
                    transform: translateY(1px);
                    filter: saturate(150%);
                }
                &:hover {
                    color: #e7e4ff;
                    border-color: #e7e4ff;
                }
            }
        }
    }
</style>
