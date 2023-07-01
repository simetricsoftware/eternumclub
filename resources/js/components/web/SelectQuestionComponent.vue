<template>
  <div class="container d-flex align-items-center justify-content-center" >
    <div class="w-100">
      <h4>{{ question }}</h4>
      <div>
        <label for="mySelect">Selecciona una opción:</label>
        <select id="mySelect" class="form-control" v-model="selectedOption" @change="emitAnswer">
          <option v-for="option in options" :key="option" :value="option">{{ option }}</option>
        </select>
        <p>Has seleccionado: {{ selectedOption }}</p>
      </div>
    </div>
  </div>
</template>

    
    <script>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
    
    export default {
        components:{ FontAwesomeIcon },
        props:{question: String, options: Array},
        data() {
         return { 
         selectedOption : "",

        };
      },
       methods: {
        selectOption(option) {
        this.selectedOption = option;
        },
        emitAnswer(){
          this.$emit('input', this.selectedOption);
        }
      }
    }
</script>
    
    <style lang="css" scoped>
    </style>
    