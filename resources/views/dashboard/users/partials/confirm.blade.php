<div class="modal fade" id="confirm-delete-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro en eliminar estas seguro en eliminar este usuario?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>No podrás efectuar acciónes sobre él hasta que se vuelva a activar</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form id="user-delete" action="" data-url="{{ url()->current() }}" method="post">
            @csrf
            @method('PUT')
            <input id="toogle-user-status" class="btn btn-warning" type="submit" data-toggle="modal" value="">
        </form>
      </div>
    </div>
  </div>
</div>
