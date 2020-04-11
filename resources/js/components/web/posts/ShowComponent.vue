<template>
  <div>
      <div class="row justify-content-center">
          <div class="col-sm-12">
              <post-component :compact="false" @voted="getPost" :post="post"></post-component>
              <div class="row">
                  <div class="col-sm-8">
                      <comment-box-component @voted="getPost"></comment-box-component>
                  </div>
                  <div class="col-sm-4">
                      <div class="overflow-auto">
                          <recent-posts-component :size="'lg'"></recent-posts-component>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import PostComponent from './partials/PostComponent'
import RecentPostsComponent from './partials/RecentPostsComponent'
import CommentBoxComponent from '../comments/CommentBoxComponent'
export default {
    components: { RecentPostsComponent, PostComponent, CommentBoxComponent },
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
