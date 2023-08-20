<div class="modal fade m-2 p-1" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm ">
      <form id="form-del" class="modal-content bg-white rounded" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="modalDeleteTitle">{{$title}}</h5>
        </div>
        <div class="modal-body">
            {{ $message }}
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary rounded" id="btn-action">
            <i class="fas fa-save"></i>
            <span id="span-operaction">Confirmo!</span>
          </button>
          <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancelar</span>
          </button>
        </div>
      </form>
    </div>
  </div>
