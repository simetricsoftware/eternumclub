<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-6 m-auto">
          <purchase-component></purchase-component>
          <div class="text-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bankModal">
              <i class="fas fa-university mr-2"></i>
              Ver información bancaria
            </button>
          </div>
          <div class="total_price"> Total {{  total }}</div>
          <!-- Modal -->
          <div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="bankModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="bankModalLabel">Información Bancaria</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <bank-info-component></bank-info-component>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
         
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
  margin-top: 50px;
}  

.total_price {
font-size: 1.5rem;
text-align: center;
}
</style>

<script>
    import PurchaseComponent from './PurchaseComponent.vue'
    import OpenQuestionComponent from './OpenQuestionComponent.vue'
    import MultipleQuestionComponent from './MultipleQuestionComponent.vue'
    import RadioQuestionComponent from './RadioQuestionComponent.vue'
    import SelectQuestionComponent from './SelectQuestionComponent.vue'
    import BankInfoComponent from './BankInfoComponent.vue'

    export default {
        components: { OpenQuestionComponent, MultipleQuestionComponent, RadioQuestionComponent, SelectQuestionComponent, PurchaseComponent,BankInfoComponent },
      computed: {
        total() {
          return this.$store.state.amount
        }
      },
        data(){
      return{
        optionsRadio: ["opción1", "opcion2","opcines4"],
        optionsMulti: ["opciones1", "opciones2", "opción3"],
        optionsDrop: ["Cerveza", "Tequila", "Ron","Wisky",],
        answer1: "",
        answer2:[],
        answer3: "",
        answer4: "",
        ticketTypes: [],
      }  
     },
  
     methods:{
    getBanks() {
      const slug = this.$route.params.post;       
      axios.get(`/api/posts/${slug}/bank-accounts`)
        .then(response => {
          this.bankInfo = response.data.data;
          console.log(this.bankInfo); // Imprimir los datos en la consola

        });
    },
  
  },
  created() {
    // Recibir el dato numérico del otro sistema y asignarlo a 
    this.getBanks();
  }
    }

</script>

<style lang="css" scoped>
</style>
