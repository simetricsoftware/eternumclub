<template>
<div class="container">
    <div class="row">
        <div v-if="formBankAccounts.length" class="col-12 col-sm-8">
            <div v-for="(formBankAccount, index) of formBankAccounts" :key="`${index}-bank-account-${formBankAccount.account_number}`">
                <h3>
                    Número de cuenta {{ index + 1 }}
                    <button class="btn btn-danger" type="button" @click="formBankAccounts.splice(index, 1)">
                        <i class="fas fa-trash"></i>
                    </button>
                </h3>
                <bank-account :bank-account="formBankAccount" :index="index"></bank-account>
                <hr>
            </div>
        </div>
        <div v-else>
            <div class="col-12 col-sm-8">
                <p>No hay cuentas bancarias</p>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-sm-8">
            <button class="btn btn-primary" type="button" @click="addQuestion">Añadir cuenta bancaria</button>
            <button class="btn btn-success" type="submit">Guardar</button>
        </div>
    </div>
</div>
</template>

<script>
import BankAccount from './partials/BankAccountForm.vue';

export default {
    components: {
        BankAccount
    },
    props: ['bankAccounts'],
    data() {
        return {
            formBankAccounts: [],
        }
    },
    created() {
        this.formBankAccounts = [...this.bankAccounts];
    },
    methods: {
        addQuestion() {
            this.formBankAccounts.push({
                type: 'open',
                statement: '',
                options: []
            });
        },
    }
}
</script>
