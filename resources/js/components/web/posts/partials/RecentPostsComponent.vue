<template>
  <div>
      <div class="container">
          <div class="row">
              <div v-for="post in posts" :key="post.id" :class="sizeClass">
                  <post-component :compact="true" :post="post"></post-component>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import PostComponent from './PostComponent'
export default {
    props: ['size'],
    components: { PostComponent },
    computed: {
        sizeClass() {
            switch (this.size) {
                case 'lg':
                    return 'col-sm-12'
                    break
                case 'sm':
                    return 'col-sm-4'
                    break
                default:
                    return 'col-sm-8'
            }
        }
    },
    data() {
        return {
            posts: []
        }
    },
    methods: {
        getPosts() {
            let post = this.$route.params.post
            axios.get(`/api/posts/recents${post ? '?curren_post='+post : ''}`)
            .then(response => {
                this.posts = response.data.data
            })
        }
    },
    mounted() {
        this.getPosts()
    }
}
</script>

<style lang="css" scoped>
</style>
