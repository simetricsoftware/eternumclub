<template>
<div>
    <footer class="container">
        <p class="text-center">Simetric Club is powered by &copy; <a href="https://www.simetricsoftware.com/"  target="blank">Simetric Software</a> {{ year }}</p>
    </footer>
</div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faHeart } from '@fortawesome/free-solid-svg-icons'

export default {
    components:{ FontAwesomeIcon },
    computed: {
        year() {
            return new Date().getFullYear();
        }
    },
    data() {
        return {
            heart: faHeart
        }
    }
}
</script>

<style lang="css" scoped>
</style>
