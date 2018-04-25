<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
        <div @click.prevent="$emit('close')" class="close">&#10010;</div>
        <form @submit.prevent="$emit('close',form)" action="">
          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
                <label for="name-modal">Ваше имя</label>
                <input required type="text" id="name-modal" name="name" v-model="form.name"><br>
                <label for="phone-modal">Ваш телефон</label>
                <masked-input id="phone-modal" name="phone" v-model="form.phone" mask="\+\7 (111) 111-1111" placeholder="Номер телефона" type="tel" />
                <input type="hidden" name="realty_id" v-model="form.rId">
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <button class="modal-default-button" type="submit">
                Отправить
              </button>
            </slot>
          </div>
        </form>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
import maskedInput from 'vue-masked-input'
export default {
  name: 'modal',
  data () {
    return {
      showModal: false,
      form: {
        name:'',
        phone:'',
        rId:this.realtyId,
      }
    }
  },
  props: ['realtyId'],
  components: {
      maskedInput
  },
  created(){
  }
}

</script>
<style lang="scss">
    #phone-modal{
        width: 300px;
        height: 30px;
        padding-left: 8px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #898989;
    }
</style>

<style lang="scss" scoped>
  .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 510px;
  margin: 0px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
  position: relative;
  font-family: RobotoCondensed-Regular;

  .close {
      height: 23px;
      width: 22px;
      position: absolute;
      right: 0px;
      top: 0px;
      font-size: 25px;
      cursor: pointer;
      color: #252525;
      transform: rotate(45deg);
  }

}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 10px 0;
    label{
        display: block;
        margin-bottom: 3px;
        margin-top: 10px;
        font-size: 12px;
    }
    input[type="text"]{
        width: 300px;
        height: 30px;
        padding-left: 8px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #898989;
    }
}

.modal-footer{
    width: 100%;
    font-family: RobotoCondensed-Regular;

    .modal-default-button {
        font-family: RobotoCondensed-Regular;
        background: none;
        height: 30px;
        border-radius: 5px;
        border: 1px solid #898989;
        font-size: 14px;
        background-color: #a3cdf9;
        cursor: pointer;
    }
}



/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
