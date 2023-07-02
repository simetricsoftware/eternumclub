<template>
<div>
    <div class="form-group">
        <label for="identification_number">Número de cédula</label>
        <input type="tel" id="identification_number" :name="`bankAccounts[${index}][identification_number]`" :value="identification_number" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="name">Nómbre</label>
        <input type="text" id="name" :name="`bankAccounts[${index}][name]`" :value="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="bank">Banco</label>
        <input type="text" id="bank" :name="`bankAccounts[${index}][bank]`" :value="bank" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="account_number">Número de cuenta</label>
        <input type="tel" id="account_number" :name="`bankAccounts[${index}][account_number]`" :value="account_number" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="account_type">Tipo de cuenta</label>
        <select id="account_type" class="form-control" :name="`bankAccounts[${index}][account_type]`" :value="account_type" required>
            <option value="savings">Ahorros</option>
            <option value="current">Corriente</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" :name="`bankAccounts[${index}][email]`" :value="email" class="form-control">
    </div>
</div>
</template>

<script>
export default {
    props: ['bankAccount', 'index'],
    data() {
        return {
            identification_number: '',
            name: '',
            bank: '',
            account_number: '',
            account_type: 'savings',
            email: ''
        }
    },
    created() {
        this.identification_number = this.bankAccount.identification_number;
        this.name = this.bankAccount.name;
        this.bank = this.bankAccount.bank;
        this.account_number = this.bankAccount.account_number;
        this.account_type = this.bankAccount.account_type;
        this.email = this.bankAccount.email;
    }
}
</script>
