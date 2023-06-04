<template>
<div>
    <div class="form-group">
        <label for="type">Tipo de pregunta</label>
        <div class="input-group">
            <select name="type" id="type" class="form-control" v-model="type">
                <option value="open">Abierta</option>
                <option value="multiple">Multiple</option>
                <option value="radio">Radio</option>
                <option value="dropdown">Lista</option>
            </select>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i v-if="type === 'open'" class="fa-solid fa-font"></i>
                    <i v-if="type === 'multiple'" class="fa-solid fa-square-check"></i>
                    <i v-if="type === 'radio'" class="fa-solid fa-circle-dot"></i>
                    <i v-if="type === 'dropdown'" class="fa-solid fa-caret-down"></i>
                </span>
            </div>
        </div>
    </div>
    <input type="hidden" :name="`questions[${index}][type]`" :value="type">
    <open-question v-if="type === 'open'" :question="question" :index="index"></open-question>
    <multiple-question v-if="['multiple', 'radio', 'dropdown'].includes(type)" :question="question" :index="index"></multiple-question>
</div>
</template>

<script>
import OpenQuestion from './OpenQuestion';
import MultipleQuestion from './MultipleQuestion';
export default {
    components: {
        OpenQuestion,
        MultipleQuestion
    },
    props: ['question', 'index'],
    data() {
        return {
            type: 'open'
        }
    },
    methods: {
        updateStatement(statement) {
            this.$emit('updateStatement', statement);
        }
    },
    created() {
        this.type = this.question.type;
    }
}
</script>
