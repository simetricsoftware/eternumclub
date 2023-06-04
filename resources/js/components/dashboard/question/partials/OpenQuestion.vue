<template>
<div>
    <h4>Pregunta</h4>
    <input type="text" class="form-control" :name="`questions[${index}][statement]`" placeholder="Enunciado de la pregunta" v-model="statement" required>
</div>
</template>

<script>
export default {
    props: ['question', 'index'],
    data() {
        return {
            statement: ''
        }
    },
    created() {
        this.statement = this.question.statement;
    },
}
</script>
