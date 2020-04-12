<template>
    <div>
        <button :class="`btn btn-sm ${voteType === 'like' ? 'btn-primary' : 'btn-secondary'}`" type="button" name="button" data-toggle="popover" data-container="body" :id="`like-${tag}`" data-placement="top" @click="vote('like')" @mouseover="tooglePopLikes(true)" @mouseleave="tooglePopLikes(false)">
            <font-awesome-icon icon="thumbs-up" />
            <span class="badge badge-light">{{ votes.likes }}</span>
        </button>
        <button :class="`btn btn-sm ${voteType === 'dislike' ? 'btn-primary' : 'btn-secondary'}`" type="button" name="button" data-toggle="popover" data-container="body" :id="`dislike-${tag}`" data-placement="top" @click="vote('dislike')" @mouseover="tooglePopDislikes(true)" @mouseleave="tooglePopDislikes(false)">
            <font-awesome-icon icon="thumbs-down" />
            <span class="badge badge-light">{{ votes.dislikes }}</span>
        </button>
        <div v-show="like" :id="`like-icon-${tag}`">
            <font-awesome-icon icon="heart" />
        </div>
        <div v-show="dislike" :id="`dislike-icon-${tag}`">
            <font-awesome-icon icon="heart-broken" />
        </div>
    </div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faThumbsUp, faThumbsDown, faHeart, faHeartBroken } from '@fortawesome/free-solid-svg-icons'

library.add(faThumbsUp, faThumbsDown, faHeart, faHeartBroken)

export default {
    props: ['votes', 'tag', 'url'],
    components: { FontAwesomeIcon },
    data() {
        return {
            like: false,
            dislike: false
        }
    },
    computed: {
        voteType() {
            let vote = this.votes.user_vote_type
            if (vote) return vote.type
            return null
        },
    },
    methods: {
        vote(vote) {
            axios.put(this.url, { type: vote })
            .then(response => {
                this.$emit('voted')
            })
        },
        tooglePopLikes(status) {
            if(this.voteType === 'like'){
                if(status) $(`#like-${this.tag}`).popover('show')
                else $(`#like-${this.tag}`).popover('hide')
                this.like = true
            }
        },
        tooglePopDislikes(status) {
            if(this.voteType === 'dislike'){
                if(status) $(`#dislike-${this.tag}`).popover('show')
                else $(`#dislike-${this.tag}`).popover('hide')
                this.dislike = true
            }
        }
    },
    mounted() {
        $(() => {
            let like = $(`#like-${this.tag}`)
            like.popover({
                html: true,
                content: $(`#like-icon-${this.tag}`)
            })
            like.popover('update')
            let dislike = $(`#dislike-${this.tag}`)
            dislike.popover({
                html: true,
                content: $(`#dislike-icon-${this.tag}`)
            })
            dislike.popover('update')
        })
    }
}
</script>

<style lang="css" scoped>
</style>
