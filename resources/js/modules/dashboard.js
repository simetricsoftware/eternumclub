require('./quill.js');

/*
* Modal de confirmación para eliminar un registro desde la vista index
*/
window.onload = () => {

    $('#confirmDelete').on('show.bs.modal', event => {
        let button = $(event.relatedTarget)
        let id = button.data('id')

        let action = $('#row-delete').attr('data-action') +'/'+ id
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
