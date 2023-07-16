<div class="modal fade m-2 p-1" id="modalItemFiltro" tabindex="-1" aria-labelledby="modalItemFiltroTitle" aria-hidden="true">
    <div class="modal-dialog">
      <div id="form-item-filter" class="modal-content bg-white rounded">
        @csrf
        @method('POST')
        <div class="modal-header">
          <h5 class="modal-title" id="modalItemFiltroTitle">Filtros</h5>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
                <span>Cancelar</span>
              </button>
        </div>
    </div>
    </div>
  </div>
