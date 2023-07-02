<template>
    <div>
        <h1 class="display-6 text-center">Ingresa tus datos para continuar</h1>
        <div class="container-sm" style="max-width: 100%; height: auto;">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control custom-input" id="email" placeholder="Ingresa tu email" v-model="email" @change="onChange" required>
            </div>
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control custom-input" id="name" placeholder="Nombre" v-model="name" @change="onChange" required>
            </div>
            <div class="form-group">
                <label for="identification_number">Cédula:</label>
                <input type="number" class="form-control custom-input" id="identification_number" placeholder="Número de ID" v-model="identification_number" @change="onChange" required>
            </div>
            <div class="form-group">
                <label for="phone">Celular:</label>
                <span>Ej. 0987654321</span>
                <input type="tel" class="form-control custom-input" id="phone" placeholder="Ingresa tu número" v-model="phone" @change="onChange" pattern="^09\d{8}$" required>
            </div>
            <div class="form-group">
                <label for="voucher">Subir comprobante de pago/ transferencia:</label>
                <input type="file" class="form-control-file" id="voucher" @change="onFileChange" required>
            </div>
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
