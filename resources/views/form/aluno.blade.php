@extends('layouts.dashboard')
@php
    $is_edit = isset($aluno->user);
    $data = ['rounded' => true,'user_tipo' => 'ALUNO'];
    $method = $is_edit ? "PUT" : "POST";
    if($is_edit){
        $data['user'] = $aluno->user;
        $data['password_hidden'] = true;
    }
@endphp
@section('painel')
    <form id="form-user" class="modal-content bg-white rounded" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">{{ !$is_edit ? "Adicionar aluno" : "Editar aluno"}}</h5>
        </div>
        <div class="modal-body">
            @if (!$is_edit)
                <div class="mb-2">
                    <label for="search-aluno">Digita o curso</label>
                    <input type="search" value="" id="search-aluno" class="form-control">
                </div>
                <div id="table-curso-result"></div>
            @endif
            @include('components.import.utilizador', $data)
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
