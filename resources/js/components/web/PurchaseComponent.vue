  <template>
      <div style="padding-top: 30px;">
          <h1 class="display-6 text-center">Ingresa la info de contacto</h1>
          <div class="container-sm" style="max-width: 100%; height: auto;">
            <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control custom-input" id="email" placeholder="Ingresa tu email" v-model="email" @change="onChange" required>
          </div>
          <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control custom-input" id="name" placeholder="Nombre" v-model="name" @change="onChange" required>
          </div>
          <div class= "form-group">
            <label for="identification_number">Cédula:</label>
            <input type="number" class="form-control custom-input" id="identification_number" placeholder="Número de ID" v-model="identification_number" @change="onChange" required>
          </div>
          <div class="form-group">
            <label for="phone">Celular:</label>
            <span>Ej. 0987654321</span>
            <input type="tel" class="form-control custom-input" id="phone" placeholder="Ingresa tu número" v-model="phone" @change="onChange" pattern="^09\d{8}$" required>
          </div>
          
          <div class="text-center" style="margin-top: 50px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bankModal">
              <i class="fas fa-university mr-2"></i>
              Ver información bancaria
            </button>
          </div>
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
                  <bank-info-component style="font-size: 1.2rem;"></bank-info-component>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="form-group" style="margin-top: 50px;">
            <label style="font-weight:bold" for="voucher">Puedes realizar el pago de tus entradas adjuntando la captura de la transferencia 😄 👇</label>
            <input type="file" class="form-control-file" id="voucher" @change="onFileChange" required>
          </div>
        </div>
        <hr>
      </div>
    </template>


  <script>
  import RecentPostsComponent from './posts/partials/RecentPostsComponent'
  import BankInfoComponent from './BankInfoComponent.vue'


  export default {
    components: {
      RecentPostsComponent,BankInfoComponent
    },
    data() {
      return {
        email: "",
        name: "",
        identification_number: "",
        phone: "",
        voucher: null
      };
    },
    methods: {
      onFileChange(event) {
          this.voucher = event.target.files[0];
          this.onChange();
      },
      onChange() {
          this.$emit('change', {
              email: this.email,
              name: this.name,
              identification_number: this.identification_number,
              phone: this.phone,
              voucher: this.voucher
          })
      }
    }
  }
  </script>

  <style lang="css" scoped>
  </style>
