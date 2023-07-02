<template>
<div>
    <footer class="container">
        <p class="text-center">Eternum Club is powered by &copy; Simetric Software {{ year }}</p>
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
