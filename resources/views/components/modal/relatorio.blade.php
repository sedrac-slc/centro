<div class="modal fade m-2 p-1" id="modalRelatorio" tabindex="-1" aria-labelledby="modalRelatorioTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="form-relatorio" class="modal-content bg-white rounded" action="{{ route('relatoria') }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="modalRelatorioTitle">
                    <i class="fas fa-file-pdf"></i>
                    <span>Relatório</span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="filterSelect">Tipo impressão:</label>
                    <select class="form-select" name="tipo_impressao" id="tipoImpressaoRelatorio" aria-label="Floating label select example" required>
                        <option selected>Escolha o tipo de impressão</option>
                        <option value="simplificada">Simplificada</option>
                        <option value="detalhada">Detalhada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="filterSelect">Periódo:</label>
                    <select class="form-select" name="periodo" id="periodoRelatorio" aria-label="Floating label select example" required>
                        <option selected>Seleciona o periódo</option>
                        <option value="diario">Diário</option>
                        <option value="mensal">Mensal</option>
                        <option value="anual">Anual</option>
                    </select>
                </div>
                <div class="form-group" id="campoRelatorio">
                    <label for="valueRelatorio">Digita o (periódo):</label>
                    <input type="date" id="valueRelatorio" name="value" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary rounded">
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
