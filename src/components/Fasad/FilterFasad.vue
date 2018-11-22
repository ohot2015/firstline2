<template>
    <div class="filter-fasad">
        <div class="desc">количество комнат</div>
        <div class="wrap-button">
            <button @click="buttonClick(1, $event)" :class="$store.getters.findAll('selectedButton')[1]?'active':''" >1</button>
            <button @click="buttonClick(2, $event)" :class="$store.getters.findAll('selectedButton')[2]?'active':''" >2</button>
            <button @click="buttonClick(3, $event)" :class="$store.getters.findAll('selectedButton')[3]?'active':''" >3</button>
            <button @click="buttonClick(4, $event)" :class="$store.getters.findAll('selectedButton')[4]?'active':''" >4+</button>
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
        @media screen and (min-width: 1024px) {
            left: 32px;
        }
        @media screen and (min-width: 1366px) {
            left: 0;
        }
        @media screen and (min-width: 1920px) {
            left: 0;
        }
        .desc {
            text-transform: uppercase;
            font-size: 12px;
            font-family: RobotoCondensed-Regular;
        }
        .wrap-button {
            margin-top: 5px;
            button {
                font: inherit;
                font-size: 22px;
                font-family: direct-Bold;
                color: white;
                border: 1px solid transparent;
                box-sizing: border-box;
                width: 37px;
                height: 33px;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                background-color: rgba(0, 0, 0,0.6);

                &.active {
                    border-color: #e7e4ff;
                    color: black;
                    border-color: black;
                    background-color: rgba(255, 255, 255, .6);
                }
                &:active{
                    transform: translateY(2px);
                    outline: none;
                }
                &:focus{
                    outline: none;
                }
                &:hover {
                    color: black;
                    border-color: white;
                    background-color: rgba(255, 255, 255, .6);
                }
            }
        }
    }
</style>
