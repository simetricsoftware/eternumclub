<template>
  <div class="container d-flex align-items-center justify-content-center"  >
    <div class="w-100" >
      <h4>{{ question }}</h4>
      <input type="text" class="form-control" placeholder="Ingresa tu respuesta" v-model="answer" @input="emitAnswer">
    </div>
  </div>
</template>



    <script>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

    export default {
      components:{ FontAwesomeIcon },
      props:{question: String, value:String},
      data() {
        return {
         answer: ''
        };
      },
      methods: {
        emitAnswer(){
          this.$emit('input', this.answer);
        }
      }
    }
    </script>

    <style lang="css" scoped>
    </style>

