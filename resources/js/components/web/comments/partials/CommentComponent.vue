<template>
<div>
    <div @mouseover="hover = true" @mouseleave="hover = false">
        <label><strong>{{ comment.user.name }}</strong></label>
        <span>{{ time }}</span>
        <div class="d-inline" v-if="showActions">
            <button class="btn btn-sm btn-success" type="button" v-show="!isEditing" @click="toogleEdit" name="button">
                <font-awesome-icon icon="pen" />
            </button>
            <div class="btn-group" v-show="isEditing" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-success" @click="editComment">Guardar</button>
                <button type="button" class="btn btn-sm btn-secondary" @click="toogleEdit">Cancelar</button>
            </div>
            <button class="btn btn-sm btn-danger" type="button" name="button" v-show="!isDeleting" @click="toogleDelete">
                <font-awesome-icon icon="trash" />
            </button>
            <div class="btn-group" v-show="isDeleting" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-danger" @click="deleteComment">Confirmar</button>
                <button type="button" class="btn btn-sm btn-secondary" @click="toogleDelete">Cancelar</button>
            </div>
        </div>

        <div class="float-right">
            <votes-component :votes="this.comment.votes" :tag="this.comment.id" :url="url" @voted="$emit('success-response', 'voted')"></votes-component>
        </div>

        <p v-show="!isEditing">
            {{ comment.content }}
        </p>

        <textarea class="form-control my-2" v-show="isEditing" v-model="comment.content"></textarea>
    </div>
</div>
</template>

<script>
import { mapState } from 'vuex'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPen, faTrash } from '@fortawesome/free-solid-svg-icons'
import VotesComponent from '../../partials/VotesComponent'
import moment from 'moment'

moment.locale('es')
library.add(faPen, faTrash)

export default {
    props: ['comment'],
    components: { FontAwesomeIcon, VotesComponent },
    computed: {
        time() {
            return moment(this.comment.ago).fromNow()
        },
        url(){
            let post = this.$route.params.post
            return `/api/posts/${post}/comments/${this.comment.id}/vote`
        },
        showActions() {
            let showActions
            if (this.user) {
                showActions = showActions || this.user.role.name === 'admin' || this.user.id === this.comment.user.id
            }
            return showActions && this.hover || this.isEditing || this.isDeleting
        },
        ...mapState([
            'user'
        ])
    },
    data() {
        return {
            hover: false,
            isEditing: false,
            isDeleting: false,
        }
    },
    methods: {
        deleteComment() {
            let post = this.$route.params.post
            axios.delete(`/api/posts/${post}/comments/${this.comment.id}`)
                .then(response => {
                    this.$emit('success-response', 'Comentario eliminado correctamente')
                })
                .catch(error => {
                    this.$emit('error-response', 'No se pudo eliminar el comentario')
                })
        },
        editComment() {
            let post = this.$route.params.post
            axios.put(`/api/posts/${post}/comments/${this.comment.id}`, {
                    content: this.comment.content
                })
                .then(response => {
                    this.isEditing = false
                    this.$emit('success-response', 'Comentario editado correctamente')
                })
                .catch(error => {
                    this.$emit('error-response', 'No se pudo editar el comentario')
                })
        },
        toogleEdit() {
            this.isEditing = !this.isEditing
        },
        toogleDelete() {
            this.isDeleting = !this.isDeleting
        }
    },
}
</script>

<style lang="css" scoped>
</style>
