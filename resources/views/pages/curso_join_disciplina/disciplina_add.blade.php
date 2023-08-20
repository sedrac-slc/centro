@extends('layouts.dashboard')
@section('painel')
    <form id="form-user" class="modal-content bg-white rounded" action="{{ route('curso-disciplina.store') }}" method="POST">
        @csrf
        @method('post')
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">Adicionar disciplina</h5>
            <h6>Curso: {{ $curso->nome }}</h6>
        </div>
        <div class="modal-body">
            <div class="mb-2">
                <label for="search-disciplina">Digita a disciplina</label>
                <input type="search" value="" id="search-disciplina" class="form-control">
            </div>
            <div id="table-disciplina-result"></div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-info rounded" href="{{ route('cursos.index') }}">
                <i class="fas fa-arrow-left"></i>
                <span>voltar</span>
            </a>
            <button type="submit" class="btn btn-outline-primary rounded">
                <i class="fas fa-save"></i>
                <span id="span-operaction">Cadastra</span>
            </button>
        </div>
        <input type="hidden" name="curso_id" value="{{ $curso->id }}">
    </form>
    <div hidden>
        <input type="hidden" name="" id="url-disciplina-curso" value="{{ route('disciplinas.ajax') }}">
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/ajax/disciplina.js') }}"></script>
    <script src="{{ asset('js/search/disciplina.js') }}"></script>
@endsection
