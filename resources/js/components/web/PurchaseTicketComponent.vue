<template>
  <div class="container">
    <h1 class="text-center title">Compra tus Entradas</h1>

    <img src="./eternum_ico.png" alt="Imagen" class="image">

    <div v-for="ticket of ticketTypes" :key="ticket.id" class="ticket">
      <div class="ticket-row">
        <label class="label-text">Tipo:</label>
        <div class="label-text">{{ ticket.name }}</div>
      </div>
      <div class="ticket-row">
        <label class="label-text">Precio:</label>
        <div class="price">$ {{ ticket.amount }}</div>
      </div>
      <div class="ticket-row">
        <label class="label-text">Cantidad:</label>
        <div class="input-container">
          <input type="number" :max="ticket.quantity" v-model="ticket.count" @input="validateCount(ticket)" value="1">
        </div>
      </div>
      <div class="error-message">{{ ticket.error }}</div>
    </div>

    <div class="total">
      Total: <span>$ {{ total }}</span>
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
  align-items: center;
}

.title {
  font-size: 2rem; /* Aumenta el tamaño del título */
  margin-bottom: 20px; /* Añade margen inferior al título */
}

.image {
  width: 100px;
  height: 100px;
  object-fit: cover;
  margin-bottom: 20px;
}

.ticket {
  border: none; /* Quita el borde */
  padding: 10px;
}

.ticket-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 5px;
}

.label-text {
  font-size: 1.5rem; /* Aumenta el tamaño del texto de etiqueta */
}

.price {
  font-size: 1.5rem; /* Aumenta el tamaño del precio */
}

.input-container {
  flex-basis: 30%; /* Haz el campo de cantidad más pequeño */
}

input[type="number"] {
  width: 5vw; /* Aumenta el ancho del campo numérico */
  padding: 5px;
  border: 1px solid #ddd; /* Agrega un borde al campo numérico */
  -moz-appearance: textfield; /* Elimina los botones de incremento y decremento en Firefox */
  appearance: textfield; /* Elimina los botones de incremento y decremento en otros navegadores */
}

.error-message {
  color: red;
  margin-top: 5px;
}

.total {
  font-size: 1.5rem;
  margin-top: 20px; /* Añade margen superior al pie de página */
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
  .label-text {
    font-size: 1.3rem; /* Ajusta el tamaño del texto de etiqueta en dispositivos móviles */
  }

  input[type="number"] {
    width: 15vw; /* Ajusta el ancho del campo numérico en dispositivos móviles */
  }
}
</style>
