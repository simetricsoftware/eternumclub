<template>
<div class="container">
    <div class="row">
        <div v-if="formQuestions.length" class="col-12 col-sm-8">
            <div v-for="(question, index) of formQuestions" :key="`${index}-question-${question.statement}`">
                <h3>
                    Pregunta {{ index + 1 }}
                    <button class="btn btn-danger" type="button" @click="formQuestions.splice(index, 1)">
                        <i class="fas fa-trash"></i>
                    </button>
                </h3>
                <question-selector :question="question" :index="index"></question-selector>
                <hr>
            </div>
        </div>
        <div v-else>
            <div class="col-12 col-sm-8">
                <p>No hay preguntas</p>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-sm-8">
            <button class="btn btn-primary" type="button" @click="addQuestion">Añadir pregunta</button>
            <button class="btn btn-success" type="submit">Guardar</button>
        </div>
    </div>
</div>
</template>

<script>
import OpenQuestion from './partials/OpenQuestion';
import QuestionSelector from './partials/QuestionSelector';
export default {
    components: {
        OpenQuestion,
        QuestionSelector
    },
    props: ['questions'],
    data() {
        return {
            formQuestions: [],
        }
    },
    created() {
        this.formQuestions = [...this.questions];
    },
    methods: {
        addQuestion() {
            this.formQuestions.push({
                type: 'open',
                statement: '',
                options: []
            });
        }
    }
}
</script>
