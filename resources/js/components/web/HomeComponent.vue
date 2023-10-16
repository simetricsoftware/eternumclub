<template>
  <div>
    <div class="carousel-container">
      <b-carousel :controls="true" :indicators="true" :interval="8000" :background="'#000000'" :style="{ maxHeight: '500px' }">
        <b-carousel-slide img-src="images/banner1.gif"></b-carousel-slide>
        <b-carousel-slide img-src="images/banner2.gif"></b-carousel-slide>
        <b-carousel-slide img-src="images/banner3.gif"></b-carousel-slide>
      </b-carousel>
    </div>
  
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
.carousel-container {
  margin-top: 40px;
}

.carousel-control-prev,
.carousel-control-next {
  background-color: #ff0000;
  width: 50px;
  height: 50px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: #ffffff;
  width: 20px;
  height: 20px;
}
</style>
