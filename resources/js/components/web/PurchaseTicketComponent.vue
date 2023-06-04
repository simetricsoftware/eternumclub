<template>
  <div class="container">
    <h1 class="text-center">Información de Entrada</h1>

    <img src="./eternum_ico.png" alt="Imagen" class="image">

    <div class="form-group">
      <label for="inputType">Tipo de Entrada:</label>
      <input type="text" class="form-control" id="inputType" v-model="entrada.tipo" readonly>
    </div>

    <div class="form-group">
      <label for="inputCantidad">Cantidad de Entradas:</label>
      <input type="number" class="form-control" id="inputCantidad" v-model="cantidadEntradas" @input="validateCantidadEntradas">
    </div>

    <div v-if="entrada.tipo && cantidadEntradas > 0">
      <h3>Información de la Entrada:</h3>
      <p>Tipo: {{ entrada.tipo }}</p>
      <p>Cantidad: {{ cantidadEntradas }}</p>
      <button class="btn btn-primary" @click="continuar">Continuar</button>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
  components: {
    FontAwesomeIcon
  },
  data() {
    return {
      entrada: {
        tipo: 'Ejemplo de Tipo de Entrada'
      },
      cantidadEntradas: 0,
      cantidades: [1, 2, 3, 4, 5],
      mostrarBoton: false
    };
  },
  methods: {
    validateCantidadEntradas() {
      if (this.cantidadEntradas < 0) {
        this.cantidadEntradas = 0;
      }

      this.mostrarBoton = this.cantidadEntradas > 0;
    },
    continuar() {
      // Lógica para continuar después de validar la cantidad de entradas
      console.log("Continuar");
    }
  },
  created() {
    // Recibir el dato numérico del otro sistema y asignarlo a cantidadEntradas
    const datoNumerico = obtenerDatoNumericoDelOtroSistema(); // Reemplaza obtenerDatoNumericoDelOtroSistema() con la lógica para obtener el dato numérico
    this.cantidadEntradas = datoNumerico;
    this.mostrarBoton = this.cantidadEntradas > 0;
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
}

.image {
  width: 150px;
  height: 150px;
  object-fit: cover;
  margin-bottom: 20px;
}

@media (max-width: 576px) {
  .form-group {
    max-width: 100%;
  }
}
</style>
