<template>
    <div>
        <div class="container">
            <div class="row">
                <form @submit.prevent="handleSubmit">
                    <div class="col-6 m-auto">
                        <purchase-component @change="onChangeBasicData($event)"></purchase-component>
                        <div class="text-center">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bankModal">
                                <i class="fas fa-university mr-2"></i>
                                Ver información bancaria
                            </button>
                        </div>
                        <div class="total_price"> Total {{ total }}</div>
                        <!-- Modal -->
                        <div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="bankModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bankModalLabel">Información Bancaria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <bank-info-component></bank-info-component>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="margins">
                            <div v-for="question of questions">
                                <open-question-component v-if="question.type === 'open'" :question="question.statement" v-model="question.answer"></open-question-component>
                                <multiple-question-component v-if="question.type === 'multiple'" :question="question.statement" v-model="question.answer" :options="question.options"></multiple-question-component>
                                <radio-question-component v-if="question.type === 'radio'" :question="question.statement" v-model="question.answer" :options="question.options"></radio-question-component>
                                <select-question-component v-if="question.type === 'dropdown'" :question="question.statement" v-model="question.answer" :options="question.options"></select-question-component>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary custom-button">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
.margins > * {
    margin-bottom: 50px;
    margin-top: 50px;
}

.total_price {
    font-size: 1.5rem;
    text-align: center;
}
</style>

<script>
import PurchaseComponent from './PurchaseComponent.vue'
import OpenQuestionComponent from './OpenQuestionComponent.vue'
import MultipleQuestionComponent from './MultipleQuestionComponent.vue'
import RadioQuestionComponent from './RadioQuestionComponent.vue'
import SelectQuestionComponent from './SelectQuestionComponent.vue'
import BankInfoComponent from './BankInfoComponent.vue'

export default {
    components: { OpenQuestionComponent, MultipleQuestionComponent, RadioQuestionComponent, SelectQuestionComponent, PurchaseComponent, BankInfoComponent },
    computed: {
        total() {
            return this.ticketTypes.reduce((previous, current) => {
                return previous + current.amount;
            }, 0)
        },
        ticketTypes() {
            return this.$store.state.tickets;
        },
        slug() {
            return this.$route.params.post;
        }
    },
    data() {
        return {
            basicData: {},
            questions: [],
        }
    },

    methods: {
        getBanks() {
            axios.get(`/api/posts/${this.slug}/bank-accounts`)
                .then((response) => {
                    this.bankInfo = response.data.data;
                });
        },
        getQuestions() {
            axios.get(`/api/posts/${this.slug}/questions`)
                .then((response) => {
                    this.questions = response.data.data;
                });
        },
        checkInvalidTotal() {
            if (this.total === 0) {
                this.$router.push({ name: 'posts.tickets', params: { post: this.$route.params.post } })
            }
        },
        onChangeBasicData(event) {
            this.basicData = event;
        },
        handleSubmit() {
            const formData = new FormData()

            formData.append('assistant[name]', this.basicData.name)
            formData.append('assistant[email]', this.basicData.email)
            formData.append('assistant[phone]', this.basicData.phone)
            formData.append('assistant[identification_number]', this.basicData.identification_number)
            formData.append('assistant[voucher]', this.basicData.voucher)
            this.questions.forEach((question, index) => {
                formData.append(`answers[${index}][question_id]`, +question.id)
                formData.append(`answers[${index}][response]`, question.answer)
            })
            this.ticketTypes.forEach((ticketType, index) => {
                formData.append(`tickets[${index}][ticket_type_id]`, ticketType.id)
                formData.append(`tickets[${index}][quantity]`, ticketType.count)
            })

            axios.post(`/api/posts/${this.slug}/tickets`, formData)
                .then(() => {
                    this.$router.push({ name: 'thanks' })
                })
        }
    },

    created() {
        // Recibir el dato numérico del otro sistema y asignarlo a
        this.getBanks();
        this.getQuestions();
        this.checkInvalidTotal();
    }
}
</script>

<style lang="css" scoped>
</style>

