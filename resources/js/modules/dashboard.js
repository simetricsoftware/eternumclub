import Vue from 'vue';
require('./quill.js');

/*
* Modal de confirmación para eliminar un registro desde la vista index
*/
window.onload = () => {

    $('#confirmDelete').on('show.bs.modal', event => {
        let button = $(event.relatedTarget)
        const id = button.data('id')
        const current = button.data('current')

        let action = $('#row-delete').attr('data-action') + (current ? '' : ('/'+ id))
        $('#row-delete').attr('action', action)

        let modal = $(this)
        modal.find('.modal-title').text('Se eliminará el registro con id ' + id)

    })

    $('#confirm-delete-user').on('show.bs.modal', event => {
        let button = $(event.relatedTarget)
        let id = button.data('id')
        let status = button.data('status')

        $('#toogle-user-status').attr('value', status ? 'Restaurar' : 'Eliminar' )

        let url = $('#user-delete').attr('data-url')
        let action = `${url}/${status ? 'restore' : 'delete'}/${id}`
        $('#user-delete').attr('action', action)
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('questions-component', require('../components/dashboard/question/QuestionsComponent.vue').default);
Vue.component('bank-accounts-component', require('../components/dashboard/bank-account/BankAccountsComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.getElementById('app')) {
    new Vue({
        el: '#app',
    });
}
