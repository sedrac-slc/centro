<div class="modal fade m-2 p-1" id="modalUtilizador" tabindex="-1" aria-labelledby="modalUtilizadorTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-item-filter" class="modal-content bg-white rounded" action="{{ route('utilizadores.search') }}">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUtilizadorTitle">Filtros</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="filterSelect">Escolha o filtro:</label>
                    <select class="form-select" name="field" id="filterSelect" aria-label="Floating label select example">
                        <option selected>Campo</option>
                        <option value="name">Nome</option>
                        <option value="email">Email</option>
                        <option value="birthday">Data nascimento</option>
                        <option value="tipo">Tipo</option>
                        <option value="phone">Contacto</option>
                        <option value="gender">Genêro</option>
                     </select>
                </div>
                <div class="form-group" id="filter-div">
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
