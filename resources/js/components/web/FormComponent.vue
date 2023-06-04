<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-6 m-auto">
          <purchase-component></purchase-component>
          <div class="margins">
            <open-question-component question="Pregunta 1" v-model="answer1"></open-question-component>
            <multiple-question-component question="Pregunta 2" v-model="answer2" :options="optionsMulti"></multiple-question-component>
            <radio-question-component question="Pregunta 3" v-model="answer3" :options="optionsRadio"></radio-question-component>
            <select-question-component question="Pregunta 4" v-model="answer4" :options="optionsDrop"></select-question-component>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.margins > * {
  margin-bottom: 50px;
}
</style>

<script>
    import OpenQuestionComponent from './OpenQuestionComponent.vue'
    import MultipleQuestionComponent from './MultipleQuestionComponent.vue'
    import RadioQuestionComponent from './RadioQuestionComponent.vue'
    import SelectQuestionComponent from './SelectQuestionComponent.vue'
import PurchaseComponent from './PurchaseComponent.vue'

    export default {
        components: { OpenQuestionComponent, MultipleQuestionComponent, RadioQuestionComponent, SelectQuestionComponent, PurchaseComponent, },
     data(){
      return{
        optionsRadio: ["opción1", "opcion2","opcines4"],
        optionsMulti: ["opciones1", "opciones2", "opción3"],
        optionsDrop: ["Cerveza", "Tequila", "Ron","Wisky",],
        answer1: "",
        answer2:[],
        answer3: "",
        answer4: "",
      }  
     }
    }

</script>

<style lang="css" scoped>
</style>
