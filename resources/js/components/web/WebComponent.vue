<template>
<div>
    <header-component></header-component>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <router-view :key="$route.path"></router-view>
            </div>
        </div>
    </main>

    <footer-component></footer-component>

</div>
</template>

<script>
import HeaderComponent from './partials/HeaderComponent'
import FooterComponent from './partials/FooterComponent'

export default {
    components: {
        HeaderComponent,
        FooterComponent
    },
    methods: {
        getAuthUser() {
            axios.get('/api/user')
            .then(response => {
                this.$store.state.user = response.data.data
            })
            .catch(error => {
                this.$store.state.user = null
            })
        }
    },
    mounted() {
        this.getAuthUser()
    }
}
</script>
