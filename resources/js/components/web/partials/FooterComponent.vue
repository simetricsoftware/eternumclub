<template>
<div>
    <footer class="container">
        <p class="text-center">&copy; Developed with <font-awesome-icon :icon="heart" /> by Christian Albán</p>
    </footer>
</div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faHeart } from '@fortawesome/free-solid-svg-icons'

export default {
    components:{ FontAwesomeIcon },
    data() {
        return {
            heart: faHeart
        }
    }
}
</script>

<style lang="css" scoped>
</style>
