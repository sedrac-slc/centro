@extends('layouts.dashboard')
@section('painel')
    <form id="form-user" class="modal-content bg-white rounded" action="{{ route('professores.curso_disciplina.store',$professor->user->id) }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">Adicionar curso-disciplina </h5>
            <h6>Professor: {{ $professor->user->name }}</h6>
        </div>
        <div class="modal-body">
                <div class="mb-2">
                    <label for="search-aluno">Digita o curso</label>
                    <input type="search" value="" id="search-aluno" class="form-control">
                </div>
                <div id="table-curso-result"></div>
                <hr/>
                <div class="mb-2" id="curso_disciplina">
                    <label for="search-disciplina">Escolha a disciplina</label>
                </div>
                <div id="table-disciplina-result"></div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-info rounded" href="{{ route('professores.index') }}">
                <i class="fas fa-arrow-left"></i>
                <span>voltar</span>
            </a>
            <button type="submit" class="btn btn-outline-primary rounded">
                <i class="fas fa-save"></i>
                <span id="span-operaction">Cadastra</span>
            </button>
        </div>
    </form>
    <div hidden>
        <input type="hidden" name="" id="url-curso" value="{{ route('cursos.ajax.thenDisciplina') }}">
        <input type="hidden" name="" id="url-disciplina-curso" value="{{ route('disciplinas.ajax.jsonCurso') }}">
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/ajax/disciplina_curso.js') }}"></script>
    <script src="{{ asset('js/ajax/curso_professor.js') }}"></script>
    <script src="{{ asset('js/search/curso_professor.js') }}"></script>
@endsection
