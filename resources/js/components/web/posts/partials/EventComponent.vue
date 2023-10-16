<template>
    <div>
      <div v-if="post" class="card my-2">

            <!-- Imagen de la tarjeta con enlace al router -->
            
            <div class="card-header text-center">
        <div :class="['overflow-hidden', compact ? 'overflow-image' : '']" style="position: relative;">
          <video class="w-100" id="myVideo" autoplay loop muted>
            <source src="/images/video.mp4" type="video/mp4">
            Tu navegador no soporta la reproducción de videos.
          </video>
          <button id="playButton" @click="toggleVideoPlayback" style="position: absolute; top: 10px; right: 10px; background: #8A2BE2; color: #fff;">
            {{ videoMuted ? "Reproducir" : "Pausar" }} Audio
          </button>
        </div>
      </div>
       
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
        <router-link class="purchase-button" :to="{ name: compact ? 'posts.show' : 'posts.tickets', params: { post: post.slug } }">
        <div >Comprar entradas</div>
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
      url() {
        let post = this.$route.params.post
        return `/api/posts/${post}/vote`
      }
    },

    data (){
      return {
        videoMuted: true
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
      getVotes(votes) {
        if (!votes) return 0
        return votes
      },
      toggleVideoPlayback() {
        const video = document.getElementById("myVideo");
        video.muted=!video.muted;
        this.videoMuted = video.muted  
      }
    }
  }
  </script>

<style lang="scss" scoped>
.overflow-image {
  max-height: 250px;
}

.purchase-button {
  display: inline-block;
  outline: 0;
  text-align: center;
  cursor: pointer;
  padding: 17px 30px;
  border: 0;
  color: #fff;
  font-size: 17.5px;
  background: linear-gradient(45deg, #FF6F61, #8A2BE2);
  line-height: 30px;
  font-weight: 800;
  transition: background, color .1s ease-in-out;
}
</style>
