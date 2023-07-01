<template>
  <div class="container">
    <h1 class="text-center">Cuentas para transferencia:</h1>

    <div v-for="bank of bankInfo" :key="bank.id" class="bank-info-container">
      <div class="row">
        <span class="small text-muted">Banco:</span>
        <span class="small">{{ bank.bank }}</span>
      </div>
      <div class="row">
        <span class="small text-muted">Número de cuenta:</span>
        <span class="small">{{ bank.account_number }}</span>
      </div>
      <div class="row">
        <span class="small text-muted">Tipo de cuenta:</span>
        <span class="small">{{ bank.account_type }}</span>
      </div>
      <div class="row">
        <span class="small text-muted">Nombre:</span>
        <span class="small">{{ bank.name }}</span>
      </div>
      <div class="row">
        <span class="small text-muted">Número de identificación:</span>
        <span class="small">{{ bank.identification_number }}</span>
      </div>
      <div class="row">
        <span class="small text-muted">Correo electrónico:</span>
        <span class="small">{{ bank.email }}</span>
      </div>
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
      bankInfo: [],
    };
  },

 methods:{
    getBanks() {
      const slug = this.$route.params.post;
      axios.get(`/api/posts/${slug}/bank-accounts`)
        .then(response => {
          this.bankInfo = response.data.data;

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
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.bank-info-container {
  margin-top: 20px;
}

.row {
  margin-top: 10px;
  display: block;
}

.data {
  margin-right: 10px;
  font-size: 1rem;
}
</style>
