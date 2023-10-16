<template>
  <div class="container text-center">
    <h1 class="display-4">¡Gracias por tu compra!</h1>
    <p class="lead">Apreciamos tu apoyo y confianza.</p>
    <img src="./eternum_ico.png" alt="Imagen de agradecimiento" class="image">
  </div>
</template>

<script>
export default {
  beforeRouteEnter(to, from, next) {
    // Esta función se ejecutará antes de que la ruta se active
    window.scrollTo(0, 0); // Lleva al usuario al principio de la ventana
    next();
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

.image {
  width: 300px;
  height: 300px;
  object-fit: cover;
  margin-top: 20px;
}
</style>
