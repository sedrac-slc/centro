<div class="modal fade m-2 p-1" id="modalLogaut" tabindex="-1" aria-labelledby="modalLogautTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm ">
      <form id="form-del" class="modal-content bg-white rounded" action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" id="modalLogautTitle">Fechar a conta</h5>
        </div>
        <div class="modal-body">
            Tens certeza que desejas sair da sua conta
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
