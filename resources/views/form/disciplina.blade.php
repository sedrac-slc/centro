@extends('layouts.dashboard')
@php
    $is_edit = isset($disciplina);
    $data = ['rounded' => true];
    $method = $is_edit ? 'PUT' : 'POST';
@endphp
@section('painel')
    <form id="form-disciplina" class="modal-content bg-white rounded" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="modal-header">
            <h5 class="modal-title" id="modalUserTitle">{{ !$is_edit ? "Adicionar disciplina" : "Editar disciplina"}}</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="key" id="key" />
            @include('components.import.disciplina', $data)
        </div>
        <div class="modal-footer">
            <a class="btn btn-outline-info rounded" href="{{ route('disciplinas.index') }}">
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
