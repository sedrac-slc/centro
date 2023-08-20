@extends('layouts.dashboard')
@section('painel')
    <form id="form-user" class="modal-content bg-white rounded" action="{{ route('aluno-curso.store',$aluno->user->id) }}" method="POST">
        @csrf
        @method('post')
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">Adicionar curso</h5>
            <h6>Aluno: {{ $aluno->user->name }}</h6>
        </div>
        <div class="modal-body">
            <div class="mb-2">
                <label for="search-aluno">Digita o curso</label>
                <input type="search" value="" id="search-aluno" class="form-control">
            </div>
            <div id="table-curso-result"></div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-info rounded" href="{{ route('alunos.index') }}">
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
        <input type="hidden" name="" id="url-curso" value="{{ route('cursos.ajax') }}">
    </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/ajax/curso_aluno.js') }}"></script>
    <script src="{{ asset('js/search/curso_aluno.js') }}"></script>
@endsection
