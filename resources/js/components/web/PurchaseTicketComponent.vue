<template>
  <div class="container">
    <h1 class="text-center">Compra tus Entradas</h1>

    <img src="./eternum_ico.png" alt="Imagen" class="image">

    <div v-for="ticket of ticketTypes" :key="ticket.id" class="form-group">
      <div class="form-group-row">
        <label for="inputType" class="label">Tipo:</label>
        <div class="data">{{ ticket.name }}</div>
      </div>
      <div class="form-group-row">
        <label for="inputPrecio" class="label">Precio:</label>
        <div class="data">{{ ticket.amount }}</div>
      </div>
      <div class="form-group-row">
        <label for="inputCantidad" class="label">Cantidad:</label>
        <input type="number" class="form-control input" :id="'inputCantidad-' + ticket.id" :max="ticket.quantity" v-model="ticket.count" @input="validateCount(ticket)">
      </div>
      <div class="error-message">{{ ticket.error }}</div>
    </div>

    <div class="total">
      Total: <span>{{ total  }}</span>
    </div>

    <button class="continue-button" @click="continuar" :disabled="!canContinue">Continuar</button>
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
    calcularTotal() {
      let total = 0;
      this.ticketTypes.forEach(ticket => {
        const cantidad = ticket.count || 0;
        const precio = ticket.amount || 0;
        total += cantidad * precio;
      });
      return total.toFixed(2);
    },
    total() {
      return this.$store.state.amount
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
      this.$router.push({name: "posts.form"})
    },

    getTickets() {
      const slug = this.$route.params.post;
      axios.get(`/api/posts/${slug}/ticket-types`)
        .then(response => {
          this.ticketTypes = response.data.data;
        });
    },

    validateCount(ticket) {
      this.$store.state.amount = this.calcularTotal
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