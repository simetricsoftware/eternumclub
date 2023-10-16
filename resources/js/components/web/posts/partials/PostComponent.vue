<template>
    <div>
      <div v-if="post" class="card my-2">
        <!-- Tarjeta -->
        <div class="card-body">
          <div v-if="compact">
            <h2>{{ truncate(post.title, 20) }}</h2>
            <div>
              <p>{{ convertPlainText(post.content) }}</p>
            </div>
          </div>
          <div v-else>
            <h2>{{ post.title }}</h2>
            <div class="card-body ql-container ql-snow">
              <div class="ql-editor">
                <p v-html="post.content"></p>
              </div>
            </div>
          </div>
        </div>
        <!-- Fin Tarjeta -->
  
        <!-- Imagen de la tarjeta con enlace al router -->
        <router-link :to="{ name: compact ? 'posts.show' : 'posts.tickets', params: { post: post.slug } }">
          <div class="card-header text-center">
            <div :class="['overflow-hidden', compact ? 'overflow-image' : '']">
              <img class="w-100 img-thumbnail" :src="post.image" alt="Imagen no encontrada">
            </div>
          </div>
        </router-link>
  
      </div>
    </div>
  </template>
  

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faThumbsUp, faThumbsDown } from '@fortawesome/free-solid-svg-icons'
import VotesComponent from '../../partials/VotesComponent'

library.add(faThumbsUp, faThumbsDown)

export default {
    props: ['post', 'compact'],
    components: { FontAwesomeIcon, VotesComponent },
    computed: {
        url(){
            let post = this.$route.params.post
            return `/api/posts/${post}/vote`
        }
    },
    methods: {
        truncate(text, n = 20, useWordBoundary = true) {
            if (text.length <= n || !this.compact) return text
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
        getVotes(votes){
            if (!votes) return 0
            return votes
        }
    }
}
</script>

<style lang="scss" scoped>
.overflow-image {
    max-height: 250px;
}
</style>
