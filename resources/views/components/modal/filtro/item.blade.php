<div class="modal fade m-2 p-1" id="modalItemFiltro" tabindex="-1" aria-labelledby="modalItemFiltroTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-item-filter" class="modal-content bg-white rounded" action="{{ route('items.search') }}">
            <div class="modal-header">
                <h5 class="modal-title" id="modalItemFiltroTitle">Filtros</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="filterSelect">Escolha o filtro:</label>
                    <select class="form-select" name="field" id="filterSelect" aria-label="Floating label select example">
                        <option selected>Campo</option>
                        <option value="medicamento">Medicamento</option>
                        <option value="codigo">Código</option>
                        <option value="data_validade">Data válidade</option>
                        <option value="ano_validade">Ano válidade</option>
                        <option value="mes_validade">Mês válidade</option>
                        <option value="fora_do_prazo">Fora do prazo de válidade</option>
                        <option class="text-danger" value="fora_do_prazo_elim">Apagar (fora do prazo)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="filterSearch">Digita (a pesquisa):</label>
                    <input type="text" id="filterSearch" name="search" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary rounded">
                    <i class="fas fa-search"></i>
                    <span>Pesquisar</span>
                </button>
                <button type="button" class="btn btn-outline-danger rounded" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                </button>
            </div>
        </form>
    </div>
</div>
