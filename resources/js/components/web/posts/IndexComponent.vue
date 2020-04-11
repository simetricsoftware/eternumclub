<template>
<div>
    <div class="row justify-content-center">
        <div class="col-md-2">
            <category-component :active="postsResult.meta.category" @active-category="setCategory"></category-component>
        </div>
        <div class="col-md-10">
            <div v-for="post in postsResult.data"  :key="post.id" class="col-md-12">
                <post-component compact="true" :post="post"></post-component>
            </div>
            <div class="col-md-12">
                <laravel-vue-pagination :data="postsResult" @pagination-change-page="setPage"></laravel-vue-pagination>
                <div>
                    Total {{ postsResult.meta.total }} posts
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>
</template>

<script>
import PostComponent from './partials/PostComponent'
import CategoryComponent from '../categories/CategoryComponent'
import LaravelVuePagination from 'laravel-vue-pagination'
export default {
    components: { PostComponent, LaravelVuePagination, CategoryComponent },
    data() {
        return {
            postsResult: {
                data: [],
                links: {},
                meta: {
                    current_page: 1,
                    category: 'all'
                }
            }
        }
    },
    methods: {
        getPosts() {
            let current_page = this.postsResult.meta.current_page
            let category = this.postsResult.meta.category
            axios.get(`/api/posts?page=${current_page}&category=${category}`)
            .then(response => {
                this.postsResult = response.data
            })
        },
        setCategory(category) {
            this.postsResult.meta.category = category
            this.postsResult.meta.current_page = 1
            this.getPosts()
        },
        setPage(page) {
            this.postsResult.meta.current_page = page
            this.getPosts()
        }
    },
    mounted() {
        this.getPosts()
    }
}
</script>

<style lang="css" scoped>
</style>
