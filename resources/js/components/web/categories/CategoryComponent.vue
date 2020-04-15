<template>
  <div>
      <h3>Categorias</h3>
      <div class="list-group">
          <button :class="['list-group-item', 'list-group-item-action', active === 'all' ? 'active' : '']" @click="emitCategory('all')">Todas</button>
          <button
            :class="['list-group-item', 'list-group-item-action', active === category.title ? 'active' : '']"
            v-for="category in categories"
            :key="category.title"
            @click="emitCategory(category.title)"
            >{{ category.title }}</button>
      </div>
  </div>
</template>

<script>
export default {
    props: ['active'],
    data() {
        return {
            categories: []
        }
    },
    methods: {
        getCategories() {
            axios.get('/api/categories')
            .then(response => {
                this.categories = response.data.data
            })
        },
        emitCategory(category) {
            this.$emit('active-category', category)
        }
    },
    mounted() {
        this.getCategories()
    }
}
</script>

<style lang="css" scoped>
</style>
