<template>
<div>
    <h4>Pregunta</h4>
    <input type="text" class="form-control" :name="`questions[${index}][statement]`" placeholder="Enunciado de la pregunta" v-model="statement" required>
    <div class="mt-3">
        <h4>Opciones (Mínimo una opción)</h4>
        <div v-if="opts.length" v-for="(opt, idx) of opts" class="input-group mb-3" :key="`${index}-option-${idx}-${opt.statement}`">
            <input type="text" class="form-control" :name="`questions[${index}][options][]`" placeholder="Opción" v-model="optValues[idx]" required>
            <div class="input-group-append">
                <button class="btn btn-danger" type="button" @click="removeOption(idx)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-secondary" type="button" @click="addOption">
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>
</template>

<script>
export default {
    props: ['question', 'index'],
    data() {
        return {
            opts: [],
            optValues: [],
            statement: ''
        }
    },
    methods: {
        addOption() {
            let newOption = '';
            this.opts.push(newOption);
        },
        removeOption(index) {
            this.opts.splice(index, 1);
            this.optValues.splice(index, 1);
        }
    },
    created() {
        this.opts = [...this.question.options || []];
        this.optValues = this.opts.map((opt) => opt);
        this.statement = this.question.statement;
    }
}
</script>
