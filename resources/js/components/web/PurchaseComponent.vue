<template>
  <div>
    <h1 class="display-6 text-center" >Ingresa tus datos para continuar</h1>
      <div class="container-sm" style="max-width: 100%; height: auto;">
        <form>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control custom-input" id="email" placeholder="Ingresa tu email" v-model="email">
          </div>
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control custom-input" id="nombre" placeholder="Nombre" v-model="nombre">
          </div>
          <div class="form-group">
            <label for="cedula">Cédula:</label>
            <input type="text" class="form-control custom-input" id="cedula" placeholder="Número de ID" v-model="cedula">
          </div>
          <div class="form-group">
            <label for="celular">Celular:</label>
            <input type="text" class="form-control custom-input" id="celular" placeholder="Ingresa tu número" v-model="celular">
          </div>
          <div class="form-group">
            <label for="imagen">Subir comprobante de pago/ transferencia:</label>
            <input type="file" class="form-control-file" id="imagen" @change="onFileChange">
          </div>
          <button type="submit" class="btn btn-primary custom-button">Enviar</button>
        </form>
      </div>
    <hr>
  </div>
</template>


<script>
import RecentPostsComponent from './posts/partials/RecentPostsComponent'

export default {
  components: {
    RecentPostsComponent
  },
  data() {
    return {
      email: "",
      nombre: "",
      cedula: "",
      celular: "",
      imagen: null
    };
  },
  methods: {
    onFileChange(event) {
      this.imagen = event.target.files[0];
    }
  }
}
</script>

<style lang="css" scoped>
</style>
