<template>
  <div>
      <div class="row justify-content-center">
          <div class="col-sm-12">
              <event-component :compact="false" @voted="getPost" :post="post"></event-component>
              
          </div>
      </div>
  </div>
</template>

<script>
import EventComponent from './partials/EventComponent'
import RecentPostsComponent from './partials/RecentPostsComponent'
import CommentBoxComponent from '../comments/CommentBoxComponent'
export default {
    components: { RecentPostsComponent, EventComponent, CommentBoxComponent },
    data() {
        return {
            post: null
        }
    },
    methods: {
        getPost() {
            let post = this.$route.params.post
            axios.get('/api/posts/'+post)
            .then(response => {
                this.post = response.data.data
            })
            .catch(error => {
                this.$router.push({ name: '404' })
            })
        }
    },
    mounted() {
        this.getPost()
    }
}
</script>

<style lang="css" scoped>
</style>
