<template>
  <div class="container d-flex align-items-center justify-content-center" >
    <div class="w-100">
      <h4>{{question}}</h4>
      <div class="d-flex justify-content-center itemgap">
        <div class="form-check" v-for="option of options" :key="option">
          <input v-model="answer" :value="option" class="form-check-input custom-radio" type="radio" name="radioOptions" :id="option" @change="emitAnswer">
          <label class="form-check-label" :for="option">{{ option }}</label>
        </div>
      </div>
    </div>
  </div>
</template>
    
<style>
.itemgap{
  gap:50px;    
}
</style>
    <script>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
    
    export default {
        components:{ FontAwesomeIcon },
        props:{question: String, options: Array},
        data() {
         return {
          answer: ""
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
    