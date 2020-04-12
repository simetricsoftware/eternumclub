<template>
  <div>
      <div class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" id="search-box" placeholder="Buscar" aria-label="Buscar" @click="box = true" v-model="keyword">
      </div>
      <div v-show="box" id="results-box">
          <div class="overflow-auto" v-if="posts.length > 0" style="max-height: 300px;">
              <div class="list-group">
                  <router-link class="list-group-item list-group-item-action" :to="{ name: 'posts.show', params: { post: post.slug } }" v-for="post of posts" :key="post.id">
                      <strong>{{ post.title }}</strong>
                      <p>{{ convertPlainText(post.content) }}</p>
                  </router-link>
              </div>
          </div>
          <div v-else>
              Sin resultados
          </div>
      </div>
  </div>
</template>

<script>
export default {
    computed:{
        showPopUp(){
            if(this.posts) return true
            return false
        }
    },
    data() {
        return {
            keyword: '',
            posts: [],
            box: false
        }
    },
    watch: {
        keyword(newKeyword, oldKeyword) {
            this.debouncedGetPosts()
        }
    },
    methods: {
        getPosts() {
            this.posts = []
            if(this.keyword !== '') {
                axios(`/api/posts?search=${this.keyword}`)
                .then(response => {
                    this.posts = response.data.data
                })
            }
        },
        truncate(text, n = 100, useWordBoundary = true) {
            if (text.length <= n) return text
            let subString = text.substring(0, n - 1)
            return (useWordBoundary ?
                subString.substr(0, subString.lastIndexOf(' ')) :
                subString) + "..."
        },
        convertPlainText(html) {
            let tag = document.createElement('div')
            tag.innerHTML = html
            return this.truncate(tag.innerText)
        },
    },
    created() {
        this.debouncedGetPosts = _.debounce(this.getPosts, 500)
        $(() => {
            $('#search-box').popover({
                html: true,
                content: $('#results-box'),
                placement: 'bottom',
                trigger: 'focus'
            })
        })
    }
}
</script>

<style lang="css" scoped>
</style>
