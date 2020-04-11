<template>
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" v-show="message">
                {{ message }}
                <button type="button" class="close" aria-label="Close" @click="dismissSuccess">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show" v-show="error">
                {{ error }}
                <button type="button" class="close"  aria-label="Close" @click="dismissError">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div v-if="$store.state.user" class="form-group">
                <label for="comments">Comentarios</label>
                <textarea class="form-control" id="comments" name="comments" placeholder="Escribe un comentario" v-model="content"></textarea>
                <button class="btn btn-primary my-2 float-right" type="button" name="button" @click="publicComment">Publicar</button>
            </div>
            <div v-else class="text-center">
                <a href="/login">
                    Inicia sesión para realizar comentarios
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item my-2" v-for="comment in comments" :key="comment.id">
                    <comment-component @success-response="succesResponse" @error-response="errorResponse" :comment="comment"></comment-component>
                </li>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
import CommentComponent from './partials/CommentComponent'
export default {
    props: ['post'],
    components: {
        CommentComponent
    },
    data() {
        return {
            comments: [],
            content: '',
            message: '',
            error: ''
        }
    },
    methods: {
        getComments() {
            let post = this.$route.params.post
            axios.get(`/api/posts/${post}/comments`)
                .then(response => {
                    this.comments = response.data.data
                })
        },
        publicComment() {
            let post = this.$route.params.post
            axios.post(`/api/posts/${post}/comments`, {content: this.content})
                .then(response => {
                    this.content = ''
                    this.succesResponse('Comentario publicado correctamente')
                })
                .catch(error => {
                    this.error = 'No se pudo publicar el comentario'
                })
        },
        succesResponse(message){
            if(message === 'voted') this.$emit('voted')
            else this.message = message
            this.getComments()
        },
        errorResponse(error) {
            this.error = error
        },
        dismissSuccess() {
            this.message = ''
        },
        dismissError() {
            this.error = ''
        }
    },
    mounted() {
        this.getComments()
    }
}
</script>

<style lang="css" scoped>
</style>
