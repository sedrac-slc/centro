@extends('layouts.dashboard')
@php
    $is_edit = isset($user);
    $data = ['rounded' => true, 'user_tipo' => 'ADMINISTRADOR'];
    $method = $is_edit ? 'PUT' : 'POST';
    if ($is_edit) {
        $data['password_hidden'] = true;
    }
@endphp
@section('painel')
    <form id="form-user" class="modal-content bg-white rounded" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">{{ !$is_edit ? "Adicionar Utilizador" : "Editar utilizador"}}</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="key" id="key" />
            @include('components.import.utilizador', $data)
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-info rounded" href="{{ route('utilizadores.index') }}">
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
