<template>
  <div>
      <h1 class="display-3 text-center">Eventos</h1>
      <p style="font-size: 1.3rem; margin-top: 40px;">Descubre tus eventos top y compra tus entradas sin moverte de casa. Nuestra plataforma online es fácil de usar y mega segura. Solo explora nuestra súper variedad de eventos y elige el que más te emocione. Tendrás toda la info que necesitas, como fecha, hora, lugar y precios de las entradas. ¡No te lo pierdas!</p>
      <p style="color: ffffff;"><a class="btn btn-primary btn-lg" href="#" role="button">Todos los eventos &raquo;</a></p>

      <recent-posts-component :size="'sm'"></recent-posts-component>

      <hr>
  </div>
</template>

<script>
import RecentPostsComponent from './posts/partials/RecentPostsComponent'
export default {
    components: { RecentPostsComponent }
}
</script>

<style lang="css" scoped>
</style>
