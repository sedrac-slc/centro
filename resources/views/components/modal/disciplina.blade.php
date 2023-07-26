<div class="modal fade m-2 p-1" id="modalDisciplina" tabindex="-1" aria-labelledby="modalDisciplinaTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="form-disciplina" class="modal-content bg-white rounded" action="" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalDisciplinaTitle"></h5>
            </div>
            <div class="modal-body">
                <section id="form-component">
                    @include('components.import.disciplina')
                </section>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary rounded" id="btn-action">
                    <i class="fas fa-check"></i>
                    <span id="span-operaction">Cadastra</span>
                </button>
                <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                </button>
            </div>
        </form>
    </div>
</div>
