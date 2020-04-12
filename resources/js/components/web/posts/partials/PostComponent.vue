<template>
<div>
    <div v-if="post" class="card my-2">
        <div class="card-header">
            <div :class="`overflow-hidden ${ compact ? 'overflow-image' : ''}`">
                <img class="w-100 img-thumbnail" :src="post.image" alt="">
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <span class="badge badge-primary">
                    {{ post.category.title }}
                </span>
                <div class="d-inline" v-if="post.tags">
                    <span class="badge badge-success mr-1" v-for="tag of post.tags">
                        {{ tag.name }}
                    </span>
                </div>
                <div class="float-right">
                    <votes-component class="d-inline" v-if="!compact" :votes="this.post.votes" :tag="this.post.id" :url="url" @voted="$emit('voted')"></votes-component>
                    <div v-else>
                        <font-awesome-icon icon="thumbs-up" />
                        <span class="badge badge-light">{{ post.votes.likes }}</span>
                        <font-awesome-icon icon="thumbs-down" />
                        <span class="badge badge-light">{{ post.votes.dislikes }}</span>
                    </div>
                </div>
            </div>
            <hr>
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
        <div class="card-footer">
            <p>
                <router-link class="btn btn-secondary" v-if="compact" :to="{ name: 'posts.show', params: {post: post.slug} }">Ver detalles &raquo;</router-link>
                <router-link class="btn btn-secondary" v-else :to="{ name: 'posts' }">Ir a los pots</router-link>
            </p>
        </div>
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
        truncate(text, n = 100, useWordBoundary = true) {
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
