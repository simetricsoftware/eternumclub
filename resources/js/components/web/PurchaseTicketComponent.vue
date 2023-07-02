<template>
  <div class="container">
    <h1 class="text-center">Compra tus Entradas</h1>

    <img src="./eternum_ico.png" alt="Imagen" class="image">

    <div  v-for="ticket of ticketTypes" :key="ticket.id" style="margin-bottom: 2vh;">
  <div class="row w-100">
    <label class="col-5" style="font-size: 4vh;">Tipo:</label>
    <div class="col-7" style="font-size: 4vh;">{{ ticket.name }}</div>
  </div>
  <div class="row w-100">
    <label class="col-5" style="font-size: 4vh;">Precio:</label>
    <div class="col-7" style="font-size: 4vh;"> ${{ ticket.amount }}</div>
  </div>
  <div class="row w-100">
    <label class="col-5" style="font-size: 4vh;">Cantidad:</label>
    <div class="col-3">
      <input type="number" style="width: 100%; font-size: 4vh;" :max="ticket.quantity" v-model="ticket.count" @input="validateCount(ticket)">
    </div>
  </div>
  <div style="margin-top: 1vh; font-size: 3.6vh;">{{ ticket.error }}</div>
</div>

    <div class="total">
  Total: <span>$ {{ total }}</span>
</div>


<button class="continue-button" @click="continuar" :disabled="!canContinue" style="font-size: 1.5rem; padding: 10px 20px;">Continuar</button>

  </div>
</template>


<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
  components: {
    FontAwesomeIcon
  },

  computed: {
    canContinue() {
      return this.ticketTypes.some(ticket => ticket.count > 0);
    },
    total() {
      return this.ticketTypes.reduce((previous, current) => {
        return previous + (current.amount * +current.count);
      }, 0)
    }
  },

  data() {
    return {
      ticketTypes: [],
      totalValue: 0,
    };
  },

  methods: {
    continuar() {
      // Lógica para continuar después de validar la cantidad de entradas
      this.$store.state.tickets = this.ticketTypes;
      this.$router.push({name: "posts.form"})
    },

    getTickets() {
      const slug = this.$route.params.post;
      axios.get(`/api/posts/${slug}/ticket-types`)
        .then(response => {
          this.ticketTypes = response.data.data.map(ticket => {
            return {
              ...ticket,
              count: 0,
              error: "",
            };
          });
        });
    },

    validateCount(ticket) {
      if (ticket.count <= 0) {
        ticket.error = "La cantidad debe ser mayor a cero";
      } else {
        ticket.error = "";
      }
    },
  },

  created() {
    // Recibir el dato numérico del otro sistema y asignarlo a cantidadEntradas
    this.getTickets();
  }
}
</script>

<style lang="css" scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.form-group {
  width: 100%;
  max-width: 400px;
  margin-bottom: 20px;
}

.form-group-row {
  display: flex;
  align-items: center;
}

.label {
  flex-basis: 20%;
  text-align: right;
  margin-right: 10px;
}

.data {
  flex-basis: 80%;
}

.input {
  width: 100%;
}

.image {
  width: 150px;
  height: 150px;
  object-fit: cover;
  margin-bottom: 20px;
}

.error-message {
  color: red;
  margin-top: 5px;
}

.continue-button {
  margin-top: 20px;
  background-color: #01c4e7;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 50px;
}

.continue-button:hover {
  background-color: #ff0534;
}

@media (max-width: 576px) {
  .form-group {
    max-width: 100%;
  }
}

.total{
  font-size: 1.5rem;
}
</style>
