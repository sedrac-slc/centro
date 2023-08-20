@extends('layouts.dashboard')
@php
    $is_edit = isset($nota);
    $data = ['rounded' => true];
    $method = $is_edit ? 'PUT' : 'POST';
@endphp
@section('painel')
    <form id="form-nota" class="modal-content bg-white rounded" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">{{ !$is_edit ? 'Adicionar nota' : 'Editar nota' }}</h5>
        </div>
        <div class="modal-body">
            <section id="form-component">
                @if ($is_edit)
                    <div class="mb-2">
                        <label for="aluno-input">Aluno</label>
                        <input type="search" value="{{ $nota->aluno->user->name }}" id="aluno-input" class="form-control"
                            disabled>
                    </div>
                    <div class="mb-2">
                        <label for="curso-input">Curso</label>
                        <input type="search" value="{{ $nota->curso_disciplina->curso->nome }}" id="curso-input"
                            class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="disciplina-input">Disciplina</label>
                        <input type="search" value="{{ $nota->curso_disciplina->disciplina->nome }}" id="disciplina-input"
                            class="form-control" disabled>
                    </div>
                @else
                    <div class="mb-2">
                        <label for="search-aluno">Digita o nome do aluno</label>
                        <input type="search" value="" id="search-aluno" class="form-control">
                    </div>
                    <div id="table-aluno-result"></div>
                    <hr/>
                    <div class="mb-2" id="curso_disciplina">
                        <label for="search-disciplina">Escolha a disciplina</label>
                    </div>
                    <div id="table-disciplina-result"></div>
                    <input type="hidden" name="aluno_id" id="aluno_join" value="" >
                    <div hidden>
                        <input type="hidden" name="" value="{{ route('alunos.ajax') }}" id="url-alunos">
                        <input type="hidden" name="" id="url-disciplina-curso" value="{{ route('disciplinas.ajax.jsonCurso') }}">
                    </div>
                @endif
                @include('components.import.nota')
            </section>
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-info rounded" href="{{ route('notas.index') }}">
                <i class="fas fa-arrow-left"></i>
                <span>voltar</span>
            </a>
            <button type="submit" class="btn btn-outline-primary rounded">
                <i class="fas fa-save"></i>
                <span id="span-operaction">Cadastra</span>
            </button>
        </div>
    </form>
@endsection
@section('script')
    @parent
    @if (!$is_edit)
        <script src="{{ asset('js/alert.js') }}"></script>
        <script src="{{ asset('js/ajax/alunos.js') }}"></script>
        <script src="{{ asset('js/ajax/disciplina_curso.js') }}"></script>
        <script src="{{ asset('js/search/alunos.js') }}"></script>
    @endif
@endsection
